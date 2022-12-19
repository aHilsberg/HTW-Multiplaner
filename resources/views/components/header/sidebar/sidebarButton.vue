<script setup lang="ts">
import { Bars3Icon } from "@heroicons/vue/24/outline";

import Sidebar from "@/views/components/header/sidebar/sidebar.vue";

const modalOpen = ref(false);


</script>

<template>
    <button
        class="text-gray-700 hover:scale-110 transition-transform"
        @click="modalOpen = true"
    >
        <Bars3Icon class="w-8 h-8" />
    </button>

    <Sidebar v-model:open="modalOpen" />
</template>
