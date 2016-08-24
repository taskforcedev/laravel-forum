<?php

return [
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
    ],
    'avatars' => [
        /* Whether or not to show a users avatar (uses gravatar module) */
        'display' => true,
        /* Default image if user does not have a gravatar */
        'default' => '',
    ]
];
