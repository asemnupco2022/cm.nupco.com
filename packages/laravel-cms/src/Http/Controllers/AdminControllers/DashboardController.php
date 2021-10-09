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

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dashboard()
    {
//        $filesPathTest=   Storage::disk('public_uploads')->allFiles('testfolder')[0];
//        dd($filesPathTest);
//        $expDate_20 = Carbon::now()->subDays(20)->format('Y-m-d');
//
//        $prepares=PoSapMasterSchedle::whereDate('nupco_delivery_date','>','2021-08-05')->orderBy('vendor_code')->get()->toArray();
//        $prepares=collect($prepares)->groupBy('vendor_code');
//
//        foreach ($prepares as $vendorCode=> $collection){
//            $childCollection =collect($collection)->groupBy('scheduler_id');
//            foreach ($childCollection as $schedulerId=> $CCollection){
//                dispatch(new NotifySap($vendorCode,$schedulerId,$CCollection, 'enquiry-email'));
//            }
//        }
//        dd('eixt');

//       $data = PoSapMasterSchedle::where('vendor_code',400021)->update(['execution_done'=>'20']);dd($data);
//        Permission::create(['name' => 'lbs-permission-staff-data','display_name'=>'Access Staff','json_data'=>'master']);

//        return response()->json([
//            'message_type'=>'enquiry',
//            'unique_hash'=>'3gr4htn3rrgh3jokrko',
//            'tender_num'=>'NPT0001/18',
//            'vendor_num'=>'23454',
//            'po_num'=>'345678909876',
//            'customer_num'=>'9765432234F',
//            'po_item_num'=>'10',
//            'mat_num'=>'10',
//            'uom'=>'103',
//            'ordered_qty'=>'10888',
//            'open_qty'=>'10000',
//            'net_order_value'=>'1034567.538',
//            'delivery_date'=>Carbon::now()->format('Y-m-d'),
//        ]);

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
