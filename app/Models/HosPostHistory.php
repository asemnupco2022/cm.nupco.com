<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HosPostHistory extends Model
{
    use HasFactory;

    public function hasNotificationHistory()
    {
        return $this->belongsTo(NotificationHistory::class,'mail_unique','mail_ticket_hash');
    }
}
