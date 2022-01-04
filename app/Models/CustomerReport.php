<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use rifrocket\LaravelCms\Models\ModelTraits\UniversalModelTrait;

class CustomerReport extends Model
{
    use HasFactory, UniversalModelTrait;

    const CONST_COLUMNS = [
        "Customer Code"=>true,
        "Customer Name En"=>true,
        "Customer Name Ar"=>true,
        "Customer Email"=>true,
        "Customer Phone"=>true,
        "Region"=>true,
        "Tendor Description"=>true,
        "File Name"=>true,
    ];

    protected $fillable = [
        'customer_code',
        'customer_name_en',
        'customer_name_ar',
        'customer_email',
        'customer_phone',
        'region',
        'tendor_no',
        'tendor_description',
        'file_name',
        'file_path',
        'json_data',
        'status',
        'suspendReason',
        'po_number',
        'item_details',


    ];
}
