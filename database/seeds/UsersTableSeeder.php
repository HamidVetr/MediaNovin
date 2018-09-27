<?php

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
            'role' => 1,
        ]);

        User::create([
            'first_name' => 'b',
            'last_name' => 'b',
            'username' => 'user',
            'email' => 'user@email.com',
            'password' => bcrypt('123456'),
            'role' => 2,
        ]);
    }
}
