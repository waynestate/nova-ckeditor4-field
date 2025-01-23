<?php

namespace Waynestate\Nova\CKEditor4Field\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'nova_ckeditor_attachments';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Purge the attachment.
     *
     * @return void
     * @throws \Exception
     */
    public function purge(): void
    {
        Storage::disk($this->disk)->delete($this->attachment);

        $this->delete();
    }
}
