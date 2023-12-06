<?php

use App\View\Components;

return [
    'components' => [
        'button' => [
            'class' => Components\Button::class,
            'themes' => [
                'default' => 'btn bg-white',
                'gradient' => 'btn gradient-to-98 text-white',
                'ghost' => '',
            ],
        ],
        'text' => [
            'class' => Components\Text::class,
            'themes' => [
                'p' => 'p',
                'h1' => 'h1',
                'h2' => 'h2',
                'h3' => 'h3',
                'h4' => 'h4',
                'h6' => 'h6',
            ],
        ],
        'form' => [
            'class' => Components\Form::class,
            'field' => [
                'class' => Components\Form\Field::class,
                'themes' => [
                    'default' => 'space-y-2 mb-4',
                ],
            ],
            'input' => [
                'class' => Components\Form\Input::class,
                'themes' => [
                    'default' => [
                        'normal' => 'bg-light-gray block w-full rounded-full border-0 px-[30px] pt-[18px] pb-[21px] text-almost-dark placeholder:font-normal placeholder:text-dark-gray-2 focus:ring-2 focus:ring-inset focus:ring-primary-red  leading-[20px]',
                        'invalid' => 'bg-light-gray block w-full rounded-full border-0 px-[30px] pt-[18px] pb-[21px] text-almost-dark placeholder:font-normal placeholder:text-dark-gray-2 focus:ring-2 focus:ring-inset focus:ring-primary-red  leading-[20px]',
                    ],
                ],
            ],
            'label' => [
                'class' => Components\Form\Label::class,
                'themes' => [
                    'default' => 'block px-[30px] text-[15px] font-bold leading-[20px] text-almost-black mb-[7px]',
                ],
            ],
            'legend' => [
                'class' => Components\Form\Legend::class,
                'themes' => [
                    'default' => 'block text-sm font-medium text-primary',
                ],
            ],
            'radio' => [
                'class' => Components\Form\Radio::class,
                'themes' => [
                    'default' => [
                        'normal' => 'focus:ring-radio-500 h-5 w-5 text-radio-600 border-primary',
                        'invalid' => 'focus:ring-radio-500 h-5 w-5 text-red-600 border-primary',
                        'disabled' => 'focus:ring-radio-500 h-5 w-5 text-gray-600 border-primary',
                    ],
                ],
            ],
            'select' => [
                'class' => Components\Form\Select::class,
                'themes' => [
                    'default' => [
                        'normal' => 'rounded-select bg-light-gray block w-full rounded-full border-0 px-[30px] pt-[18px] pb-[21px] text-almost-dark placeholder:text-dark-gray-2 focus:ring-2 focus:ring-inset focus:ring-primary-red  leading-[20px]',
                        'invalid' => 'rounded-select bg-light-gray block w-full rounded-full border-0 px-[30px] pt-[18px] pb-[21px] text-almost-dark placeholder:text-dark-gray-2 focus:ring-2 focus:ring-inset focus:ring-primary-red  leading-[20px]',
                    ],
                ],
            ],
            'textarea' => [
                'class' => Components\Form\Textarea::class,
                'themes' => [
                    'default' => [
                        'normal' => 'max-w-lg shadow-sm block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md',
                        'invalid' => 'max-w-lg shadow-sm block w-full focus:ring-red-500 focus:border-red-500 sm:text-sm border-gray-300 rounded-md',
                        'disabled' => 'bg-gray-50 max-w-lg shadow-sm block w-full focus:ring-gray-500 focus:border-gray-500 sm:text-sm border-gray-300 rounded-md',
                    ],
                ],
            ],
            'checkbox' => [
                'class' => Components\Form\Checkbox::class,
                'themes' => [
                    'default' => [
                        'normal' => 'focus:ring-indigo-500 h-4 w-4 text-primary border-primary ',
                        'invalid' => 'focus:ring-indigo-500 h-4 w-4 text-red-600 border-primary ',
                        'disabled' => 'focus:ring-indigo-500 h-4 w-4 text-gray-600 border-primary ',
                    ],
                ],
            ],
            'error' => [
                'class' => Components\Form\Error::class,
                'themes' => [
                    'default' => 'mt-3 text-sm text-gradient',
                ],
            ],
            'description' => [
                'class' => Components\Form\Description::class,
                'themes' => [
                    'default' => 'mt-2 block text-sm text-gray-600',
                ],
            ],
        ],
    ],
];
