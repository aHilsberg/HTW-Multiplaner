<script setup lang="ts">
import {ChevronRightIcon} from '@heroicons/vue/24/outline'
import {Link} from '@inertiajs/inertia-vue3'
import {useOffsetPagination} from '@vueuse/core'

import useGlobal from '@/scripts/composables/useGlobal'
import {queryStudyGroupCall} from '@/scripts/helpers/backendInteraction'
import InputLabel from '@/views/components/common/forms/inputLabel.vue'
import PrimaryButton from '@/views/components/common/forms/primaryButton.vue'
import TextInput from '@/views/components/common/forms/textInput.vue'
import PaginationMenu from '@/views/components/common/pagination/paginationMenu.vue'

const props = defineProps<{ close: () => void }>()


const PAGE_COUNT = 10

const update = (currentPage: number) => {
    queryStudyGroupCall({
        data: {
            query: {
                study_group: {
                    id: studyGroup.value,
                    page_index: currentPage - 1,
                    page_count: PAGE_COUNT,
                },
            },
        },
        onSuccess: () => {
        },
    })
}

const studyGroup = ref('')

const studyGroupResults = computed(() => useGlobal().query?.studyGroup)
const {currentPage, isLastPage, isFirstPage, next, prev} =
    useOffsetPagination({
        total: computed(() => studyGroupResults.value?.count ?? 0),
        page: 1,
        pageSize: PAGE_COUNT,
        onPageChange: ({currentPage}) => update(currentPage),
    })

const submit = () => {
    currentPage.value = 0
    update(currentPage.value)
}
</script>

<template>
    <form @submit.prevent="submit">
        <InputLabel label="Studiengruppe" for="study-group-id"/>
        <TextInput
            id="study-group-id"
            v-model="studyGroup"
            placeholder="z.B. 21/041/62"
        />

        <PrimaryButton class="w-full my-2">
            <span class="mx-auto">Anzeigen</span>
        </PrimaryButton>
    </form>

    <ul class="divide-y divide-gray-200">
        <li
            v-for="studyGroup in studyGroupResults?.studyGroups"
            class="py-2 px-3 flex justify-between"
        >
            <span>{{ studyGroup.id }}</span>
            <Link href="/search" :data="{ study_group: studyGroup.id }" @click="close">
                <ChevronRightIcon class="w-6 h-6 text-gray-700"/>
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
