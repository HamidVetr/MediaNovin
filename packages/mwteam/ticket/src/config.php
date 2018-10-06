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
        'permission' => 'Mwteam\\Ticket\\Database\\Seeds\\PermissionTableSeeder',
        'ticket' => 'Mwteam\\Ticket\\Database\\Seeds\\TicketTableSeeder'
    ]
];