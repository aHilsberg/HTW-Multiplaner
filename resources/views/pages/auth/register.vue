<script setup lang="ts">
import {useRegisterForm} from '@/scripts/helpers/forms'
import InputError from '@/views/components/common/forms/inputError.vue'
import TextInput from '@/views/components/common/forms/textInput.vue'
import InputLabel from '@/views/components/common/forms/inputLabel.vue'
import PrimaryButton from '@/views/components/common/forms/primaryButton.vue'
import {Link} from '@inertiajs/inertia-vue3'

const {form, submit, validate} = useRegisterForm()
</script>

<template layout="auth">
    <form @submit.prevent="() => submit({ onFinish: () => {form.reset('password', 'password_confirmation')} })"
          @focusout="() => !form.processing && validate()">
        <div>
            <InputLabel for="name" label="Name"/>
            <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                       autocomplete="name"/>
            <InputError class="mt-2" :message="form.errors.name"/>
        </div>

        <div class="mt-4">
            <InputLabel for="email" label="Email"/>
            <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                       autocomplete="username"/>
            <InputError class="mt-2" :message="form.errors.email"/>
        </div>

        <div class="mt-4">
            <InputLabel for="password" label="Password"/>
            <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                       autocomplete="new-password"/>
            <InputError class="mt-2" :message="form.errors.password"/>
        </div>

        <div class="mt-4">
            <InputLabel for="password_confirmation" label="Confirm Password"/>
            <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                       v-model="form.password_confirmation" required autocomplete="new-password"/>
            <InputError class="mt-2" :message="form.errors.password_confirmation"/>
        </div>

        <div class="flex items-center justify-end mt-4 gap-4">
            <Link :href="route('login')" class="text-sm text-gray-600">
                Already registered?
            </Link>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Register
            </PrimaryButton>
        </div>
    </form>
</template>
