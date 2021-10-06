<?php


namespace rifrocket\LaravelCms\Http\Livewire\AdminControllers\layouts;


use Livewire\Component;
use rifrocket\LaravelCms\Facades\LaravelCmsFacade;

class AdminNavBarComponent extends  Component
{


    public function logout()
    {
        return  LaravelCmsFacade::lsb_logout('admin','lbs.auth.admin.login');
    }

    public function render()
    {
        return view('LbsViews::livewire.AdminComponent.layouts.admin_nav');
    }
}
