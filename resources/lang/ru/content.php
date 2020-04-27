<?php

return [
    'mainPage' => [
        'title' => 'Сокращатель ссылок',
        'mainForm' =>
        [
            'pageCaption' => 'Сервис сокращения URL-ссылок',
            'inputUrlCaption' => 'Введите свой url ниже:',
            'yourUrlCaption' => 'Исходная ссылка:',
            'buttonCaption' => 'Сократить ссылку',
            'shortLinkCaption' => 'Короткая ссылка',
            'statisticLinkCaption' => 'Ссылка на статистику переходов',
            'datePickerCaption' => 'Срок хранения ссылки',
            'newButtonCaption' => 'Создать новую ссылку',
        ],
        'errors' =>
        [
            'invalidUrl' => 'Сервис не поддерживает указанный тип URL',
        ],
    ],

    'statisticPage' => [
        'title' => 'Статистика переходов по ссылке',
        'h3Caption' => 'Статистика переходов для ссылки:',
        'noDataCaption' => 'Данные по переходам отсутствуют',
        'dateCaption' => 'Дата и время (Гринвич)',
        'countryCaption' => 'Страна',
        'cityCaption' => 'Город',
        'userAgentCaption' => 'Версия браузера и ОС',
    ],

    'testData' => [
        'urls' => [
            ['token' => '00000',
                'url' => 'https://laravel.com/',
                'lifetime' => null,
            ],
            ['token' => '11111',
                'url' => 'https://laravel.com/',
                'lifetime' => '2099.01.01',
            ],
            ['token' => '2222',
                'url' => 'https://laravel.com/',
                'lifetime' => '2020.01.01',
            ],
        ],
        'statistic' => [
            ['url_id' => 1,
                'date_time' => now(),
                'country' => 'Russia',
                'city' => 'Voronezh',
                'user_agent' => 'test server',
            ],
        ],
    ],
];
