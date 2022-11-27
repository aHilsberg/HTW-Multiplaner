<script setup lang="ts">
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    DialogDescription,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { XIcon } from "@heroicons/vue/solid";
import { useVModel } from "@vueuse/core";

import CommonButton from "@/views/components/common/CommonButton.vue";

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
                <DialogPanel as="div" class="w-full max-w-sm rounded bg-white">
                    <DialogTitle v-if="!!header">{{ header }}</DialogTitle>
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
