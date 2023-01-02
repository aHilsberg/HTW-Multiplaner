<script setup lang="ts">
import { useVModel } from "@vueuse/core";

import CommonSidebarModal from "@/views/components/common/headless/commonSidebarModal.vue";
import Events from "@/views/components/header/sidebar/events.vue";
import Friends from "@/views/components/header/sidebar/friends.vue";
import Groups from "@/views/components/header/sidebar/groups.vue";

const props = defineProps<{
    open: boolean;
}>();

const isOpen = useVModel(props, "open");
</script>

<template>
    <CommonSidebarModal v-model:open="isOpen">
        <div class="px-6 py-4">
            <Friends />
            <Groups />
            <Events />
        </div>
    </CommonSidebarModal>
</template>
