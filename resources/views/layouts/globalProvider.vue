<script setup lang="ts">
import {usePage} from '@inertiajs/inertia-vue3'
import {inject, watchEffect} from 'vue'
import {flashKey, FlashProvides} from '@/scripts/plugins/flash.plugin'
import FlashContainer from '@/views/components/flash/container.vue'
import useGlobal from '@/scripts/composables/useGlobal'

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
    useGlobal().user = user;
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
    <slot/>
</template>
