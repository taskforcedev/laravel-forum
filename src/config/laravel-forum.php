<?php

return [
    'layout' => 'laravel-forum::layout.master',

    'sitename' => 'Laravel',

    // What type of modals should the package use.
    'modal' => [
        /*
         * Type of modal to use:
         * Valid options: 'bootstrap', 'jquery',
         * Currently Supported: 'bootstrap'
         */
        'type' => 'bootstrap',
    ],

    'wysiwyg' => [

        /**
         * Whether the package should include the WYSIWYG code (CSS/JS etc)
         * if set to false then your layout will have to include it otherwise WYSIWYG won't be visible.
         */
        'include' => true,

        /*
         * Which WYSIWYG to use.  Only relevant if include is true.
         * Valid Options: 'tinymce'
         * Currently Supported: None - TODO
         */
        'name' => 'tinymce'
    ]
];
