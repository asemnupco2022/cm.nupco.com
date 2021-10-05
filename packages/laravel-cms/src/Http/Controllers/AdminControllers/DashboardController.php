<?php

namespace rifrocket\LaravelCms\Http\Controllers\AdminControllers;

use App\Jobs\Po\NotifySap;
use App\Models\PoSapMaster;
use App\Models\PoSapMasterSchedle;
use Carbon\Carbon;
use rifrocket\LaravelCms\Facades\LaravelCmsFacade;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dashboard()
    {
//        $prepares=PoSapMasterSchedle::orderBy('purchasing_document')->groupBy('purchasing_document')->get();
//        dd($prepares);
        return view('LbsViews::admin_views.views.dashboard');
    }

    public function logout()
    {
        return  LaravelCmsFacade::lsb_logout('admin','lbs.auth.admin.login');
    }


    public function error404()
    {
        return view('LbsViews::admin_docs.errors.404');
    }

}
