<?php

return [
    'sidebar' => [
        'icon' => 'ion-android-chat tx-24',
        'title' => 'تیکتینگ',
        'path' => 'dashboard/tickets',
        'yield' => 'tickets',
        'notification' => 'ticketCount',
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
        'permission' => 'Mwteam\\Ticket\\Database\\Seeds\\PermissionTableSeeder',
        'ticket' => 'Mwteam\\Ticket\\Database\\Seeds\\TicketTableSeeder'
    ]
];