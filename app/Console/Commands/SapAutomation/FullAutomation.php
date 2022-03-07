<?php

namespace App\Console\Commands\SapAutomation;

use App\Jobs\SapAutomation\FullAutomationJob;
use App\Models\LbsUserSearchSet;
use App\Models\NupAutoSetting;
use App\Models\PoSapMaster;
use Carbon\Carbon;
use Illuminate\Console\Command;
use rifrocket\LaravelCms\Models\LbsMember;

class FullAutomation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lbs:full-sap-automation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is full automated system to send notifications for sap reports';

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

        $autoSetting = NupAutoSetting::where('setting_for_table', LbsUserSearchSet::TEMPLATE_SAP_LINE_ITEM)->first();

        $day_1 = 20;
        $day_2 = 15;
        $day_3 = 5;

        if($autoSetting){

            $expDate_20 = Carbon::now()->subDays($autoSetting->first_notification)->format('Y-m-d');
            $expDate_15 = Carbon::now()->subDays($autoSetting->second_notification)->format('Y-m-d');
            $expDate_05 = Carbon::now()->subDays($autoSetting->thired_notification)->format('Y-m-d');
            $expDate_00 = Carbon::now()->subDays($autoSetting->fourth_notification)->format('Y-m-d');
            $expSup_ratio = $autoSetting->supply_ratio;

        }else{

            $expDate_20 = Carbon::now()->subDays(20)->format('Y-m-d');
            $expDate_15 = Carbon::now()->subDays(15)->format('Y-m-d');
            $expDate_05 = Carbon::now()->subDays(5)->format('Y-m-d');
            $expDate_00 = Carbon::now()->subDays(0)->format('Y-m-d');
            $expSup_ratio = 90;
        }


        // $prepares_20=PoSapMaster::whereDate('nupco_delivery_date',$expDate_20)->where('execution_done', 'init')->where('supply_ratio','<',$expSup_ratio)->get()->toArray();
        // $prepares_15=PoSapMaster::whereDate('nupco_delivery_date',$expDate_15)->where('execution_done', $day_1)->where('supply_ratio','<',$expSup_ratio)->get()->toArray();
        // $prepares_05=PoSapMaster::whereDate('nupco_delivery_date',$expDate_05)->where('execution_done', $day_2)->where('supply_ratio','<',$expSup_ratio)->get()->toArray();
        // $prepares_00=PoSapMaster::whereDate('nupco_delivery_date',$expDate_00)->where('execution_done', $day_3)->where('supply_ratio','<',$expSup_ratio)->get()->toArray();

        $prepares_20 = PoSapMaster::whereDate('nupco_delivery_date', $expDate_20)->where('supply_ratio', '<', $expSup_ratio)->get()->toArray();
        $prepares_15 = PoSapMaster::whereDate('nupco_delivery_date', $expDate_15)->where('supply_ratio', '<', $expSup_ratio)->get()->toArray();
        $prepares_05 = PoSapMaster::whereDate('nupco_delivery_date', $expDate_05)->where('supply_ratio', '<', $expSup_ratio)->get()->toArray();
        $prepares_00 = PoSapMaster::whereDate('nupco_delivery_date', $expDate_00)->where('supply_ratio', '<', $expSup_ratio)->get()->toArray();

        if ($prepares_20 and !empty($prepares_20)){

            // PoSapMaster::whereDate('nupco_delivery_date',$expDate_20)->where('execution_done', 'init')->update(['execution_done'=>"$day_1"]);
            $vendorByCollection = collect($prepares_20)->groupBy(['vendor_code', 'purchasing_group']);

            foreach ($vendorByCollection as $vendorCode => $collection) {

                if (count($collection) <= 0) {
                    continue;
                }
                foreach ($collection as $ColVal) {
                    $ids = [];
                    foreach ($ColVal as $value) {
                        $ids[] = $value['id'];
                    }
                    $vendor_name_en = $ColVal[0]['vendor_name_en'];
                    $vendor_name_er = $ColVal[0]['vendor_name_er'];
                    $customer_name = $ColVal[0]['customer_name'];
                    $sendData = [
                        'purchasing_code' => null,
                        'vendor_code' => $vendorCode,
                        'vendor_name_en' => $vendor_name_en,
                        'vendor_name_er' => $vendor_name_er,
                        'customer_name' => $customer_name,
                        'po_items' => 0,
                        'sap_object' => PoSapMaster::whereIn('id', $ids)->get()
                    ];
                    $tableType = LbsUserSearchSet::TEMPLATE_SAP_LINE_ITEM;
                    $to = str_replace(' ', '', LbsMember::where('vendor_code', $vendorCode)->first()->email);

                    dispatch(new FullAutomationJob('enquiry-email', $sendData, $tableType, $to));
                }
            }
        }

        if ($prepares_15 and !empty($prepares_15)){

            // PoSapMaster::whereDate('nupco_delivery_date', $expDate_15)->where('execution_done', $day_1)->update(['execution_done'=>"$day_2"]);
            $vendorByCollection = collect($prepares_15)->groupBy(['vendor_code', 'purchasing_group']);

            foreach ($vendorByCollection as $vendorCode => $collection) {

                if (count($collection) <= 0) {
                    continue;
                }
                foreach ($collection as $ColVal) {
                    $ids = [];
                    foreach ($ColVal as $value) {
                        $ids[] = $value['id'];
                    }
                    $vendor_name_en = $ColVal[0]['vendor_name_en'];
                    $vendor_name_er = $ColVal[0]['vendor_name_er'];
                    $customer_name = $ColVal[0]['customer_name'];
                    $sendData = [
                        'purchasing_code' => null,
                        'vendor_code' => $vendorCode,
                        'vendor_name_en' => $vendor_name_en,
                        'vendor_name_er' => $vendor_name_er,
                        'customer_name' => $customer_name,
                        'po_items' => 0,
                        'sap_object' => PoSapMaster::whereIn('id', $ids)->get()
                    ];
                    $tableType = LbsUserSearchSet::TEMPLATE_SAP_LINE_ITEM;
                    $to = trim(LbsMember::where('vendor_code', $vendorCode)->first()->email);

                    dispatch(new FullAutomationJob('enquiry-email', $sendData, $tableType, $to));
                }
            }
        }

        if ($prepares_05 and !empty($prepares_05)){

            // PoSapMaster::whereDate('nupco_delivery_date', $expDate_00)->where('execution_done', $day_2)->update(['execution_done'=>"$day_3"]);
            $vendorByCollection = collect($prepares_05)->groupBy(['vendor_code', 'purchasing_group']);

            foreach ($vendorByCollection as $vendorCode => $collection) {

                if (count($collection) <= 0) {
                    continue;
                }
                foreach ($collection as $ColVal) {
                    $ids = [];
                    foreach ($ColVal as $value) {
                        $ids[] = $value['id'];
                    }
                    $vendor_name_en = $ColVal[0]['vendor_name_en'];
                    $vendor_name_er = $ColVal[0]['vendor_name_er'];
                    $customer_name = $ColVal[0]['customer_name'];
                    $sendData = [
                        'purchasing_code' => null,
                        'vendor_code' => $vendorCode,
                        'vendor_name_en' => $vendor_name_en,
                        'vendor_name_er' => $vendor_name_er,
                        'customer_name' => $customer_name,
                        'po_items' => 0,
                        'sap_object' => PoSapMaster::whereIn('id', $ids)->get()
                    ];
                    $tableType = LbsUserSearchSet::TEMPLATE_SAP_LINE_ITEM;
                    $to = trim(LbsMember::where('vendor_code', $vendorCode)->first()->email);

                    dispatch(new FullAutomationJob('enquiry-email', $sendData, $tableType, $to));
                }
            }
        }


        if ($prepares_00 and !empty($prepares_00)){

            // PoSapMaster::whereDate('nupco_delivery_date',$expDate_20)->where('execution_done', $day_3)->update(['execution_done'=>'finish']);
            $vendorByCollection = collect($prepares_05)->groupBy(['vendor_code', 'purchasing_group']);

            foreach ($vendorByCollection as $vendorCode => $collection) {

                if (count($collection) <= 0) {
                    continue;
                }
                foreach ($collection as $ColVal) {
                    $ids = [];
                    foreach ($ColVal as $value) {
                        $ids[] = $value['id'];
                    }
                    $vendor_name_en = $ColVal[0]['vendor_name_en'];
                    $vendor_name_er = $ColVal[0]['vendor_name_er'];
                    $customer_name = $ColVal[0]['customer_name'];
                    $sendData = [
                        'purchasing_code' => null,
                        'vendor_code' => $vendorCode,
                        'vendor_name_en' => $vendor_name_en,
                        'vendor_name_er' => $vendor_name_er,
                        'customer_name' => $customer_name,
                        'po_items' => 0,
                        'sap_object' => PoSapMaster::whereIn('id', $ids)->get()
                    ];
                    $tableType = LbsUserSearchSet::TEMPLATE_SAP_LINE_ITEM;
                    $to = trim(LbsMember::where('vendor_code', $vendorCode)->first()->email);

                    dispatch(new FullAutomationJob('expedite-email', $sendData, $tableType, $to));
                }
            }
        }

        return 0;

    }



}
