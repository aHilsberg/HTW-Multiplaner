<script setup lang="ts">
import {Link} from '@inertiajs/inertia-vue3'
import {XMarkIcon} from '@heroicons/vue/24/outline'

const props = defineProps<{
    href: string,
}>()

const name = computed(() => {
    if (props.href === '/')
        return 'Eigener Stundenplan'

    return 'TODO'
})

defineEmits(['close'])
</script>


<template>
    <Link :href="href" as="ul"
          class="flex items-center gap-2 -ml-2 pl-4 pr-2 py-1 border-t border-r border-gray-300 rounded-tr-xl">
        <span class="text-md mr-1">{{ name }}</span>

        <button v-if="href !== '/'" @click.prevent="$emit('close')">
            <XMarkIcon class="w-4 h-4 text-gray-600"/>
        </button>
    </Link>
</template>
