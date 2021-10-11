<?php

namespace App\Console\Commands;

use App\Models\PoSapMaster;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Importer;

class ImportSap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lba:import-sap';

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

        $filesName=   Storage::disk('nupco_remote')->allFiles()[0];
        if (App::environment('local')){
            Storage::disk('public_uploads')->put('uploads/sap_nupco_backup.csv', Storage::disk('nupco_remote')->get($filesName));
        }else{
            Storage::disk('public_uploads')->put('uploads/sap_nupco_backup.csv', Storage::disk('nupco_remote')->get($filesName));
        }



        $excel = Importer::make('Csv');
        $excel->load(Storage::disk('public_uploads')->get('uploads/sap_nupco_backup.csv'));
        $collection = $excel->getCollection();


        if ($collection and !empty($collection)) {

            $collection = $collection->groupBy(9);
            if ($collection and !empty($collection)) {

                foreach ($collection as $groupKey => $collectionGroup) {

//                    if ($groupKey == 0) continue;

                    if (PoSapMaster::where('purchasing_document', Str::replace(' ', '', $groupKey))->exists()) {
                        PoSapMaster::where('purchasing_document', Str::replace(' ', '', $groupKey))->delete();
                    }
                    foreach ($collectionGroup as $key => $collectionInd) {

                        $fillable = new PoSapMaster();
                        $fillable->po_type = $collectionInd[2];
                        $fillable->po_type_description = $collectionInd[19];
                        $fillable->pur_group = $collectionInd[7];
                        $fillable->customer_name = $collectionInd[74];
                        $fillable->tender_no = $collectionInd[17];
                        $fillable->vendor_code = $collectionInd[5];
                        $fillable->vendor_name = $collectionInd[89];
                        $fillable->contact_no = $collectionInd[72];
                        $fillable->contract_item_no = $collectionInd[73];
                        $fillable->purchasing_document = $collectionInd[1];
                        $fillable->po_item = $collectionInd[20];
                        $fillable->generic_mat_code = $collectionInd[80];
                        $fillable->nupco_trade_code = $collectionInd[73];
                        $fillable->cust_gen_code = $collectionInd[75];
                        $fillable->mat_description = $collectionInd[57];
                        $fillable->uom = $collectionInd[25];
                        $fillable->ordered_quantity = $collectionInd[61];
                        $fillable->gr_qty = $collectionInd[48];
                        $fillable->supply_ration = $collectionInd[31];
                        $fillable->open_quantity = $collectionInd[62];
                        $fillable->net_price_per_unit_1 = $collectionInd[28];
                        $fillable->net_order_value = $collectionInd[30];
                        $fillable->gr_amount = $collectionInd[49];
                        $fillable->currency = $collectionInd[8];
                        $fillable->delivery_address = $collectionInd[65];
                        $fillable->nupco_delivery_date = $collectionInd[42];
                        $fillable->delivery_no = $collectionInd[66];
                        $fillable->item_status = $collectionInd[64];
                        $fillable->plant = $collectionInd[23];
                        $fillable->storage_location = $collectionInd[24];
                        $fillable->old_new_po_number = $collectionInd[81];
                        $fillable->old_po_item = $collectionInd[82];
                        $fillable->old_p_o1 = $collectionInd[83];
                        $fillable->old_po_item1 = $collectionInd[84];
                        $fillable->on_behalf_of_po = $collectionInd[87];
                        $fillable->on_behalf_of_po_item = $collectionInd[88];
                        $fillable->the_testimonial = $collectionInd[88];
                        $fillable->trade_date = Carbon::now();
                        $fillable->save();
                    }
                }
            }
        }


        return 0;
    }
}
