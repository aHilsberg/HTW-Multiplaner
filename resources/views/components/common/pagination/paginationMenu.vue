<script setup lang="ts">
import { ArrowLeftIcon, ArrowRightIcon } from "@heroicons/vue/24/outline";

import PaginationButton from "@/views/components/common/pagination/paginationButton.vue";

const props = defineProps<{
    currentPage: number;
    isFirstPage: boolean;
    isLastPage: boolean;
    prev: () => void;
    next: () => void;
}>();
</script>

<template>
    <div class="flex gap-2 justify-center">
        <PaginationButton :active="!isFirstPage" :current="false" @click="prev">
            <ArrowLeftIcon class="w-4 h-4" />
        </PaginationButton>
        <PaginationButton :current="true" :active="true">
            {{ currentPage }}
        </PaginationButton>
        <PaginationButton :active="!isLastPage" :current="false" @click="next">
            <ArrowRightIcon class="w-4 h-4" />
        </PaginationButton>
    </div>
</template>
