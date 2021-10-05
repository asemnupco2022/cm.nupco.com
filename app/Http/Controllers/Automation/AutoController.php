<?php

namespace App\Http\Controllers\Automation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AutoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('automation.list-automates');
    }

    public function automationHistory()
    {
        return view('automation.history-automates');
    }
}
