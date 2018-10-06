<?php

return [
    'sidebar' => [
        [
            'icon' => 'ion-android-chat tx-24',
            'title' => 'تیکتینگ',
            'yield' => 'tickets',
            'permission' => 'tickets',
            'model' => \Mwteam\Ticket\App\Models\Ticket::class,
            'subMenus' => [
                [
                    'title' => 'ارسال تیکت',
                    'url' => route('dashboard.tickets.create'),
                    'yield' => 'tickets-create',
                    'permission' => 'tickets-send',
                    'model' => \Mwteam\Ticket\App\Models\Ticket::class,
                ],
                [
                    'title' => 'لیست تیکت ها',
                    'url' => route('dashboard.tickets.index'),
                    'yield' => 'tickets-index',
                    'permission' => 'tickets',
                    'model' => \Mwteam\Ticket\App\Models\Ticket::class,
                ]
            ]
        ]
    ],
    'seed' => [
        'permissions' => 'Mwteam\\Ticket\\Database\\Seeds\\PermissionTableSeeder',
        'tickets' => 'Mwteam\\Ticket\\Database\\Seeds\\TicketTableSeeder'
    ],
    'validation' => [
        'file' => [
            'laravel' => [
                'mimetypes' => 'image/jpeg,image/png,application/pdf,application/zip',
                'max' => 10240,
                'file.max' => 'حداکثر سایز فایل 10 مگابایت می باشد'
            ],
            'js' => [
                'type' => 'image/jpeg,image/png,application/pdf,application/x-zip-compressed',
                'maxSize' => 1024 * 1024 * 10,
                'message' => 'فرمت قابل قبول: jpg, png, pdf, zip. حداکثر سایز فایل: 10 مگابایت',
            ]
        ]
    ]
];