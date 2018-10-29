<?php
return [
    /*
    |--------------------------------------------------------------------------------
    | CKEditor 4 Javascript URL
    |--------------------------------------------------------------------------------
    |
    | This is the URL used to load the CKEditor instance.
    | ex: https://cdn.ckeditor.com/4.10.1/standard-all/ckeditor.js
    |
    | Note: The URL must begin with "http://" or "https://"
    |
    | CKEditor 4 is only supported. This will not work with CKEditor 5
    |
    */
    'ckeditor_url' => 'https://cdn.ckeditor.com/4.10.1/standard-all/ckeditor.js',

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
            ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo'],
            ['Scayt'],
            ['Link','Unlink','Anchor'],
            ['Image','Table','HorizontalRule','SpecialChar'],
            ['Maximize'],
            ['Source'],
            '/',
            ['Bold','Italic','Strike','RemoveFormat','-','Subscript','Superscript'],
            ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
            ['Format'],
            ['About']
        ]
    ],
];
