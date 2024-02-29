<?php
return [
    'title' => '__get',
    'description' => 'See [magic methods](http://php.net/manual/en/language.oop5.overloading.php#object.get)',
    'parameters' => [
        [
            'name' => 'name',
            'type' => 'string',
            'description' => 'The name of the property to access.'
        ]
    ],
    'returns' => 'mixed',
    'supported_names' => [
        [
            'name' => 'outertext',
            'description' => 'Returns the outer text of the root element.'
        ],
        [
            'name' => 'innertext',
            'description' => 'Returns the inner text of the root element.'
        ],
        [
            'name' => 'plaintext',
            'description' => 'Returns the plain text of the root element.'
        ],
        [
            'name' => 'charset',
            'description' => 'Returns the charset for the document.'
        ],
        [
            'name' => 'target_charset',
            'description' => 'Returns the target charset for the document.'
        ]
    ]
];