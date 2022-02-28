<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use rifrocket\LaravelCms\Models\LbsMember;
use rifrocket\LaravelCms\Models\ModelTraits\UniversalModelTrait;

class TicketMasterHeadr extends Model
{
    use HasFactory, UniversalModelTrait;

    protected $fillable=[

        'unique_hash',
        'unique_line',
        'message_type',
        'tender_num',
        'vendor_num',
        'vendor_name_en',
        'vendor_name_er',
        'po_num',
        'customer_name',
        'cust_code',
        'po_item_num',
        'uom',
        'plant',
        'ordered_qty',
        'open_qty',
        'net_order_value',
        'delivery_date',
        'item_desc',
        'mat_num',
        'tender_desc',
        'customer_po_no',
        'customer_po_item',
        'importance',
        'delivery_address',
        'line_status',
        'meta',
        'json_data',
        'status',
        'suspendReason',
        'updated_at'
    ];


    const CONS_COLUMNS=[
        // "Unique Hash"=>true,
        // "Unique Line"=>true,
        "Message Type"=>true,
        "Tender Num"=>true,
        "Vendor Num"=>true,
        "Vendor Name En"=>true,
        "Po Num"=>true,
        "Customer Name"=>true,
        "Cust Code"=>true,
        "Po Item Num"=>true,
        "Uom"=>true,
        "Plant"=>true,
        // "Ordered Qty"=>true,
        // "Open Qty"=>true,
        // "Net Order Value"=>true,
        "Delivery Date"=>true,
        "Item Desc"=>true,
        "Mat Num"=>true,
        "Tender Desc"=>true,
        "Customer Po No"=>true,
        "Customer Po Item"=>true,
        "Importance"=>true,
        "Delivery Address"=>true,
        "Line Status"=>true,
        // "Meta"=>true,
        // "Json Data"=>true,
        // "Status"=>true,
        // "SuspendReason"=>true,
    ];

    public function has_chat()
    {
        return $this->belongsTo(TicketManager::class, 'unique_line', 'unique_line');
    }

  

    public function has_vendor()
    {
        return $this->belongsTo(LbsMember::class, 'vendor_num', 'vendor_code');
    }



    public function getAllTicketCountAttribute()
    {
        $unique_hash_=$this->attributes['unique_line'];;
        $counter = TicketManager::where('unique_line',$unique_hash_)->get();
        if ($counter) {
         return    $counter->count();
        }
        return 0;
    }


    public function getReadTicketCountAttribute()
    {
        $unique_hash_=$this->attributes['unique_line'];;
        $counter = TicketManager::where('unique_line',$unique_hash_)->where('msg_read_at', null)->get();
        if ($counter) {
         return    $counter->count();
        }
        return 0;
    }
}
