<?php

return [
    'sidebar' => [
        'icon' => 'ion-android-chat tx-24',
        'title' => 'مدیریت بلاگ',
        'path' => 'dashboard/articles',
        'yield' => 'blog',
        'subMenus' => [
            [
                'title' => 'مقالات',
                'url' => route('dashboard.blog.articles.index'),
                'yield' => 'blog-articles-index',
            ],
            [
                'title' => 'ساخت مقاله جدید',
                'url' => route('dashboard.blog.articles.create'),
                'yield' => 'blog-articles-create',
            ],
            [
                'title' => 'دسته بندی‌ها',
                'url' => route('dashboard.blog.categories.index'),
                'yield' => 'blog-categories-index',
            ],
            [
                'title' => 'ساخت دسته بندی جدید',
                'url' => route('dashboard.blog.categories.create'),
                'yield' => 'blog-categories-create',
            ],
            [
                'title' => 'تگ‌ها',
                'url' => route('dashboard.blog.tags.index'),
                'yield' => 'blog-tags-index',
            ],
            [
                'title' => 'ساخت تگ جدید',
                'url' => route('dashboard.blog.tags.create'),
                'yield' => 'blog-tags-create',
            ],
            [
                'title' => 'نظرات',
                'url' => route('dashboard.blog.comments.index'),
                'yield' => 'blog-comments-index',
            ],
        ]
    ],
    'seed' => [
        'permissions' => 'Mwteam\\Blog\\Database\\Seeds\\PermissionTableSeeder',
        'tags'        => 'Mwteam\\Blog\\Database\\Seeds\\BlogTagsTableSeeder',
        'categories'  => 'Mwteam\\Blog\\Database\\Seeds\\BlogCategoriesTableSeeder',
        'articles'    => 'Mwteam\\Blog\\Database\\Seeds\\BlogArticlesTableSeeder',
        'comments'    => 'Mwteam\\Blog\\Database\\Seeds\\BlogCommentsTableSeeder',
    ]
];