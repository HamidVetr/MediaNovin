<?php

return [
    'sidebar' => [
        'icon' => 'ion-android-chat tx-24',
        'title' => 'تیکتینگ',
        'path' => 'dashboard/tickets',
        'yield' => 'tickets',
        'subMenus' => [
            [
                'title' => 'ارسال تیکت',
                'url' => route('dashboard.tickets.create'),
                'yield' => 'tickets-create'
            ],
            [
                'title' => 'لیست تیکت ها',
                'url' => route('dashboard.tickets.index'),
                'yield' => 'tickets-index'
            ]
        ]
    ],
    'seed' => [
        'Mwteam\\Ticket\\Database\\Seeds\\PermissionTableSeeder',
        'Mwteam\\Ticket\\Database\\Seeds\\TicketTableSeeder'
    ]
];