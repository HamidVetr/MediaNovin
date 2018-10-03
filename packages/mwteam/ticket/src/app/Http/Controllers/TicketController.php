<?php

namespace Mwteam\Ticket\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        return view('ticket::dashboard.index');
    }

    public function create()
    {
        return view('ticket::dashboard.create');
    }

    public function store()
    {

    }

    public function show($ticketId)
    {
        return view('ticket::dashboard.show');
    }

    public function reply($ticketId)
    {

    }

    public function destroy($ticketId)
    {

    }

    public function destroyMessage($ticketId, $messageId)
    {

    }
}
