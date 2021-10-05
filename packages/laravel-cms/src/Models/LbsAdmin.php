<?php

namespace rifrocket\LaravelCms\Models;


use rifrocket\LaravelCms\Models\ModelTraits\UniversalModelTrait;
use rifrocket\LaravelCms\Notifications\AdminResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class LbsAdmin extends Authenticatable
{
    use UniversalModelTrait,HasFactory,Notifiable;

    const LBS_CONST_ADMIN='admin';
    const LBS_CONST_SUPER_ADMIN='super_admin';


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
