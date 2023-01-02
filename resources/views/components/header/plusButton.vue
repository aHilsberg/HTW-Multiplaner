<script setup lang="ts">
import { PlusIcon } from "@heroicons/vue/24/outline";

import CommonPopover from "@/views/components/common/headless/commonPopover.vue";
import SearchModal from "@/views/components/header/search/searchModal.vue";

const openSearchModal = ref(false);
</script>

<template>
    <CommonPopover>
        <template #content>
            <menu
                class="grid grid-cols-1 w-auto content-center shadow-lg border border-inherit divide-y text-m text-gray-600 box-content h-8 w-8 p-4"
            >
                <li>
                    <button @click="openSearchModal = true">Neuer Tab</button>
                </li>
                <li>
                    <a href="/engagement">Neuer Termin</a>
                </li>
            </menu>
        </template>
        <template #button>
            <PlusIcon class="w-8 h-8 hover:scale-110 transition-transform" />
        </template>
    </CommonPopover>

    <SearchModal v-model:open="openSearchModal" />
</template>
