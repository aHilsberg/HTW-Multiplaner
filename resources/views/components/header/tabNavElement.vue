<script setup lang="ts">
import { Tab } from "@headlessui/vue";
import { XMarkIcon } from "@heroicons/vue/24/outline";
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps<{
    href: string;
    lastTab: boolean;
}>();

const name = computed(() => {
    if (props.href === "/") return "Eigener Stundenplan";

    return "TODO";
});

defineEmits(["close"]);
</script>

<template>
    <!-- Use the `selected` state to conditionally style the selected tab. -->
    <Tab v-slot="{ selected }" as="template">
        <Link
            :href="href"
            as="ul"
            class="flex items-center gap-2 pl-4 pr-2 py-1 border border-gray-800"
            :class="{ 'bg-gray-50': !selected, ' rounded-tr-xl': lastTab }"
        >
            <span class="text-md mr-1">{{ name }}</span>

            <button v-if="href !== '/'" @click.prevent="$emit('close')">
                <XMarkIcon class="w-4 h-4 text-gray-600" />
            </button>
        </Link>
    </Tab>
</template>
