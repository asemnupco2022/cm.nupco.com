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

    public function ticketChat(Request $request)
    {
            return view('ticket-manager.ticket-chat', ['mail_ticket_hash'=>$request->token]);
    }

    public function download_attachment(){
        $filename = 'temp-image.jpg';
        $tempImage = tempnam(sys_get_temp_dir(), $filename);
        copy('https://my-cdn.com/files/image.jpg', $tempImage);
 
        return response()->download($tempImage, $filename);
    }
}
