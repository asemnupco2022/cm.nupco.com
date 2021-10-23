<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoNotificationManager extends Model
{
    use HasFactory;

    protected $fillable = [

        'table_type',
        'po_number',
        'po_item',
        'ext1',
        'execution_done',
        'meta',
        'json_data',
        'status',
        'suspendReason'
    ];
}
