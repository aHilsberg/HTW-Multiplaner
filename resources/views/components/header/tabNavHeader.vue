<script setup lang="ts">
import {Link, usePage} from '@inertiajs/inertia-vue3'
import TabNavElement from '@/views/components/header/tabNavElement.vue'

const validTabsPathNames = [
    // @ts-ignore
    new URL(route('lookup')).pathname,
]

const page = usePage()
const tabs = ref<string[]>([])

const loading = ref(false)


watchEffect(() => {
    if (loading.value) return

    const path = page.url.value
    if (!validTabsPathNames.find(validName => path.startsWith(validName))) return

    if (tabs.value.includes(path)) return
    console.log({add: path})
    tabs.value.push(path)
})

const removeTab = (index: number) => {
    const tabsRef = [...tabs.value]
    console.log({remove: tabsRef.splice(index, 1)})
    tabs.value = tabsRef
    console.log({tabsRef})
    const lastTab = index > 0 ? tabs.value[index - 1] : '/'


    loading.value = true
    Inertia.visit(lastTab, {
        onFinish: () => {
            loading.value = false
        },
    })
}
</script>

<template>
    <li class="self-end flex items-center">
        <TabNavElement href="/"/>
        <TabNavElement v-for="(tab, index) in tabs"
                       :key="index"
                       :href="tab"
                       @close="() => removeTab(index)"
        />
        <Link as="ul" :href="route('lookup')" :data="{ module: 'B111' }">
            DEBUG ADD TAB
        </Link>
    </li>
</template>
