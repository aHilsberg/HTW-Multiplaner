<script setup lang="ts">
import { XCircleIcon } from "@heroicons/vue/24/outline";

import FlashItem from "./item.vue";

defineProps<{ header: string; text: string }>();
</script>

<template>
    <FlashItem class="bg-red-50">
        <div :class="['flex', !text && 'items-center']">
            <div class="flex-shrink-0">
                <XCircleIcon class="h-5 w-5 text-red-400" aria-hidden="true" />
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">
                    {{ header }}
                </h3>
                <div class="mt-2 text-sm text-red-700">
                    <ul role="list" class="list-disc pl-5 space-y-1">
                        <li
                            v-for="(err, index) in text?.split('\\-') ?? []"
                            :key="index"
                        >
                            {{ err }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </FlashItem>
</template>
