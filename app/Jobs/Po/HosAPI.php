<?php

namespace App\Jobs\Po;

use App\Models\HosPostHistory;
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
        $this->hosUrl='';
        $this->vendor_code=$vendor_code;
        $this->collection=$collection;
        $this->email_unique=$email_unique;
        $this->email_hash=$email_hash;
        $this->mail_type=$mail_type;
    }


//mail_unique
//mail_hash

//{
//"message_type": "enquiry",
//"unique_hash": "3gr4htn3rrgh3jokrko",
//"tender_num": "NPT0001/18",
//"vendor_num": "23454",
//"po_num": "345678909876",
//"customer_num": "9765432234F",
//"po_item_num": "10",
//"mat_num": "10",
//"uom": "103",
//"ordered_qty": "10888",
//"open_qty": "10000",
//"net_order_value": "1034567.538",
//"delivery_date": "2021-10-07"
//}

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
                $insertToHos->tender_num= $poItemCol->tender_no;
                $insertToHos->vendor_num=$this->vendor_code;
                $insertToHos->po_num=$poItemCol->purchasing_document;
                $insertToHos->customer_num=$poItemCol->customer_name;
                $insertToHos->po_item_num=$poItemCol->po_item;
                $insertToHos->uom=$poItemCol->uom;
                $insertToHos->ordered_qty=$poItemCol->ordered_quantity;
                $insertToHos->open_qty=$poItemCol->open_quantity;
                $insertToHos->net_order_value=$poItemCol->net_order_value;
                $insertToHos->delivery_date=$poItemCol->nupco_delivery_date;
                $insertToHos->save();

                $response = Http::post($this->hosUrl, [
                    'mail_unique'=> $this->email_unique,
                    'mail_hash'=> $this->email_hash,
                    'message_type'=> $this->mail_type,
                    'unique_hash'=> $unique_hash,
                    'tender_num'=> $poItemCol->tender_no,
                    'vendor_num'=>$this->vendor_code,
                    'po_num'=>$poItemCol->purchasing_document,
                    'customer_num'=>$poItemCol->customer_name,
                    'po_item_num'=>$poItemCol->po_item,
                    'uom'=>$poItemCol->uom,
                    'ordered_qty'=>$poItemCol->ordered_quantity,
                    'open_qty'=>$poItemCol->open_quantity,
                    'net_order_value'=>$poItemCol->net_order_value,
                    'delivery_date'=>$poItemCol->nupco_delivery_date,
                ]);

                Log::info('HOS-API-POST-REQUEST',[$response]);


            }
        }


    }
}
