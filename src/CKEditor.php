<?php

namespace Waynestate\Nova\CKEditor4Field;

use Waynestate\Nova\CKEditor4Field\Handlers\DiscardPendingAttachments;
use Waynestate\Nova\CKEditor4Field\Handlers\StorePendingAttachment;
use Waynestate\Nova\CKEditor4Field\Models\DeleteAttachments;
use Waynestate\Nova\CKEditor4Field\Models\DetachAttachment;
use Laravel\Nova\Fields\Expandable;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class CKEditor extends Trix
{
    use Expandable;

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-ckeditor4';

    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $defaultConfig = require __DIR__ . '/../config/ckeditor-field.php';

        $this->withMeta([
            'options' => config('nova.ckeditor-field.options', $defaultConfig['options']),
        ]);
    }

    /**
     * Set configuration options for the CKEditor editor instance.
     *
     * @param  array $options
     * @return $this
     */
    public function options($options)
    {
        $currentOptions = $this->meta['options'] ?? [];

        return $this->withMeta([
            'options' => array_merge($currentOptions, $options),
        ]);
    }

    /**
     * Prepare the element for JSON serialization.
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return array_merge(parent::jsonSerialize(), [
            'shouldShow' => $this->shouldBeExpanded(),
        ]);
    }

    /**
     * @param string|null $disk
     * @return $this
     */
    public function withFiles($disk = null, $path = '/')
    {
        $this->withFiles = true;

        $this->setFilesPlugins();

        $this->disk($disk);

        $this->attach(new StorePendingAttachment($this))
            ->detach(new DetachAttachment($this))
            ->delete(new DeleteAttachments($this))
            ->discard(new DiscardPendingAttachments())
            ->prunable();

        return $this;
    }

    /**
     * Hydrate the given attribute on the model based on the incoming request.
     *
     * @param  NovaRequest $request
     * @param  string $requestAttribute
     * @param  object $model
     * @param  string $attribute
     * @return \Closure|null
     */
    protected function fillAttribute(NovaRequest $request, $requestAttribute, $model, $attribute)
    {
        parent::fillAttribute($request, $requestAttribute, $model, $attribute);

        if ($request->{$this->attribute.'DraftId'} && $this->withFiles) {
            return function () use ($request, $model, $attribute) {
                config('nova.ckeditor-field.pending_attachment_model')::persistDraft(
                    $request->{$this->attribute.'DraftId'},
                    $this,
                    $model
                );
            };
        }
    }

    /**
     * If they already have the extraPlugins set in the config, we need to make sure that the plugins required are added.
     *
     * @return void
     */
    protected function setFilesPlugins()
    {
        if (!empty($this->meta['options']['extraPlugins'])) {
            $extraPlugins = explode(',', preg_replace('/\s+/', '', $this->meta['options']['extraPlugins']));

            if (!in_array('uploadimage', $extraPlugins)) {
                $extraPlugins[] = 'uploadimage';
            }

            if (!in_array('image2', $extraPlugins)) {
                $extraPlugins[] = 'image2';
            }

            $this->options([
                'extraPlugins' => implode(',', $extraPlugins),
            ]);
        } else {
            $this->options([
                'extraPlugins' => 'image2,uploadimage',
            ]);
        }
    }
}
