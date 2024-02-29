<?php
return [
    'title' => 'file_get_html',
    'description' => 'Parses the provided file and returns the DOM object.',
    'parameters' => [
        [
            'name' => 'url',
            'description' => 'Name or URL of the file to read.'
        ],
        [
            'name' => 'use_include_path',
            'description' => 'See [file_get_contents](http://php.net/manual/en/function.file-get-contents.php#refsect1-function.file-get-contents-parameters)'
        ],
        [
            'name' => 'context',
            'description' => 'See [file_get_contents](http://php.net/manual/en/function.file-get-contents.php#refsect1-function.file-get-contents-parameters)'
        ],
        [
            'name' => 'offset',
            'description' => 'See [file_get_contents](http://php.net/manual/en/function.file-get-contents.php#refsect1-function.file-get-contents-parameters)'
        ],
        [
            'name' => 'maxLen',
            'description' => 'See [file_get_contents](http://php.net/manual/en/function.file-get-contents.php#refsect1-function.file-get-contents-parameters)'
        ],
        [
            'name' => 'lowercase',
            'description' => 'Forces lowercase matching of tags if enabled. This is very useful when loading documents with mixed naming conventions.'
        ],
        [
            'name' => 'forceTagsClosed',
            'description' => 'Obsolete. This parameter is no longer used by the parser.'
        ],
        [
            'name' => 'target_charset',
            'description' => 'Defines the target charset when returning text from the document.'
        ],
        [
            'name' => 'stripRN',
            'description' => 'If enabled, removes newlines before parsing the document.'
        ],
        [
            'name' => 'defaultBRText',
            'description' => 'Defines the default text to return for <br> elements.'
        ],
        [
            'name' => 'defaultSpanText',
            'description' => 'Defines the default text to return for <span> elements.'
        ]
    ]
];
