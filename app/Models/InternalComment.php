<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use rifrocket\LaravelCms\Models\LbsAdmin;

class InternalComment extends Model
{
    use HasFactory;


    public function userdata()
    {
        return $this->belongsTo(LbsAdmin::class, 'admin_id','id');
    }
}
