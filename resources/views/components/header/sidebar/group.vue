<script setup lang="ts">
import {
    PlusSmallIcon,
    PencilIcon,
    XMarkIcon,
} from "@heroicons/vue/24/outline";

import {
    renameGroupCall,
    removeGroupCall,
    updateGroupCall,
} from "@/scripts/helpers/backendInteraction";
import { Group } from "@/scripts/types/userRelationships";
import TextInput from "@/views/components/common/forms/textInput.vue";
import SidebarItem from "@/views/components/header/sidebar/sidebarItem.vue";

const props = defineProps<{
    group: Group;
}>();

const showForm = ref(false);

const renameGroup = () =>
    renameGroupCall({
        data: { group_id: props.group.id, name: props.group.name },
    });
const updateGroup = () =>
    updateGroupCall({
        data: { group_id: props.group.id, additional_members: [] },
    });
const removeGroup = () =>
    removeGroupCall({ data: { group_id: props.group.id } });
</script>

<template>
    <SidebarItem class="flex items-center gap-2">
        <template v-if="!showForm">
            <div class="bg-gray-200">
                <span class="text-lg">{{ group.name }}</span>
            </div>
        </template>

        <template v-if="showForm">
            <TextInput
                v-model="props.group.name"
                @keyup.enter="
                    renameGroup();
                    showForm = false;
                "
            />
        </template>

        <button>
            <PencilIcon
                v-show="!showForm"
                class="w-6 h-6"
                @click="showForm = true"
            />
        </button>

        <button>
            <PlusSmallIcon
                v-show="!showForm"
                class="w-6 h-6"
                @click="showForm = true"
            />
        </button>

        <button>
            <XMarkIcon
                v-show="!showForm"
                class="w-6 h-6 text-red-400"
                @click="removeGroup"
            />
        </button>
    </SidebarItem>
</template>
