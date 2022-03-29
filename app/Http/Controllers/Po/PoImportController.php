<?php

namespace App\Http\Controllers\Po;

use App\Http\Controllers\Controller;
use App\Models\PoSapMaster;
use Illuminate\Http\Request;
use Importer;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\XmlConfiguration\Group;

class PoImportController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function importPO()
    {
        return view('po.import');
    }


    public function SAPTable()
    {
        return view('po.saptabel');
    }


    public function MawTable()
    {
        return view('po.mawtabel');
    }


    public function SAPTableLineItem($slug)
    {
        $po_number=base64_decode($slug);
        return view('po.sapLineItems',compact('po_number'));
    }

    public function SAPTableLineItems($slug)
    {
        $po_number=base64_decode($slug);
        return view('po.sapLineItems',compact('po_number'));
    }

    public function SAPTableLinestatistic($slug)
    {



        $collectionString=base64_decode($slug);
        $SapId = collect(DB::select($collectionString))->pluck('id')->toArray();
        $SapIdTmp =$SapId ;

        $SapId = implode(',',$SapId);

        $statisticTable=DB::select("
        SELECT
        COUNT(*) AS total_shipments,
        (SELECT COUNT(*) FROM `po_sap_masters` WHERE `supply_ratio` = 0 AND `id` IN (".$SapId."))  AS supply_0,
        (SELECT COUNT(*) FROM `po_sap_masters` WHERE `supply_ratio` BETWEEN 1 AND 25 AND `id` IN (".$SapId."))  AS supply_1_to_25,
        (SELECT COUNT(*) FROM `po_sap_masters` WHERE `supply_ratio` BETWEEN 26 AND 50 AND `id` IN (".$SapId."))  AS supply_26_to_50,
        (SELECT COUNT(*) FROM `po_sap_masters` WHERE `supply_ratio` BETWEEN 51 AND 75 AND `id` IN (".$SapId."))  AS supply_51_to_75,
        (SELECT COUNT(*) FROM `po_sap_masters` WHERE `supply_ratio` BETWEEN 76 AND 98 AND `id` IN (".$SapId."))  AS supply_76_to_98,
        (SELECT COUNT(*) FROM `po_sap_masters` WHERE `supply_ratio` BETWEEN 99 AND 100 AND `id` IN (".$SapId."))  AS supply_99_to_100,

        (SELECT COUNT(*) FROM `po_sap_masters` WHERE `asn` = 'no' AND `id` IN (".$SapId."))  AS asn_no,
        (SELECT COUNT(*) FROM `po_sap_masters` WHERE `asn` = 'new' AND `id` IN (".$SapId."))  AS asn_new,
        (SELECT COUNT(*) FROM `po_sap_masters` WHERE `asn` = 'approved' AND `id` IN (".$SapId."))  AS asn_approved,
        (SELECT COUNT(*) FROM `po_sap_masters` WHERE `asn` = 'rejected' AND `id` IN (".$SapId."))  AS asn_rejected,

        (SELECT COUNT(*) OVER () FROM `po_sap_masters`  WHERE  `id` IN (".$SapId.") group by `vendor_code` LIMIT 1 )  AS numberofsuppliers,
        (SELECT COUNT(*) OVER () FROM `po_sap_masters`  WHERE  `id` IN (".$SapId.") group by `nupco_trade_code` LIMIT 1 )  AS numberofitems,
        (SELECT COUNT(*) FROM `po_sap_masters` WHERE `nupco_delivery_date` > CURDATE() AND `id` IN (".$SapId.") )  AS late_contract,

        (SELECT COUNT(*) FROM `po_sap_masters` WHERE `supplier_comment` ='تم التوريد (يجب ارفاق مذكرة استلام)' AND `id` IN (".$SapId.") )  AS comment1,
        (SELECT COUNT(*) FROM `po_sap_masters` WHERE `supplier_comment` ='سيتم التوريد (يجب تحديد التاريخ)' AND `id` IN (".$SapId.") )  AS comment2,
        (SELECT COUNT(*) FROM `po_sap_masters` WHERE `supplier_comment` ='رفض استلام من الجهة (يجب ارفاق الرفض)' AND `id` IN (".$SapId.") )  AS comment3,
        (SELECT COUNT(*) FROM `po_sap_masters` WHERE `supplier_comment` ='توريد جزئي' AND `id` IN (".$SapId.") )  AS comment4,
        (SELECT COUNT(*) FROM `po_sap_masters` WHERE `supplier_comment` ='توريد جزئي حسب طلب الجهة (يجب ارفاق الطلب)' AND `id` IN (".$SapId.") )  AS comment5,
        (SELECT COUNT(*) FROM `po_sap_masters` WHERE `supplier_comment` ='اعتذار عن توريد البند (يجب ارفاق خطاب أسباب الاعتذار)' AND `id` IN (".$SapId.") )  AS comment6,
        (SELECT COUNT(*) FROM `po_sap_masters` WHERE `supplier_comment` ='طلب خطاب تمديد/ فتح دفعة (يجب ارفاق الطلب)' AND `id` IN (".$SapId.") )  AS comment7,
        (SELECT COUNT(*) FROM `po_sap_masters` WHERE `supplier_comment` ='طلب اذن استيراد (يجب ارفاق الطلب)' AND `id` IN (".$SapId.") )  AS comment8,
        (SELECT COUNT(*) FROM `po_sap_masters` WHERE `supplier_comment` ='الرد على خطاب الانذار' AND `id` IN (".$SapId.") )  AS comment9,
        (SELECT COUNT(*) FROM `po_sap_masters` WHERE `supplier_comment` ='أخرى' AND `id` IN (".$SapId.") )  AS comment10,

        SUM(CAST(REPLACE(gr_quantity, ',', '') AS DECIMAL(10, 2))) AS gr_quantity,
        SUM(CAST(REPLACE(ordered_quantity, ',', '') AS DECIMAL(10, 2))) AS ordered_quantity,
        SUM(CAST(REPLACE(net_value, ',', '') AS DECIMAL(10, 2))) AS net_order_value,
        SUM(CAST(REPLACE(gr_amount, ',', '') AS DECIMAL(10, 2))) AS gr_amount,
        concat(round(( SUM(CAST(REPLACE(gr_quantity, ',', '') AS DECIMAL(10, 2)))/SUM(CAST(REPLACE(ordered_quantity, ',', '') AS DECIMAL(10, 2))) * 100 ),2),'%') AS percentageofGRquantity,
        concat(round(( SUM(CAST(REPLACE(gr_amount, ',', '') AS DECIMAL(10, 2)))/SUM(CAST(REPLACE(net_value, ',', '') AS DECIMAL(10, 2))) * 100 ),2),'%') AS percentageofGamount
        FROM

        po_sap_masters

        where `id` IN (".$SapId.")")[0];


        $collections = PoSapMaster::whereIn('id',$SapIdTmp)->get();
        $vendorCollections=$collections->pluck('vendor_code','vendor_name_en' );
        // $tradeCollections=$collections->groupBy('nupco_trade_code' )->toArray();
        // dd($tradeCollections);


// dd($statisticTable);

        return view('po.sapLineIStatistic',compact(
            'collectionString',
            'statisticTable',
            'vendorCollections',
            // 'tradeCollections',

        ));
    }


    public function MawTableLineItem($slug)
    {
        $po_id=base64_decode($slug);
        return view('po.mawLineItems',compact('po_id'));
    }



}



