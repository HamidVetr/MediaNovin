<?php
namespace Mwteam\Dashboard\Database\Seeds;

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
        $permissions = [
            [
                'fa_title' => 'مدیران',
                'en_title' => 'admins',
                'parent' => null
            ],
        ];

        foreach ($permissions as $permission){
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
