<?php

namespace rifrocket\LaravelCms\Http\Controllers\AdminControllers;

use App\Jobs\Po\NotifySap;
use App\Models\PoSapMaster;
use App\Models\PoSapMasterSchedle;
use Carbon\Carbon;
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
