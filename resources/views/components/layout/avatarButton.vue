<script setup lang="ts">
import useUser, {isLoggedIn} from '@/scripts/composables/useUser'
import  { Link} from '@inertiajs/inertia-vue3'

const user = useUser()
</script>


<template>
    <div v-if="isLoggedIn()">
        {{ user.name }}
        <Link :href="route('logout')" method="post" as="button" class="underline text-sm text-gray-600">Log Out</Link>
    </div>
    <Link  v-else :href="route('register')">NO</Link>
</template>
