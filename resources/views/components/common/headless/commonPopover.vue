<script setup lang="ts">
import { Popover, PopoverButton, PopoverPanel } from "@headlessui/vue";
</script>

<template>
    <Popover class="relative">
        <PopoverButton class="flex items-center">
            <slot name="button" />
        </PopoverButton>
        <transition
            enter-active-class="transition duration-200 ease-out"
            enter-from-class="translate-y-1 opacity-0"
            enter-to-class="translate-y-0 opacity-100"
            leave-active-class="transition duration-150 ease-in"
            leave-from-class="translate-y-0 opacity-100"
            leave-to-class="translate-y-1 opacity-0"
        >
            <PopoverPanel class="absolute w-max right-0">
                <slot name="content" />
            </PopoverPanel>
        </transition>
    </Popover>
</template>
