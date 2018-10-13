<?php
namespace Mwteam\Ticket\Database\Seeds;

use Illuminate\Database\Seeder;
use Mwteam\Ticket\App\Models\Ticket;
use Mwteam\Ticket\App\Models\TicketMessages;

class TicketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ticket = Ticket::create([
           'user_id' => 2,
           'title' => 'تست 1',
           'status' => 'closed'
        ]);

        TicketMessages::create([
            'ticket_id' => $ticket->id,
            'sender' => 1,
            'sent_from' => 'admin-panel',
            'message' => 'پیام 1 تست 1 ادمین',
            'seen' => 1
        ]);

        TicketMessages::create([
            'ticket_id' => $ticket->id,
            'sender' => 2,
            'sent_from' => 'user-panel',
            'message' => 'پیام 2 تست 1 کاربر',
            'seen' => 1
        ]);

        TicketMessages::create([
            'ticket_id' => $ticket->id,
            'sender' => 4,
            'sent_from' => 'admin-panel',
            'message' => 'پیام 3 تست 1 ادمین',
            'seen' => 0
        ]);

        $ticket = Ticket::create([
            'user_id' => 3,
            'title' => 'تست 2',
            'status' => 'in-queue'
        ]);

        TicketMessages::create([
            'ticket_id' => $ticket->id,
            'sender' => 3,
            'sent_from' => 'user-panel',
            'message' => 'پیام 1 تست 2 کاربر',
            'seen' => 0
        ]);
    }
}
