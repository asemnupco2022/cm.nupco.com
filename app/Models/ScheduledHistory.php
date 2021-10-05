<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use rifrocket\LaravelCms\Models\ModelTraits\UniversalModelTrait;

class ScheduledHistory extends Model
{
    use HasFactory,UniversalModelTrait;

    const CONS_COLUMNS = [
        'sender_name' => true,
        'recipient_name' => true,
        'table_type'=>true,
        'msg_subject' => true,
        'msg_body' => true,
        'last_executed_at' => true,
        'end_date' => true,
    ];
}
