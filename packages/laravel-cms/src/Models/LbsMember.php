<?php

namespace rifrocket\LaravelCms\Models;


use rifrocket\LaravelCms\Models\ModelTraits\UniversalModelTrait;
use rifrocket\LaravelCms\Notifications\MemberResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class LbsMember extends Authenticatable
{
    use UniversalModelTrait,HasFactory,Notifiable, HasRoles;


    protected $hidden = [
        'password',
        'remember_token',
    ];

    const CONS_COLUMNS=[
        'Vendor_name'=>true,
        'vendor_code'=>true,
        'email'=>true,
        'status'=>true,
    ];

    public $selectedPo=[];
    public $selectAll=false;

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MemberResetPasswordNotification($token));
    }

}
