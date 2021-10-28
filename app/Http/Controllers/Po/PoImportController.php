<?php

namespace App\Http\Controllers\Po;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Importer;
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


    public function MawTableLineItem($slug)
    {
        $po_id=base64_decode($slug);
        return view('po.mawLineItems',compact('po_id'));
    }



}
