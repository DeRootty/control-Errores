<?php
return [
    'title' => 'API Reference',
    'sections' => [
        [
            'title' => 'Parsing documents',
            'description' => 'The parser accepts documents in the form of URLs, files and strings. The document must be accessible for reading and cannot exceed MAX_FILE_SIZE.',
            'methods' => [
                [
                    'name' => 'str_get_html( string $content ) : object',
                    'description' => 'Creates a DOM object from string.'
                ],
                [
                    'name' => 'file_get_html( string $filename ) : object',
                    'description' => 'Creates a DOM object from file or URL.'
                ]
            ]
        ],
        [
            'title' => 'DOM methods & properties',
            'methods' => [
                [
                    'name' => '__construct( [string $filename] ) : void',
                    'description' => 'Constructor, set the filename parameter will automatically load the contents, either text or file/url.'
                ],
                [
                    'name' => 'plaintext : string',
                    'description' => 'Returns the contents extracted from HTML.'
                ],
                // Other methods...
            ]
        ],
        // Other sections...
    ],
    'naming_conventions' => [
        [
            'method' => '$e->getAllAttributes()',
            'mapping' => '$e->attr'
        ],
        // Other naming conventions...
    ]
];