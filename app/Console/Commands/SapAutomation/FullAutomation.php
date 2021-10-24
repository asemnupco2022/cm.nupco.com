<?php

namespace App\Console\Commands\SapAutomation;

use App\Jobs\Po\NotifySap;
use App\Models\PoSapMaster;
use Carbon\Carbon;
use Illuminate\Console\Command;

class FullAutomation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

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

        $expDate_20 = Carbon::now()->subDays(20)->format('Y-m-d');
        $expDate_15 = Carbon::now()->subDays(15)->format('Y-m-d');
        $expDate_05 = Carbon::now()->subDays(5)->format('Y-m-d');
        $expDate_00 = Carbon::now()->format('Y-m-d');

        $prepares_20=PoSapMaster::whereDate('nupco_delivery_date',$expDate_20)->where('execution_done', 'init')->where('supply_ratio','<',90)->get()->toArray();
        $prepares_15=PoSapMaster::whereDate('nupco_delivery_date',$expDate_15)->where('execution_done', '20')->where('supply_ratio','<',90)->get()->toArray();
        $prepares_05=PoSapMaster::whereDate('nupco_delivery_date',$expDate_05)->where('execution_done', '15')->where('supply_ratio','<',90)->get()->toArray();
        $prepares_00=PoSapMaster::whereDate('nupco_delivery_date',$expDate_00)->where('execution_done', '5')->where('supply_ratio','<',90)->get()->toArray();


        if ($prepares_20 and !empty($prepares_20)){

            PoSapMaster::whereDate('nupco_delivery_date',$expDate_20)->where('execution_done', 'init')->update(['execution_done'=>'20']);
            $vendorByCollection=collect($prepares_20)->groupBy('vendor_code');
            foreach ($vendorByCollection as $vendorCode=> $collection){
                $childCollection =collect($collection)->groupBy('scheduler_id');
                foreach ($childCollection as $schedulerId=> $CCollection){
                    dispatch(new NotifySap($vendorCode,$schedulerId,$CCollection, 'enquiry-email'));
                }
            }

        }

        if ($prepares_15 and !empty($prepares_15)){

            PoSapMaster::whereDate('nupco_delivery_date',$expDate_20)->where('execution_done', '20')->update(['execution_done'=>'15']);
            $vendorByCollection=collect($prepares_20)->groupBy('vendor_code');
            foreach ($vendorByCollection as $vendorCode=> $collection){
                $childCollection =collect($collection)->groupBy('scheduler_id');
                foreach ($childCollection as $schedulerId=> $CCollection){
                    dispatch(new NotifySap($vendorCode,$schedulerId,$CCollection, 'enquiry-email'));
                }
            }

        }

        if ($prepares_05 and !empty($prepares_05)){

            PoSapMaster::whereDate('nupco_delivery_date',$expDate_20)->where('execution_done', '15')->update(['execution_done'=>'5']);
            $vendorByCollection=collect($prepares_20)->groupBy('vendor_code');
            foreach ($vendorByCollection as $vendorCode=> $collection){
                $childCollection =collect($collection)->groupBy('scheduler_id');
                foreach ($childCollection as $schedulerId=> $CCollection){
                    dispatch(new NotifySap($vendorCode,$schedulerId,$CCollection, 'enquiry-email'));
                }
            }
        }


        if ($prepares_00 and !empty($prepares_00)){

            PoSapMaster::whereDate('nupco_delivery_date',$expDate_20)->where('execution_done', '5')->update(['execution_done'=>'0']);
            $vendorByCollection=collect($prepares_20)->groupBy('vendor_code');
            foreach ($vendorByCollection as $vendorCode=> $collection){
                $childCollection =collect($collection)->groupBy('scheduler_id');
                foreach ($childCollection as $schedulerId=> $CCollection){
                    dispatch(new NotifySap($vendorCode,$schedulerId,$CCollection, 'enquiry-email'));
                }
            }
        }

        return 0;

    }



}
