<script setup lang="ts">
import {PlusIcon} from "@heroicons/vue/24/outline";
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue';
import CommonPopover from "@/views/components/common/headless/commonPopover.vue";


</script>

<template>
    <CommonPopover>
        <template #content>

            <div class="grid grid-cols-1">
                <a href="/analytics">Neuer Tab</a>
                <a href="/engagement">Neuer Termin</a>
            </div>
        </template>
        <template #button>
                <PlusIcon />
        </template>

    </CommonPopover>

</template>
