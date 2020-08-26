<?php

namespace Waynestate\Nova;

use Laravel\Nova\Fields\Expandable;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Trix\DeleteAttachments;
use Laravel\Nova\Trix\DetachAttachment;
use Laravel\Nova\Trix\DiscardPendingAttachments;
use Waynestate\Nova\Handlers\StorePendingAttachment;

class CKEditor extends Trix
{
    use Expandable;

    /**
     * Hydrate the given attribute on the model based on the incoming request.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param string $requestAttribute
     * @param object $model
     * @param string $attribute
     * @return void
     */
    protected function fillAttributeFromRequest(
        NovaRequest $request,
        $requestAttribute,
        $model,
        $attribute
    ) {
        if ($request->exists($requestAttribute)) {
            $model->{$attribute} = $request[$requestAttribute];
        }
    }

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-ckeditor';

    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->withMeta([
            'options' => config('nova.ckeditor-field.options', [])
        ]);
    }

    /**
     * Set configuration options for the CKEditor editor instance.
     *
     * @param array $options
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
     * @return array
     */
    public function jsonSerialize()
    {
        return array_merge(parent::jsonSerialize(), [
            'shouldShow' => $this->shouldBeExpanded(),
        ]);
    }

    /**
     * Specify that file uploads should be allowed.
     *
     * @param string $disk
     * @param string $path
     * @return $this
     */
    public function withFiles($disk = null, $path = '/')
    {
        $this->withFiles = true;

        $this->disk($disk)
             ->path($path);

        $this->attach(new StorePendingAttachment($this))
             ->detach(new DetachAttachment($this))
             ->delete(new DeleteAttachments($this))
             ->discard(new DiscardPendingAttachments($this))
             ->prunable();

        return $this;
    }

}
