<?php


namespace rifrocket\LaravelCms\Http\Controllers\AuthControllers;


use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth_redirect:admin', ['only' => 'showLoginForm']);
        $this->middleware('guest:admin', ['except' => 'logout']);

    }

    public function showLoginForm()
    {
        return view('LbsViews::auth_views.views.login');
    }

    public function logout()
    {
        return 'dasdas';
    }
}
