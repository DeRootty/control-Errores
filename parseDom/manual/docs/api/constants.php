<?php
return [
    'title' => 'Constants',
    'constants' => [
        [
            'name' => 'DEFAULT_TARGET_CHARSET',
            'description' => 'Defines the default target charset for text returned by the parser.',
            'default' => '\'UTF-8\''
        ],
        [
            'name' => 'DEFAULT_BR_TEXT',
            'description' => 'Defines the default text to return for <br> elements.',
            'default' => '"\r\n"'
        ],
        [
            'name' => 'DEFAULT_SPAN_TEXT',
            'description' => 'Defines the default text to return for <span> elements.',
            'default' => '\' \''
        ],
        [
            'name' => 'MAX_FILE_SIZE',
            'description' => 'Defines the maximum number of bytes the parser can load into memory. This limit only applies to the source file or string.',
            'default' => '600000'
        ]
    ]
];