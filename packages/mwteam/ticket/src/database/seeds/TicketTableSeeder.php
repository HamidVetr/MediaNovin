<?php
namespace Mwteam\Ticket\Database\Seeds;

use Illuminate\Database\Seeder;
use Mwteam\Ticket\App\Models\Ticket;

class TicketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Ticket::create([
           'user_id' => 2,
           'title' => 'تست',
           'status' => 'closed'
       ]);
    }
}
