<?php

namespace App\Jobs;

use App\Jobs\Po\MigrateSap;
use App\Jobs\Po\SapScheduler;
use App\Models\LbsUserSearchSet;
use App\Models\ScheduleNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PoSchedulerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $scheduler_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($scheduler_id)
    {
        $this->scheduler_id=$scheduler_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $scheduler=ScheduleNotification::find($this->scheduler_id);
        if ($scheduler->table_type==LbsUserSearchSet::TEMPLATE_SAP_LINE_ITEM){
            dispatch(new MigrateSap($this->scheduler_id));
        }

    }
}
