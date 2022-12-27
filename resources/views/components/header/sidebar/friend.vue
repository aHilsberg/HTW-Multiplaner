<script setup lang="ts">
import { MinusIcon, XMarkIcon, CheckIcon } from "@heroicons/vue/24/outline";

import {
    acceptFriendshipCall,
    removeFriendshipCall,
} from "@/scripts/helpers/backendInteraction";
import {
    friendshipStatusText,
    friendshipStatusColor,
} from "@/scripts/helpers/basic";
import { FriendshipStatus, User } from "@/scripts/types/userRelationships";
import SidebarItem from "@/views/components/header/sidebar/sidebarItem.vue";

const props = defineProps<{
    friend: User & { friendshipState: FriendshipStatus };
}>();

const removeFriend = () =>
    removeFriendshipCall({ data: { friend_id: props.friend.id } });
const acceptFriend = () =>
    acceptFriendshipCall({ data: { friend_id: props.friend.id } });
</script>

<template>
    <SidebarItem
        class="flex items-center gap-2"
        :class="{
            '!bg-green-50':
                friend.friendshipState === FriendshipStatus.Befriended,
        }"
    >
        <div class="w-10 h-10 rounded-full bg-gray-200" />
        <span class="text-lg">{{ friend.name }}</span>

        <div class="mx-auto" />

        <span
            :class="friendshipStatusColor(friend.friendshipState)"
            class="ml-3"
        >
            {{ friendshipStatusText(friend.friendshipState) }}
        </span>

        <template v-if="friend.friendshipState === FriendshipStatus.Invited">
            <button>
                <CheckIcon class="w-6 h-6 text-green-400" @click="acceptFriend" />
            </button>
            <button>
                <XMarkIcon class="w-6 h-6 text-red-400" @click="removeFriend" />
            </button>
        </template>
        <template v-else>
            <button>
                <MinusIcon class="w-6 h-6 text-gray-700" @click="removeFriend" />
            </button>
        </template>
    </SidebarItem>
</template>
