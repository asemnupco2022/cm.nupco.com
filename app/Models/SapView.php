<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SapView extends Model
{
    use HasFactory;

    const CONS_COLUMNS = [

        'po_type' => false,
        'po_type_description' => false,
        'pur_group' => false,
        'tender_no' => true,
        'purchasing_document' => true,
        'customer_name' => true,
        'vendor_code' => true,
        'vendor_name' => true,
        'Ordered_quantity' => true,
        'pending_qty' => true,
        'total_recived_qty' => true,
        'order_total' => true,
        'gr_amount'=>true,
        'trade_date' => true,
    ];


    protected $table = "sap_views";


}
