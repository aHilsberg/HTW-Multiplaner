<script setup lang="ts">
import { useConfirmPasswordForm } from "@/scripts/helpers/backendInteraction";
import InputError from "@/views/components/common/forms/inputError.vue";
import InputLabel from "@/views/components/common/forms/inputLabel.vue";
import PrimaryButton from "@/views/components/common/forms/primaryButton.vue";
import TextInput from "@/views/components/common/forms/textInput.vue";

const { form, submit } = useConfirmPasswordForm();
</script>

<template layout="auth">
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        This is a secure area of the application. Please confirm your password
        before continuing.
    </div>

    <form
        @submit.prevent="
            () =>
                submit({
                    onFinish: () => {
                        form.reset();
                    },
                })
        "
    >
        <div>
            <InputLabel for="password" value="Password" />
            <TextInput
                id="password"
                v-model="form.password"
                type="password"
                class="mt-1 block w-full"
                required
                autocomplete="current-password"
                autofocus
            />
            <InputError class="mt-2" :message="form.errors.password" />
        </div>

        <div class="flex justify-end mt-4">
            <PrimaryButton
                class="ml-4"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Confirm
            </PrimaryButton>
        </div>
    </form>
</template>
