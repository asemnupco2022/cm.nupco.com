<?php

namespace App\Console\Commands;

use App\Models\HosPostHistory;
use App\Models\TicketManager;
use App\Models\TicketMasterHeadr;
use Illuminate\Console\Command;

class SyncTickets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lbs:sync-tickets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'synchronise new ticketing system with old code';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $allNotifciations = HosPostHistory::all();


        foreach ($allNotifciations as $key => $value) {

            $unique_line = $value->po_num.'_'.$value->po_item_num;
            $ticketHeader=[
                'unique_hash'=>$value->unique_hash,
                'unique_line'=>$unique_line,
                'message_type'=> $value->message_type,
                'tender_num'=> $value->tender_num,
                'vendor_num'=>ltrim($value->vendor_num,0),
                'vendor_name_en'=>$value->vendor_name_en,
                'vendor_name_er'=>$value->vendor_name_er,
                'po_num'=>$value->po_num,
                'customer_name'=>$value->customer_name,
                'cust_code'=>$value->cust_code,
                'po_item_num'=>$value->po_item_num,
                'uom'=>$value->uom,
                'plant'=>$value->plant,
                'ordered_qty'=>$value->ordered_qty,
                'open_qty'=>$value->open_qty,
                'net_order_value'=>$value->net_order_value,
                'delivery_date'=>$value->delivery_date,
                "item_desc"=>  $value->item_desc,
                "mat_num"=> $value->mat_num,
                "tender_desc"=>$value->tender_desc,
                "customer_po_no"=>$value->customer_po_no,
                "customer_po_item"=>$value->customer_po_item,
                "importance"=>$value->importance,
                "delivery_address"=>$value->delivery_address,
            ];



                $ticketMHeader =TicketMasterHeadr::where('unique_line',$unique_line)->first();
                if ($ticketMHeader) {
                    $ticketMHeader->update($ticketHeader);
                }else{
                    TicketMasterHeadr::create($ticketHeader);
                }

               $ticketManagers = TicketManager::where('ticket_hash',$value->unique_hash )->get();
               if ($ticketManagers and !$ticketManagers->isEmpty()) {
                   foreach ($ticketManagers as $Tkey => $Tvalue) {
                    $Tvalue->update(['unique_line'=>$unique_line]);
                   }

               }

        }
        return Command::SUCCESS;
    }
}
