<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ExicutePoFilter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lbs:po-scheduler-filter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command will run the filtration job every day';

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
//        dispatch(new \App\Jobs\Po\FilterSap());    //SAP Mowarid
    }
}
