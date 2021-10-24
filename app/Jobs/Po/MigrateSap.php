<?php

namespace App\Jobs\Po;

use App\Models\PoSapMaster;
use App\Models\PoSapMasterScheduler;
use App\Models\ScheduleNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MigrateSap implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $scheduler_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($scheduler_id)
    {
        $this->scheduler_id=$scheduler_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $scheduler=ScheduleNotification::find($this->scheduler_id);
        $query=null;
        if ($scheduler){

            if ($scheduler->json_data and !empty($scheduler->json_data)){
                $searchableItems=json_decode($scheduler->json_data, true);
                if ($searchableItems and !empty($searchableItems)){
                    $query = PoSapMaster::orderBy('po_item', 'DESC');
                    foreach ($searchableItems as $key => $searchableItem){
                        $operator=$searchableItem['queryOpr'];
                        $query = $query->where(trim($searchableItem['queryCol']),trim("$operator"),trim($searchableItem['queryVal']));
                    }
                }
            }
            $query=$query->get();
            if ($query and !empty($query) and $query->isEmpty()){
                foreach ($query as $query_data){

                    $newPoEntry=new PoSapMasterScheduler();
                    $newPoEntry->document_type=$query_data->document_type;
                    $newPoEntry->document_type_desc=$query_data->document_type_desc;
                    $newPoEntry->po_number=$query_data->po_number;
                    $newPoEntry->po_item=$query_data->po_item;
                    $newPoEntry->material_number=$query_data->material_number;
                    $newPoEntry->mat_description=$query_data->mat_description;
                    $newPoEntry->po_created_on=$query_data->po_created_on;
                    $newPoEntry->purchasing_organization=$query_data->purchasing_organization;
                    $newPoEntry->purchasing_group=$query_data->purchasing_group;
                    $newPoEntry->currency=$query_data->currency;
                    $newPoEntry->customer_no=$query_data->customer_no;
                    $newPoEntry->customer_name=$query_data->customer_name;
                    $newPoEntry->tender_no=$query_data->tender_no;
                    $newPoEntry->tender_desc=$query_data->tender_desc;
                    $newPoEntry->vendor_code=$query_data->vendor_code;
                    $newPoEntry->vendor_name_en=$query_data->vendor_name_en;
                    $newPoEntry->vendor_name_er=$query_data->vendor_name_er;
                    $newPoEntry->plant=$query_data->plant;
                    $newPoEntry->storage_location=$query_data->storage_location;
                    $newPoEntry->uo_m=$query_data->uo_m;
                    $newPoEntry->net_price=$query_data->net_price;
                    $newPoEntry->price_unit=$query_data->price_unit;
                    $newPoEntry->net_value=$query_data->net_value;
                    $newPoEntry->nupco_trade_code=$query_data->nupco_trade_code;
                    $newPoEntry->nupco_delivery_date=$query_data->nupco_delivery_date;
                    $newPoEntry->ordered_quantity=$query_data->ordered_quantity;
                    $newPoEntry->open_quantity=$query_data->open_quantity;
                    $newPoEntry->item_status=$query_data->item_status;
                    $newPoEntry->delivery_address=$query_data->delivery_address;
                    $newPoEntry->delivery_no=$query_data->delivery_no;
                    $newPoEntry->cust_cont_trade_numb=$query_data->cust_cont_trade_numb;
                    $newPoEntry->cust_gen_code=$query_data->cust_gen_code;
                    $newPoEntry->generic_mat_code=$query_data->generic_mat_code;
                    $newPoEntry->old_new_po_number=$query_data->old_new_po_number;
                    $newPoEntry->old_po_item=$query_data->old_po_item;
                    $newPoEntry->gr_quantity=$query_data->gr_quantity;
                    $newPoEntry->gr_amount=$query_data->gr_amount;
                    $newPoEntry->supply_ratio=$query_data->supply_ratio;
                    $newPoEntry->save();
                }

            }

        }
    }
}
