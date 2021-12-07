<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerReport extends Model
{
    use HasFactory;

    const CONST_COLUMNS = [
        'customer_code'=>true,
        'customer_name_en'=>true,
        'customer_name_ar'=>true,
        'region'=>true,
        'tendor_no'=>true,
        'tendor_description'=>true,
        'po_number'=>true,
        'item_details'=>true,
        'json_data'=>true,
        'status'=>true,
        'suspendReason'=>true,
    ];

    protected $fillable = [
        'customer_code',
        'customer_name_en',
        'customer_name_ar',
        'region',
        'tendor_no',
        'tendor_description',
        'po_number',
        'item_details',
        'json_data',
        'status',
        'suspendReason',
        'customer_email',
        'customer_phone',
    ];
}
