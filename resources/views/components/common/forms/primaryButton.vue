<script setup lang="ts">
defineProps<{
    type?: 'button' | 'reset' | 'submit'
}>()
</script>

<template>
    <button :type="type ?? 'submit'"
            class="inline-flex items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
        <slot/>
    </button>
</template>
