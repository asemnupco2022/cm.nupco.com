<?php

namespace rifrocket\LaravelCms\Models;


use rifrocket\LaravelCms\Models\ModelTraits\UniversalModelTrait;
use rifrocket\LaravelCms\Notifications\MemberResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Sabberworm\CSS\Value\URL;
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

    protected $appends = ['avatar'];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MemberResetPasswordNotification($token));
    }

    public function getAvatarAttribute()
    {
        if (empty($this->attributes['avatar'])) {

            return  'img/default_avatar.svg';
        }
        return $this->attributes['avatar'];
    }

    public function getByVendorCode($vendorCode, $parameter)
    {
        try {
           return LbsMember::where('vendor_code',$vendorCode)->pluck($parameter)->first();
        } catch (\Throwable $th) {
            return null;
        }
    }

}
