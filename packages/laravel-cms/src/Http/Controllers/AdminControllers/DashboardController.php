<?php

namespace rifrocket\LaravelCms\Http\Controllers\AdminControllers;

use App\Jobs\Po\NotifySap;
use App\Models\PoSapMaster;
use App\Models\PoSapMasterSchedle;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use rifrocket\LaravelCms\Facades\LaravelCmsFacade;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Importer;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dashboard()
    {

    //    $baseFilePath=public_path('uploads/sap_nupco_backup.csv');
    //    $excel = Importer::make('Csv');
    //    $excel->load($baseFilePath);
    //    $collection = $excel->getCollection()->toArray();
    //    dd($collection);
    //    $newCollection=[];
    //    foreach(  $collection as $key => $collect){
    //        $implded=implode("|",$collect);
    //        $newCollection[$key]  =explode('|',$implded);
    //    }
    //    dd($collection);
//        $collection = collect($newCollection);

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
