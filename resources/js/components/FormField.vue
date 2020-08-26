<template>
    <default-field :field="field" :errors="errors" :full-width-content="true">
        <template slot="field">
            <vue-ckeditor
                :id="field.attribute"
                v-model="value"
                :config="editorConfig"
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
                defaultEditorConfig: this.field.options,
                withFiles: this.field.withFiles,
            }
        },
        computed: {
            editorConfig() {
                let cfg = this.defaultEditorConfig
                let token = document.head.querySelector('meta[name="csrf-token"]').content
                if (!!this.withFiles) {
                    cfg.filebrowserImageUploadUrl = `/nova-vendor/nova-ckeditor4-field/${
                    this.resourceName
                    }/upload/${
                    this.field.attribute
                    }?_token=${token}&draftId=${this.uuidv4()}`
                }
                return cfg
            },
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
            },

            uuidv4() {
                return ([1e7] + -1e3 + -4e3 + -8e3 + -1e11).replace(/[018]/g, c =>
                            (c ^
                                (crypto.getRandomValues(new Uint8Array(1))[0] & (15 >> (c / 4)))
                            ).toString(16)
                    )
            },
        }
    }
</script>
