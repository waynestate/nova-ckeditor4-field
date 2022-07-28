<?php

return [
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
            ['Source', '-', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Print', 'SpellChecker', 'Scayt'],
            ['Undo', 'Redo', '-', 'Find', 'Replace', '-', 'SelectAll', 'RemoveFormat'],
            ['Image', 'Table', 'HorizontalRule', 'SpecialChar', 'PageBreak'],
            '/',
            ['Bold', 'Italic', 'Strike', '-', 'Subscript', 'Superscript'],
            ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', 'Blockquote', 'CreateDiv'],
            ['JustifyLeft', 'JustifyCenter', 'JustifyRight'],
            ['Link', 'Unlink', 'Anchor'],
            '/',
            ['Format', 'FontSize'],
            ['Maximize', 'ShowBlocks', '-', 'About'],
        ],
    ],

    /*
    |--------------------------------------------------------------------------------
    | CKEditor Attachment Models
    |--------------------------------------------------------------------------------
    |
    | The fully qualified class name of models that are used for attachments, such as images.
    | To use attachments you can set up the file store by appending withFiles() to the Nova Resource.
    |
    | Example: CKEditor::make('Body')->withFiles('public')
    |
    */

    'attachment_model' => \Waynestate\Nova\CKEditor4Field\Models\Attachment::class,
    'pending_attachment_model' => \Waynestate\Nova\CKEditor4Field\Models\PendingAttachment::class,

    /*
    |--------------------------------------------------------------------------------
    | CKEditor 4 Javascript URL
    |--------------------------------------------------------------------------------
    |
    | This is the URL used to load the CKEditor instance.
    |
    | Note: The URL must begin with "http://" or "https://"
    |
    | If you wish to use a different CKEditor 4 preset you can use a
    | CKEditor 4 preset from https://cdn.ckeditor.com/
    |
    | or
    |
    | you could use composer to install your CKEditor from
    | https://github.com/ckeditor/ckeditor-releases/ and symbolic link the
    | "vendor/ckeditor/ckeditor" to "public/js/ckeditor".
    | then replace the "ckeditor_url" to be
    |
    | 'ckeditor_url' => config('app.url').'/js/ckeditor/ckeditor.js',
    |
    | CKEditor 4 is only supported. This will not work with CKEditor 5
    |
    */
    'ckeditor_url' => 'https://cdn.ckeditor.com/4.19.1/full-all/ckeditor.js',
];
