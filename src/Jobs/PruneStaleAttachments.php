<?php

namespace Waynestate\Nova\CKEditor4Field\Jobs;

class PruneStaleAttachments
{
    /**
     * Prune the stale attachments from the system.
     *
     * @return void
     */
    public function __invoke(): void
    {
        config('nova.ckeditor-field.pending_attachment_model')::where('created_at', '<=', now()->subDays(1))
            ->orderBy('id', 'desc')
            ->chunk(100, function ($attachments) {
                $attachments->each->purge();
            });
    }
}
