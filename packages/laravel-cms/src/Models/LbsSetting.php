<?php

namespace rifrocket\LaravelCms\Models;


use Illuminate\Support\Arr;
use rifrocket\LaravelCms\Models\ModelTraits\UniversalModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LbsSetting extends Model
{
    use UniversalModelTrait,HasFactory;


    public function scopeAppSetting($query,array $filter=null)
    {
        $LbsAppSettings=[];
        $appSettings= $query->OnlyActive()->get()->toArray();
        foreach ($appSettings as $key => $value){

            $LbsAppSettings["{$value['setting_meta_key']}"]=$value['setting_meta_value'];
        }
        if ($filter and !empty($filter)){

            $LbsAppSettings = Arr::only($LbsAppSettings, $filter);
        }

        return json_decode(json_encode($LbsAppSettings));
    }
}
