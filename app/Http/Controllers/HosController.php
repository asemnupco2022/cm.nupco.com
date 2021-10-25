<?php

namespace App\Http\Controllers;

use App\Models\HosPostHistory;
use App\Models\TicketManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HosController extends Controller
{
    public function vendorResponse(Request $request)
    {

        $v = Validator::make($request->all(), [
            'unique_hash' => 'required',
            'vendor_comment' => 'required',
        ]);

        if ($v->fails())
        {
            return response()->json(['success'=>false,'msg'=>$v->errors()->first()]);
        }
        if (!HosPostHistory::where('unique_hash',$request->unique_hash)->exists()){
            return response()->json(['success'=>false,'msg'=>'unique hash does not found']);
        }

        $hosHistory = HosPostHistory::with('hasNotificationHistory')->where('unique_hash',$request->unique_hash)->first();

        $tickets = new TicketManager();
        $tickets->ticket_number=$hosHistory->mail_unique;
        $tickets->ticket_hash=$hosHistory->unique_hash;
        $tickets->staff_user_id=$hosHistory->hasNotificationHistory->sender_user_id;
        $tickets->staff_user_model=$hosHistory->hasNotificationHistory->sender_user_model;
        $tickets->staff_name=$hosHistory->hasNotificationHistory->sender_name;
        $tickets->staff_email=$hosHistory->hasNotificationHistory->sender_email;
        $tickets->vendor_user_id=$hosHistory->hasNotificationHistory->recipient_user_id;
        $tickets->vendor_user_id=$hosHistory->hasNotificationHistory->recipient_user_id;
        $tickets->vendor_user_model=$hosHistory->hasNotificationHistory->recipient_user_model;
        $tickets->vendor_name=$hosHistory->hasNotificationHistory->recipient_name;
        $tickets->vendor_email=$hosHistory->hasNotificationHistory->recipient_email;
        $tickets->msg_sender_id='vendor';
        $tickets->msg_body=json_encode($request->vendor_comment);
        $tickets->attachment=$request->attachment_info['file_path'];
        $tickets->attachment_name=$request->attachment_info['file_name'];
        $tickets->json_data=$request->item_note;
        $tickets->msg_receiver_id='staff';
        if ($tickets->save()){
            return response()->json(['success'=>true,'msg'=>'data saved successfully']);
        }
        return response()->json(['success'=>false,'msg'=>'there is something wrong']);
    }
}
