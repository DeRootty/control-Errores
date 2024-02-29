<?php
return [
    'title' => '__construct',
    'description' => 'Creates a new `simple_html_dom` object.',
    'parameters' => [
        [
            'name' => 'str',
            'description' => 'The HTML document string.',
            'default' => 'null'
        ],
        [
            'name' => 'lowercase',
            'description' => 'Tag names are parsed in lowercase letters if enabled.',
            'default' => 'true'
        ],
        [
            'name' => 'forceTagsClosed',
            'description' => 'Tags inside block tags are forcefully closed if the closing tag was omitted.',
            'default' => 'true'
        ],
        [
            'name' => 'target_charset',
            'description' => 'Defines the target charset for text returned by the parser.',
            'default' => 'DEFAULT_TARGET_CHARSET'
        ],
        [
            'name' => 'stripRN',
            'description' => 'Newline characters are replaced by whitespace if enabled.',
            'default' => 'true'
        ],
        [
            'name' => 'defaultBRText',
            'description' => 'Defines the default text to return for `<br>` elements.',
            'default' => 'DEFAULT_BR_TEXT'
        ],
        [
            'name' => 'defaultSpanText',
            'description' => 'Defines the default text to return for `<span>` elements.',
            'default' => 'DEFAULT_SPAN_TEXT'
        ],
        [
            'name' => 'options',
            'description' => 'Additional options for the parser. Currently supports `\'HDOM_SMARTY_AS_TEXT\'` to remove [Smarty](https://www.smarty.net/) scripts.',
            'default' => '0'
        ]
    ],
    'returns' => 'object'
];