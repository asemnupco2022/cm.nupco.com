<?php

namespace App\Jobs\Po;


use App\Models\PoSapMasterScheduler;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FilterSap implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {


        $expDate_20 = Carbon::now()->subDays(20)->format('Y-m-d');
        $expDate_15 = Carbon::now()->subDays(15)->format('Y-m-d');
        $expDate_05 = Carbon::now()->subDays(5)->format('Y-m-d');
        $expDate_00 = Carbon::now()->format('Y-m-d');

        $prepares_20=PoSapMasterScheduler::whereDate('nupco_delivery_date',$expDate_20)->where('execution_done', 'init')->where('supply_ratio','<',90)->get()->toArray();
        $prepares_15=PoSapMasterScheduler::whereDate('nupco_delivery_date',$expDate_15)->where('execution_done', '20')->where('supply_ratio','<',90)->get()->toArray();
        $prepares_05=PoSapMasterScheduler::whereDate('nupco_delivery_date',$expDate_05)->where('execution_done', '15')->where('supply_ratio','<',90)->get()->toArray();
        $prepares_00=PoSapMasterScheduler::whereDate('nupco_delivery_date',$expDate_00)->where('execution_done', '05')->where('supply_ratio','<',90)->get()->toArray();

        // $prepares_20=PoSapMasterScheduler::where('execution_done', 'init')->get()->toArray();
        // $vendorByCollection=collect($prepares_20)->groupBy('vendor_code');
        // foreach ($vendorByCollection as $vendorCode=> $collection){
        //     $childCollection =collect($collection)->groupBy('scheduler_id');
        //     foreach ($childCollection as $schedulerId=> $CCollection){
        //         dispatch(new NotifySap($vendorCode,2,$CCollection, 'enquiry-email'));
        //     }
        // }

        // die;

        if ($prepares_20 and !empty($prepares_20)){

            PoSapMasterScheduler::whereDate('nupco_delivery_date',$expDate_20)->where('execution_done', 'init')->update(['execution_done'=>'20']);
            $vendorByCollection=collect($prepares_20)->groupBy('vendor_code');
            foreach ($vendorByCollection as $vendorCode=> $collection){
                $childCollection =collect($collection)->groupBy('scheduler_id');
                foreach ($childCollection as $schedulerId=> $CCollection){
                    dispatch(new NotifySap($vendorCode,$schedulerId,$CCollection, 'enquiry-email'));
                }
            }

        }

        if ($prepares_15 and !empty($prepares_15)){

            PoSapMasterScheduler::whereDate('nupco_delivery_date',$expDate_20)->where('execution_done', 'init')->update(['execution_done'=>'15']);
            $vendorByCollection=collect($prepares_20)->groupBy('vendor_code');
            foreach ($vendorByCollection as $vendorCode=> $collection){
                $childCollection =collect($collection)->groupBy('scheduler_id');
                foreach ($childCollection as $schedulerId=> $CCollection){
                    dispatch(new NotifySap($vendorCode,$schedulerId,$CCollection, 'enquiry-email'));
                }
            }

        }

        if ($prepares_05 and !empty($prepares_05)){

            PoSapMasterScheduler::whereDate('nupco_delivery_date',$expDate_20)->where('execution_done', 'init')->update(['execution_done'=>'5']);
            $vendorByCollection=collect($prepares_20)->groupBy('vendor_code');
            foreach ($vendorByCollection as $vendorCode=> $collection){
                $childCollection =collect($collection)->groupBy('scheduler_id');
                foreach ($childCollection as $schedulerId=> $CCollection){
                    dispatch(new NotifySap($vendorCode,$schedulerId,$CCollection, 'enquiry-email'));
                }
            }
        }


        if ($prepares_00 and !empty($prepares_00)){

            PoSapMasterScheduler::whereDate('nupco_delivery_date',$expDate_20)->where('execution_done', 'init')->update(['execution_done'=>'0']);
            $vendorByCollection=collect($prepares_20)->groupBy('vendor_code');
            foreach ($vendorByCollection as $vendorCode=> $collection){
                $childCollection =collect($collection)->groupBy('scheduler_id');
                foreach ($childCollection as $schedulerId=> $CCollection){
                    dispatch(new NotifySap($vendorCode,$schedulerId,$CCollection, 'enquiry-email'));
                }
            }
        }

    }

}
