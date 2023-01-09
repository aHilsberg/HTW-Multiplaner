<script setup lang="ts">
import { ChevronRightIcon } from "@heroicons/vue/24/outline";
import { Link } from "@inertiajs/inertia-vue3";
import { useOffsetPagination } from "@vueuse/core";

import useGlobal from "@/scripts/composables/useGlobal";
import { queryModuleCall } from "@/scripts/helpers/backendInteraction";
import InputLabel from "@/views/components/common/forms/inputLabel.vue";
import PrimaryButton from "@/views/components/common/forms/primaryButton.vue";
import TextInput from "@/views/components/common/forms/textInput.vue";
import PaginationMenu from "@/views/components/common/pagination/paginationMenu.vue";

const props = defineProps<{ close: () => void }>();

const PAGE_COUNT = 10;

const update = (currentPage: number) => {
    queryModuleCall({
        data: {
            query: {
                module: {
                    ...(faculty.value &&
                        faculty.value.length > 0 && {
                            faculty: faculty.value,
                        }),
                    ...(module.value &&
                        module.value.length > 0 && {
                            id: module.value,
                        }),
                    ...(lecturer.value &&
                        lecturer.value.length > 0 && {
                            lecturer: lecturer.value,
                        }),
                    page_index: currentPage - 1,
                    page_count: PAGE_COUNT,
                },
            },
        },
        onSuccess: () => {},
    });
};
const module = ref("");
const faculty = ref("");
const lecturer = ref("");

const moduleResults = computed(() => useGlobal().query?.module);
const { currentPage, isLastPage, isFirstPage, next, prev } =
    useOffsetPagination({
        total: computed(() => moduleResults.value?.count ?? 0),
        page: 1,
        pageSize: PAGE_COUNT,
        onPageChange: ({ currentPage }) => update(currentPage),
    });

const submit = () => {
    currentPage.value = 0;
    update(currentPage.value);
};
</script>

<template>
    <form class="flex flex-col" @submit.prevent="submit">
        <InputLabel label="Modulnummer" for="module-id" />
        <TextInput id="module-id" v-model="module" placeholder="z.B. I110" />
        <InputLabel label="Fakultät" for="module-faculty" />
        <TextInput
            id="module-faculty"
            v-model="faculty"
            placeholder="z.B. Mathematik/Informatik"
        />
        <InputLabel label="Professor" for="module-lecturer" />
        <TextInput
            id="module-lecturer"
            v-model="lecturer"
            placeholder="z.B. Prof. Hollas"
        />

        <PrimaryButton class="w-full my-2">
            <span class="mx-auto">Anzeigen</span>
        </PrimaryButton>
    </form>

    <ul class="divide-y divide-gray-200">
        <li
            v-for="module in moduleResults?.modules"
            class="py-2 px-3 flex justify-between"
        >
            <span>{{ module.id }}</span>
            <Link href="/search" :data="{ module: module.id }" @click="close">
                <ChevronRightIcon class="w-6 h-6 text-gray-700" />
            </Link>
        </li>
    </ul>
    <PaginationMenu
        :current-page="currentPage"
        :is-first-page="isFirstPage"
        :is-last-page="isLastPage"
        :next="next"
        :prev="prev"
        class="mt-2"
    />
</template>
