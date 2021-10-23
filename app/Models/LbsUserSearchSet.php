<?php

namespace App\Models;

use App\Helpers\PoHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use rifrocket\LaravelCms\Helpers\Classes\LbsConstants;
use rifrocket\LaravelCms\Models\LbsAdmin;
use rifrocket\LaravelCms\Models\ModelTraits\UniversalModelTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class LbsUserSearchSet extends Model
{
    use HasFactory,UniversalModelTrait, LogsActivity;

    const LOG_NAME='LOG_SEARCH_TEMPLATE';
    const TEMPLATE_ALL='all';
    const TEMPLATE_NOTIFICATION_HISTORY='notification_history';

    const TEMPLATE_SAP_LINE_ITEM='sap_line_item';
    const TEMPLATE_SAP_HEADER_ITEM='sap_header_item';

    const TEMPLATE_MOWARED_LINE_ITEM='mowared_line_item';
    const TEMPLATE_MOWARED_HEADER_ITEM='mowared_header_item';

    const TEMPLATE_ARRAY=[
//        "App\Models\SapMasterView"=>LbsUserSearchSet::TEMPLATE_SAP_HEADER_ITEM,
        "App\Models\SapMasterView"=>LbsUserSearchSet::TEMPLATE_SAP_LINE_ITEM,
    ];

    const CONS_COLUMNS=[
        "staff"=>true,
        "template_name"=>true,
        "template_for_table"=>true,
        "query"=>true,
        "status"=>true,
    ];

    public $operators=LbsConstants::CONST_OPERATOR;
    protected static $logName = LbsUserSearchSet::LOG_NAME;



    protected $fillable = [
        'user_id', 'template_name', 'pages','template_for_table', 'filter_tm1','filter_tm2', 'make_fav', 'json_data', 'status', 'suspendReason', 'remember_token', 'deleted_at'
    ];


    protected $appends = ['json_to_string'];


    public function getJsonToStringAttribute()
    {
       $json_data=$this->attributes['json_data'];
        $json_data_to_string='';
        $operatorArray=json_decode($json_data, true);
        $count=count($operatorArray);
        foreach ($operatorArray as $strKey => $toString){
            $json_data_to_string .=PoHelper::NormalizeColString($toString['queryCol']).'  <b>'.$this->operators[$toString['queryOpr']].'</b>  '.$toString['queryVal'];
            if ($count>$strKey+1){
                $json_data_to_string .=' <b>AND</b>  ';
            }
        }
        return $this->attributes['json_to_string'] = $json_data_to_string;
    }


    public function User()
    {
        return $this->belongsTo(LbsAdmin::class,'user_id','id');
    }
}
