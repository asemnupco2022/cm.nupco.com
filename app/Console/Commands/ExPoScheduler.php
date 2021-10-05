<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;

class ExPoScheduler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lbs:po-scheduler-ex';

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
        dispatch(new \App\Jobs\Po\FilterSap());    //SAP jobs
//        dispatch(new \App\Jobs\Po\SendNotification());    //MAWAR jobs
        return 0;
    }
}
