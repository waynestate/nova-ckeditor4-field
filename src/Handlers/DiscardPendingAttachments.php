<?php

namespace Waynestate\Nova\CKEditor4Field\Handlers;

use Illuminate\Http\Request;

class DiscardPendingAttachments
{
    /**
     * Discard pending attachments on the field.
     *
     * @param  Request $request
     * @return void
     */
    public function __invoke(Request $request): void
    {
        config('nova.ckeditor-field.pending_attachment_model')::where('draft_id', $request->draftId)
            ->get()
            ->each
            ->purge();
    }
}
