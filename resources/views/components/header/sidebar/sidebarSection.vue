<script setup lang="ts">

</script>


<template>
    <section>
        <div class="flex gap-2 items-center">
            <slot name="header" />
        </div>

        <div class="mt-2 space-y-1">
            <slot name="content" />
        </div>
    </section>
</template>
