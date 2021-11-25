<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use rifrocket\LaravelCms\Models\LbsAdmin;

class UserExportFiles extends Model
{
    use HasFactory;

    protected $fillable =[
        'admin_id',
        'model',
        'taable_type',
        'file_name',
        'file_path',
        'status',
    ];

    public function adminInfo()
    {
        return $this->belongsTo(LbsAdmin::class, 'admin_id', 'id');
    }

    public static function getCountOFUnread()
    {
        return UserExportFiles::where('admin_id',auth()->user()->id)->where('status','unread')->count();
    }
}
