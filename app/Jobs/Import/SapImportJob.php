<?php

namespace App\Jobs\Import;

use App\Helpers\PoHelper;
use App\Models\LbsUserSearchSet;
use App\Models\PoImportScheduler;
use App\Models\PoSapMaster;
use App\Models\PoSapMasterTmp;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SapImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $file;
    protected $po_import_schedulers;
    protected $fileOrigin;
    protected $globalKey;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file, $po_import_schedulers, $fileOrigin, $globalKey)
    {
        $this->file=$file;
        $this->po_import_schedulers=$po_import_schedulers;
        $this->fileOrigin=$fileOrigin;
        $this->globalKey=$globalKey;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = array_map(function ($v) {
            return str_getcsv($v, "|");
        }, file($this->file));

        foreach ($data as $key => $row) {

            if ($this->fileOrigin == 0 and $key== 0 ){

                PoImportScheduler::find($this->po_import_schedulers)->update([
                    'start_time'=>Carbon::now()->format('H:i:s'),
                ]);
                continue;}

            $this->storeInfo($row);
        }

        if (File::exists($this->file)) {
            File::delete($this->file);
        }


        $updateInit = PoImportScheduler::find($this->po_import_schedulers);
        $total_ex_records = $updateInit->total_ex_records + $key + 1;
        $deleted_at = null;


        if ( $updateInit->total_records == $total_ex_records ){
            $deleted_at = Carbon::now()->format('Y-m-d');
        }

        PoImportScheduler::find($this->po_import_schedulers)->update([
            'total_ex_records'=>$total_ex_records,
            'deleted_at'=>$deleted_at,
            'end_time'=>Carbon::now()->format('H:i:s')
        ]);

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
            "customer_po_no"=>$row[37],
            "customer_po_item"=>$row[38],
            "pur_grp_name"=>$row[39],
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
}
