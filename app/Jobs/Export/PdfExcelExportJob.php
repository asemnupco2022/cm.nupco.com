<?php

namespace App\Jobs\Export;

use App\Helpers\PoHelper;
use App\Models\PoSapMaster;
use App\Models\UserExportFiles;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use PDF;

class PdfExcelExportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $ColKeys, $collection, $type ;
    protected $admin_id, $model, $taable_type ;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($ColKeys,$collection, $type,$admin_id,$model, $taable_type)
    {
        $this->ColKeys= $ColKeys;
        $this->collection= $collection;
        $this->type= $type;


        $this->admin_id= $admin_id;
        $this->model= $model;
        $this->taable_type= $taable_type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $dateTime=Carbon::now(config('app.timezone'))->format('d-m-Y h.m.s');
        $this->collection =DB::select($this->collection);

        if ($this->type =='PDF'){
            $fileName='SAP-'.$dateTime.'.pdf';
            $this->export_pdf($this->ColKeys,$this->collection,$fileName);

        }
        if ($this->type =='EXCEL'){
            $ColKeys= PoHelper::NormalizeColString(null, $this->ColKeys);
            $newArray = array_merge([$ColKeys], $this->collection);
            $collection = collect($newArray);
            $fileName='SAP-'.$dateTime.'.xlsx';
            PoHelper::excel_export($collection, $fileName);
        }

        $this->saveRecord($fileName, 'export/'.$fileName);
    }

    protected function export_pdf($cols, $collections, $filename)
    {
        $title = explode('-', $filename)[0];
        $path = storage_path('app/export');
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }
        return PDF::loadView('pdf.table-print-job-pdf', compact('cols', 'collections', 'title'))->save($path . '/' . $filename);
    }


    protected  function saveRecord($fileName, $filePath)
    {
        $fillable =[
            'admin_id'=> $this->admin_id,
            'model'=>$this->model,
            'taable_type'=>$this->taable_type,
            'file_name'=>$fileName,
            'file_path'=>$filePath,
            'status'=>'unread',
        ];

        UserExportFiles::create($fillable);
    }
}
