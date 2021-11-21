<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffColumnSet extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_line',
        'user_id',
        'table_type',
        'columns',
        'filter_tm1',
        'filter_tm2',
        'make_fav',
        'json_data',
        'status',
        'suspendReason',
    ];
}
