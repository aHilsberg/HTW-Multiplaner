<script setup lang="ts">
import {PlusIcon} from '@heroicons/vue/24/outline'
import CommonPopover from '@/views/components/common/headless/commonPopover.vue'


</script>

<template>
    <CommonPopover>
        <template #content>
            <menu class="grid grid-cols-1">
                <li>
                    <a href="/analytics">Neuer Tab</a>
                </li>
                <li>
                    <a href="/engagement">Neuer Termin</a>
                </li>
            </menu>
        </template>
        <template #button>
            <PlusIcon class="w-8 h-8"/>
        </template>

    </CommonPopover>

</template>
