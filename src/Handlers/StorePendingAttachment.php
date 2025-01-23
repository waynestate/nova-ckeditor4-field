<?php

namespace Waynestate\Nova\CKEditor4Field\Handlers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Waynestate\Nova\CKEditor4Field\CKEditor;

class StorePendingAttachment
{
    public const STORAGE_PATH = '/attachments';

    /**
     * The field instance.
     *
     * @var CKEditor
     */
    public CKEditor $field;

    /**
     * Create a new invokable instance.
     *
     * @param CKEditor $field
     */
    public function __construct(CKEditor $field)
    {
        $this->field = $field;
    }

    /**
     * Attach a pending attachment to the field.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function __invoke(Request $request): string
    {
        $filename = $this->generateFilename($request->upload);

        $this->abortIfFileNameExists($filename);

        $attachment = config('nova.ckeditor-field.pending_attachment_model')::create([
            'draft_id' => $request->draftId,
            'attachment' => $request->upload->storeAs(
                self::STORAGE_PATH,
                $filename,
                $this->field->disk
            ),
            'disk' => $this->field->disk,
        ])->attachment;

        return Storage::disk($this->field->disk)->url($attachment);
    }

    /**
     * @param string $filename
     */
    protected function abortIfFileNameExists($filename): void
    {
        if (Storage::disk($this->field->disk)->exists(self::STORAGE_PATH.'/'.$filename)) {
            abort(response()->json([
                'status' => Response::HTTP_CONFLICT,
                'message' => 'A file with this name already exists on the server',
            ], Response::HTTP_CONFLICT));
        }
    }

    /**
     * @param UploadedFile $uploadedFile
     * @return string
     */
    protected function generateFilename(UploadedFile $uploadedFile): string
    {
        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);

        return Str::slug($originalFilename).'-'.uniqid('', false).'.'.$uploadedFile->guessExtension();
    }
}
