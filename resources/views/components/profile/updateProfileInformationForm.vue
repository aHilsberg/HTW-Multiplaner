<script setup lang="ts">
import {useUpdateProfileForm} from '@/scripts/helpers/forms'
import InputLabel from '@/views/components/common/forms/inputLabel.vue'
import TextInput from '@/views/components/common/forms/textInput.vue'
import InputError from '@/views/components/common/forms/inputError.vue'
import PrimaryButton from '@/views/components/common/forms/primaryButton.vue'
import  {Link} from '@inertiajs/inertia-vue3'

const props = defineProps<{
    mustVerifyEmail: boolean,
    status?: string,
}>()

const {form, submit, validate} =useUpdateProfileForm()
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Profile Information</h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Update your account's profile information and email
                address.</p>
        </header>

        <form @submit.prevent="submit" @focusout="() => !form.processing && validate()" class="mt-6 space-y-6">
            <div>
                <InputLabel for="name" label="Name"/>
                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                           autocomplete="name"/>
                <InputError class="mt-2" :message="form.errors.name"/>
            </div>

            <div>
                <InputLabel for="email" label="Email"/>
                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                           autocomplete="email"/>
                <InputError class="mt-2" :message="form.errors.email"/>
            </div>

            <div v-if="props.mustVerifyEmail">
                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                    Your email address is unverified.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    >
                        Click here to re-send the verification email.
                    </Link>
                </p>
                <div v-show="props.status === 'verification-link-sent'"
                     class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                    A new verification link has been sent to your email address.
                </div>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>
                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
