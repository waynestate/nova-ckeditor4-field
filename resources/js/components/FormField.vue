<template>
    <default-field :field="field" :errors="errors" :full-width-content="true">
        <template slot="field">
            <vue-ckeditor
                :id="field.name"
                v-model="value"
                :config="config"
            />
        </template>
    </default-field>
</template>


<script>
    import {FormField, HandlesValidationErrors} from 'laravel-nova'
    import VueCkeditor from 'vue-ckeditor2';

    export default {
        components: {VueCkeditor},

        mixins: [FormField, HandlesValidationErrors],

        props: ['resourceName', 'resourceId', 'field'],

        data() {
            return {
                config: this.field.options
            }
        },

        methods: {
            /*
             * Set the initial, internal value for the field.
             */
            setInitialValue() {
                this.value = this.field.value || ''
            },

            /**
             * Fill the given FormData object with the field's internal value.
             */
            fill(formData) {
                formData.append(this.field.attribute, this.value || '')
            },

            /**
             * Update the field's internal value.
             */
            handleChange(value) {
                this.value = value
            }
        }
    }
</script>
