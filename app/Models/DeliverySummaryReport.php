<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliverySummaryReport extends Model
{
    use HasFactory;
    protected $table = "delivery_summary_report";

    const CONS_COLUMNS = [
        "customer_name"=>true,
        "tender_desc"=>true,
        "tender_no"=>true,
        "count_of_items"=>true,   //po items
        "count_of_line"=>true,   // total qty
        "total_value"=>true,
        "delivered_value"=>true,
        "remaining_delivered_value"=>true,
        "supply_ratio"=>true,
        "total_qty"=>true,
        "delivered_qty"=>true,
        "remaining_delivered_qty"=>true,
        "po_number"=>true,
        "nupco_delivery_date"=>true,
        "storage_location"=>true,
        "plant"=>false,
        "vendor_code"=>false,
        "customer_no"=>false,
    ];





}
