<template>
    <PanelItem :index="index" :field="field">
        <template #value>
            <Excerpt
                :content="field.value"
                :plain-text="false"
                :should-show="field.shouldShow"
            />
        </template>
    </PanelItem>
</template>

<script>
    export default {
        props: ['index', 'resource', 'resourceName', 'resourceId', 'field'],
    }
</script>
