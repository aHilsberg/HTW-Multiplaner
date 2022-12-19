<script setup lang="ts">
import { Event } from "@/scripts/types/userRelationships";
import {
  renameEventCall,
  updateEventCall,
  removeEventCall
} from "@/scripts/helpers/backendInteraction";

const props = defineProps<{
    event: Event;
}>();

const renameEvent = () =>
  renameEventCall({ data: { group_id: props.event.id, name: props.event.name } });
const updateEvent = () =>
  updateEventCall({ data: { group_id: props.event.id, additional_members: [] } });
const removeEvent = () =>
  removeEventCall({ data: { group_id: props.event.id } });
</script>

<template>
  <SidebarItem class="flex items-center gap-2">
    <div class="bg-gray-200">
      <span class="text-lg">{{ event.name }}</span>
    </div>
  </SidebarItem>
</template>
