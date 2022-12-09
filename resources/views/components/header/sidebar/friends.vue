<script setup lang="ts">
import {PlusSmallIcon} from '@heroicons/vue/24/outline'
import {useRequestFriendshipForm} from '@/scripts/helpers/backendInteraction'
import TextInput from '@/views/components/common/forms/textInput.vue'
import useGlobal from '@/scripts/composables/useGlobal'
import Friend from '@/views/components/header/sidebar/friend.vue'
import SidebarSection from '@/views/components/header/sidebar/sidebarSection.vue'
import {flashKey} from '@/scripts/plugins/flash.plugin'

const {createErrorMessage} = inject(flashKey)!
const friends = computed(() => useGlobal().friends)

const showForm = ref(false)
const {form, validate, submit: submitFriendship} = useRequestFriendshipForm()

const submit = () => {
    submitFriendship({
        onSuccess: () => {
            showForm.value = false
        },
        onError: (err) => {
            createErrorMessage(err)
        },
    })
}
</script>

<template>
    <SidebarSection>
        <template #header>
            <h4 class="text-xl font-semibold">Friends</h4>
            <form v-show="showForm" @submit.prevent="submit" class="flex-grow">
                <TextInput
                    v-model="form.name"
                    :class="{ 'text-red-400': !!form.errors.name }"
                    class="w-full"
                    autofocus
                    placeholder="Freundschaftsanfrage an ..."
                    @input="form.errors.name = undefined"
                />
            </form>
            <PlusSmallIcon v-show="!showForm" class="w-6 h-6" @click="showForm = true"/>
        </template>
        <template #content>
            <Friend v-for="friend in friends" :key="friend.id" :friend="friend"/>
        </template>
    </SidebarSection>
</template>
