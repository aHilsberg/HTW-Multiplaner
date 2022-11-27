<script setup lang="ts">
import GlobalProvider from "@/views/layouts/globalProvider.vue";
</script>

<template>
    <div
        class="min-h-screen grid items-center justify-center px-5 sm:px-12 lg:px-24"
    >
        <main class="max-w-md sm:max-w-xl">
            <slot />
        </main>
    </div>
</template>
