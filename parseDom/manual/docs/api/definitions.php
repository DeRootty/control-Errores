<?php
return [
    'title' => 'Definitions',
    'sections' => [
        [
            'name' => 'Node Types',
            'description' => 'The type of a node is determined during parsing and represented by one of the elements in the list below.',
            'items' => [
                [
                    'type' => 'HDOM_TYPE_ELEMENT',
                    'description' => 'Start tag (i.e. `<html>`)'
                ],
                [
                    'type' => 'HDOM_TYPE_COMMENT',
                    'description' => 'HTML comment (i.e. `<!-- Hello, World! -->`)'
                ],
                [
                    'type' => 'HDOM_TYPE_TEXT',
                    'description' => 'Plain text (i.e. `Hello, World!`)'
                ],
                // Other items...
            ]
        ],
        [
            'name' => 'Quote Types',
            'description' => 'Identifies the quoting type on attribute values.',
            'items' => [
                [
                    'type' => 'HDOM_QUOTE_DOUBLE',
                    'description' => 'Double quotes (`""`)'
                ],
                [
                    'type' => 'HDOM_QUOTE_SINGLE',
                    'description' => 'Single quotes (`\'\'`)'
                ],
                // Other items...
            ]
        ],
        // Other sections...
    ],
    'notes' => [
        [
            'title' => 'Example',
            'content' => '```html
<!DOCTYPE html><html><!-- Hello, World! --></html>Hello, World!
```'
        ]
    ],
    'tables' => [
        [
            'name' => 'Node Info Types',
            'description' => 'Each node stores additional information (metadata) that is identified by the elements below.',
            'rows' => [
                [
                    'type' => 'HDOM_INFO_BEGIN',
                    'description' => 'Cursor position for the start tag of a node.'
                ],
                [
                    'type' => 'HDOM_INFO_END',
                    'description' => 'Cursor position for the end tag of a node. A value of zero indicates a node with no end tag (missing closing tag).'
                ],
                // Other rows...
            ]
        ],
        // Other tables...
    ]
];