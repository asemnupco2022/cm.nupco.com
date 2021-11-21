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
    use HasFactory, UniversalModelTrait, LogsActivity;


    const LOG_NAME='LOG_PO_SAP';
    protected static $logName = PoSapMaster::LOG_NAME;

    const CONS_COLUMNS = [

            "notified"=>true,
            "asn"=>true,
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
            "supply_ratio"=>true,
            "supplier_comment"=>false,
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
        "supply_ratio",
        "unique_line",
        "unique_line_date",
        "notified",
        "asn",
        "unique_hash",
        "supplier_comment",
    ];

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
