<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use rifrocket\LaravelCms\Models\LbsMember;

class HosPostHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'updated_at',
    ];
    
    public function hasNotificationHistory()
    {
        return $this->belongsTo(SchedulerNotificationHistory::class,'mail_hash','mail_ticket_hash');
    }

    public function VendorData()
    {
        return $this->belongsTo(LbsMember::class, 'vendor_num', 'vendor_code');
    }

    public function hasTicket()
    {
        return $this->belongsTo(TicketManager::class, 'unique_hash', 'ticket_hash');
    }
}
