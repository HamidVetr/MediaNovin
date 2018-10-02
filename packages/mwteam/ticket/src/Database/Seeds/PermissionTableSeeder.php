<?php
namespace Mwteam\Ticket\Database\Seeds;

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
                'fa_title' => 'تیکت ها',
                'en_title' => 'tickets',
            ],
            [
                'fa_title' => 'ایجاد تیکت',
                'en_title' => 'tickets-create',
            ],
            [
                'fa_title' => 'حذف تیکت',
                'en_title' => 'tickets-delete',
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
