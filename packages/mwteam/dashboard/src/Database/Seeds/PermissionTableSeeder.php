<?php
namespace Mwteam\Dashboard\Database\Seeds;

use Illuminate\Database\Seeder;
use Mwteam\Dashboard\Models\Permission;
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
        $permissions = [
            [
                'fa_title' => 'مدیران',
                'en_title' => 'admins',
            ],
            [
                'fa_title' => 'ایجاد مدیر',
                'en_title' => 'admins-create',
            ],
            [
                'fa_title' => 'ویرایش مدیر',
                'en_title' => 'admins-edit',
            ],
            [
                'fa_title' => 'حذف مدیر',
                'en_title' => 'admins-delete',
            ],
        ];

        foreach ($permissions as $permission){
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
