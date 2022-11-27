<script setup lang="ts">
import { inject } from "vue";

import { flashKey, FlashProvides } from "@/scripts/plugins/flash.plugin";

defineProps<{ flashId?: number }>();

const { closeFlash } = inject(flashKey) as FlashProvides;
</script>

<template>
    <transition
        enter-active-class="transform ease-out duration-300 transition"
        enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
        enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
        leave-active-class="transition ease-in duration-100"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
    >
        <div
            v-bind="$attrs"
            :class="[
                'max-w-sm w-full shadow-lg rounded-lg pointer-events-auto ring-1 ring-gray-500 ring-opacity-[0.02] overflow-hidden',
                !/(^|\s)bg-/.test($attrs.class) && 'bg-white',
            ]"
        >
            <div class="p-4">
                <slot :close-flash="() => closeFlash(flashId)"></slot>
            </div>
        </div>
    </transition>
</template>
