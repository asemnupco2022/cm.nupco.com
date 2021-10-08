<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HosController extends Controller
{
    public function index(Request $request)
    {
        $v = Validator::make($request->all(), [
            'unique_hash' => 'required',
            'supplier_comment' => 'required',
        ]);

        if ($v->fails())
        {
            return response()->json(['success'=>false,'msg'=>$v->errors()->first()]);
        }

        return response()->json(['success'=>true,'msg'=>'data saved successfully']);
    }
}
