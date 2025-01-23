<?php

namespace Waynestate\Nova\CKEditor4Field\Models;

use Illuminate\Http\Request;

class DetachAttachment
{
    /**
     * Delete an attachment from the field.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __invoke(Request $request): void
    {
        config('nova.ckeditor-field.attachment_model')::where('url', $request->attachmentUrl)
                        ->get()
                        ->each
                        ->purge();
    }
}
