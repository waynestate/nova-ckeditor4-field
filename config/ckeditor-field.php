<?php
return [
    /*
    |--------------------------------------------------------------------------------
    | CKEditor 4 Javascript URL
    |--------------------------------------------------------------------------------
    |
    | This is the URL used to load the CKEditor instance.
    | ex: https://cdn.ckeditor.com/4.11.2/full-all/ckeditor.js
    |
    | Note: The URL must begin with "http://" or "https://"
    |
    | CKEditor 4 is only supported. This will not work with CKEditor 5
    |
    */
    'ckeditor_url' => 'https://cdn.ckeditor.com/4.11.2/full-all/ckeditor.js',

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
            ['Maximize', 'ShowBlocks', '-', 'About']
        ]
    ],
];
