<?php

namespace App\Http\Controllers;

use App\Helpers\PoHelper;
use App\Models\HosPostHistory;
use App\Models\HosResponseLog;
use App\Models\PoSapMaster;
use App\Models\SchedulerNotificationHistory;
use App\Models\TicketManager;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
            return response()->json(['success'=>false,'message'=>$v->errors()->first()]);
        }
        if (!HosPostHistory::where('unique_hash',$request->unique_hash)->exists()){
            return response()->json(['success'=>false,'message'=>'unique hash does not found']);
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

        if($request->attachment_info ){
            $tickets->attachment= $request->attachment_info['file_path'];
            $tickets->attachment_name=$request->attachment_info['original_file_name'];
        }

        $tickets->json_data=$request->item_note;
        $tickets->msg_receiver_id='staff';
        if ($tickets->save()){


            $insert =new HosResponseLog();
            $insert->request="received comment from Hos by vendor ".$hosHistory->hasNotificationHistory->venodInfo->display_name." for ticket unique hash: ".$request->unique_hash;
            $insert->request_type="POST";
            $insert->brodcast_type='RECEIVED';
            $insert->rs_status=1;
            $insert->rs_mesg="DATA RECEIVED";
            $insert->rs_body=json_encode($request->all());
            $insert->save();

            Log::info('HOS-API-LOG',[$insert]);

            SchedulerNotificationHistory::where('mail_ticket_hash',$hosHistory->hasNotificationHistory->mail_ticket_hash)->first()->update(['updated_at'=>Carbon::now()]);
            HosPostHistory::where('unique_hash',$hosHistory->unique_hash)->first()->update(['updated_at'=>Carbon::now()]);
            $supplier_comment=PoHelper::NormalizeColString($request->vendor_comment[0]);

            $saptmp=[
                'supplier_comment'=>$supplier_comment,
                "unique_hash"=>$hosHistory->unique_hash,
            ];
            PoHelper::sapMasterTmp($saptmp,$hosHistory->po_num, $hosHistory->po_item_num);

            return response()->json(['status'=>1,'message'=>'data saved successfully!']);
        }
        return response()->json(['status'=>0,'message'=>'there is something wrong']);
    }


    public function HosAsnManager(Request $request)
    {

       $v = Validator::make($request->all(), [
            'po_number' => 'required',
            'po_item' => 'required',
            'asn_status'=>'required',
            'asn_json'=>'required',
        ]);

        if ($v->fails())
        {
            return response()->json(['success'=>false,'message'=>$v->errors()->first()]);
        }
        $unique_line =$request->po_number.'_'.$request->po_item;
        if (!PoSapMaster::where('unique_line', $unique_line)->exists()){
            return response()->json(['success'=>false,'message'=>'unique hash does not found']);
        }

        $saptmp=[
            'asn'=>$request->asn_status,
            'asn_json'=>$request->asn_json,
        ];

        $result = PoHelper::sapMasterTmp($saptmp,$request->po_number, $request->po_item);
        if($result){

            $insert =new HosResponseLog();
            $insert->request="received ASN information for SAP uniqui line ".$unique_line;
            $insert->request_type="POST";
            $insert->brodcast_type='RECEIVED';
            $insert->rs_status=1;
            $insert->rs_mesg="DATA RECEIVED";
            $insert->rs_body=json_encode($request->all());
            $insert->save();
            Log::info('HOS-API-LOG',[$insert]);
            return response()->json(['status'=>1,'message'=>'ASN data saved successfully!']);
        }

        $hosLog = PoHelper::hosLogs( $request, "received ASN information for SAP uniqui line ","POST", 'RECEIVED');
        Log::info('HOS-API-LOG',[$hosLog]);
        return response()->json(['status'=>0,'message'=>'there is something wrong']);
    }
}
