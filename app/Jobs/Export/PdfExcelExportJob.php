<?php

namespace App\Jobs\Export;

use App\Helpers\PoHelper;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class PdfExcelExportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $ColKeys, $collection, $type ;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($ColKeys,$collection, $type)
    {
        $this->ColKeys= $ColKeys;
        $this->collection= $collection->get();
        $this->type= $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $dateTime=Carbon::now(config('app.timezone'))->format('D-M-Y h.m.s');

        if ($this->type =='PDF'){
            $fileName='SAP-'.$dateTime.'.pdf';
            PoHelper::export_pdf($this->ColKeys,$this->collection,$fileName);
            return Storage::disk('local')->download('export/'.$fileName);
        }
        if ($this->type =='EXCEL'){
            $ColKeys= PoHelper::NormalizeColString(null, $this->ColKeys);
            $collection=collect(array_merge([$ColKeys],$this->collection->toArray()));
            $fileName='SAP-'.$dateTime.'.xlsx';
            PoHelper::excel_export($collection, $fileName);
            return Storage::disk('local')->download('export/'.$fileName);
        }
    }
}
