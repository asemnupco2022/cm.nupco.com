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

    protected $fillable=[

        'ticket_number',
        'ticket_hash',
        'unique_line',
        'staff_user_id',
        'staff_user_model',
        'staff_name',
        'staff_email',
        'vendor_user_id',
        'vendor_user_model',
        'vendor_name',
        'vendor_email',
        'msg_sender_id',
        'msg_body',
        'attachment',
        'attachment_name',
        'msg_receiver_id',
        'msg_read_at',

    ];
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
