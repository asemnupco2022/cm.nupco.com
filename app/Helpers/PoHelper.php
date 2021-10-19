<?php


namespace App\Helpers;


use App\Jobs\Po\HosAPI;
use App\Models\InternalComment;
use App\Models\LbsUserSearchSet;
use App\Models\NotificationHistory;
use Illuminate\Support\Facades\Hash;
use PDF;
use Exporter;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class PoHelper
{

    public static  function NormalizeColString($string=null, array $keyCollection =null)
    {
        if ($keyCollection){
            foreach ($keyCollection as $key=> $collection){
                $collection=  Str::replace('_', ' ', $collection);
                $collection=  Str::replace('-', ' ', $collection);
                $keyCollection[$key]= ucwords(trans($collection));
            }
           return $keyCollection;
        }
        $string=  Str::replace(['_','-','[',']','"'], ' ', $string);
        return ucwords(trans($string));
    }

    public static function excel_export($collection,$filename)
    {

        $path=storage_path('app/export');
        if(!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        $excel = Exporter::make('Excel');
        $excel->load($collection);
        $excel->setChunk(1000);
        return $excel->save($path.'/'.$filename);
    }

    public static function export_pdf($cols,$collections,$filename)
    {
        $title=explode('-',$filename)[0];
        $path=storage_path('app/export');
        if(!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }
      return  PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])->loadView('pdf.table-print', compact('cols','collections','title'))->setPaper('a4', 'landscape')->setWarnings(false)->save($path.'/'.$filename);
    }


    public static function SaveNotificationHistory($notifiable, $mailableData)
    {

        $ticket_hash=Hash::make($notifiable['mail_ticket_number']);
        $schedulerHistory=new NotificationHistory();

        $schedulerHistory->broadcast_type =$notifiable['broadcast_type'];
        $schedulerHistory->mail_ticket_number   =$notifiable['mail_ticket_number'];
        $schedulerHistory->mail_ticket_hash   = $ticket_hash;  // ;
        $schedulerHistory->mail_type =$notifiable['mail_type'];
        $schedulerHistory->table_type =$notifiable['table_type'];
        $schedulerHistory->sender_user_id =$notifiable['sender_user_id'];
        $schedulerHistory->sender_user_model =$notifiable['sender_user_model'];
        $schedulerHistory->sender_name =$notifiable['sender_name'];
        $schedulerHistory->sender_email =$notifiable['sender_email'];
        $schedulerHistory->recipient_user_id =$notifiable['recipient_user_id'];
        $schedulerHistory->recipient_user_model =$notifiable['recipient_user_model'];
        $schedulerHistory->recipient_email =$notifiable['recipient_email'];
        $schedulerHistory->msg_subject =$notifiable['msg_subject'];
        $schedulerHistory->msg_body =$notifiable['msg_body'];
        $schedulerHistory->execute_at_date =$notifiable['execute_at_date'];
        $schedulerHistory->execute_at_time =$notifiable['execute_at_time'];
        $schedulerHistory->last_executed_at =$notifiable['last_executed_at'];
        $schedulerHistory->meta =$notifiable['meta'];
        $schedulerHistory->json_data =$notifiable['json_data'];
        dispatch(new HosAPI($mailableData['vendor_code'],$notifiable['mail_type'],$mailableData['sap_object'],$notifiable['mail_ticket_number'],$ticket_hash));
        return $schedulerHistory->save();
    }


    public static function getInternalCommentCount( $purchasing_doc_no, $line_item_no, $tableType )
    {
      return  InternalComment::where('table_type',$tableType)->where('purchasing_doc_no',$purchasing_doc_no)->where('line_item_no',$line_item_no)->count();
    }

}
