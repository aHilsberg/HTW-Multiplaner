<script setup lang="ts">
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    DialogDescription,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { XMarkIcon } from "@heroicons/vue/24/outline";
import { useVModel } from "@vueuse/core";

const props = defineProps<{
    header: string;
    description?: string;
    open: boolean;
}>();

const emit = defineEmits(["close"]);
const isOpen = useVModel(props, "open", emit);
</script>

<template>
    <TransitionRoot :show="isOpen" as="template">
        <Dialog static as="div" @close="() => emit('close')">
            <!-- The backdrop, rendered as a fixed sibling to the panel container -->
            <div class="fixed inset-0 bg-black/30" aria-hidden="true" />

            <TransitionChild
                appear
                as="div"
                class="fixed inset-0 flex items-center justify-center"
            >
                <DialogPanel
                    as="div"
                    class="w-full max-w-sm rounded bg-white px-6 py-4 relative"
                >
                    <button
                        class="absolute right-5"
                        @click="() => emit('close')"
                    >
                        <XMarkIcon class="w-8 h-8 text-gray-700" />
                    </button>

                    <DialogTitle v-if="!!header" class="text-2xl">{{
                        header
                    }}</DialogTitle>
                    <DialogDescription v-if="!!description">{{
                        description
                    }}</DialogDescription>

                    <div>
                        <slot />
                    </div>
                </DialogPanel>
            </TransitionChild>
        </Dialog>
    </TransitionRoot>
</template>
