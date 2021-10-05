<?php


namespace rifrocket\LaravelCms\Http\Livewire\AdminControllers\layouts;

use rifrocket\LaravelCms\Facades\LaravelCmsFacade;
use Livewire\Component;

class AdminLeftMenuComponent extends Component
{

    public function logout()
    {
        return  LaravelCmsFacade::lsb_logout('admin','lbs.auth.admin.login');
    }
    public function render()
    {
        return view('LbsViews::livewire.AdminComponent.layouts.admin_left_menu');
    }

}
