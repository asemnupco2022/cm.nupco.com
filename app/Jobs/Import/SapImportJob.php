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
use Illuminate\Support\Facades\File;

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


        if ( $updateInit->total_ex_files == $total_ex_records ){
            $deleted_at = Carbon::now()->format('Y-m-d');
        }

        PoImportScheduler::find($this->po_import_schedulers)->update([
            'total_ex_records'=>$total_ex_records,
            'deleted_at'=>$deleted_at,
            'end_time'=>Carbon::now()->format('H:i:s')
        ]);

    }

    protected function storeInfo($row){

        $insertable=[

            "document_type"=>$row[0],
            "document_type_desc"=>null,
            "po_number"=>(int)$row[1],
            "po_item"=>(int)$row[2],
            "material_number"=>$row[3],
            "mat_description"=>$row[4],
            "po_created_on"=>$row[5],
            "purchasing_organization"=>$row[6],
            "purchasing_group"=>$row[7],
            "currency"=>$row[8],
            "customer_no"=>$row[9],
            "customer_name"=>$row[10],
            "tender_no"=>$row[11],
            "tender_desc"=>$row[12],
            "vendor_code"=>$row[13],
            "vendor_name_en"=>$row[14],
            "vendor_name_er"=>$row[15],
            "plant"=>$row[16],
            "storage_location"=>$row[17],
            "uo_m"=>$row[18],
            "net_price"=>$row[19],
            "price_unit"=>$row[20],
            "net_value"=>$row[21],
            "nupco_trade_code"=>$row[22],
            "nupco_delivery_date"=>$row[23],
            "ordered_quantity"=>$row[24],
            "open_quantity"=>$row[25],
            "item_status"=>$row[26],
            "delivery_address"=>$row[27],
            "delivery_no"=>$row[28],   //here is the index change
            "cust_gen_code"=>$row[30],
            "generic_mat_code"=>$row[31],
            "old_new_po_number"=>$row[32],
            "old_po_item"=>$row[33],
            "gr_quantity"=>$row[34],
            "gr_amount"=>$row[35],
            "supply_ratio"=>((int)$row[34]/(int)$row[24])*100
        ];


        PoSapMaster::create($insertable);

    }
}
