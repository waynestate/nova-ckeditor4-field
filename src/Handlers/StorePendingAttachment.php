<?php

namespace Waynestate\Nova\Handlers;

use Illuminate\Http\Request;
use Laravel\Nova\Trix\PendingAttachment;
use Illuminate\Support\Facades\Storage;

class StorePendingAttachment extends \Laravel\Nova\Trix\StorePendingAttachment
{
    /**
     * @param Request $request
     */
    public function __invoke(Request $request)
    {
        $disk = $this->field->getStorageDisk();

        return Storage::disk($disk)
                      ->url(PendingAttachment::create([
                          'draft_id' => $request->draftId,
                          'attachment' => $request->file('upload')
                                                  ->store($this->field->getStorageDir(), $disk),
                          'disk' => $disk,
                      ])->attachment);
    }
}
