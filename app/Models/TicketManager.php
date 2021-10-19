<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use rifrocket\LaravelCms\Models\LbsAdmin;
use rifrocket\LaravelCms\Models\LbsMember;

class TicketManager extends Model
{
    use HasFactory;

    public function VendorData()
    {
        return $this->belongsTo(LbsMember::class, 'vendor_user_id', 'id');
    }

    public function userdata()
    {
        return $this->belongsTo(LbsAdmin::class, 'staff_user_id', 'id');
    }
}
