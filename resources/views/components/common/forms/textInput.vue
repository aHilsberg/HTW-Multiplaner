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
        class="border border-gray-200 ring-indigo-500 focus:ring-2 !outline-none rounded-md px-1.5 py-1"
    />
</template>
