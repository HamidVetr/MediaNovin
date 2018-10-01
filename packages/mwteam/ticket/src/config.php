<?php

return [
    'sidebar' => [
        'icon' => 'ion-android-chat tx-24',
        'title' => 'تیکتینگ',
        'path' => 'dashboard/tickets',
        'subMenus' => [
            [
                'title' => 'ارسال تیکت',
                'url' => route('dashboard.tickets.create'),
            ],
            [
                'title' => 'لیست تیکت ها',
                'url' => route('dashboard.tickets.index')
            ]
        ]
    ]
];