<script setup lang="ts">
import {Appointment, Event, Module, PrivateEvent} from '@/scripts/types/datatypes'

const props = defineProps<{
    private_events: PrivateEvent[],
    events: Event[] & { appointments: Appointment[] },
    modules: Module[],
    study_group_content?: Appointment[]
}>()

console.log(props.study_group_content)
</script>

<template layout="default">
    {{ JSON.stringify(props) }}
</template>
