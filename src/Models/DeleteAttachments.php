<?php

namespace Waynestate\Nova\CKEditor4Field\Models;

use Illuminate\Http\Request;

class DeleteAttachments
{
    /**
     * The field instance.
     *
     * @var \Waynestate\Nova\CKEditor4Field\Fields\CKEditor
     */
    public $field;

    /**
     * Create a new class instance.
     *
     * @param  \Waynestate\Nova\CKEditor4Field\Fields\CKEditor $field
     * @return void
     */
    public function __construct($field)
    {
        $this->field = $field;
    }

    /**
     * Delete the attachments associated with the field.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $model
     * @return string[]
     */
    public function __invoke(Request $request, $model)
    {
        config('nova.ckeditor-field.attachment_model')::where('attachable_type', get_class($model))
                ->where('attachable_id', $model->getKey())
                ->get()
                ->each
                ->purge();

        return [$this->field->attribute => ''];
    }
}
