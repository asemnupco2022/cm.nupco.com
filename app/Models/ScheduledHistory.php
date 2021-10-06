<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use rifrocket\LaravelCms\Models\ModelTraits\UniversalModelTrait;

class ScheduledHistory extends Model
{
    use HasFactory,UniversalModelTrait;

    const CONS_COLUMNS = [
        'sender_name' => true,
        'recipient_name' => true,
        'table_type'=>true,
        'msg_subject' => true,
        'last_executed_at' => true,
    ];


    protected $appends = ['sender_full_name','recipient_full_name'];


//    public function getSenderFullNameAttribute(){
//        $sender_id=$this->attributes['sender_user_id'];
//        $sender_model=$this->attributes['sender_user_model'];
//        return $this->attributes['sender_full_name']=$sender_model::find($sender_id);
//    }
//
//    public function getRecipientFullNameAttribute(){
//        $recipient_id=$this->attributes['recipient_user_id'];
//        $recipient_model=$this->attributes['recipient_user_model'];
//        dd($recipient_model);
//        return $this->attributes['recipient_full_name']=$recipient_model::find($recipient_id);
//    }
}
