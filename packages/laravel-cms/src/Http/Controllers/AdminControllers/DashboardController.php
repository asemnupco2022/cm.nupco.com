<?php

namespace rifrocket\LaravelCms\Http\Controllers\AdminControllers;

use App\Models\LbsUserSearchSet;
use App\Models\PoImportScheduler;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use rifrocket\LaravelCms\Facades\LaravelCmsFacade;
use App\Http\Controllers\Controller;
use Importer;
use rifrocket\LaravelCms\Models\LbsMember;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dashboard()
    {


    //     $passing_data=[
    //         'mail_unique'=> 11111111111111111,
    //         'mail_hash'=> 4234234324,
    //         'message_type'=> 'enquiry',
    //         'unique_hash'=> 423423984074234723,
    //         'tender_num'=> 444444,
    //         'vendor_num'=>4792847982347,
    //         'po_num'=>42343,
    //         'customer_num'=>423423,
    //         'po_item_num'=>43242,
    //         'uom'=>4234234,
    //         'ordered_qty'=>4234234,
    //         'open_qty'=>4324234,
    //         'net_order_value'=>42342342,
    //         'delivery_date'=>4234234,
    //     ];
    //     $array1=['vendor_nos'=>[40001334,40003433]];
    //    return  $response = Http::post('https://hos-dev.nupco.com/HOS_S4/api/get-vendor-master',$array1);
       
        
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
        $paths = public_path('uploads/sap_parts/2021_10_23/');
        $path = ($paths.'*.csv');
        $global = glob($path);
        natsort($global);

        foreach (array_splice($global, 0, 2) as $globalKey => $file) {
            $data = array_map(function ($v) {
                return str_getcsv($v, "|");
            }, file($file));

//            if ($globalKey == 0){
//                $fileOrigin= explode('_',basename($file, '.csv'));
//                if ((int)end($fileOrigin)==0){continue;}
//            }

            foreach ($data as $key => $row) {
                dump($row);
                    if($key==65)  dd($row);

            }
//            dd('end');
            if (File::exists($file)) {
                File::delete($file);
            }
        }

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
