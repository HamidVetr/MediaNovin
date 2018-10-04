<?php

namespace Mwteam\Blog\Database\Seeds;

use Illuminate\Database\Seeder;
use Mwteam\Dashboard\App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prev_permissions = Permission::select('en_title')->get()->toArray();
        $seeded_permissions = array_map(function ($permission){
            return $permission['en_title'];
        }, $prev_permissions);

        $permissions = [
            [
                'fa_title' => 'وبلاگ',
                'en_title' => 'blog',
            ],
            [
                'fa_title' => 'ایجاد مقاله',
                'en_title' => 'blog-articles-create',
            ],
            [
                'fa_title' => 'ویرایش مقاله',
                'en_title' => 'blog-articles-edit',
            ],
            [
                'fa_title' => 'حذف مقاله',
                'en_title' => 'blog-articles-delete',
            ],
            [
                'fa_title' => 'ایجاد دسته بندی',
                'en_title' => 'blog-categories-create',
            ],
            [
                'fa_title' => 'ویرایش دسته بندی',
                'en_title' => 'blog-categories-edit',
            ],
            [
                'fa_title' => 'حذف دسته بندی',
                'en_title' => 'blog-categories-delete',
            ],
            [
                'fa_title' => 'ایجاد تگ',
                'en_title' => 'blog-tags-create',
            ],
            [
                'fa_title' => 'ویرایش تگ',
                'en_title' => 'blog-tags-edit',
            ],
            [
                'fa_title' => 'حذف تگ',
                'en_title' => 'blog-tags-delete',
            ],
            [
                'fa_title' => 'تایید نظر',
                'en_title' => 'blog-comments-approve',
            ],
            [
                'fa_title' => 'ویرایش نظر',
                'en_title' => 'blog-comments-edit',
            ],
            [
                'fa_title' => 'حذف نظر',
                'en_title' => 'blog-comments-delete',
            ],
            [
                'fa_title' => 'پاسخ به نظر',
                'en_title' => 'blog-comments-reply',
            ],
        ];

        foreach ($permissions as $permission){
            if (!in_array($permission['en_title'], $seeded_permissions)) {
                $newPermission = Permission::create([
                    'fa_title' => $permission['fa_title'],
                    'en_title' => $permission['en_title'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                DB::table('permission_user')->insert([
                    'permission_id' => $newPermission->id,
                    'user_id' => 1
                ]);
            }
        }
    }
}
