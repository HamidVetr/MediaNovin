<?php

return [
    'sidebar' => [
        [
            'icon'   => 'ion-help tx-24',
            'title'  => 'مدیریت راهنماها',
            'yield'  => 'guide',
            'policy' => 'guide',
            'model'  => \Mwteam\Guide\App\Models\Guide::class,
            'subMenus' => [
                [
                    'title'  => 'راهنماها',
                    'url'    => route('dashboard.guide.index'),
                    'yield'  => 'guide-index',
                    'policy' => 'index',
                    'model'  => \Mwteam\Guide\App\Models\Guide::class,
                ],
                [
                    'title'  => 'ساخت راهنمای جدید',
                    'url'    => route('dashboard.guide.create'),
                    'yield'  => 'guide-create',
                    'policy' => 'create',
                    'model'  => \Mwteam\Guide\App\Models\Guide::class,
                ],
                [
                    'title'  => 'دسته بندی‌ها',
                    'url'    => route('dashboard.guide.categories.index'),
                    'yield'  => 'guide-categories-index',
                    'policy' => 'index',
                    'model'  => \Mwteam\Guide\App\Models\GuideCategory::class,
                ],
                [
                    'title'  => 'ساخت دسته بندی جدید',
                    'url'    => route('dashboard.guide.categories.create'),
                    'yield'  => 'guide-categories-create',
                    'policy' => 'create',
                    'model'  => \Mwteam\Guide\App\Models\GuideCategory::class,
                ],
            ]
        ]
    ],
    'seed' => [
        'permissions' => 'Mwteam\\Guide\\Database\\Seeds\\PermissionTableSeeder',
        'guides'      => 'Mwteam\\Guide\\Database\\Seeds\\GuidesTableSeeder',
        'categories'  => 'Mwteam\\Guide\\Database\\Seeds\\GuideCategoriesTableSeeder',
    ],
    'validation' => [
        'image' => [
            'laravel' => [
                'max' => 5 * 1024
            ]
        ],
    ]
];