<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use rifrocket\LaravelCms\Models\ModelTraits\UniversalModelTrait;

class PoImportScheduler extends Model
{
    use HasFactory, UniversalModelTrait;

    const CONS_COLUMNS=[

        'table_type'=>true,
        'path'=>false,
        'total_records'=>true,
        'total_ex_records'=>true,
        'start_time'=>true,
        'end_time'=>true,
        'created_at'=>true,

    ];

    protected $fillable = [
        'table_type',
        'path',
        'total_files',
        'total_records',
        'total_ex_files',
        'total_ex_records',
        'meta',
        'json_data',
        'status',
        'suspendReason',
        'end_time',
        'start_time'
    ];

    public function getCreatedAtAttribute()
    {
       $date= $this->attributes['created_at'];
        return Carbon::parse( $date)->format('Y-m-d');
    }
}
