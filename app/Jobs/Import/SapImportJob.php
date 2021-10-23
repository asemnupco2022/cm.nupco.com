<?php

namespace App\Jobs\Import;

use App\Models\PoImportScheduler;
use App\Models\PoSapMaster;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SapImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $path;
    public $po_import_schedulers;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($path,$po_import_schedulers)
    {
       $this->path=$path;
       $this->po_import_schedulers=$po_import_schedulers;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $paths = public_path($this->path);
        $filepath = ($paths.'*.csv');
        $txtFile = $textFile ='uploads/sap_parts/'.basename($paths, ".txt").'/'.basename($paths, ".txt").'.txt';

        $global = glob($filepath);
        natsort($global);

        foreach (array_splice($global, 0, 1) as $globalKey => $file) {

            $fileOrigin= explode('_',basename($file, '.csv'));
            if ((int)end($fileOrigin)==0){
                if (File::exists($file)) {
                    File::delete($file);
                }
                PoImportScheduler::find($this->po_import_schedulers)->update([
                    'start_time'=>Carbon::now()->format('H:i:s'),
                ]);
                continue;}


            $data = array_map(function ($v) {
                return str_getcsv($v, "|");
            }, file($file));
            foreach ($data as $key => $row) {
                $this->storeInfo($row,$txtFile);
            }

            if (File::exists($file)) {
                File::delete($file);
            }

            $updateInit = PoImportScheduler::find($this->po_import_schedulers);

            $total_ex_files = $updateInit->total_ex_files + $globalKey + 1;
            $total_ex_records = $updateInit->total_ex_records + $key + 1;
            $deleted_at = null;


            if ($updateInit->total_ex_records == $total_ex_files and $updateInit->total_ex_files == $total_ex_records ){
                $deleted_at = Carbon::now()->format('Y-m-d');

            }

           PoImportScheduler::find($this->po_import_schedulers)->update([
               'total_ex_files'=>$total_ex_files,
               'total_ex_records'=>$total_ex_records,
               'deleted_at'=>$deleted_at,
               'end_time'=>Carbon::now()->format('H:i:s')
           ]);

        }
    }


    protected function storeInfo($row,$txtFile){

        $tctArray = json_decode(Storage::disk('public_uploads')->get($txtFile), true);


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

//        if (! in_array((int)$row[2], $tctArray)){
//            if (PoSapMaster::where('po_number',(int)$row[2])->exists()){
//                PoSapMaster::where('po_number',(int)$row[2])->delete($insertable);
//            }
//            $tctArray[]=(int)$row[2];
//            Storage::disk('public_uploads')->put($txtFile,json_encode($tctArray));
//        }
        $tctArray[]=(int)$row[2];
        Storage::disk('public_uploads')->put($txtFile,json_encode($tctArray));

         PoSapMaster::create($insertable);

    }
}
