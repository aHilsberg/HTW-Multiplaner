<script setup lang="ts">

import { PlusSmallIcon } from "@heroicons/vue/24/outline";
import useGlobal from "@/scripts/composables/useGlobal";
import { useCreateEventForm } from "@/scripts/helpers/backendInteraction";

import { flashKey } from "@/scripts/plugins/flash.plugin";
import TextInput from "@/views/components/common/forms/textInput.vue";
import Event from "@/views/components/header/sidebar/event.vue";
import SidebarSection from "@/views/components/header/sidebar/sidebarSection.vue";

const { createErrorMessage } = inject(flashKey)!;
const events = computed(() => useGlobal().events);

const showForm = ref(false);
const { form, validate, submit: submitNewEvent } = useCreateEventForm();

const submit = () => {
    submitNewEvent({
        onSuccess: () => {
            showForm.value = false;
        },
        onError: (err) => {
            createErrorMessage(err);
        },
    });
};

</script>

<template>
  <SidebarSection>
    <template #header>
      <h4 class="text-xl font-semibold">Events</h4>

      <form v-show="showForm" class="flex-grow" @submit.prevent="submit">
        <TextInput
          v-model="form.name"
          :class="{ 'text-red-400': !!form.errors.name }"
          class="w-full"
          autofocus
          placeholder="Neues Event erstellen"
          @input="form.errors.name = undefined"
        />
      </form>

      <PlusSmallIcon
        v-show="!showForm"
        class="w-6 h-6"
        @click="showForm = true"
      />
    </template>
    <template #content>
      <Event
        v-for="event in events"
        :key="event.id"
        :event="event"
      />
    </template>
  </SidebarSection>
</template>