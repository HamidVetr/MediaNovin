<?php
namespace Mwteam\Dashboard\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'a',
            'last_name' => 'a',
            'username' => 'admin',
            'email' => 'admin@email.com',
            'password' => bcrypt('123456'),
            'role' => 'super-admin',
        ]);

        User::create([
            'first_name' => 'b',
            'last_name' => 'b',
            'username' => 'user',
            'email' => 'user@email.com',
            'password' => bcrypt('123456'),
            'role' => 'user',
        ]);

        User::create([
            'first_name' => 'c',
            'last_name' => 'c',
            'username' => 'user2',
            'email' => 'user2@email.com',
            'password' => bcrypt('123456'),
            'role' => 'user',
        ]);

        User::create([
            'first_name' => 'd',
            'last_name' => 'd',
            'username' => 'admin2',
            'email' => 'admin2@email.com',
            'password' => bcrypt('123456'),
            'role' => 'admin',
        ]);
    }
}
