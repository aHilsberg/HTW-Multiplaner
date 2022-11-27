<script setup lang="ts">
import {usePage} from '@inertiajs/inertia-vue3'
import {inject, watchEffect} from 'vue'
import {flashKey, FlashProvides} from '@/scripts/plugins/flash.plugin'
import FlashContainer from '@/views/components/flash/container.vue'
import useGlobal from '@/scripts/composables/useGlobal'
import {ExtendedUser, FriendshipStatus, User} from '@/scripts/types/userRelationships'

const page = usePage<{
    auth: {
        user: ExtendedUser
    },
    flash: {
        message: string
    },
    data: {
        relationships: {
            friends: (User & { friendship: { friendship_state: FriendshipStatus } })[]
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

    useGlobal().friends = friends.map(friend => {
        const state = friend.friendship.friendship_state
        return {...friend, friendshipState: state} as (User & { friendshipState: FriendshipStatus })
    })
})
</script>


<template>
    <FlashContainer/>
    <slot/>

    <div class="px-12 py-6">
        {{ page.props.value.data.relationships }}

        <span><br/>---------------------------<br/></span>

        {{ JSON.stringify(useGlobal()) }}
    </div>
</template>
