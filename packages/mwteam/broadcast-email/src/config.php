<?php

return [
    'sidebar' => [
        [
            'icon' => 'ion-android-chat tx-24',
            'title' => 'ارسال پیام گروهی',
            'yield' => 'broadcast-email',
            'policy' => 'broadcastEmail',
            'model' => \Mwteam\BroadcastEmail\App\Models\BroadcastEmail::class,
            'subMenus' => [
                [
                    'title' => 'ارسال پیام',
                    'url' => route('dashboard.broadcastEmail.create'),
                    'yield' => 'broadcast-email-create',
                    'policy' => 'broadcastEmail',
                    'model' => \Mwteam\BroadcastEmail\App\Models\BroadcastEmail::class,
                ],
                [
                    'title' => 'لیست پیام ها',
                    'url' => route('dashboard.broadcastEmail.index'),
                    'yield' => 'broadcast-email-index',
                    'policy' => 'broadcastEmail',
                    'model' => \Mwteam\BroadcastEmail\App\Models\BroadcastEmail::class,
                ]
            ]
        ]
    ],
    'seed' => [
        'permissions' => 'Mwteam\\BroadcastEmail\\Database\\Seeds\\PermissionTableSeeder',
        'broadcast_emails' => 'Mwteam\\BroadcastEmail\\Database\\Seeds\\BroadcastEmailTableSeeder'
    ],
];