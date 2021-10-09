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



        $excel = Importer::make('Excel');
        $excel->load(Storage::disk('public_uploads')->get('uploads/sap_nupco_backup.csv'));
        $collection = $excel->getCollection();


        if ($collection and !empty($collection)) {

            $collection = $collection->groupBy(9);
            if ($collection and !empty($collection)) {

                foreach ($collection as $groupKey => $collectionGroup) {

                    if ($groupKey == 0) continue;

                    if (PoSapMaster::where('purchasing_document', Str::replace(' ', '', $groupKey))->exists()) {
                        PoSapMaster::where('purchasing_document', Str::replace(' ', '', $groupKey))->delete();
                    }
                    foreach ($collectionGroup as $key => $collectionInd) {

                        $fillable = new PoSapMaster();
                        $fillable->po_type = $collectionInd[0];
                        $fillable->po_type_description = $collectionInd[1];
                        $fillable->pur_group = $collectionInd[2];
                        $fillable->customer_name = $collectionInd[3];
                        $fillable->tender_no = $collectionInd[4];
                        $fillable->vendor_code = $collectionInd[5];
                        $fillable->vendor_name = $collectionInd[6];
                        $fillable->contact_no = $collectionInd[7];
                        $fillable->contract_item_no = $collectionInd[8];
                        $fillable->purchasing_document = $collectionInd[9];
                        $fillable->po_item = $collectionInd[10];
                        $fillable->generic_mat_code = $collectionInd[11];
                        $fillable->nupco_trade_code = $collectionInd[12];
                        $fillable->cust_gen_code = $collectionInd[13];
                        $fillable->mat_description = $collectionInd[14];
                        $fillable->uom = $collectionInd[15];
                        $fillable->ordered_quantity = $collectionInd[16];
                        $fillable->gr_qty = $collectionInd[17];
                        $fillable->supply_ration = $collectionInd[18];
                        $fillable->open_quantity = $collectionInd[19];
                        $fillable->net_price_per_unit_1 = $collectionInd[20];
                        $fillable->net_order_value = $collectionInd[21];
                        $fillable->gr_amount = $collectionInd[22];
                        $fillable->currency = $collectionInd[23];
                        $fillable->delivery_address = $collectionInd[24];
                        $fillable->nupco_delivery_date = $collectionInd[25];
                        $fillable->delivery_no = $collectionInd[26];
                        $fillable->item_status = $collectionInd[27];
                        $fillable->plant = $collectionInd[28];
                        $fillable->storage_location = $collectionInd[29];
                        $fillable->old_new_po_number = $collectionInd[30];
                        $fillable->old_po_item = $collectionInd[31];
                        $fillable->old_p_o1 = $collectionInd[32];
                        $fillable->old_po_item1 = $collectionInd[33];
                        $fillable->on_behalf_of_po = $collectionInd[34];
                        $fillable->on_behalf_of_po_item = $collectionInd[35];
                        $fillable->the_testimonial = $collectionInd[36];
                        $fillable->trade_date = Carbon::now();
                        $fillable->save();
                    }
                }
            }
        }


        return 0;
    }
}
