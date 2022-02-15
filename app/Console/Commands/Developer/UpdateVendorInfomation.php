<?php

namespace App\Console\Commands\Developer;

use App\Helpers\PoHelper;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use rifrocket\LaravelCms\Models\LbsMember;

class UpdateVendorInfomation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev:update-vendor-info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update vendors information from HOS';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function updateVendorInfo()
    {
        $currentVendors = LbsMember::pluck('vendor_code')->all();
        $url = env('HOS_API_BASE') . '/HOS_S4/api/get-vendor-master';
        $parts = (array_chunk($currentVendors, 70));

        foreach ($parts as  $value) {
            $sendData = ['vendor_nos' => $value];
            $response = Http::get($url, $sendData);

            // PoHelper::hosLogs($response, 'fetch vendor info for list: ' . json_encode($value), 'SEND', 'FETCH_VENDOR_INFO');
            foreach (json_decode($response, true)['data'] as $row) {

                try {

                    if (LbsMember::where('vendor_code', $row["vendor_no"])->first()) {
                        $insert = LbsMember::where('vendor_code', $row["vendor_no"])->first();
                    } else {
                        $insert = new LbsMember();
                    }
                    if (empty($row["email"])) {
                        PoHelper::hosLogs($response, 'failed to store vendor info for vendor code: ' . $row["vendor_no"], 'IN-BOUND', 'FETCH_VENDOR_INFO');
                        continue;
                    }


                    $insert->vendor_code = ltrim($row["vendor_no"], "0");
                    $insert->first_name = $row["en_name"];
                    $insert->last_name = $row["ar_name"];
                    $insert->username = $row["en_name"];
                    $insert->display_name = $row["en_name"];
                    $insert->email = $row["email"];
                    $insert->password = Hash::make($row["email"]);
                    $insert->save();
                    var_dump('store id: ' . $insert->id);

                } catch (\Exception $exception) {

                   Log::info('vendor import failed ', [$exception->getMessage()]);
                }
            }
        }
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $this->updateVendorInfo();
        return 0;
    }
}
