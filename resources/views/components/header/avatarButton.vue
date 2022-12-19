<script setup lang="ts">
import { UserCircleIcon } from "@heroicons/vue/24/outline";
import { Link } from "@inertiajs/inertia-vue3";

import useGlobal from "@/scripts/composables/useGlobal";
import CommonPopover from "@/views/components/common/headless/commonPopover.vue";

const user = useGlobal().user;
</script>

<template>
    <template v-if="!!user">
        <CommonPopover>
            <template #content>
                <menu
                    class="w-20 grid grid-cols-1 content-center shadow-lg box-content h-8 w-8 p-4 divide-y"
                >
                    <li>
                        <Link
                            :href="route('profile')"
                            method="get"
                            as="button"
                            class="ml-4 text-m text-gray-600"
                        >
                            Profile
                        </Link>
                    </li>
                    <li>
                        <Link
                            :href="route('logout')"
                            method="post"
                            as="button"
                            class="ml-2.5 text-m text-gray-600"
                        >
                            Log Out
                        </Link>
                    </li>
                </menu>
            </template>
            <template #button>
                <UserCircleIcon
                    class="w-8 h-8 hover:scale-110 transition-transform"
                />
            </template>
        </CommonPopover>
    </template>

    <template v-else>
        <Link :href="route('login')">Login</Link>
    </template>
</template>
