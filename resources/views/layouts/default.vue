<script setup lang="ts">
import AvatarButton from "@/views/components/header/avatarButton.vue";
import DownloadButton from "@/views/components/header/downloadButton.vue";
import PlusButton from "@/views/components/header/plusButton.vue";
import SidebarButton from "@/views/components/header/sidebar/sidebarButton.vue";
import TabNavHeader from "@/views/components/header/tabNavHeader.vue";
import UploadButton from "@/views/components/header/uploadButton.vue";
import GlobalProvider from "@/views/layouts/globalProvider.vue";
</script>

<template>
    <GlobalProvider>
        <div>
            <nav
                class="flex items-center justify-between border-b border-gray-200 mt-1"
            >
                <TabNavHeader />
                <div class="flex px-8 py-2 gap-3 items-center">
                    <DownloadButton />
                    <UploadButton />
                    <PlusButton />
                    <SidebarButton />
                    <AvatarButton />
                </div>
            </nav>

            <main class="w-full">
                <slot />
            </main>
        </div>
    </GlobalProvider>
</template>
