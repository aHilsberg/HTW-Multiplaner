<script setup lang="ts">
import { inject } from 'vue'

import { flashKey, FlashProvides } from '@/scripts/plugins/flash.plugin'

const { activeMessages } = inject(flashKey) as FlashProvides
</script>

<template>
  <teleport to="body">
    <div
      aria-live="assertive"
      class="fixed inset-0 flex items-end px-4 py-6 pointer-events-none sm:p-6 sm:items-start z-50"
    >
      <div class="w-full flex flex-col items-center space-y-4 sm:items-end">
        <template v-for="message in activeMessages" :key="message.id">
          <component
            :is="message.component"
            v-bind="message.attrs"
            :flash-id="message.id"
          />
        </template>
      </div>
    </div>
  </teleport>
</template>
