<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use rifrocket\LaravelCms\Models\LbsAdmin;
use Spatie\Activitylog\Traits\LogsActivity;

class InternalComment extends Model
{
    use LogsActivity, HasFactory;

    const LOG_NAME='INTERNAL COMMENTS';
    protected static $logName = ScheduleNotification::LOG_NAME;
    protected static $recordEvents = ['created'];

    public function userdata()
    {
        return $this->belongsTo(LbsAdmin::class, 'admin_id','id');
    }
}
