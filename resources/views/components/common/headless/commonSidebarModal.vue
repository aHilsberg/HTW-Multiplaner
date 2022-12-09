<script setup lang="ts">
import {XMarkIcon} from '@heroicons/vue/24/outline'
import {
    Dialog,
    DialogPanel,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue'
import {useVModel} from '@vueuse/core'


const props = defineProps<{
    open: boolean
}>()

const isOpen = useVModel(props, 'open')

const close = () => {
    if (!isOpen.value) return
    isOpen.value = false
}
</script>

<template>
    <TransitionRoot :show="isOpen" as="template">
        <Dialog static as="div" @close="close" class="fixed inset-0">
            <TransitionChild
                appear
                as="template"
                enter-from="translate-x-full"
                enter-to="translate-x-0"
                leave-from="translate-x-0"
                leave-to="translate-x-full"
            >
                <DialogPanel
                    as="div"
                    class="fixed bg-white w-[min(25rem,100%)] top-20 bottom-12 right-0 shadow-xl rounded-l-xl md:border-l-2 border-y flex flex-col transition-transform ease-in-out duration-200 overflow-y-scroll scrollbar-hide z-10"
                >
                    <button @click="close" class="absolute right-1 top-1">
                        <XMarkIcon class="w-8 h-8 text-gray-700"/>
                    </button>
                    <slot />
                </DialogPanel>
            </TransitionChild>
        </Dialog>
    </TransitionRoot>
</template>


<style>
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}

/* For IE, Edge and Firefox */
.scrollbar-hide {
    -ms-overflow-style: none; /* IE and Edge */
    scrollbar-width: none; /* Firefox */
}
</style>
