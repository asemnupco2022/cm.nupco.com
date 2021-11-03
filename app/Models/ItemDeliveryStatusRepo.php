<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDeliveryStatusRepo extends Model
{
    use HasFactory;
    protected $table = "po_sap_masters";
    const CONS_COLUMNS = [

        "customer_name"=>true,
        "tender_no"=>true,
        "vendor_code"=>true,
        "vendor_name_en"=>true,
        "vendor_name_er"=>true,
        "po_number"=>true,
        "po_item"=>true,
        "generic_mat_code"=>true,
        "nupco_trade_code"=>true,
        "cust_gen_code"=>true,
        "mat_description"=>true,
        "ordered_quantity"=>true,
        "gr_quantity"=>true,
        "open_quantity"=>true,
        "supply_ratio"=>true,
        "net_value"=>true,
        "gr_amount"=>true,
        "nupco_delivery_date"=>true,
        "customer_no"=>false,
        "plant"=>false,
        "storage_location"=>false,
        ];


}
