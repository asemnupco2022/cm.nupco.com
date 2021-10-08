<?php

namespace App\Jobs\Po;


use App\Models\PoSapMasterSchedle;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

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
        $prepares=PoSapMasterSchedle::orderBy('vendor_code')->groupBy('vendor_code')->get();
        foreach ($prepares as $key=> $prepare){
            if ($prepare->execution_done=='finish'){
                continue;
            }

            $initDate=Carbon::parse($prepare->trade_date);
            $now = Carbon::now();
            $diff = $initDate->diffInDays($now);

//            dispatch(new NotifySap($prepares[$key]->vendor_code,'enquiry-email')); break;


            if ($diff ==20){
                PoSapMasterSchedle::where('vendor_code', $prepares[$key]->vendor_code)->update('execution_done',20);
                dispatch(new NotifySap($prepares[$key]->vendor_code,'enquiry-email'));
            }

            if ($diff ==15){
                PoSapMasterSchedle::where('vendor_code', $prepares[$key]->vendor_code)->update('execution_done',15);
                dispatch(new NotifySap($prepares[$key]->vendor_code,'enquiry-email'));
            }

            if ($diff ==5){
                PoSapMasterSchedle::where('vendor_code', $prepares[$key]->vendor_code)->update('execution_done',5);
                dispatch(new NotifySap($prepares[$key]->vendor_code,'enquiry-email'));
            }

            if ($diff ==0){
                PoSapMasterSchedle::where('vendor_code', $prepares[$key]->vendor_code)->update('execution_done',0);
                dispatch(new NotifySap($prepares[$key]->vendor_code,'warning email'));
            }
        }

    }

}
