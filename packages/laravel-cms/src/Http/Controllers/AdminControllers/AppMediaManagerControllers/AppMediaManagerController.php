<?php

namespace rifrocket\LaravelCms\Http\Controllers\AdminControllers\AppMediaManagerControllers;

use App\Http\Controllers\Controller;

class AppMediaManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function mediaManager()
    {
        return view('LbsViews::admin_views.views.media_manager.list_media');
    }
}
