<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use rifrocket\LaravelCms\Models\ModelTraits\UniversalModelTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class PoMowaredMaster extends Model
{
    use HasFactory , UniversalModelTrait, LogsActivity;


    const LOG_NAME='LOG_PO_MOWARE';

    protected static $logName = PoMowaredMaster::LOG_NAME;
}
