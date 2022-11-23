<script setup lang="ts">
import { InformationCircleIcon } from '@heroicons/vue/24/outline'

import FlashItem from './item.vue'

defineProps<{ header: string; text: string }>()
</script>

<template>
  <FlashItem class="bg-blue-50">
    <div class="flex">
      <div class="flex-shrink-0">
        <InformationCircleIcon
          class="h-5 w-5 text-blue-400"
          aria-hidden="true"
        />
      </div>
      <div class="ml-3 flex-1 md:flex md:justify-between">
        <p class="text-sm text-blue-700">
          {{ header }}
        </p>
        <p v-if="text" class="mt-3 text-sm md:mt-0 md:ml-6">
          <a
            href="#"
            class="whitespace-nowrap font-medium text-blue-700 hover:text-blue-600"
            >{{ text }} <span aria-hidden="true">&rarr;</span></a
          >
        </p>
      </div>
    </div>
  </FlashItem>
</template>
