<?php
return [
    'title' => 'str_get_html',
    'description' => 'Parses the provided string and returns the DOM object.',
    'parameters' => [
        [
            'name' => 'str',
            'description' => 'The HTML document string.'
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
            'description' => 'Defines the default text to return for `<br>` elements.'
        ],
        [
            'name' => 'defaultSpanText',
            'description' => 'Defines the default text to return for `<span>` elements.'
        ]
    ]
];