<script setup lang="ts">
import FlashItem from "./item.vue";

defineProps<{
    header: string;
    text: string;
    confirmAction: () => void;
    buttons?: { confirm: string; cancel: string };
}>();
</script>

<template>
    <FlashItem v-slot="{ closeFlash }">
        <div class="flex -m-4 divide-x divide-gray-200">
            <div class="p-4 flex-grow">
                <p class="text-sm font-medium text-gray-900">{{ header }}</p>
                <p class="mt-1 text-sm text-gray-500">
                    {{ text }}
                </p>
            </div>
            <div class="flex flex-col divide-y divide-gray-200">
                <div class="h-0 flex-1 flex">
                    <button
                        type="button"
                        class="w-full border border-transparent rounded-none rounded-tr-lg px-4 py-3 flex items-center justify-center text-sm font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:z-10 focus:ring-2 focus:ring-indigo-500"
                        @click="
                            () => {
                                closeFlash();
                                confirmAction();
                            }
                        "
                    >
                        {{ buttons?.confirm ?? "OK" }}
                    </button>
                </div>
                <div class="h-0 flex-1 flex">
                    <button
                        type="button"
                        class="w-full border border-transparent rounded-none rounded-br-lg px-4 py-3 flex items-center justify-center text-sm font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        @click="closeFlash"
                    >
                        {{ buttons?.cancel ?? "Dont allow" }}
                    </button>
                </div>
            </div>
        </div>
    </FlashItem>
</template>
