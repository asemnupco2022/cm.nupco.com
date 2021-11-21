<?php

namespace App\Console\Commands\Import;

use App\Helpers\PoHelper;
use App\Models\PoSapMaster;
use App\Models\PoSapMasterTmp;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SapSyncTmp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lbs:Sap-master-sync-tmp';

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
        $this->SapMasterSyncTmp();
        return Command::SUCCESS;
    }


    protected function SapMasterSyncTmp()
    {
       $poSapTmp = PoSapMasterTmp::all();

       $counter=0;
       foreach ($poSapTmp as $key => $value) {
        $counter++;
            try {
                PoSapMaster::where('unique_line', $value->unique_line)->first()->update([
                    "notified"=>$value->notified,
                    "asn"=>$value->asn,
                    "asn_json"=>$value->asn_json,
                    "expediting_request"=>$value->expediting_request,
                    "expediting_json"=>$value->expediting_json,
                    "supplier_comment"=>$value->supplier_comment,
                    "unique_hash"=>$value->unique_hash,
                    "execution_done"=>$value->execution_done,
                    "meta"=>$value->meta,
                    "json_data"=>$value->json_data,
                ]);

            } catch (\Throwable $th) {
                PoHelper::createLogChennel('sync-sap-mastertmp-to-samp-master.log');
                Log::channel('custom_chennel')->info('SAP-LINE-SYNC-WITH-TMP',[$value]);
            }
        }
        PoHelper::createLogChennel('sync-sap-mastertmp-to-samp-master.log');
        Log::channel('custom_chennel')->info('SAP-LINE-SYNC-WITH-TMP-FROM-'.$poSapTmp->count().'-TO-'.$counter);
    }
}
