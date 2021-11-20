<?php

namespace App\Jobs\Po;

use App\Helpers\PoHelper;
use App\Models\HosPostHistory;
use App\Models\PoSapMaster;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use rifrocket\LaravelCms\Facades\LaravelCmsFacade;

class HosAPI implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $hosUrl, $vendor_code,$mail_type,$collection, $email_unique, $email_hash;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($vendor_code, $mail_type, $collection, $email_unique, $email_hash)
    {
        $this->hosUrl=env('HOS_API_BASE').'/HOS_S4/api/add-supplier-comment';
        $this->vendor_code=$vendor_code;
        $this->collection=$collection;
        $this->email_unique=$email_unique;
        $this->email_hash=$email_hash;
        $this->mail_type=$mail_type;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        if ($this->collection and !empty($this->collection)){
            foreach ($this->collection as $key=> $poItemCol){

                $ticket_number=LaravelCmsFacade::lbs_random_generator(16,true,false,true,false);
                $unique_hash=Hash::make($ticket_number);
                $insertToHos=new HosPostHistory();
                $insertToHos->mail_unique= $this->email_unique;
                $insertToHos->mail_hash= $this->email_hash;
                $insertToHos->message_type= $this->mail_type;
                $insertToHos->unique_hash= $unique_hash;
                $insertToHos->tender_num= $poItemCol['tender_no'];
                $insertToHos->vendor_num=$this->vendor_code;
                $insertToHos->po_num=$poItemCol['po_number'];
                $insertToHos->customer_name=$poItemCol['customer_name'];
                $insertToHos->cust_code=$poItemCol['customer_no'];
                $insertToHos->po_item_num=$poItemCol['po_item'];
                $insertToHos->uom=$poItemCol['uo_m'];
                $insertToHos->plant=$poItemCol['plant'];
                $insertToHos->ordered_qty=$poItemCol['ordered_quantity'];
                $insertToHos->open_qty=$poItemCol['open_quantity'];
                $insertToHos->net_order_value=$poItemCol['net_value'];
                $insertToHos->delivery_date=$poItemCol['nupco_delivery_date'];
                $insertToHos->item_desc=$poItemCol['mat_description'];
                $insertToHos->mat_num=$poItemCol['material_number'];
                $insertToHos->save();


                $sendable=[
                    'mail_unique'=> $this->email_unique,
                    'mail_hash'=> $this->email_hash,
                    'message_type'=> $this->mail_type,
                    'unique_hash'=> $unique_hash,
                    'tender_num'=> $poItemCol['tender_no'],
                    'vendor_num'=>ltrim($this->vendor_code,0),
                    'po_num'=>$poItemCol['po_number'],
                    'customer_name'=>$poItemCol['customer_name'],
                    'cust_code'=>$poItemCol['customer_no'],
                    'po_item_num'=>$poItemCol['po_item'],
                    'uom'=>$poItemCol['uo_m'],
                    'plant'=>$poItemCol['plant'],
                    'ordered_qty'=>$poItemCol['ordered_quantity'],
                    'open_qty'=>$poItemCol['open_quantity'],
                    'net_order_value'=>$poItemCol['net_value'],
                    'delivery_date'=>$poItemCol['nupco_delivery_date'],
                    "item_desc"=>  $poItemCol['mat_description'],
                    "mat_num"=> $poItemCol['material_number'],
                ];


                try {


                    // $response = Http::get($this->hosUrl,$sendable );
                    // Log::info('HOS-API-POST-REQUEST',[$response]);

                    // $hosLog = PoHelper::hosLogs( $response, 'send notification for sap line item: '.json_encode($sendable), 'SEND', 'SAP_LINE_ITEM');
                    // Log::info('HOS-API-LOG',[$hosLog]);

                    $result =  PoSapMaster::find($poItemCol['id'])->update(['uniue_hash'=>$unique_hash]);
                    Log::info('update sap hash for'.$poItemCol['id'],[$result]);

                    $saptmp=[
                        'unique_hash'=>$unique_hash,
                        'notified'=>'yes',
                    ];
                    $tmpResult=PoHelper::sapMasterTmp($saptmp,$poItemCol['po_number'], $poItemCol['po_item']);
                    Log::info('update sap tmp record'.$poItemCol['id'],[$tmpResult]);
                } catch (\Throwable $th) {
                    //throw $th;
                }

            }
        }
    }
}
