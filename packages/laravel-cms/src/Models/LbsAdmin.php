<?php

namespace rifrocket\LaravelCms\Models;


use Illuminate\Support\Collection;
use rifrocket\LaravelCms\Models\ModelTraits\UniversalModelTrait;
use rifrocket\LaravelCms\Notifications\AdminResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class LbsAdmin extends Authenticatable
{
    use UniversalModelTrait,HasFactory,Notifiable, HasRoles;

    const LBS_CONST_ADMIN='admin';
    const LBS_CONST_SUPER_ADMIN='super_admin';

    const CONS_COLUMNS=[
        'first_name'=>true,
        'last_name'=>true,
        'username'=>false,
        'employee_num'=>true,
        'email'=>true,
        'role'=>true,
        'phone'=>true,
        'permissions'=>true,
        'status'=>true,
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }

//    public static function getPermissionDisplayNames()
//    {
//        return $this->permissions->pluck('display_name');
//    }

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
