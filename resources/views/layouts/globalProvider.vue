<script setup lang="ts">
import {usePage} from '@inertiajs/inertia-vue3'
import {inject, watchEffect} from 'vue'
import {flashKey, FlashProvides} from '@/scripts/plugins/flash.plugin'
import useUser from '@/scripts/composables/useUser'
import FlashContainer from '@/views/components/flash/container.vue'

const page = usePage<{
    auth: {
        user: {
            id: number,
            name: string,
            email: string,
        }
    },
    flash: {
        message: string
    }
}>()
const {createFlashMessage} = inject(flashKey) as FlashProvides

watchEffect(() => {
    const user = page.props.value.auth.user

    console.log({user})
    useUser().value = user;
})

watchEffect(
    () => {
        const flashString = page.props.value.flash.message

        if (!flashString || flashString.length === 0) return

        console.log({flashString})
        createFlashMessage(flashString)
    }
)
</script>


<template>
    <FlashContainer />
    {{ page.props.value.flash }}
    <slot/>
</template>
