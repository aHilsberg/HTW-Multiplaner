<script setup lang="ts">
import {useVModel} from '@vueuse/core'

const props = defineProps<{
    modelValue: boolean
}>()

const emit = defineEmits(['update:modelValue'])

const value = useVModel(props, 'modelValue', emit)
</script>

<template>
    <input type="checkbox" v-model="value"
           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
</template>
