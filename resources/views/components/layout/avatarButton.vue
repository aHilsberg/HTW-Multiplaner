<script setup lang="ts">
import { Link } from "@inertiajs/inertia-vue3";

import useGlobal from "@/scripts/composables/useGlobal";

const user = useGlobal().user;
</script>

<template>
    <template v-if="!!user">
        {{ user.name }}
        <Link
            :href="route('logout')"
            method="post"
            as="button"
            class="underline text-sm text-gray-600"
            >Log Out</Link
        >
        <Link
            :href="route('profile')"
            method="get"
            as="button"
            class="ml-2 underline text-sm text-gray-600"
            >Profile</Link
        >
    </template>
    <template v-else>
        <Link :href="route('login')">Login</Link>
    </template>
</template>
