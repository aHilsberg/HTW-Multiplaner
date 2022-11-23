<script setup lang="ts">
import TabNavHeader from "@/views/components/layout/tabNavHeader.vue";
import AddNavButton from "@/views/components/layout/addNavButton.vue";
import AvatarButton from "@/views/components/layout/avatarButton.vue";
</script>

<template>
    <div class="min-h-screen">
        <nav class="">
            <TabNavHeader/>
            <div>
                <AddNavButton />
                <button>MENU</button>
                <AvatarButton />
            </div>
        </nav>

        <div class="w-full">
            <slot/>
        </div>
    </div>
</template>
