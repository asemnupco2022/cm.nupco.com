<?php


namespace App\Helpers;


use PDF;
use Exporter;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class PoHelper
{

    public static  function NormalizeColString($string=null, array $keyCollection =null)
    {
        if ($keyCollection){
            foreach ($keyCollection as $key=> $collection){
                $collection=  Str::replace('_', ' ', $collection);
                $collection=  Str::replace('-', ' ', $collection);
                $keyCollection[$key]= ucwords(trans($collection));
            }
           return $keyCollection;
        }
        $string=  Str::replace('_', ' ', $string);
        $string=  Str::replace('-', ' ', $string);
        $string=  Str::replace('[', ' ', $string);
        $string=  Str::replace(']', ' ', $string);
        $string=  Str::replace('"', ' ', $string);
        return ucwords(trans($string));
    }

    public static function excel_export($collection,$filename)
    {

        $path=storage_path('app/export');
        if(!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        $excel = Exporter::make('Excel');
        $excel->load($collection);
        $excel->setChunk(1000);
        return $excel->save($path.'/'.$filename);
    }

    public static function export_pdf($cols,$collections,$filename)
    {
        $title=explode('-',$filename)[0];
        $path=storage_path('app/export');
        if(!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }
      return  PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])->loadView('pdf.table-print', compact('cols','collections','title'))->setPaper('a4', 'landscape')->setWarnings(false)->save($path.'/'.$filename);
    }



}
