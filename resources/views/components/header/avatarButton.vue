<script setup lang="ts">
import {UserCircleIcon} from '@heroicons/vue/24/outline'
import {Link} from '@inertiajs/inertia-vue3'

import useGlobal from '@/scripts/composables/useGlobal'
import CommonPopover from '@/views/components/common/headless/commonPopover.vue'

const user = useGlobal().user
</script>

<template>
    <template v-if="!!user">
        <CommonPopover>
            <template #content>
                <menu class="grid grid-cols-1">
                    <li>
                        <Link
                            :href="route('profile')"
                            method="get"
                            as="button"
                            class="ml-2 underline text-sm text-gray-600"
                        >
                            Profile
                        </Link>
                    </li>
                    <li>
                        <Link
                            :href="route('logout')"
                            method="post"
                            as="button"
                            class="underline text-sm text-gray-600"
                        >
                            Log Out
                        </Link>
                    </li>
                </menu>
            </template>
            <template #button>
                <UserCircleIcon class="w-8 h-8"/>
            </template>
        </CommonPopover>
    </template>

    <template v-else>
        <Link :href="route('login')">Login</Link>
    </template>
</template>
