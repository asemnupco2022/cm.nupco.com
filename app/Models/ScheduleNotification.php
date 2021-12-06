<?php

namespace App\Models;

use App\Helpers\PoHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use rifrocket\LaravelCms\Helpers\Classes\LbsConstants;
use rifrocket\LaravelCms\Models\ModelTraits\UniversalModelTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class ScheduleNotification extends Model
{
use LogsActivity,UniversalModelTrait, HasFactory;

    const LOG_NAME='LOG SCHEDULE AUTOMATE';
    protected static $logName = ScheduleNotification::LOG_NAME;
    public $operators=LbsConstants::CONST_OPERATOR;

    const CONS_COLUMNS = [
        'user_name' => true,
        'po_table' => true,
        'query' => true,
        'day_recurrence' => true,
        'start_date' => true,
        'start_time' => true,
        'last_executed_at' => true,
        'attempts' => true,
        'end_date' => true,
        'option' => false,
        'meta' => false,
        'schedule_status' => true,
        'status' => true,
        ];

    const JOB_STATUS_AWAIT='await';
    const JOB_STATUS_COMPLETE='complete';
    const JOB_STATUS_RECURRENCE='recurrence';
    const JOB_STATUS_HOLD='hold';

    protected $appends = ['user_name','json_to_string','recurrent_days'];

    public function getRecurrentDaysAttribute()
    {
        $recurrent_days=$this->attributes['recurrent_days'];
        if ($recurrent_days and !empty($recurrent_days)){
            $recurrent_days=  Str::replace(['_','-','[',']','"'], ' ', $recurrent_days);
            return $recurrent_days;
        }
      return '';
    }

    public function getUserNameAttribute(){
        $user_id=$this->attributes['user_id'];
        $user_model=$this->attributes['user_model'];
        return $this->attributes['user_name']=$user_model::find($user_id);
    }

    public function getJsonToStringAttribute(){
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


}
