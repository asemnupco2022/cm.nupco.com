<?php

namespace App\Models;

use App\Helpers\PoHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use rifrocket\LaravelCms\Helpers\Classes\LbsConstants;
use rifrocket\LaravelCms\Models\ModelTraits\UniversalModelTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class SchedulerNotificationHistory extends Model
{
    use LogsActivity,UniversalModelTrait, HasFactory;

    const LOG_NAME='LOG_SCHEDULE_HISTORY';
    protected static $logName = SchedulerNotificationHistory::LOG_NAME;
    public $operators=LbsConstants::CONST_OPERATOR;

    const CONS_COLUMNS = [
        'broadcast_type' => true,
        'mail_type' => true,
        'table_type'=>true,
        'sender_name' => true,
        'recipient_name' => true,
        'recipient_email' => true,
        'msg_subject' => true,
        'last_executed_at' => true,
    ];

}
