<script setup lang="ts">
import { ExclamationCircleIcon } from '@heroicons/vue/24/outline'

import FlashItem from './item.vue'

defineProps<{ header: string; text: string }>()
</script>

<template>
  <FlashItem class="bg-yellow-50" data-cy="alert-warning">
    <div :class="['flex', !text && 'items-center']">
      <div class="flex-shrink-0">
        <ExclamationCircleIcon class="h-5 w-5 text-yellow-400" aria-hidden="true" />
      </div>
      <div class="ml-3">
        <h3 class="text-sm font-medium text-yellow-800">{{ header }}</h3>
        <div class="mt-2 text-sm text-yellow-700">
          <p>
            {{ text }}
          </p>
        </div>
      </div>
    </div>
  </FlashItem>
</template>
