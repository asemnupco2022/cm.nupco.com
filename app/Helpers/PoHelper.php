<?php


namespace App\Helpers;

use App\Jobs\Export\PdfExcelExportJob;
use App\Jobs\Po\HosAPI;
use App\Models\HosPostHistory;
use App\Models\HosResponseLog;
use App\Models\InternalComment;
use App\Models\LbsUserSearchSet;
use App\Models\PoSapMaster;
use App\Models\PoSapMasterTmp;
use App\Models\SchedulerNotificationHistory;
use App\Models\StaffColumnSet;
use App\Models\TicketManager;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use PDF;
use Exporter;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class PoHelper
{

    public static function NormalizeColString($string = null, array $keyCollection = null)
    {
        if ($keyCollection) {
            foreach ($keyCollection as $key => $collection) {
                $collection = Str::replace('_', ' ', $collection);
                $collection = Str::replace('-', ' ', $collection);
                $keyCollection[$key] = ucwords(trans($collection));
            }
            return $keyCollection;
        }
        $string = Str::replace(['_', '-', '[', ']', '"'], ' ', $string);
        return ucwords(trans($string));
    }


    public static function DeNormalizeColString($string = null, array $keyCollection = null)
    {
        if ($keyCollection) {
            foreach ($keyCollection as $key => $collection) {
                $collection = Str::replace(' ', '_', $collection);
                $keyCollection[$key] = strtolower(trans($collection));
            }
            return $keyCollection;
        }

        $string = Str::replace(' ', '_', $string);;
        return ucwords(trans($string));
    }

    public static function excel_export($collection, $filename)
    {

        $path = storage_path('app/export');
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        $excel = Exporter::make('Excel');
        $excel->load($collection);
        $excel->setChunk(1000);
        return $excel->save($path . '/' . $filename);
    }

    public static function export_pdf($cols, $collections, $filename)
    {
        $title = explode('-', $filename)[0];
        $path = storage_path('app/export');
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }
        return PDF::loadView('pdf.table-print', compact('cols', 'collections', 'title'))->save($path . '/' . $filename);
    }


    public static function SaveNotificationHistory($notifiable, $mailableData)
    {

        $ticket_hash = Hash::make($notifiable['mail_ticket_number']);
        $schedulerHistory = new SchedulerNotificationHistory();

        $schedulerHistory->broadcast_type = $notifiable['broadcast_type'];
        $schedulerHistory->mail_ticket_number = $notifiable['mail_ticket_number'];
        $schedulerHistory->mail_ticket_hash = $ticket_hash;  // ;
        $schedulerHistory->mail_type = $notifiable['mail_type'];
        $schedulerHistory->table_type = $notifiable['table_type'];
        $schedulerHistory->sender_user_id = $notifiable['sender_user_id'];
        $schedulerHistory->sender_user_model = $notifiable['sender_user_model'];
        $schedulerHistory->sender_name = $notifiable['sender_name'];
        $schedulerHistory->sender_email = $notifiable['sender_email'];
        $schedulerHistory->recipient_user_id = $notifiable['recipient_user_id'];
        $schedulerHistory->recipient_user_model = $notifiable['recipient_user_model'];
        $schedulerHistory->recipient_email = $notifiable['recipient_email'];
        $schedulerHistory->msg_subject = $notifiable['msg_subject'];
        $schedulerHistory->msg_body = $notifiable['msg_body'];
        $schedulerHistory->execute_at_date = $notifiable['execute_at_date'];
        $schedulerHistory->execute_at_time = $notifiable['execute_at_time'];
        $schedulerHistory->last_executed_at = $notifiable['last_executed_at'];
        $schedulerHistory->meta = $notifiable['meta'];
        $schedulerHistory->json_data = $notifiable['json_data'];
        dispatch(new HosAPI($mailableData['vendor_code'], $notifiable['mail_type'], $mailableData['sap_object'], $notifiable['mail_ticket_number'], $ticket_hash));
        return $schedulerHistory->save();
    }


    public static function getInternalCommentCount($purchasing_doc_no, $line_item_no, $tableType)
    {
        return InternalComment::where('table_type', $tableType)->where('purchasing_doc_no', $purchasing_doc_no)->where('line_item_no', $line_item_no)->count();
    }

    public static function sendHeaderForChat(array $supplier_comment)
    {
//        $supplier_comment = [
//            "message_type" => "enquiry",
//            "unique_hash" => "3gr4htn3rrgh3jokrko",
//            "tender_num" => "NPT0001/18",
//            "vendor_num" => "400034",
//            "po_num" => "345678909876",
//            "customer_num" => "9765432234F",
//            "po_item_num" => "10",
//            "mat_num" => "10",
//            "uom" => "103",
//            "ordered_qty" => "10888",
//            "open_qty" => "10000",
//            "net_order_value" => "1034567.538",
//            "delivery_date" => "2021-10-07"
//        ];
        return Http::post(env('HOS_API_BASE') . '/HOS_S4/api/add-supplier-comment', $supplier_comment);
    }

    public static function unreadMessages( $level, $data=null)
    {
        if ($level=='top'){
            return   TicketManager::where('msg_read_at', null)->get()->count();
        }
        if ($level=='middle'){

          $unique_hash =  HosPostHistory::where('mail_hash',$data)->first();

          if($unique_hash){
          $unique_hash=$unique_hash->unique_hash;
            return  TicketManager::where('ticket_hash',$unique_hash)->where('msg_read_at', null)->get()->count();
          }
          return 0;

        }
        if ($level=='middle-all'){

            $unique_hash =  HosPostHistory::where('mail_hash',$data)->first();

            if($unique_hash){
            $unique_hash=$unique_hash->unique_hash;
              return  TicketManager::where('ticket_hash',$unique_hash)->get()->count();
            }
            return 0;

          }
        if ($level=='lower'){
            return  TicketManager::where('ticket_hash',$data)->where('msg_read_at', null)->get()->count();
        }
        if ($level=='lower-all'){
            return  TicketManager::where('ticket_hash',$data)->get()->count();
        }
    }


    public static function lastVendorComment($po_number, $po_item, $tableType=null){
        // $unique_line=$po_number.'_'.$po_item;
            if(HosPostHistory::where('po_num',$po_number)->where('po_item_num',$po_item)->orderBy('id','DESC')->first()){

              $uniqueHash =  HosPostHistory::where('po_num',$po_number)->where('po_item_num',$po_item)->orderBy('id','DESC')->first()->unique_hash;
              if($uniqueHash){
                return  $tickets= TicketManager::where('ticket_hash',$uniqueHash)->get()->count();
              }
            }
            return 0;
    }


    public static function getSAPpoData($po_number, $po_item, $colunm){

        if(PoSapMaster::where('po_number',$po_number)->where('po_item',$po_item)->orderBy('id','DESC')->first()){
         $result = PoSapMaster::where('po_number',$po_number)->where('po_item',$po_item)->orderBy('id','DESC')->first();
            return $result->{$colunm};
        }
        return null;
    }

    public static function hosLogs($response, $request, $request_type, $brodcast_type)
    {
        $data=json_decode($response, true);
        $insert =new HosResponseLog();
        $insert->request=$request;
        $insert->request_type=$request_type;
        $insert->brodcast_type=$brodcast_type;
        $insert->rs_status=Arr::has($data,'status')?$data['status']:'no status found';
        $insert->rs_mesg=Arr::has($data,'message')?$data['message'] : $request;
        $insert->rs_body=$response;
      return   $insert->save();
    }

    public static function sapMasterTmp($requests, $po_number, $po_item)
    {
        $update =PoSapMasterTmp::where('unique_line',$po_number.'_'.$po_item)->first();
        $sapMasterUpdate =PoSapMaster::where('unique_line',$po_number.'_'.$po_item)->first();

        if(! $update){
            $update = new PoSapMasterTmp();
            $update->po_number=$po_number;
            $update->po_item=$po_item;
        }
        foreach ($requests as $key => $value) {
            $update->{$key} = $value;
            $sapMasterUpdate->{$key} = $value;
        }
        $sapMasterUpdate->save();
       return $update->save();
    }


    public static function thousandsCurrencyFormat($num) {

        if($num>1000) {

            $x = round($num);
            $x_number_format = number_format($x);
            $x_array = explode(',', $x_number_format);
            $x_parts = array('K', 'M', 'B', 'T');
            $x_count_parts = count($x_array) - 1;
            $x_display = $x;
            $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
            $x_display .= ' '.$x_parts[$x_count_parts - 1];

            return $x_display;
        }
        return $num;
    }


    public static function createLogChennel($fileNae)
    {
        Config::set('logging.channels.custom_chennel.path', storage_path('logs').'/'.$fileNae);
    }



    //COLLECTION MANAGER FROM VIEW SQL
    public static function collection_sap_pur_groups()
    {
       return  DB::table('collection_sap_pur_groups')->pluck('purchasing_group','purchasing_group');
    }

    public static function collection_sap_po_types()
    {
       return  DB::table('collection_sap_po_types')->pluck('document_type','document_type');
    }

    public static function collection_sap_delivery_address()
    {
       return  DB::table('collection_sap_delivery_address')->pluck('delivery_address','delivery_address');
    }


    public static function collection_sap_plnts()
    {
       return  DB::table('collection_sap_plnts')->pluck('plant','plant');
    }


    public static function collection_vendor_codes()
    {
       return  DB::table('collection_vendor_codes')->pluck('vendor_code','vendor_code');
    }

    public static function collection_sap_tender_nos()
    {
       return  DB::table('collection_sap_tender_nos')->pluck('tender_no','tender_no');
    }

    public static function collection_sap_customer_names()
    {
       return  DB::table('collection_sap_customer_names')->pluck('customer_name','customer_name');
    }

    public static function collection_sap_vendor_name_ens()
    {
       return  DB::table('collection_sap_vendor_name_ens')->pluck('vendor_name_en','vendor_name_en');
    }

    public static function collection_sap_tender_descs()
    {
       return  DB::table('collection_sap_tender_descs')->pluck('tender_desc','tender_desc');
    }

    public static function collection_sap_po_numbers()
    {
       return  DB::table('collection_sap_po_numbers')->pluck('po_number','po_number');
    }

    public static function collection_sap_generic_mat_codes()
    {
       return  DB::table('collection_sap_generic_mat_codes')->pluck('generic_mat_code','generic_mat_code');
    }

    public static function collection_sap_cust_gen_codes()
    {
       return  DB::table('collection_sap_cust_gen_codes')->pluck('cust_gen_code','cust_gen_code');
    }


    public static function collection_sap_mat_descriptions()
    {
       return  DB::table('collection_sap_mat_descriptions')->pluck('mat_description','mat_description');
    }


    public static function collection_sap_storage_locations()
    {
       return  DB::table('collection_sap_storage_locations')->pluck('storage_location','storage_location');
    }

    public static function collection_sap_customer_nos()
    {
       return  DB::table('collection_sap_customer_nos')->pluck('customer_no','customer_no');
    }



}
