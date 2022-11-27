<script setup lang="ts">
import {Link} from '@inertiajs/inertia-vue3'

import {useRegisterForm} from '@/scripts/helpers/backendInteraction'
import InputError from '@/views/components/common/forms/inputError.vue'
import InputLabel from '@/views/components/common/forms/inputLabel.vue'
import PrimaryButton from '@/views/components/common/forms/primaryButton.vue'
import TextInput from '@/views/components/common/forms/textInput.vue'

const {form, submit, validate} = useRegisterForm()
</script>

<template layout="auth">
    <form @submit.prevent="() => submit({ onFinish: () => {form.reset('password', 'password_confirmation')} })"
          @focusout="() => !form.processing && validate()"
    >
        <div>
            <InputLabel for="name" label="Name"/>
            <TextInput
                id="name" v-model="form.name" type="text" class="mt-1 block w-full" required autofocus
                autocomplete="name"
            />
            <InputError class="mt-2" :message="form.errors.name"/>
        </div>

        <div class="mt-4">
            <InputLabel for="email" label="Email"/>
            <TextInput
                id="email" v-model="form.email" type="email" class="mt-1 block w-full" required
                autocomplete="username"
            />
            <InputError class="mt-2" :message="form.errors.email"/>
        </div>

        <div class="mt-4">
            <InputLabel for="password" label="Password"/>
            <TextInput
                id="password" v-model="form.password" type="password" class="mt-1 block w-full" required
                autocomplete="new-password"
            />
            <InputError class="mt-2" :message="form.errors.password"/>
        </div>

        <div class="mt-4">
            <InputLabel for="password_confirmation" label="Confirm Password"/>
            <TextInput
                id="password_confirmation" v-model="form.password_confirmation" type="password"
                class="mt-1 block w-full" required autocomplete="new-password"/>
            <InputError
                class="mt-2"
                :message="form.errors.password_confirmation"
            />
        </div>

        <div class="flex items-center justify-end mt-4 gap-4">
            <Link :href="route('login')" class="text-sm text-gray-600">
                Already registered?
            </Link>

            <PrimaryButton
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Register
            </PrimaryButton>
        </div>
    </form>
</template>
