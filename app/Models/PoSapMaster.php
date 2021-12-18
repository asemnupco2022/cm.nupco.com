<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use rifrocket\LaravelCms\Models\LbsAdmin;
use rifrocket\LaravelCms\Models\LbsMember;
use rifrocket\LaravelCms\Models\ModelTraits\UniversalModelTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class PoSapMaster extends Model
{
    use HasFactory, UniversalModelTrait;



    const CONS_COLUMNS = [

            "notified"=>true,
            // "asn"=>true,
            "document_type"=>true,
            "document_type_desc"=>true,
            "po_number"=>true,
            "po_item"=>true,
            "material_number"=>true,
            "mat_description"=>true,
            "po_created_on"=>true,
            "purchasing_organization"=>true,
            "purchasing_group"=>true,
            "currency"=>true,
            "customer_no"=>true,
            "customer_name"=>true,
            "tender_no"=>true,
            "tender_desc"=>true,
            "vendor_code"=>true,
            "vendor_name_en"=>true,
            "vendor_name_er"=>true,
            "plant"=>true,
            "storage_location"=>true,
            "uo_m"=>true,
            "net_price"=>true,
            "price_unit"=>true,
            "net_value"=>true,
            "nupco_trade_code"=>true,
            "nupco_delivery_date"=>true,
            "ordered_quantity"=>true,
            "open_quantity"=>true,
            "item_status"=>true,
            "delivery_address"=>true,
            "delivery_no"=>true,
            "cust_cont_trade_numb"=>true,
            "cust_gen_code"=>true,
            "generic_mat_code"=>true,
            "old_new_po_number"=>true,
            "old_po_item"=>true,
            "gr_quantity"=>true,
            "gr_amount"=>true,
            "customer_po_no"=>true,
            "customer_po_item"=>true,
            "pur_grp_name"=>true,
            "supply_ratio"=>true,
            "supplier_comment"=>false,
        ];

        const CONS_COLUMNS_NORMALIZED =[
            "Notified"=>true,
            // "Asn"=>true,
            "Document Type"=>true,
            "Document Type Desc"=>true,
            "Po Number"=>true,
            "Po Item"=>true,
            "Material Number"=>true,
            "Mat Description"=>true,
            "Po Created On"=>true,
            "Purchasing Organization"=>true,
            "Purchasing Group"=>true,
            "Currency"=>true,
            "Customer No"=>true,
            "Customer Name"=>true,
            "Tender No"=>true,
            "Tender Desc"=>true,
            "Vendor Code"=>true,
            "Vendor Name En"=>true,
            "Vendor Name Er"=>true,
            "Plant"=>true,
            "Storage Location"=>true,
            "Uo M"=>true,
            "Net Price"=>true,
            "Price Unit"=>true,
            "Net Value"=>true,
            "Nupco Trade Code"=>true,
            "Nupco Delivery Date"=>true,
            "Ordered Quantity"=>true,
            "Open Quantity"=>true,
            "Item Status"=>true,
            "Delivery Address"=>true,
            "Delivery No"=>true,
            "Cust Cont Trade Numb"=>true,
            "Cust Gen Code"=>true,
            "Generic Mat Code"=>true,
            "Old New Po Number"=>true,
            "Old Po Item"=>true,
            "Gr Quantity"=>true,
            "Gr Amount"=>true,
            "Customer PO No"=>true,
            "Customer PO Item"=>true,
            "Pur. Grp Name"=>true,
            "Supply Ratio"=>true,
            "Supplier Comment"=>false,
        ];


    protected $fillable = [

        "document_type",
        "document_type_desc",
        "po_number",
        "po_item",
        "material_number",
        "mat_description",
        "po_created_on",
        "purchasing_organization",
        "purchasing_group",
        "currency",
        "customer_no",
        "customer_name",
        "tender_no",
        "tender_desc",
        "vendor_code",
        "vendor_name_en",
        "vendor_name_er",
        "plant",
        "storage_location",
        "uo_m",
        "net_price",
        "price_unit",
        "net_value",
        "nupco_trade_code",
        "nupco_delivery_date",
        "ordered_quantity",
        "open_quantity",
        "item_status",
        "delivery_address",
        "delivery_no",
        "cust_cont_trade_numb",
        "cust_gen_code",
        "generic_mat_code",
        "old_new_po_number",
        "old_po_item",
        "gr_quantity",
        "gr_amount",
        "customer_po_no",
        "customer_po_item",
        "pur_grp_name",
        "supply_ratio",
        "unique_line",
        "unique_line_date",
        "notified",
        "asn",
        "unique_hash",
        "supplier_comment",
    ];


    public function getInternalComentCountAttribute()
    {
        $po_number =$this->attributes['po_number'];
        $po_item =$this->attributes['po_item'];

        return InternalComment::where('table_type', 'sap_line_item')->where('purchasing_doc_no', $po_number)->where('line_item_no', $po_item)->count();
    }

    public function getVendorlComentCountAttribute()
    {
        $unique_hash =$this->attributes['unique_hash'];
        if ($unique_hash) {
            return  $tickets= TicketManager::where('ticket_hash',$unique_hash)->get()->count();
        }return 0;

    }

    public function setPoCreatedOnAttribute($value)
    {
        Log::info('check-> '.$value);
        return $this->attributes['po_created_on'] = Carbon::createFromFormat('d.m.Y',$value)->format('Y-m-d');
    }

    public function setNupcoDeliveryDateAttribute($value)
    {
        return $this->attributes['nupco_delivery_date'] =  Carbon::createFromFormat('d.m.Y',$value)->format('Y-m-d');
    }

    public function vendorInfo()
    {
      return  $this->belongsTo(LbsMember::class,  'vendor_code', 'vendor_code');
    }

    public function staffInfo()
    {
       return  $this->belongsTo(LbsAdmin::class, 'meme', 'vendor_code');
    }

    public function scopeSaptmp($query, $searchString=null)
    {

        return $query->join('po_sap_master_tmps', function($join) use($searchString)
                {
                    $join->on('po_sap_master_tmps.po_number', '=', 'po_sap_masters.po_number');
                    $join->on('po_sap_master_tmps.po_item','=', 'po_sap_masters.po_item');
                    if(!empty($searchString)){
                        $join->where('po_sap_master_tmps.supplier_comment',$searchString);
                    }
                });

    }

    public function sapMasterTmp()
    {
       return $this->hasOne(poSapMasterTmp::class, 'unique_line', 'unique_line');
    }
}
