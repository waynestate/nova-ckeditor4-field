# Laravel Nova CKEditor 4 Field

This nova package allows you to use [CKEditor 4](https://ckeditor.com/ckeditor-4/) for text areas using [Vue Ckeditor2](https://vue-ckeditor2.surge.sh/)

## Installation

You can install the package into a Laravel application that uses [Nova](https://nova.laravel.com) via composer:

```bash
composer require waynestate/nova-ckeditor4-field
```

By default the CKEditor 4 instance used is the latest (4.10.1) Standard All version. If you wish to use a different CKEditor 4 you can do so by editing the configuration.

## Usage

```php
<?php

namespace App\Nova;

use Waynestate\Nova\CKEditor;

class Article extends Resource
{
    // ...

    public function fields(Request $request)
    {
        return [
            // ...

            CKEditor::make('Body', 'body');
                
            // ...
        ];
    }
}
```

## Overriding Config Values

To change any of config values, publish a config file:

```bash
php artisan vendor:publish --tag=config --provider=Waynestate\\Nova\\CKEditorFieldServiceProvider
```

## Customization

You can change the [configuration options](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html) of the CKEditor instance by either editing the published config file at `nova.ckeditor-field.options`

```php
    /*
    |--------------------------------------------------------------------------------
    | CKEditor Options
    |--------------------------------------------------------------------------------
    |
    | To view a list of all available options checkout the CKEditor API documentation
    | https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html
    |
    */
    'options' => [
        'toolbar' => [
            ['Source','-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
            ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
            ['Image','Table','HorizontalRule','SpecialChar','PageBreak'],
            '/',
            ['Bold','Italic','Strike','-','Subscript','Superscript'],
            ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
            ['JustifyLeft','JustifyCenter','JustifyRight'],
            ['Link','Unlink','Anchor'],
            '/',
            ['Format','FontSize'],
            ['Maximize', 'ShowBlocks','-','About']
        ]
    ],
```

or you can pass it with the `options` method using:

```php
public function fields(Request $request)
{
    return [
        // ...

        CKEditor::make('Body', 'body')->options([
            'height' => 300,
            'toolbar' => [
                ['Source','-','Cut','Copy','Paste'],
            ],
        ]),

        // ...
    ];
}
```
