<script setup lang="ts">
import { useVModel } from "@vueuse/core";

const props = defineProps<{
    modelValue: string;
}>();

const emit = defineEmits(["update:modelValue"]);
const value = useVModel(props, "modelValue", emit);
</script>

<template>
    <input
        v-model="value"
        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
    />
</template>
