<?php

namespace App\Console\Commands;

use App\Jobs\PoSchedulerJob;
use App\Models\ScheduleNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class poScheduler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
        protected $signature = 'lbs:po-scheduler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Schedule Po Table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }



    public function scheduler()
    {

        $scheduleModel = ScheduleNotification::OnlyActive()->where('schedule_status',ScheduleNotification::JOB_STATUS_AWAIT)->get();

        if($scheduleModel and !empty($scheduleModel)){

            foreach ($scheduleModel as $findModel) {
                $execute_at_day=false;

                //Check schedule is Expire
                if (!empty($findModel->expires_at) and Carbon::now()->greaterThan($findModel->expires_at) ){
                    continue;
                }

                //Check schedule is Expire
                if (!empty($findModel->last_executed_at) and Carbon::now()->isSameDay($findModel->last_executed_at)){
                    continue;
                }

                //Check request for day vise scheduling
                if ($findModel->day_recurrence=='on' and !empty($findModel->recurrent_days)){

                    $days=explode(',',$findModel->recurrent_days);
                    foreach ($days as $day)
                    {
                        if (!empty($day) and Carbon::now()->isSameDay($day) !=1){
                            continue;
                        }
                        $execute_at_day=true;
                        break;
                    }
                    if (!$execute_at_day){
                        continue;
                    }
                }

                //Check requested for day vise scheduling
                if (($execute_at_day) and (Carbon::now()->diffInSeconds($findModel->execute_at_time) < 60) and ! (Carbon::now()->diffInSeconds($findModel->execute_at_time) > 60)){

                    //send email data...
                    $findModel->last_executed_at=Carbon::now();
                    $findModel->increment('attempts',1);
                    $findModel->save();
                    dispatch(new PoSchedulerJob($findModel->id));
                }
                else{
                    continue;
                }

            }
        }
    }


    public function jobScheduling($scheduler_id)
    {

    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->scheduler();
        return 0;
    }
}
