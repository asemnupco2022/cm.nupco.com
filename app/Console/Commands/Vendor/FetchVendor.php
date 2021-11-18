<?php

namespace App\Console\Commands\Vendor;

use App\Helpers\PoHelper;
use App\Models\PoMowaredMaster;
use App\Models\PoSapMaster;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use rifrocket\LaravelCms\Models\LbsAdmin;
use rifrocket\LaravelCms\Models\LbsMember;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
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
        // $mowaredVendors=  PoMowaredMaster::pluck('vendor_code')->all();

        //$commonValue = array_reduce($sapVendors,$currentVendors);
        //
        $fullDiff = array_unique(array_diff($sapVendors, $currentVendors));
        if(empty( $fullDiff)){
            return 0;
        }
        $url=env('HOS_API_BASE').'/HOS_S4/api/get-vendor-master';
        $parts = (array_chunk($fullDiff, 70));

        foreach ($parts as $key => $value) {
         $sendData=['vendor_nos'=>$value];
          $response = Http::get($url,$sendData);
          PoHelper::hosLogs( $response, 'fetch vendor info for list: '.json_encode($value), 'SEND', 'FETCH_VENDOR_INFO');
          foreach (json_decode($response, true)['data'] as $globalKey => $row) {

            try {

                if (LbsMember::where('vendor_code',$row["vendor_no"] )->first()){
                    $insert= LbsMember::where('vendor_code',$row["vendor_no"] )->first();

                }else{
                    $insert=new LbsMember();

                }
                if(empty($row["email"])){
                    PoHelper::hosLogs( $response, 'failed to store vendor info for vendor code: '.$row["vendor_no"], 'IN-BOUND', 'FETCH_VENDOR_INFO');
                    continue;
                }

                $insert->vendor_code=ltrim($row["vendor_no"], "0");
                $insert->first_name=$row["en_name"];
                $insert->last_name=$row["ar_name"];
                $insert->username=$row["en_name"];
                $insert->display_name=$row["en_name"];
                $insert->email=$row["email"];
                $insert->password=Hash::make($row["email"]);
                $insert->save();

                var_dump('store id: '.$insert->id);
            }catch (\Exception $exception){

            return Log::info('vendor import failed ',[$exception->getMessage()]);
            }
        }
       }

    }
}
