<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsnHeader extends Model
{
    use HasFactory;

    protected $fillable=[
        'unique_line',
        'asn_id',
        'plant',
        'sloc',
        'vendor_no',
        'total_pallet_count',
        'truck_no',
        'delivery_date',
        'delivery_time',
        'asn_status',
        'nupco_po_no',
        'nupco_po_item',
        'nupco_material',
        'trade_code',
        'batch_no',
        'mfg_date',
        'expiry_date',
        'is_deleted',
        'json_data',
        'status',
    ];
}
