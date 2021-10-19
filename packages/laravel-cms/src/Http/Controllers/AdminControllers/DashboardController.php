<?php

namespace rifrocket\LaravelCms\Http\Controllers\AdminControllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use rifrocket\LaravelCms\Facades\LaravelCmsFacade;
use App\Http\Controllers\Controller;
use Importer;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dashboard()
    {
        // $baseFile=file(public_path('uploads/sap_nupco_backup.csv'));
        // $parts= (array_chunk($baseFile,1000));
        // foreach ($parts as $key=> $part){
        //     $fileName='sap_part_'.$key.'.csv';
        //     Storage::disk('public_uploads')->put('uploads/sap_parts/'.$fileName,$part);
        // }
        return view('LbsViews::admin_views.views.dashboard');
    }


    public function importPO()
    {
        $path =public_path('uploads/sap_parts/*.csv');
        $global=glob($path);

//        foreach (array_splice($global,0,1) as $file){
        foreach ($global as $file){

            $data=array_map(function($v){return str_getcsv($v, "|");},file($file));
//            foreach ($data as $row){
//
//            }
            if(File::exists($file)) {

                File::delete($file);
            }
        }


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
