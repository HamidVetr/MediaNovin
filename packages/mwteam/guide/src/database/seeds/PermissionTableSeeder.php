<?php

namespace Mwteam\Guide\Database\Seeds;

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
                'fa_title' => 'راهنما',
                'en_title' => 'guide',
                'parent' => null,
            ],
            [
                'fa_title' => 'ایجاد راهنما',
                'en_title' => 'guide-create',
                'parent' => 'guide',
            ],
            [
                'fa_title' => 'ویرایش راهنما',
                'en_title' => 'guide-edit',
                'parent' => 'guide',
            ],
            [
                'fa_title' => 'حذف راهنما',
                'en_title' => 'guide-delete',
                'parent' => 'guide',
            ],
            [
                'fa_title' => 'ایجاد دسته بندی',
                'en_title' => 'guide-categories-create',
                'parent' => 'guide',
            ],
            [
                'fa_title' => 'ویرایش دسته بندی',
                'en_title' => 'guide-categories-edit',
                'parent' => 'guide',
            ],
            [
                'fa_title' => 'حذف دسته بندی',
                'en_title' => 'guide-categories-delete',
                'parent' => 'guide',
            ],
        ];

        foreach ($permissions as $permission){
            if (!in_array($permission['en_title'], $seeded_permissions)) {
                $newPermission = Permission::create([
                    'fa_title' => $permission['fa_title'],
                    'en_title' => $permission['en_title'],
                    'parent' => $permission['parent'],
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
