<script setup lang="ts">
import { PlusSmallIcon, PencilIcon, XMarkIcon } from "@heroicons/vue/24/outline";
import { Event } from "@/scripts/types/userRelationships";
import TextInput from "@/views/components/common/forms/textInput.vue";

import {
  renameEventCall,
  updateEventCall,
  removeEventCall
} from "@/scripts/helpers/backendInteraction";

const props = defineProps<{
    event: Event;
}>();

const showForm = ref(false);

const renameEvent = () =>
  renameEventCall({ data: { event_id: props.event.id, name: props.event.name } });
const updateEvent = () =>
  updateEventCall({ data: { event_id: props.event.id, additional_members: [] } });
const removeEvent = () =>
  removeEventCall({ data: { event_id: props.event.id } });
</script>

<template>
  <SidebarItem class="flex items-center gap-2">
    <template v-if="!showForm">
      <div class="bg-gray-200">
        <span class="text-lg">{{ event.name }}</span>
      </div>
    </template>

    <template v-if="showForm">
      <TextInput v-model="props.event.name" @keyup.enter="renameEvent(); showForm = false" />
    </template>

    <button>
      <PencilIcon v-show="!showForm" class="w-6 h-6" @click="showForm = true" />
    </button>

    <button>
      <PlusSmallIcon v-show="!showForm" class="w-6 h-6" @click="showForm = true" />
    </button>

    <button>
      <XMarkIcon v-show="!showForm" class="w-6 h-6 text-red-400" @click="removeEvent" />
    </button>

  </SidebarItem>
</template>
