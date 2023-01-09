<script setup lang="ts">
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from "@headlessui/vue";
import { useVModel } from "@vueuse/core";

import CommonModal from "@/views/components/common/headless/commonModal.vue";
import ModuluxForm from "@/views/components/header/search/moduluxForm.vue";
import StudyGroupForm from "@/views/components/header/search/studyGroupForm.vue";

const props = defineProps<{
    open: boolean;
}>();

const emit = defineEmits(["close"]);
const isOpen = useVModel(props, "open", emit);
</script>

<template>
    <CommonModal
        v-model:open="isOpen"
        header="Suche"
        class="z-[100]"
        @close="isOpen = false"
    >
        <TabGroup>
            <TabList class="flex my-2">
                <Tab
                    v-for="category in ['Studiengang', 'Modul', 'Exam']"
                    :key="category"
                    v-slot="{ selected }"
                    as="template"
                >
                    <button
                        :class="[
                            'w-full py-2.5 text-sm font-medium border',
                            selected
                                ? 'border-gray-300 border-b-0 '
                                : 'border-gray-200 hover:bg-gray-400/[0.12]',
                        ]"
                    >
                        {{ category }}
                    </button>
                </Tab>
            </TabList>
            <TabPanels>
                <TabPanel>
                    <StudyGroupForm :close="() => (isOpen = false)" />
                </TabPanel>
                <TabPanel>
                    <ModuluxForm :close="() => (isOpen = false)" />
                </TabPanel>
                <TabPanel>Content 3</TabPanel>
            </TabPanels>
        </TabGroup>
    </CommonModal>
</template>
