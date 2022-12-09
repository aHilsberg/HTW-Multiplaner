<script setup lang="ts">

import CommonSidebarModal from '@/views/components/common/headless/commonSidebarModal.vue'
import {useVModel} from '@vueuse/core'
import Friends from '@/views/components/header/sidebar/friends.vue'


const props = defineProps<{
    open: boolean
}>()


const isOpen = useVModel(props, 'open')
</script>


<template>
    <CommonSidebarModal v-model:open="isOpen">
        <div class="px-6 py-4">
            <Friends />
        </div>
    </CommonSidebarModal>
</template>
