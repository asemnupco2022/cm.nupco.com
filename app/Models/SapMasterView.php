<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SapMasterView extends Model
{
    use HasFactory;

    const CONS_COLUMNS = [
        "document_type"=>true,
        "po_number"=>true,
        "purchasing_group"=>true,
        "material_number"=>true,
        "tender_no"=>true,
        "customer_name"=>true,
        "vendor_code"=>true,
        "vendor_name_en"=>true,
        "plant"=>true,
        "storage_location"=>true,
        "delivery_address"=>true,
        "generic_mat_code"=>true,
        "ordered_quantity"=>true,
        "open_quantity"=>true,
        "total_received_quantity"=>true,
        "net_value"=>true,
        "gr_amount"=>true,
    ];


    protected $table = "sap_master_views";


}
