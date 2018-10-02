<?php

return [
    'sidebar' => [
        'icon' => 'ion-android-chat tx-24',
        'title' => 'مقالات',
        'path' => 'dashboard/articles',
        'subMenus' => [
            [
                'title' => 'لیست مقالات',
                'url' => route('dashboard.articles.index')
            ],
            [
                'title' => 'ساخت مقاله جدید',
                'url' => route('dashboard.articles.create'),
            ],
        ]
    ]
];