<?php

namespace Waynestate\Nova;

use Laravel\Nova\Fields\Field;

class CKEditor extends Field
{
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
}
