<script setup lang="ts">
import {Dialog, DialogPanel, DialogTitle, DialogDescription} from '@headlessui/vue'
import DangerButton from '@/views/components/common/forms/dangerButton.vue'
import {nextTick, ref} from 'vue'
import {useDeleteProfileForm} from '@/scripts/helpers/backendInteraction'
import SecondaryButton from '@/views/components/common/forms/secondaryButton.vue'
import InputLabel from '@/views/components/common/forms/inputLabel.vue'
import TextInput from '@/views/components/common/forms/textInput.vue'
import InputError from '@/views/components/common/forms/inputError.vue'
import CommonModal from '@/views/components/common/headless/CommonModal.vue'

const isOpen = ref(false)

const {form, submit} = useDeleteProfileForm()

const confirmUserDeletion = () => {
    isOpen.value = true
}

const deleteUser = () => {
    submit({
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onFinish: () => form.reset(),
    })
}

const closeModal = () => {
    isOpen.value = false
    form.reset()
}
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900">Delete Account</h2>
            <p>Once your account is deleted, all of its resources
                and data will be permanently deleted. Before deleting your account, please download any data or
                information that you wish to retain.</p>
        </header>

        <DangerButton @click="confirmUserDeletion">
            Delete Account
        </DangerButton>
        {{ isOpen }}
        <CommonModal
            :open="isOpen"
            @close="closeModal"
            class="relative"
            header="Are you sure your want to delete your account?"
            description="
                Once your account is deleted, all of its
                resources and data will be permanently deleted. Please enter your password to confirm you would like
                to permanently delete your account."
        >
            <div>
                <InputLabel for="password" value="Password" class="sr-only"/>
                <TextInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="Password"
                    @keyup.enter="deleteUser"
                    autofocus
                />
                <InputError :message="form.errors.password" class="mt-2"/>
            </div>

            <div class="mt-6 flex justify-end">
                <SecondaryButton @click="closeModal">
                    Cancel
                </SecondaryButton>

                <DangerButton
                    class="ml-3"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click="deleteUser"
                >
                    Delete Account
                </DangerButton>
            </div>
        </CommonModal>
    </section>
</template>
