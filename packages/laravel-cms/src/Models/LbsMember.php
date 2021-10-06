<?php

namespace rifrocket\LaravelCms\Models;


use rifrocket\LaravelCms\Models\ModelTraits\UniversalModelTrait;
use rifrocket\LaravelCms\Notifications\MemberResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class LbsMember extends Authenticatable
{
    use UniversalModelTrait,HasFactory,Notifiable;


    protected $hidden = [
        'password',
        'remember_token',
    ];

    const CONS_COLUMNS=[
        'username'=>true,
        'email'=>true,
        'role'=>true,
        'contact'=>true,
        'status'=>true,
    ];

    public $selectedPo=[];
    public $selectAll=false;

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MemberResetPasswordNotification($token));
    }

}
