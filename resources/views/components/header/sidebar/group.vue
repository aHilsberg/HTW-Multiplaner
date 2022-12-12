<script setup lang="ts">
import { PencilIcon, XMarkIcon } from "@heroicons/vue/24/outline";
import { Group } from "@/scripts/types/userRelationships";

import {
  renameGroupCall,
  removeGroupCall,
  updateGroupCall
} from "@/scripts/helpers/backendInteraction";

const props = defineProps<{
    group: Group;
}>();

const renameGroup = () =>
  renameGroupCall({ data: { group_id: props.group.id, name: props.group.name } });
const updateGroup = () =>
  updateGroupCall({ data: { group_id: props.group.id, additional_members: [] } });
const removeGroup = () =>
  removeGroupCall({ data: { group_id: props.group.id } });

</script>

<template>
  <SidebarItem class="flex items-center gap-2">
    <div class="bg-gray-200">
        <span class="text-lg">{{ group.name }}</span>
    </div>

      <PencilIcon class="w-6 h-6" @click="renameGroup" />
      <XMarkIcon class="w-6 h-6 text-red-400" @click="removeGroup" />


  </SidebarItem>
</template>