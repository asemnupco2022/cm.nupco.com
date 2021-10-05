<?php


namespace rifrocket\LaravelCms\Http\Controllers\AdminControllers\AppSettingControllers;


use App\Http\Controllers\Controller;

class AppSettingController extends Controller
{

    public function listAppSettings()
    {
        return view('LbsViews::admin_views.layouts.masterLayout');
    }

}
