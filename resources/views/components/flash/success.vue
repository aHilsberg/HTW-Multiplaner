<script setup lang="ts">
import { CheckCircleIcon } from '@heroicons/vue/24/solid'
import { XMarkIcon } from '@heroicons/vue/24/solid'

import FlashItem from './item.vue'

defineProps<{ header: string; text: string }>()
</script>

<template>
  <FlashItem
    v-slot="{ closeFlash }"
    class="bg-green-50"
    data-cy="alert-success"
  >
    <div :class="['flex', !text && 'items-center']">
      <div class="flex-shrink-0">
        <CheckCircleIcon class="h-6 w-6 text-green-400" aria-hidden="true" />
      </div>
      <div class="ml-3 w-0 flex-1 pt-0.5">
        <p class="text-sm font-medium text-green-800">{{ header ?? '' }}</p>
        <p class="mt-1 text-sm text-gray-500">
          {{ text ?? '' }}
        </p>
      </div>
      <div class="ml-4 flex-shrink-0 flex">
        <div class="-mx-1 -my-1">
          <button
            type="button"
            class="inline-flex bg-green-50 rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-50 focus:ring-green-600"
            @click="closeFlash()"
          >
            <span class="sr-only">Dismiss</span>
            <XMarkIcon class="h-5 w-5" aria-hidden="true" />
          </button>
        </div>
      </div>
    </div>
  </FlashItem>
</template>
