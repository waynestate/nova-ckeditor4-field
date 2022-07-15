<template>
    <PanelItem :index="index" :field="field"></PanelItem>
</template>

<script>
    export default {
        props: ['index', 'resource', 'resourceName', 'resourceId', 'field'],
    }
</script>
