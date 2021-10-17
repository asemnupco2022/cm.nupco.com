<?php

namespace App\Console\Commands;

use App\Models\PoSapMaster;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
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
        $baseFilePath=public_path('uploads/sap_nupco_backup.csv');
        if(File::exists($baseFilePath)) {
            File::delete($baseFilePath);
        }

        if (App::environment('local')){
            $filesName=   Storage::disk('nupco_remote_dev')->allFiles()[0];
            Storage::disk('public_uploads')->put('uploads/sap_nupco_backup.csv', Storage::disk('nupco_remote_dev')->get($filesName));

        }else{
            $filesName=   Storage::disk('nupco_remote')->allFiles()[0];
            Storage::disk('public_uploads')->put('uploads/sap_nupco_backup.csv', Storage::disk('nupco_remote')->get($filesName));
        }


        $excel = Importer::make('Csv');
        $excel->load($baseFilePath);
        $collection = $excel->getCollection()->toArray();

        $newCollection=[];
        foreach(  $collection as $key => $collect){
            $implded=implode("|",$collect);
            $newCollection[$key]  =explode('|',$implded);
        }
        $collection = collect($newCollection);

        if ($collection and !empty($collection)) {
            $collection = $collection->groupBy(0);
            if ($collection and !empty($collection)) {

                foreach ($collection as $groupKey => $collectionGroup) {

                    if (PoSapMaster::where('purchasing_document', Str::replace(' ', '', $groupKey))->exists()) {
                        PoSapMaster::where('purchasing_document', Str::replace(' ', '', $groupKey))->delete();
                    }
                    foreach ($collectionGroup as $key => $collectionInd) {

                        $fillable = new PoSapMaster();
                        $fillable->po_type = $collectionInd[1];
                        $fillable->po_type_description = $collectionInd[18];
                        $fillable->pur_group = $collectionInd[6];
                        $fillable->customer_name = $collectionInd[73];
                        $fillable->tender_no = $collectionInd[16];
                        $fillable->vendor_code = $collectionInd[4];
                        $fillable->vendor_name = $collectionInd[88];
                        $fillable->contact_no = $collectionInd[71];
                        $fillable->contract_item_no = $collectionInd[72];
                        $fillable->purchasing_document = $collectionInd[0];
                        $fillable->po_item = $collectionInd[19];
                        $fillable->generic_mat_code = $collectionInd[79];
                        $fillable->nupco_trade_code = $collectionInd[72];
                        $fillable->cust_gen_code = $collectionInd[74];
                        $fillable->mat_description = $collectionInd[56];
                        $fillable->uom = $collectionInd[24];
                        $fillable->ordered_quantity = $collectionInd[60];
                        $fillable->gr_qty = $collectionInd[47];
                        $fillable->supply_ration = $collectionInd[30];
                        $fillable->open_quantity = $collectionInd[61];
                        $fillable->net_price_per_unit_1 = $collectionInd[27];
                        $fillable->net_order_value = $collectionInd[29];
                        $fillable->gr_amount = $collectionInd[48];
                        $fillable->currency = $collectionInd[7];
                        $fillable->delivery_address = $collectionInd[64];
                        $fillable->nupco_delivery_date = $collectionInd[41];
                        $fillable->delivery_no = $collectionInd[65];
                        $fillable->item_status = $collectionInd[63];
                        $fillable->plant = $collectionInd[22];
                        $fillable->storage_location = $collectionInd[23];
                        $fillable->old_new_po_number = $collectionInd[80];
                        $fillable->old_po_item = $collectionInd[81];
                        $fillable->old_p_o1 = $collectionInd[82];
                        $fillable->old_po_item1 = $collectionInd[83];
                        $fillable->on_behalf_of_po = $collectionInd[86];
                        $fillable->on_behalf_of_po_item = $collectionInd[88];
                        $fillable->the_testimonial = $collectionInd[88];
                        $fillable->customer_number = $collectionInd[73];
                        $fillable->trade_date = Carbon::now();
                        $fillable->save();
                    }
                }
            }
        }


        return 0;
    }
}
