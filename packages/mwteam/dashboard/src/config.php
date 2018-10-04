<?php

return [
    'sidebar' => [
        'icon' => 'ion-ios-contact-outline tx-24',
        'title' => 'مدیران سایت',
        'yield' => 'admins',
        'permission' => 'admins',
        'model' => \App\Models\User::class,
        'subMenus' => [
            [
                'title' => 'افزودن مدیر',
                'url' => route('dashboard.admins.create'),
                'yield' => 'admins-create',
                'permission' => 'admins',
                'model' => \App\Models\User::class,
            ],
            [
                'title' => 'لیست مدیران',
                'url' => route('dashboard.admins.index'),
                'yield' => 'admins-index',
                'permission' => 'admins',
                'model' => \App\Models\User::class,
            ]
        ]
    ],
    'seed' => [
        'user' => 'Mwteam\\Dashboard\\Database\\Seeds\\UsersTableSeeder',
        'permission' => 'Mwteam\\Dashboard\\Database\\Seeds\\PermissionTableSeeder',
    ]
];