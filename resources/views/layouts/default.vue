<script setup lang="ts">
import AddNavButton from "@/views/components/layout/addNavButton.vue";
import AvatarButton from "@/views/components/layout/avatarButton.vue";
import TabNavHeader from "@/views/components/layout/tabNavHeader.vue";
import GlobalProvider from "@/views/layouts/globalProvider.vue";
</script>

<template>
    <GlobalProvider>
        <div>
            <nav class="flex flex-row justify-between">
                <TabNavHeader />
                <div>
                    <AddNavButton />
                    <button>MENU</button>
                    <AvatarButton />
                </div>
            </nav>

            <main class="w-full">
                <slot />
            </main>
        </div>
    </GlobalProvider>
</template>
