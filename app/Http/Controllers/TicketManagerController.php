<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketManagerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
            return view('ticket-manager.list-tickets');
    }

    public function ticketChat()
    {
            return view('ticket-manager.ticket-chat');
    }
}
