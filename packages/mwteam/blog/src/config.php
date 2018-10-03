<?php

return [
    'sidebar' => [
        'icon' => 'ion-android-chat tx-24',
        'title' => 'مقالات',
        'path' => 'dashboard/articles',
        'yield' => 'blog',
        'subMenus' => [
            [
                'title' => 'لیست مقالات',
                'url' => route('dashboard.blog.articles.index'),
                'yield' => 'blog-articles-index',
            ],
            [
                'title' => 'ساخت مقاله جدید',
                'url' => route('dashboard.blog.articles.create'),
                'yield' => 'blog-articles-create',
            ],
        ]
    ]
];