<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;
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
        Permission::create([
            'fa_title' => 'مدیران',
            'eng_title' => 'admins',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('permission_user')->insert([
            'permission_id' => 1,
            'user_id' => 1
        ]);
    }
}
