<?php

namespace App\Http\Controllers;

use App\Helpers\PoHelper;
use App\Models\AsnHeader;
use App\Models\HosPostHistory;
use App\Models\HosResponseLog;
use App\Models\PoSapMaster;
use App\Models\SchedulerNotificationHistory;
use App\Models\TicketManager;
use App\Models\TicketMasterHeadr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class HosController extends Controller
{
    public function vendorResponse_(Request $request)
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


    public function vendorResponse(Request $request)
    {
        $v = Validator::make($request->all(), [
            'vendor_comment' => 'required',
        ]);


        if ($v->fails())
        {
            return response()->json(['success'=>false,'message'=>$v->errors()->first()]);
        }


        $unique_line=(int)$request->po_num.'_'.(int)$request->po_item_num;
        $hosHistory = TicketMasterHeadr::with('has_vendor')->where('unique_line',$unique_line)->first();

        $tickets = new TicketManager();
        $tickets->ticket_hash=$unique_line;
        $tickets->unique_line=$unique_line;
        $tickets->staff_user_id=null;
        $tickets->staff_user_model=null;
        $tickets->staff_name=null;
        $tickets->staff_email=null;
        $tickets->vendor_user_id=$hosHistory->has_vendor->id;
        $tickets->vendor_user_model="rifrocket\\LaravelCms\\Models\\LbsUserMeta";
        $tickets->vendor_name=$hosHistory->has_vendor->display_name;
        $tickets->vendor_email=$hosHistory->has_vendor->email;
        $tickets->msg_sender_id='vendor';

        $tickets->msg_body=$request->vendor_comment[0];

        if($request->attachment_info ){
            $tickets->attachment= $request->attachment_info['file_path'];
            $tickets->attachment_name=$request->attachment_info['original_file_name'];
        }

        $tickets->json_data=$request->item_note;
        $tickets->msg_receiver_id='staff';
        if ($tickets->save()){


            $insert =new HosResponseLog();
            $insert->request="received comment from Hos by vendor ".$hosHistory->has_vendor->display_name." for ticket unique hash: ".$request->unique_hash;
            $insert->request_type="POST";
            $insert->brodcast_type='RECEIVED';
            $insert->rs_status=1;
            $insert->rs_mesg="DATA RECEIVED";
            $insert->rs_body=json_encode($request->all());
            $insert->save();

            Log::info('HOS-API-LOG',[$insert]);

            TicketMasterHeadr::where('unique_line',$unique_line)->first()->update(['updated_at'=>Carbon::now(),'line_status'=>'new','meta'=>'new']);
            $hosHistory = HosPostHistory::where('unique_line',$unique_line)->first();
            if ($hosHistory) {
                $hosHistory->update(['updated_at'=>Carbon::now()]);
            }
            $supplier_comment=PoHelper::NormalizeColString($request->vendor_comment[0]);

            $saptmp=[
                'supplier_comment'=>$supplier_comment,
                "unique_hash"=>$unique_line,
            ];
            PoHelper::sapMasterTmp($saptmp,$request->po_num, $request->po_item_num);

            return response()->json(['status'=>1,'message'=>'data saved successfully!']);
        }
        return response()->json(['status'=>0,'message'=>'there is something wrong']);
    }

    public function HosAsnManager(Request $request)
    {


       $v = Validator::make($request->all(), [
            'asn_id' => 'required',
            'status' => 'required',
        ]);

        if ($v->fails())
        {
            return response()->json(['success'=>false,'message'=>$v->errors()->first()]);
        }


        switch ($request->status) {
            case '1':
                $asn_status = 'new';
                break;

            case '2':
                $asn_status = 'approved';
                break;

            case '3':
                $asn_status = 'rejected';
                break;

            case '4':
                $asn_status = 'delivered';
                break;

            case '5':
                $asn_status = 'not_delivered';
                break;

            default:
                $asn_status = 'new';
                break;
        }
        $asnInsertable=[

                'asn_id'=>$request->asn_id,
                'plant'=>$request->plant,
                'sloc'=>$request->sloc,
                'vendor_no'=>$request->vendor_no,
                'total_pallet_count'=>$request->total_pallet_count,
                'truck_no'=>$request->truck_no,
                'delivery_date'=>$request->delivery_date,
                'delivery_time'=>$request->delivery_time,
                'asn_status'=> $asn_status ,

        ];

        $asn_json = json_encode( $asnInsertable );
        foreach ($request->po_details as $pokey => $povalue) {

            $povalue= (object) $povalue;
            $unique_line =$povalue->nupco_po_no.'_'.$povalue->nupco_po_item;
            $asnInsertable['unique_line']=$unique_line;
            $asnInsertable['nupco_po_no']=$povalue->nupco_po_no;
            $asnInsertable['nupco_po_item']=$povalue->nupco_po_item;
            $asnInsertable['nupco_material']=$povalue->nupco_material;
            $asnInsertable['trade_code']=$povalue->trade_code;
            $asnInsertable['batch_no']=$povalue->batch_no;
            $asnInsertable['mfg_date']=$povalue->mfg_date;
            $asnInsertable['expiry_date']= $povalue->expiry_date;
            $asnInsertable['is_deleted']= $povalue->is_deleted;

            $asnCheck = AsnHeader::where('unique_line',$unique_line)->first();
            if (!$asnCheck) {

                AsnHeader::create($asnInsertable);
            }
            else{

                $asnCheck ->update($asnInsertable);
            }

            $saptmp=[
                'asn'=> $asn_status,
                'asn_json'=>$asn_json,
            ];

            $result = PoHelper::sapMasterTmp($saptmp, $povalue->nupco_po_no, $povalue->nupco_po_item);
        }



        if($result){

            $insert =new HosResponseLog();
            $insert->request="received ASN information for asn_id ".$request->asn_id;
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
