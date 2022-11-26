<script setup lang="ts">
defineProps<{
    label?: string
}>()
</script>

<template>
    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">
        <span v-if="label">{{ label }}</span>
        <span v-else><slot /></span>
    </label>
</template>
