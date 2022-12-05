<script setup lang="ts">
import { useResetPasswordForm } from "@/scripts/helpers/backendInteraction";
import InputError from "@/views/components/common/forms/inputError.vue";
import InputLabel from "@/views/components/common/forms/inputLabel.vue";
import PrimaryButton from "@/views/components/common/forms/primaryButton.vue";
import TextInput from "@/views/components/common/forms/textInput.vue";

const props = defineProps<{
    token: string;
    email: string;
}>();

const { form, submit, validate } = useResetPasswordForm(
    props.token,
    props.email
);
</script>

<template layout="auth">
    <form
"
        @submit.prevent="() => submit({onFinish: () => {form.reset('password', 'password_confirmation')}})"
        @focusout="() => !form.processing && validate()"
    >
        <div>
            <InputLabel for="email" label="Email" />
            <TextInput
                id="email"
                v-model="form.email"
                type="email"
                class="mt-1 block w-full"
                required
                autofocus
                autocomplete="username"
            />
            <InputError class="mt-2" :message="form.errors.email" />
        </div>

        <div class="mt-4">
            <InputLabel for="password" label="Password" />
            <TextInput
                id="password"
                v-model="form.password"
                type="password"
                class="mt-1 block w-full"
                required
                autocomplete="new-password"
            />
            <InputError class="mt-2" :message="form.errors.password" />
        </div>

        <div class="mt-4">
            <InputLabel for="password_confirmation" label="Confirm Password" />
            <TextInput
                id="password_confirmation"
                v-model="form.password_confirmation"
                type="password"
                class="mt-1 block w-full"
                required
                autocomplete="new-password"
            />
            <InputError
                class="mt-2"
                :message="form.errors.password_confirmation"
            />
        </div>

        <div class="flex items-center justify-end mt-4">
            <PrimaryButton
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Reset Password
            </PrimaryButton>
        </div>
    </form>
</template>
