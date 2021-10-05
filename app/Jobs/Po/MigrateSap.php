<?php

namespace App\Jobs\Po;

use App\Models\PoSapMaster;
use App\Models\PoSapMasterSchedle;
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
//            Log::info('SAP_TABLE', $query->toArray());
            if ($query and !empty($query)){
                foreach ($query as $query_data){

                    $newPoEntry=new PoSapMasterSchedle();
                    $newPoEntry->po_type=$query_data->po_type;
                    $newPoEntry->po_type_description=$query_data->po_type_description;
                    $newPoEntry->pur_group=$query_data->pur_group;
                    $newPoEntry->customer_name=$query_data->customer_name;
                    $newPoEntry->tender_no=$query_data->tender_no;
                    $newPoEntry->vendor_code=$query_data->vendor_code;
                    $newPoEntry->vendor_name=$query_data->vendor_name;
                    $newPoEntry->contact_no=$query_data->contact_no;
                    $newPoEntry->contract_item_no=$query_data->contract_item_no;
                    $newPoEntry->purchasing_document=$query_data->purchasing_document;
                    $newPoEntry->po_item=$query_data->po_item;
                    $newPoEntry->generic_mat_code=$query_data->generic_mat_code;
                    $newPoEntry->nupco_trade_code=$query_data->nupco_trade_code;
                    $newPoEntry->cust_gen_code=$query_data->cust_gen_code;
                    $newPoEntry->mat_description=$query_data->mat_description;
                    $newPoEntry->uom=$query_data->uom;
                    $newPoEntry->ordered_quantity=$query_data->ordered_quantity;
                    $newPoEntry->gr_qty=$query_data->gr_qty;
                    $newPoEntry->supply_ration=$query_data->supply_ration;
                    $newPoEntry->open_quantity=$query_data->open_quantity;
                    $newPoEntry->net_price_per_unit_1=$query_data->net_price_per_unit_1;
                    $newPoEntry->net_order_value=$query_data->net_order_value;
                    $newPoEntry->gr_amount=$query_data->gr_amount;
                    $newPoEntry->currency=$query_data->currency;
                    $newPoEntry->delivery_address=$query_data->delivery_address;
                    $newPoEntry->nupco_delivery_date=$query_data->nupco_delivery_date;
                    $newPoEntry->delivery_no=$query_data->delivery_no;
                    $newPoEntry->item_status=$query_data->item_status;
                    $newPoEntry->plant=$query_data->plant;
                    $newPoEntry->storage_location=$query_data->storage_location;
                    $newPoEntry->old_new_po_number=$query_data->old_new_po_number;
                    $newPoEntry->old_po_item=$query_data->old_po_item;
                    $newPoEntry->old_p_o1=$query_data->old_p_o1;
                    $newPoEntry->old_po_item1=$query_data->old_po_item1;
                    $newPoEntry->on_behalf_of_po=$query_data->on_behalf_of_po;
                    $newPoEntry->on_behalf_of_po_item=$query_data->on_behalf_of_po_item;
                    $newPoEntry->the_testimonial=$query_data->the_testimonial;
                    $newPoEntry->trade_date=$query_data->trade_date;
                    $newPoEntry->save();
                }

            }

        }
    }
}
