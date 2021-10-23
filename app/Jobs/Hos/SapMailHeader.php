<?php

namespace App\Jobs\Hos;

use App\Helpers\PoHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;
use rifrocket\LaravelCms\Facades\LaravelCmsFacade;

class SapMailHeader implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $collection, $mailType;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($collection, $mailType)
    {
        $this->mailType = $mailType;
        $this->collection = $collection;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->collection){
            foreach ($this->collection as $collection){

                $unique_hash=Hash::make(LaravelCmsFacade::lbs_random_generator(16,true,false,true,false));
                $supplier_comment = [
                    "message_type" => $this->mailType,
                    "unique_hash" => $unique_hash,
                    "tender_num" => $collection->tender_no,
                    "vendor_num" => $collection->vendor_code,
                    "po_num" => $collection->po_number,
                    "customer_num" => $collection->customer_no,
                    "po_item_num" => $collection->po_item,
                    "mat_num" => $collection->material_number,
                    "uom" => $collection->uo_m,
                    "ordered_qty" => $collection->ordered_quantity,
                    "open_qty" =>$collection->open_quantity,
                    "net_order_value" => $collection->net_value,
                    "delivery_date" =>$collection->nupco_delivery_date
                ];
                PoHelper::sendHeaderForChat($supplier_comment);
            }
        }

    }
}
