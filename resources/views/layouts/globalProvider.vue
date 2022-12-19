<script setup lang="ts">
import {usePage} from '@inertiajs/inertia-vue3'
import {inject, watchEffect} from 'vue'

import useGlobal from '@/scripts/composables/useGlobal'
import {flashKey, FlashProvides} from '@/scripts/plugins/flash.plugin'
import {
    ExtendedUser,
    FriendshipStatus,
    Group,
    User,
    Event, StudyGroup,
} from '@/scripts/types/userRelationships'
import FlashContainer from '@/views/components/flash/container.vue'

const page = usePage<{
    auth: {
        user: ExtendedUser;
    };
    flash: {
        message: string;
    };
    data: {
        relationships: {
            friends: (User & {
                friendship: { friendship_state: FriendshipStatus };
            })[];
            groups: Group[];
            events: Event[];
        };
    };
    query: {
        studyGroup: {
            studyGroups?: StudyGroup[]
            count: number
        }
    }
}>()
const {createFlashMessage} = inject(flashKey) as FlashProvides

watchEffect(() => {
    const user = page.props.value.auth.user

    console.log({user})
    useGlobal().user = user
})

watchEffect(() => {
    const flashString = page.props.value.flash.message

    if (!flashString || flashString.length === 0) return

    console.log({flashString})
    createFlashMessage(flashString)
})

watchEffect(() => {
    const friends = page.props.value.data.relationships.friends

    useGlobal().friends = friends.map((friend) => {
        const state = friend.friendship.friendship_state
        return {...friend, friendshipState: state} as User & {
            friendshipState: FriendshipStatus;
        }
    })
})

watchEffect(() => {
    useGlobal().groups = page.props.value.data.relationships.groups
})
watchEffect(() => {
    useGlobal().events = page.props.value.data.relationships.events
})
watchEffect(() => {
    useGlobal().query = page.props.value.query
})
</script>

<template>
    <FlashContainer/>
    <slot/>

    <div class="px-12 py-6">
        {{ JSON.stringify(useGlobal()) }}
    </div>
</template>
