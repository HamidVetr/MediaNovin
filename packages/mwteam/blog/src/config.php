<?php

return [
    'sidebar' => [
        [
            'icon' => 'ion-android-chat tx-24',
            'title' => 'مدیریت بلاگ',
            'path' => 'dashboard/articles',
            'yield' => 'blog',
            'policy' => 'blog',
            'model' => \Mwteam\Blog\App\Models\BlogArticle::class,
            'subMenus' => [
                [
                    'title' => 'مقالات',
                    'url' => route('dashboard.blog.articles.index'),
                    'yield' => 'blog-articles-index',
                    'policy' => 'blog',
                    'model' => \Mwteam\Blog\App\Models\BlogArticle::class,
                ],
                [
                    'title' => 'ساخت مقاله جدید',
                    'url' => route('dashboard.blog.articles.create'),
                    'yield' => 'blog-articles-create',
                    'policy' => 'blog',
                    'model' => \Mwteam\Blog\App\Models\BlogArticle::class,
                ],
                [
                    'title' => 'دسته بندی‌ها',
                    'url' => route('dashboard.blog.categories.index'),
                    'yield' => 'blog-categories-index',
                    'policy' => 'blog',
                    'model' => \Mwteam\Blog\App\Models\BlogArticle::class,
                ],
                [
                    'title' => 'ساخت دسته بندی جدید',
                    'url' => route('dashboard.blog.categories.create'),
                    'yield' => 'blog-categories-create',
                    'policy' => 'blog',
                    'model' => \Mwteam\Blog\App\Models\BlogArticle::class,
                ],
                [
                    'title' => 'تگ‌ها',
                    'url' => route('dashboard.blog.tags.index'),
                    'yield' => 'blog-tags-index',
                    'policy' => 'blog',
                    'model' => \Mwteam\Blog\App\Models\BlogArticle::class,
                ],
                [
                    'title' => 'ساخت تگ جدید',
                    'url' => route('dashboard.blog.tags.create'),
                    'yield' => 'blog-tags-create',
                    'policy' => 'blog',
                    'model' => \Mwteam\Blog\App\Models\BlogArticle::class,
                ],
                [
                    'title' => 'نظرات',
                    'url' => route('dashboard.blog.comments.index'),
                    'yield' => 'blog-comments-index',
                    'policy' => 'blog',
                    'model' => \Mwteam\Blog\App\Models\BlogArticle::class,
                ],
            ]
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