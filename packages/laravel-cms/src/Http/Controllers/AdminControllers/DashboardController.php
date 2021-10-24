<?php

namespace rifrocket\LaravelCms\Http\Controllers\AdminControllers;

use App\Models\LbsUserSearchSet;
use App\Models\PoImportScheduler;
use App\Models\PoSapMaster;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use rifrocket\LaravelCms\Facades\LaravelCmsFacade;
use App\Http\Controllers\Controller;
use Importer;
use rifrocket\LaravelCms\Models\LbsMember;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dashboard()
    {
//        dd(Carbon::now());
        return view('LbsViews::admin_views.views.dashboard');
    }

    public function importCsv()
    {
        $baseFile = file(public_path('uploads/vendor_masters.csv')); //dd(count($baseFile));
//        DB::table('lbs_members')->truncate();
        foreach ($baseFile as $globalKey => $file) {

            $row =str_getcsv($file, ",");
            if ($globalKey == 0){
                continue;
            }

            if (LbsMember::where('vendor_code',$row[0] )->first()){
                $insert= LbsMember::where('vendor_code',$row[0] )->first();

            }else{
                $insert=new LbsMember();
            }
            try {
                $insert->vendor_code=$row[0];
                $insert->first_name=$row[1];
                $insert->last_name=$row[2];
                $insert->username=$row[1];
                $insert->display_name=$row[1];
                $insert->email=$row[3];
                $insert->password=Hash::make($row[3]);
                $insert->save();

            }catch (\Exception $exception){

                return $exception->getMessage();
            }

        }

        return 'transfer done';
    }


    public function importPO()
    {

        $baseFile = file(public_path('uploads/sap_nupco_backup.csv'));
        if (!File::exists(public_path('uploads/sap_nupco_backup.csv'))) {
            return 0;
        }

        $total_files=0;
        $total_records=0;

        $parts = (array_chunk($baseFile, 5000));

        $partPath='uploads/sap_parts/'.Carbon::now()->format('Y_m_d').'/';

        foreach ($parts as $key => $part) {
            $total_files++;
            $total_records=$total_records+count($part);
            $fileName = 'sap_part_' . $key . '.csv';
            Storage::disk('public_uploads')->put($partPath . $fileName, $part);
        }

        $insert=new PoImportScheduler();
        $insert->table_type=LbsUserSearchSet::TEMPLATE_SAP_LINE_ITEM;
        $insert->path=$partPath;
        $insert->total_files=$total_files;
        $insert->total_records=$total_records;
        $insert->save();
    }

    public function readPO()
    {
        $paths = public_path('uploads/sap_parts/2021_10_24/');
        $path = ($paths.'*.csv');
        $global = glob($path);
        natsort($global);

        foreach ($global as $globalKey => $file) {
            $data = array_map(function ($v) {
                return str_getcsv($v, "|");
            }, file($file));

            if ( $globalKey ==0 ){
                $fileOrigin= explode('_',basename($file, '.csv'));
                if ((int)end($fileOrigin)==0){

                    continue;}
            }
            foreach ($data as $key => $row) {

               $this->storeInfo($row);

            }

            if (File::exists($file)) {
                File::delete($file);
            }
        }

    }

    protected function storeInfo($row){

        $insertable=[

            "document_type"=>$row[0],
            "document_type_desc"=>$row[1],
            "po_number"=>(int)$row[2],
            "po_item"=>(int)$row[3],
            "material_number"=>$row[4],
            "mat_description"=>$row[5],
            "po_created_on"=>$row[6],
            "purchasing_organization"=>$row[7],
            "purchasing_group"=>$row[8],
            "currency"=>$row[9],
            "customer_no"=>$row[10],
            "customer_name"=>$row[11],
            "tender_no"=>$row[12],
            "tender_desc"=>$row[13],
            "vendor_code"=>$row[14],
            "vendor_name_en"=>$row[15],
            "vendor_name_er"=>$row[16],
            "plant"=>$row[17],
            "storage_location"=>$row[18],
            "uo_m"=>$row[19],
            "net_price"=>$row[20],
            "price_unit"=>$row[21],
            "net_value"=>$row[22],
            "nupco_trade_code"=>$row[23],
            "nupco_delivery_date"=>$row[24],
            "ordered_quantity"=>$row[25],
            "open_quantity"=>$row[26],
            "item_status"=>$row[27],
            "delivery_address"=>$row[28],
            "delivery_no"=>$row[29],   //here is the index change
            "cust_gen_code"=>$row[31],
            "generic_mat_code"=>$row[32],
            "old_new_po_number"=>$row[33],
            "old_po_item"=>$row[34],
            "gr_quantity"=>$row[35],
            "gr_amount"=>$row[36],
            "supply_ratio"=>((int)$row[35]/(int)$row[25])*100
        ];


        PoSapMaster::create($insertable);

    }


    public function logout()
    {
        return LaravelCmsFacade::lsb_logout('admin', 'lbs.auth.admin.login');
    }


    public function error404()
    {
        return view('LbsViews::admin_docs.errors.404');
    }

}
