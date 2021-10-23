<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use rifrocket\LaravelCms\Models\ModelTraits\UniversalModelTrait;

class PoImportScheduler extends Model
{
    use HasFactory, UniversalModelTrait;

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
}
