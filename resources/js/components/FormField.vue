<template>
    <DefaultField :field="currentField" :errors="errors" :show-help-text="showHelpText">
        <template #field>
            <ckeditor
                :id="field.attribute"
                v-model="value"
                :config="config"
            />
        </template>
    </DefaultField>
</template>


<script>
    import { DependentFormField, HandlesValidationErrors } from 'laravel-nova'

    export default {
        mixins: [DependentFormField, HandlesValidationErrors],

        props: ['resourceName', 'resourceId', 'field'],

        data() {
            let draftId = uuidv4();

            if(this.field.withFiles){
                let token = document.head.querySelector('meta[name="csrf-token"]').content
                this.field.options.uploadUrl =
                   `/nova-vendor/nova-ckeditor4/${this.resourceName}/upload/${this.field.attribute}?_token=${token}&draftId=${draftId}`;
                this.field.options.filebrowserUploadUrl =
                    `/nova-vendor/nova-ckeditor4/${this.resourceName}/upload/${this.field.attribute}?_token=${token}&draftId=${draftId}`;
            }

            return {
                config: this.field.options,
                draftId: draftId,
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
                this.fillIfVisible(formData, this.field.attribute, this.value || '');
                this.fillIfVisible(
                    formData,
                    `${this.field.attribute}DraftId`,
                    this.draftId
                );
            },

            /**
             * Update the field's internal value.
             */
            handleChange(value) {
                this.value = value
            },

            /**
             * Purge pending attachments for the draft
             */
            cleanUp() {
                if (this.field.withFiles) {
                    Nova.request()
                        .delete(
                            `/nova-vendor/nova-ckeditor/${this.resourceName}/attachments/${this.field.attribute}/${this.draftId}`
                        )
                        .then(response => {})
                        .catch(error => {})
                }
            },
        }
    }

    function uuidv4() {
        return ([1e7] + -1e3 + -4e3 + -8e3 + -1e11).replace(/[018]/g, c =>
            (
                c ^
                (crypto.getRandomValues(new Uint8Array(1))[0] & (15 >> (c / 4)))
            ).toString(16)
        )
    }
</script>
