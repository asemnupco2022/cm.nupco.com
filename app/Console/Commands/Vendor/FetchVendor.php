<?php

namespace App\Console\Commands\Vendor;

use App\Models\PoMowaredMaster;
use App\Models\PoSapMaster;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use rifrocket\LaravelCms\Models\LbsAdmin;
use rifrocket\LaravelCms\Models\LbsMember;

class FetchVendor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lbs:fetch-vendors';

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
        $this->fetchVendorCodeArray();
        return 0;
    }

    protected function fetchVendorCodeArray(){
        //fetch current vendor list
       $currentVendors = LbsMember::pluck('vendor_code')->all();

        //fetch SAP vendor list
        $sapVendors= PoSapMaster::pluck('vendor_code')->all();

        //fetch Mowared vendor list
//        $mowaredVendors=  PoMowaredMaster::pluck('vendor_code')->all();

        //$commonValue = array_reduce($sapVendors,$currentVendors);
        //
        $fullDiff = array_merge(array_diff($currentVendors, $sapVendors), array_diff($sapVendors, $currentVendors));

        $sendData=['vendor_nos'=>$fullDiff];
        $url=env('HOS_API_BASE').'/HOS_S4/api/get-vendor-master';
        $response = Http::get($url,[$sendData] );
        dd(Storage::disk('public_uploads')->put('bangla.txt',json_encode()));

    }
}
