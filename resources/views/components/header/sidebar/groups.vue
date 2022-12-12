<script setup lang="ts">

import { PlusSmallIcon } from "@heroicons/vue/24/outline";
import useGlobal from "@/scripts/composables/useGlobal";
import { useCreateGroupForm } from "@/scripts/helpers/backendInteraction";

import { flashKey } from "@/scripts/plugins/flash.plugin";
import TextInput from "@/views/components/common/forms/textInput.vue";
import Group from "@/views/components/header/sidebar/group.vue";
import SidebarSection from "@/views/components/header/sidebar/sidebarSection.vue";


const { createErrorMessage } = inject(flashKey)!;
const groups = computed(() => useGlobal().groups);

const showForm = ref(false);
const { form, validate, submit: submitNewGroup } = useCreateGroupForm();

const submit = () => {
    submitNewGroup({
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
      <h4 class="text-xl font-semibold">Groups</h4>

      <form v-show="showForm" class="flex-grow" @submit.prevent="submit">
        <TextInput
          v-model="form.name"
          :class="{ 'text-red-400': !!form.errors.name }"
          class="w-full"
          autofocus
          placeholder="Neue Gruppe erstellen"
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
      <Group
        v-for="group in groups"
        :key="group.id"
        :group="group"
      />
    </template>
  </SidebarSection>
</template>