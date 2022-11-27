<script setup lang="ts">
import UpdateProfileInformationForm from '@/views/components/profile/updateProfileInformationForm.vue'
import UpdatePasswordForm from '@/views/components/profile/updatePasswordForm.vue'
import DeleteUserForm from '@/views/components/profile/deleteUserForm.vue'

defineProps<{
    mustVerifyEmail: boolean,
    status?: string,
}>()
</script>

<template layout="auth">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Profile
    </h2>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <UpdateProfileInformationForm
                    :must-verify-email="mustVerifyEmail"
                    :status="status"
                    class="max-w-xl"
                />
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <UpdatePasswordForm class="max-w-xl"/>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <DeleteUserForm class="max-w-xl"/>
            </div>
        </div>
    </div>
</template>
