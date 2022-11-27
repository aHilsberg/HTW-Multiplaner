<script setup lang="ts">
import { Link } from "@inertiajs/inertia-vue3";

import { useLoginForm } from "@/scripts/helpers/backendInteraction";
import Checkbox from "@/views/components/common/forms/checkbox.vue";
import InputError from "@/views/components/common/forms/inputError.vue";
import InputLabel from "@/views/components/common/forms/inputLabel.vue";
import PrimaryButton from "@/views/components/common/forms/primaryButton.vue";
import TextInput from "@/views/components/common/forms/textInput.vue";

defineProps<{
    status: string;
}>();

const { form, submit, validate } = useLoginForm();
</script>

<template layout="auth">
    <div v-if="!!status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>

    <form
        @submit.prevent="
            () =>
                submit({
                    onFinish: () => {
                        form.reset('password');
                    },
                    onError: (err) => {
                        console.log({ err });
                    },
                })
        "
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
                autocomplete="current-password"
            />
            <InputError class="mt-2" :message="form.errors.password" />
        </div>

        <div class="block mt-4">
            <label class="flex items-center">
                <Checkbox v-model="form.remember" name="remember" />
                <span class="ml-2 text-sm text-gray-600">Remember me</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4 gap-3">
            <Link
                :href="route('register')"
                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md"
            >
                No Account yet?
            </Link>

            <Link
                :href="route('password.request')"
                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md"
            >
                Forgot your password?
            </Link>

            <PrimaryButton
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Log in
            </PrimaryButton>
        </div>
    </form>
</template>
