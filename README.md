# Laravel Nova CKEditor 4 Field

[![Latest Stable Version](http://poser.pugx.org/waynestate/nova-ckeditor4-field/v)](https://packagist.org/packages/waynestate/nova-ckeditor4-field) [![Daily Downloads](http://poser.pugx.org/waynestate/nova-ckeditor4-field/d/daily)](https://packagist.org/packages/waynestate/nova-ckeditor4-field)
[![Total Downloads](http://poser.pugx.org/waynestate/nova-ckeditor4-field/downloads)](https://packagist.org/packages/waynestate/nova-ckeditor4-field) [![Latest Unstable Version](http://poser.pugx.org/waynestate/nova-ckeditor4-field/v/unstable)](https://packagist.org/packages/waynestate/nova-ckeditor4-field) [![License](http://poser.pugx.org/waynestate/nova-ckeditor4-field/license)](https://packagist.org/packages/waynestate/nova-ckeditor4-field) [![PHP Version Require](http://poser.pugx.org/waynestate/nova-ckeditor4-field/require/php)](https://packagist.org/packages/waynestate/nova-ckeditor4-field) 

## :warning: CKEditor4 End of Life :warning:

The time has come where CKEditor4 has reached it's semi End of Life, which you can read more about at [CKEditor 4: End of Life June 2023](https://ckeditor.com/blog/ckeditor-4-end-of-life/)

Unforunately to use the CKEditor4 LTS (anything greater than v4.22.1), it requires that you have a [Long Term Support](https://ckeditor.com/ckeditor-4/).

This package isn't going anywhere soon, but if you are using CKEditor4 v4.22.1 or less, you may [encounter a Security Warning](https://github.com/waynestate/nova-ckeditor4-field/issues/95) due to the CKEditor checking a version file on the CKEditor side.

This disables the security warning option by default within the [configuration](https://github.com/waynestate/nova-ckeditor4-field/blob/main/config/ckeditor-field.php#L27) since by default it points to v4.22.1 non-LTS CKEditor4.

If you do have the LTS package for CKEditor4, please renable your version check within your configuration, before updating this package to `v1.4.0`.

## Overview

This nova package allows you to use [CKEditor 4](https://ckeditor.com/ckeditor-4/) for text areas using Nova v4.

![CKEditor Form Field](docs/form-field.jpg)

## Installation

[Nova v1, v2, v3 compatibility instructions](https://github.com/waynestate/nova-ckeditor4-field#nova-v1-v2-or-v3-compatibility)

[Nova v4 compatibility instructions](https://github.com/waynestate/nova-ckeditor4-field#nova-v4-compatibility)

You can install the package into a Laravel application that uses [Nova](https://nova.laravel.com) via composer:

```bash
composer require waynestate/nova-ckeditor4-field
```

By default the CKEditor 4 instance used is the latest (4.22.1) Full All version (https://cdn.ckeditor.com/). If you wish to use a different CKEditor 4 you can do so by publishing and editing the configuration.

## Usage

```php
<?php

namespace App\Nova;

use Waynestate\Nova\CKEditor4Field\CKEditor;

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
php artisan vendor:publish --tag=nova-ckeditor4-field-config
```

## Customization

### Configuration options
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

### File Uploads
The `nova-ckeditor4-field` allows the use of file uploads by extending the attachment functionality of the [Trix field](https://nova.laravel.com/docs/4.0/resources/fields.html#trix-file-uploads)

```bash
php artisan vendor:publish --tag=nova-ckeditor4-field-config # Make sure the config file is published
php artisan migrate # Run the migrations
```

The package migrations will automatically run when running `php artisan migrate`.

If you are not going to use the Files and have no need for the migrations, you can disable migrations in `config/nova/ckeditor-field.php`, set the `enable_migrations` to `false`.
```php
    'migrations' => [
        'enable_migrations' => false,
        // ...
    ],
```

If you do not wish to use the [Laravel Migration](https://laravel.com/docs/9.x/packages#migrations), but publish the migration yourself to your project.
Within the published `/config/nova/ckeditor-field.php`, set the `auto_migrate` to `false`.
```php
    'migrations' => [
        'enable_migrations' => true,
        'auto_migrate' => false,
    ],
```
and then publish the migration to your project.
```php
php artisan vendor:publish --tag=nova-ckeditor4-field-migrations
```

if you wish to not use the default `Attachment` and/or `PendingAttachment` models. You could replace with your own within the published `/config/nova/ckeditor-field.php`, 
```php
    'attachment_model' => \Waynestate\Nova\CKEditor4Field\Models\Attachment::class,
    'pending_attachment_model' => \Waynestate\Nova\CKEditor4Field\Models\PendingAttachment::class,
```

Using the File Uploads feature **requires** that the CKEditor uses the plugins [Enhanced Image (image2)](https://ckeditor.com/cke4/addon/image2) and [UploadImage](https://ckeditor.com/cke4/addon/uploadimage).
If they are not included within your configuration, they will be added automatically.

Like the Trix field you'll be able to chain the method `withFiles` onto the field's definition, while passing the name of the filesystem disk where the images should be stored:
```php
use Waynestate\Nova\CKEditor4Field\CKEditor;

CKEditor::make('Body')->withFiles('public');
```

Also to prune any stale attachments from the storage and table, you'll want to register a [job](https://laravel.com/docs/9.x/scheduling#introduction) to run periodically:
```php
use Waynestate\Nova\CKEditor4Field\Jobs\PruneStaleAttachments;

/**
* Define the application's command schedule.
*
* @param  \Illuminate\Console\Scheduling\Schedule  $schedule
* @return void
*/
protected function schedule(Schedule $schedule)
{
    $schedule->call(function () {
        (new PruneStaleAttachments)();
    })->daily();
}
```

#### Limitations using File Uploads
Images are not removed from the filesystem when they are removed from the editor. For the time being you'll need to rectrify this on your own.

### Custom CKEditor Instance
If you wish to not use the CKEditor from the CKEditor CDN, you can change the `ckeditor_url` under `config/nova/ckeditor-field.php` to point to the URL of the CKEditor you wish to use.

If you wish to go the route of a Custom CKEditor Instance using Composer then follow the steps at [Using Composer for Custom CKEditor Instance](https://github.com/waynestate/nova-ckeditor4-field/wiki/Using-Composer-for-Custom-CKEditor-Instance)

## Nova v1, v2, or v3 compatibility
If you require the use of `nova-ckeditor4-field` using Nova v1, v2 or v3, you can install using version [0.7.0](https://github.com/waynestate/nova-ckeditor4-field/releases/tag/0.7.0)

```bash
composer require waynestate/nova-ckeditor4-field:"^0.7.0"
```

## Nova v4 compatibility
If you require the use of `nova-ckeditor4-field` using Nova v4 you can install using version [1.4.0](https://github.com/waynestate/nova-ckeditor4-field/releases/tag/1.4.0)

```bash
composer require waynestate/nova-ckeditor4-field:"^1.4.0"
```

## Changelog
Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing
Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security
If you discover any security related issues, please email web@wayne.edu instead of using the issue tracker.

## Credits
- [Wayne State University](https://github/waynestate)
- [All Contributors](../../contributors)

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
