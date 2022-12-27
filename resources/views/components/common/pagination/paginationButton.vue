<script setup lang="ts">
defineProps<{ active: boolean, current: boolean }>()
</script>

<template>
    <button class="px-2 py-1 border border-gray-200 bg-gray-50 text-gray-500" :class="{'bg-white text-gray-200': !active, 'text-gray-900': current}" :disabled="!active">
        <slot/>
    </button>
</template>
