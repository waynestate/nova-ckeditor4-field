<template>
    <span v-html="field.value"></span>
</template>

<script>
    export default {
        props: ['resourceName', 'field'],
    }
</script>
