<?php

return [
    'sidebar' => [
        'icon' => 'ion-android-chat tx-24',
        'title' => 'تیکتینگ',
        'path' => 'dashboard/tickets',
        'yield' => 'tickets',
        'notification' => 'ticketCount',
        'method' => 'tickets',
        'model' => Mwteam\Ticket\App\Models\Ticket::class,
        'subMenus' => [
            [
                'title' => 'ارسال تیکت',
                'url' => route('dashboard.tickets.create'),
                'yield' => 'tickets-create',
                'method' => 'tickets',
                'model' => Mwteam\Ticket\App\Models\Ticket::class,
            ],
            [
                'title' => 'لیست تیکت ها',
                'url' => route('dashboard.tickets.index'),
                'yield' => 'tickets-index'
            ]
        ]
    ],
    'seed' => [
        'permission' => 'Mwteam\\Ticket\\Database\\Seeds\\PermissionTableSeeder',
        'ticket' => 'Mwteam\\Ticket\\Database\\Seeds\\TicketTableSeeder'
    ]
];