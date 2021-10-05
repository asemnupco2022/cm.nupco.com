<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SapMasterView extends Model
{
    use HasFactory;

    const CONS_COLUMNS=[

        "po_item"=>true,
        "contract_item_no"=>false,
        "generic_mat_code"=>true,
        "nupco_trade_code"=>true,
        "cust_gen_code"=>true,
        "mat_description"=>true,
        "uom"=>true,
        "ordered_quantity"=>true,
        "supply_ration"=>false,
        "open_quantity"=>true,
        "net_price_per_unit_1"=>true,
        "net_order_value"=>true,
        "gr_amount"=>true,
        "currency"=>true,
        "delivery_address"=>true,
        "nupco_delivery_date"=>true,
        "delivery_no"=>false,
        "item_status"=>false,
        "plant"=>false,
        "storage_location"=>false,
        "old_new_po_number"=>false,
        "old_po_item"=>false,
        "old_p_o1"=>false,
        "old_po_item1"=>false,
        "on_behalf_of_po"=>false,
        "on_behalf_of_po_item"=>false,
        "the_testimonial"=>false,
        "trade_date"=>false,

    ];

    protected  $table="sap_master_views";
}
