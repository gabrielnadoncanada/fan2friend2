<?php

use App\View\Components;

return [
    'components' => [
        'button' => [
            'class'  => Components\Button::class,
            'themes' => [
                'default' => 'btn bg-white',
                'gradient' => 'btn gradient-to-98 text-white'
            ],
        ],
        'text' => [
            'class'  => Components\Text::class,
            'themes' => [
                'p' => 'p',
                'h1' => 'h1',
                'h2' => 'h2',
                'h3' => 'h3',
                'h4' => 'h4',
                'h6' => 'h6',
            ],
        ],
    ],
];
