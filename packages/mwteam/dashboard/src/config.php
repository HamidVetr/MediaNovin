<?php

return [
    'sidebar' => [
        [
            'icon' => 'ion-ios-contact-outline tx-24',
            'title' => 'مدیران سایت',
            'yield' => 'admins',
            'policy' => 'admins',
            'model' => \App\Models\User::class,
            'subMenus' => [
                [
                    'title' => 'افزودن مدیر',
                    'url' => route('dashboard.admins.create'),
                    'yield' => 'admins-create',
                    'policy' => 'admins',
                    'model' => \App\Models\User::class,
                ],
                [
                    'title' => 'لیست مدیران',
                    'url' => route('dashboard.admins.index'),
                    'yield' => 'admins-index',
                    'policy' => 'admins',
                    'model' => \App\Models\User::class,
                ]
            ]
        ],
        [
            'icon' => 'ion-ios-gear-outline tx-24',
            'title' => 'تنظیمات',
            'yield' => 'settings',
            'policy' => 'settings',
            'model' => \Mwteam\Dashboard\App\Models\Setting::class,
        ]
    ],
    'seed' => [
        'users' => 'Mwteam\\Dashboard\\Database\\Seeds\\UsersTableSeeder',
        'permissions' => 'Mwteam\\Dashboard\\Database\\Seeds\\PermissionTableSeeder',
    ]
];