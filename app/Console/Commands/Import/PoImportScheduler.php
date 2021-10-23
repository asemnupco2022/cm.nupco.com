<?php

namespace App\Console\Commands\Import;

use App\Jobs\Import\MowaredImportJob;
use App\Jobs\Import\SapImportJob;
use App\Models\LbsUserSearchSet;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class PoImportScheduler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lbs:po-import-scheduler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $getRecords=\App\Models\PoImportScheduler::OnlyActive()->get();
        foreach ($getRecords as $getRecord){
            if(LbsUserSearchSet::TEMPLATE_SAP_LINE_ITEM == $getRecord->table_type){
                dispatch(new SapImportJob($getRecord->path,$getRecord->id));    //SAP import jobs
            }
            if (LbsUserSearchSet::TEMPLATE_MOWARED_LINE_ITEM == $getRecord->table_type){
                dispatch(new MowaredImportJob($getRecord->path));    //SAP import jobs
            }
        }
        return 0;
    }
}
