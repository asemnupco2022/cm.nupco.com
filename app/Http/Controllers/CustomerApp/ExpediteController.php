<?php

namespace App\Http\Controllers\CustomerApp;

use App\Http\Controllers\Controller;
use App\Models\CustomerReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpediteController extends Controller
{
   public function store_expediet(Request $request)
   {
        $v = Validator::make($request->all(), [
            'customer_name_en' => 'required',
            'region' => 'required',
            'po_number' => 'required',
            'item_details' => 'required',
        ]);

        if ($v->fails())
        {
            return response()->json(['success'=>false,'message'=>$v->errors()->first()]);
        }

      $inserData =  [
            'customer_code'=>$request->customer_code,
            'customer_name_en'=>$request->customer_name_en,
            'customer_name_ar'=>$request->customer_name_ar,
            'region'=>$request->region,
            'tendor_no'=>$request->tendor_no,
            'tendor_description'=>$request->tendor_description,
            'po_number'=>$request->po_number,
            'item_details'=>$request->item_details,
            'json_data'=>$request->json_data,
            'status'=>$request->status,
            'suspendReason'=>$request->suspendReason,
        ];

        try {

            $insert = CustomerReport::created($inserData);
            return response()->json(['status'=>1,'message'=>'data saved successfully!']);
        } catch (\Throwable $th) {
            return response()->json(['status'=>0,'message'=>'there is something wrong: '.$th->getMessage()]);
        }




   }
}
