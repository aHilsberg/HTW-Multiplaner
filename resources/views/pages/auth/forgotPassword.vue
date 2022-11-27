<script setup lang="ts">
import { useForgotPasswordForm } from "@/scripts/helpers/backendInteraction";
import InputError from "@/views/components/common/forms/inputError.vue";
import InputLabel from "@/views/components/common/forms/inputLabel.vue";
import PrimaryButton from "@/views/components/common/forms/primaryButton.vue";
import TextInput from "@/views/components/common/forms/textInput.vue";

defineProps<{
    status: string;
}>();

const { form, submit } = useForgotPasswordForm();
</script>

<template layout="auth">
    <div class="mb-4 text-sm text-gray-600">
        Forgot your password? No problem. Just let us know your email address
        and we will email you a password reset link that will allow you to
        choose a new one.
    </div>

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>

    <form @submit.prevent="submit">
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

        <div class="flex items-center justify-end mt-4">
            <PrimaryButton
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Email Password Reset Link
            </PrimaryButton>
        </div>
    </form>
</template>
