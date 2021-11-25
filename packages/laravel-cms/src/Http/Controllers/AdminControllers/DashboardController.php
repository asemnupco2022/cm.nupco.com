<?php

namespace rifrocket\LaravelCms\Http\Controllers\AdminControllers;

use App\Helpers\PoHelper;
use App\Models\LbsUserSearchSet;
use App\Models\PoImportScheduler;
use App\Models\PoSapMaster;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use rifrocket\LaravelCms\Facades\LaravelCmsFacade;
use App\Http\Controllers\Controller;
use App\Jobs\Po\FilterSap;
use App\Jobs\Po\MigrateSap;
use App\Jobs\Po\NotifySap;
use App\Models\PoSapMasterScheduler;
use App\Models\PoSapMasterTmp;
use App\Models\SupplierCommentTypes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Importer;
use rifrocket\LaravelCms\Models\LbsMember;
use Spatie\Permission\Models\Permission;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dashboard()
    {

        // return PoHelper::NormalizeColString(null,PoSapMaster::CONS_COLUMNS_NORMALIZED);

        // $query=PoSapMaster::orderBy('vendor_code', 'ASC')->pluck('id')->toArray();
        // dd($query);
        // $ColKeys=['a','b','c'];

        // if ($collectionCount == 0  ) {
        //     $collection =  PoSapMaster::whereIn('id',[1,2,3,4,5]);

        //     PoHelper::sendJobSAp($ColKeys,$collection,'EXCEL');
        //     return 3434;
        // }

        // return PoHelper::collection_vendor_codes();
        // dd(PoSapMasterTmp::where('unique_line','4500013398_1390')->first());

        // $saptmp=[
        //     'unique_hash'=>'4234234324234ss3',
        //     'notified'=>'yes',
        // ];
        // $tmpResult=PoHelper::sapMasterTmp($saptmp,'4500013398', '1250');
        // dd($tmpResult);
    //    dd( SupplierCommentTypes::supplierCommets());

        // $fiveStar = PoSapMaster::orderBy('vendor_code', 'ASC')->Saptmp('تم التوريد (يجب ارفاق مذكرة الاستلام)');
        // dd($fiveStar->get());
        // dd($fiveStar->toSql());
//        Carbon::parse('30/05/2021')->format('Y-m-d');
    //    Permission::create(['name' => 'lbs-permission-supplier-comments','display_name'=>'Access To Supplier Comments']);
        return redirect()->route('web.route.dashboard.summary');
    }

    public function summary()
    {
        $summary=true;
        $ifram_url='https://nupcobi.nupco.com/Reports/powerbi/Contract/Summary%20Dashboard';
        return view('LbsViews::admin_views.views.dashboard',compact('summary','ifram_url'));
    }

    public function suppliers_performance()
    {
        $suppliers_performance=true;
        $ifram_url='https://nupcobi.nupco.com/Reports/powerbi/Contract/Suppliers%20Performance';
        return view('LbsViews::admin_views.views.dashboard',compact('suppliers_performance','ifram_url'));
    }


    public function tenders()
    {
         $tenders=true;
         $ifram_url='https://nupcobi.nupco.com/Reports/powerbi/Contract/Tenders';
        return view('LbsViews::admin_views.views.dashboard',compact('tenders','ifram_url'));
    }


    public function progress()
    {
         $progress=true;
         $ifram_url='https://nupcobi.nupco.com/Reports/powerbi/Contract/Progress';
        return view('LbsViews::admin_views.views.dashboard',compact('progress','ifram_url'));
    }


    public function over_due()
    {
         $over_due=true;
         $ifram_url='https://nupcobi.nupco.com/Reports/powerbi/Contract/Over%20Due';
        return view('LbsViews::admin_views.views.dashboard',compact('over_due','ifram_url'));
    }

    public function contracts_expediting()
    {
         $contracts_expediting=true;
         $ifram_url='https://nupcobi.nupco.com/Reports/powerbi/Contract/Contracts%20Expediting%20Dashboard';
        return view('LbsViews::admin_views.views.dashboard',compact('contracts_expediting','ifram_url'));
    }

    public function importPO()
    {

        $baseFile = file(public_path('uploads/sap_nupco_backup.csv'));
        if (!File::exists(public_path('uploads/sap_nupco_backup.csv'))) {
            return 0;
        }

        $total_files=0;
        $total_records=0;

        $parts = (array_chunk($baseFile, 50000));

        $partPath='uploads/sap_parts/test_parts/';

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
        $paths = public_path('uploads/sap_parts/test_parts/');
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

        return '(importPO complete)';

    }

    protected function storeInfo($row){
        $uniqueLine= (int)$row[2].'_'.(int)$row[3];
        if(PoSapMaster::where('unique_line',$uniqueLine)->where('unique_line_date',$uniqueLine.'_'.Carbon::now()->format('Y_m_d'))->first()){
            PoHelper::createLogChennel('import-sap-job.log');
           return  Log::channel('custom_chennel')->info("record-already-exist",[$uniqueLine]);

        }
        $supplyRatio= ((int)Str::replace(',', '', $row[35]) / (int)Str::replace(',', '', $row[25]))*100;
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
            "vendor_code"=>ltrim($row[14], "0"),
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
            "supply_ratio"=> $supplyRatio,
            "unique_line"=>$uniqueLine,
            "unique_line_date"=>$uniqueLine.'_'.Carbon::now()->format('Y_m_d')
        ];

        try {
            PoSapMaster::create($insertable);

            if(! PoSapMasterTmp::where('unique_line',$uniqueLine)->exists()){

                $insertable=[

                    "table_type"=>LbsUserSearchSet::TEMPLATE_SAP_LINE_ITEM,
                    "po_number"=>(int)$row[2],
                    "po_item"=>(int)$row[3],
                    "unique_line"=>$uniqueLine,
                ];
                PoSapMasterTmp::create($insertable);
            }



        } catch (\Throwable $th) {

            PoHelper::createLogChennel('import-sap-job.log');
            Log::info("import-sap-job",[$th->getMessage()]);
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
