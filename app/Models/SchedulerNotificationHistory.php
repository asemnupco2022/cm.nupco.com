<?php

namespace App\Models;

use App\Helpers\PoHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use rifrocket\LaravelCms\Helpers\Classes\LbsConstants;
use rifrocket\LaravelCms\Models\LbsMember;
use rifrocket\LaravelCms\Models\ModelTraits\UniversalModelTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class SchedulerNotificationHistory extends Model
{
    use UniversalModelTrait, HasFactory;

    use LogsActivity;
    const LOG_NAME='LOG SCHEDULE HISTORY';
    protected static $logName = SchedulerNotificationHistory::LOG_NAME;
    protected static $recordEvents = ['created'];

    public $operators=LbsConstants::CONST_OPERATOR;

    const CONS_COLUMNS = [
        'broadcast_type' => true,
        'mail_type' => true,
        'table_type'=>true,
        'sender_name' => true,
        'recipient_name' => true,
        'recipient_email' => true,
        'msg_subject' => true,
        'last_executed_at' => true,
    ];

    protected $fillable = [
        'updated_at',
    ];

    public function venodInfo()
    {
        return $this->belongsTo(LbsMember::class, 'recipient_user_id','id');
    }


    public function getAllTicketCountAttribute()
    {
        $mail_hash =$this->attributes['mail_ticket_hash'];
        $unique_hash =  HosPostHistory::where('mail_hash',$mail_hash )->get();
$counter =0;
        if($unique_hash and ! $unique_hash->isEmpty()){

            foreach ($unique_hash as $key => $value) {


        $unique_hash_=$value->unique_hash;
          $counter =$counter +  TicketManager::where('ticket_hash',$unique_hash_)->get()->count();

        }
        }
        return $counter;
    }


    public function getReadTicketCountAttribute()
    {
        $mail_hash =$this->attributes['mail_ticket_hash'];
        $unique_hash =  HosPostHistory::where('mail_hash',$mail_hash )->get();
$counter =0;
        if($unique_hash and ! $unique_hash->isEmpty()){

            foreach ($unique_hash as $key => $value) {


        $unique_hash_=$value->unique_hash;
          $counter =$counter +  TicketManager::where('ticket_hash',$unique_hash_)->where('msg_read_at', null)->get()->count();

        }
        }
        return $counter;
    }

}
