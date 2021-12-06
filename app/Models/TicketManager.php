<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use rifrocket\LaravelCms\Models\LbsAdmin;
use rifrocket\LaravelCms\Models\LbsMember;
use Spatie\Activitylog\Traits\LogsActivity;

class TicketManager extends Model
{
    use HasFactory;



    use LogsActivity;
    const LOG_NAME='LOG VENDOR CONVERSATION';
    protected static $logName = SchedulerNotificationHistory::LOG_NAME;

    protected $fillable=['msg_receiver_id'];
    protected static $recordEvents = ['created'];

    public function VendorData()
    {
        return $this->belongsTo(LbsMember::class, 'vendor_user_id', 'id');
    }

    public function userdata()
    {
        return $this->belongsTo(LbsAdmin::class, 'staff_user_id', 'id');
    }
}
