<?php

return [
    'mainPage' => [
        'title' => 'Сокращатель ссылок',
        'mainForm' =>
        [
            'pageCaption' => 'Сервис сокращения URL-ссылок',
            'inputUrlCaption' => 'Введите свой url ниже:',
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
        'dateCaption' => 'Дата и время',
        'countryCaption' => 'Страна',
        'cityCaption' => 'Город',
        'userAgentCaption' => 'Версия браузера и ОС'
    ],
];
