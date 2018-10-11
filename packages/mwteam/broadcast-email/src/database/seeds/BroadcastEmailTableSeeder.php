<?php
namespace Mwteam\BroadcastEmail\Database\Seeds;

use Illuminate\Database\Seeder;
use Mwteam\BroadcastEmail\App\Models\BroadcastEmail;

class BroadcastEmailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BroadcastEmail::create([
            'title' => 'aa',
            'content' => 'aaaaaaaaaaaaaaaaaaaaaaaa',
            'users' => [0]
        ]);

        BroadcastEmail::create([
            'title' => 'bb',
            'content' => 'bbbbbbbbbbbbbbbbbbbbbbbbb',
            'users' => [2,3]
        ]);
    }
}
