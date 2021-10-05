<?php

namespace App\Http\Controllers\Logs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserLogController extends Controller
{
    public function index()
    {
        return view('logs.user-logs');
    }
}
