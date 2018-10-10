<?php

return [
    'sidebar' => [
        [
            'icon' => 'ion-ios-book tx-24',
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
                    'policy' => 'index',
                    'model' => \Mwteam\Blog\App\Models\BlogArticle::class,
                ],
                [
                    'title' => 'ساخت مقاله جدید',
                    'url' => route('dashboard.blog.articles.create'),
                    'yield' => 'blog-articles-create',
                    'policy' => 'create',
                    'model' => \Mwteam\Blog\App\Models\BlogArticle::class,
                ],
                [
                    'title' => 'دسته بندی‌ها',
                    'url' => route('dashboard.blog.categories.index'),
                    'yield' => 'blog-categories-index',
                    'policy' => 'index',
                    'model' => \Mwteam\Blog\App\Models\BlogCategory::class,
                ],
                [
                    'title' => 'ساخت دسته بندی جدید',
                    'url' => route('dashboard.blog.categories.create'),
                    'yield' => 'blog-categories-create',
                    'policy' => 'create',
                    'model' => \Mwteam\Blog\App\Models\BlogCategory::class,
                ],
                [
                    'title' => 'تگ‌ها',
                    'url' => route('dashboard.blog.tags.index'),
                    'yield' => 'blog-tags-index',
                    'policy' => 'index',
                    'model' => \Mwteam\Blog\App\Models\BlogTag::class,
                ],
                [
                    'title' => 'ساخت تگ جدید',
                    'url' => route('dashboard.blog.tags.create'),
                    'yield' => 'blog-tags-create',
                    'policy' => 'create',
                    'model' => \Mwteam\Blog\App\Models\BlogTag::class,
                ],
                [
                    'title' => 'نظرات',
                    'url' => route('dashboard.blog.comments.index'),
                    'yield' => 'blog-comments-index',
                    'policy' => 'index',
                    'model' => \Mwteam\Blog\App\Models\BlogComment::class,
                ],
            ]
        ]
    ],
    'seed' => [
//        'permissions' => 'Mwteam\\Blog\\Database\\Seeds\\PermissionTableSeeder',
        'tags'        => 'Mwteam\\Blog\\Database\\Seeds\\BlogTagsTableSeeder',
        'categories'  => 'Mwteam\\Blog\\Database\\Seeds\\BlogCategoriesTableSeeder',
        'articles'    => 'Mwteam\\Blog\\Database\\Seeds\\BlogArticlesTableSeeder',
        'comments'    => 'Mwteam\\Blog\\Database\\Seeds\\BlogCommentsTableSeeder',
    ],
    'validation' => [
        'image' => [
            'laravel' => [
                'max' => 5 * 1024
            ]
        ],
    ]
];