<?php

namespace App\Http\Livewire\Po;

use App\Models\PoMowared;
use App\Models\PoMowaredMaster;
use App\Models\PoSap;
use App\Models\PoSapMaster;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

use Importer;

class PoImportComponent extends Component
{

    use WithFileUploads;


    public $po_file;
    public $po_file_table;
    public $selectedPO=0;



    public function uploadfile()
    {
//        $this->validate([
//            'po_file' => 'require|file',
//        ]);

        $filename=time().'.'.$this->po_file->extension();
        $filepath = $this->po_file->storeAs('uploads',$filename,'public_uploads');

        $excel = Importer::make('Excel');
        $excel->load($filepath);


        $collection = $excel->getCollection();


        if($this->selectedPO =='sap'){

            $collection = $collection->groupBy(9);

            if ($collection and !empty($collection)){

                foreach ($collection as $groupKey => $collectionGroup) {

                    if ($groupKey==0) continue;

                    if (PoSapMaster::where('purchasing_document',Str::replace(' ','',$groupKey))->exists()){

                        PoSapMaster::where('purchasing_document',Str::replace(' ','',$groupKey))->delete();
                    }
                    foreach ($collectionGroup as  $key => $collectionInd ){

                        $fillable = new PoSapMaster();
                        $fillable->po_type=$collectionInd[0];
                        $fillable->po_type_description=$collectionInd[1];
                        $fillable->pur_group=$collectionInd[2];
                        $fillable->customer_name=$collectionInd[3];
                        $fillable->tender_no=$collectionInd[4];
                        $fillable->vendor_code=$collectionInd[5];
                        $fillable->vendor_name=$collectionInd[6];
                        $fillable->contact_no=$collectionInd[7];
                        $fillable->contract_item_no=$collectionInd[8];
                        $fillable->purchasing_document=$collectionInd[9];
                        $fillable->po_item=$collectionInd[10];
                        $fillable->generic_mat_code=$collectionInd[11];
                        $fillable->nupco_trade_code=$collectionInd[12];
                        $fillable->cust_gen_code=$collectionInd[13];
                        $fillable->mat_description=$collectionInd[14];
                        $fillable->uom=$collectionInd[15];
                        $fillable->ordered_quantity=$collectionInd[16];
                        $fillable->gr_qty=$collectionInd[17];
                        $fillable->supply_ration=$collectionInd[18];
                        $fillable->open_quantity=$collectionInd[19];
                        $fillable->net_price_per_unit_1=$collectionInd[20];
                        $fillable->net_order_value=$collectionInd[21];
                        $fillable->gr_amount=$collectionInd[22];
                        $fillable->currency=$collectionInd[23];
                        $fillable->delivery_address=$collectionInd[24];
                        $fillable->nupco_delivery_date=$collectionInd[25];
                        $fillable->delivery_no=$collectionInd[26];
                        $fillable->item_status=$collectionInd[27];
                        $fillable->plant=$collectionInd[28];
                        $fillable->storage_location=$collectionInd[29];
                        $fillable->old_new_po_number=$collectionInd[30];
                        $fillable->old_po_item=$collectionInd[31];
                        $fillable->old_p_o1=$collectionInd[32];
                        $fillable->old_po_item1=$collectionInd[33];
                        $fillable->on_behalf_of_po=$collectionInd[34];
                        $fillable->on_behalf_of_po_item=$collectionInd[35];
                        $fillable->the_testimonial=$collectionInd[36];
                        $fillable->trade_date =Carbon::now();
                        $fillable->save();
                    }


                }

                return redirect()->back()->with('success', 'data uploaded successfully');
            }

        }elseif ($this->selectedPO =='mowared'){

            if ($collection and !empty($collection)){

                foreach ($collection as $key=> $collectionInd) {

                    if ($key==0) continue;

                    $fillable = new PoMowaredMaster();
                    $fillable->item_code = $collectionInd[0];
                    $fillable->desc = $collectionInd[1];
                    $fillable->region_qtye = $collectionInd[2];
                    $fillable->recived = $collectionInd[3];
                    $fillable->initial_recived = $collectionInd[4];
                    $fillable->unit_price = $collectionInd[5];
                    $fillable->pending_qty = $collectionInd[6];
                    $fillable->total_recived_qty = $collectionInd[7];
                    $fillable->initial_reciving_value = $collectionInd[8];
                    $fillable->item_total_value = $collectionInd[9];
                    $fillable->final_reciving_value = $collectionInd[10];
                    $fillable->value_of_delivered = $collectionInd[11];
                    $fillable->available_qty_for_main_store = $collectionInd[12];
                    $fillable->available_qty_for_all_locations = $collectionInd[13];
                    $fillable->monthly_consumption = $collectionInd[14];
                    $fillable->tender_no = $collectionInd[15];
                    $fillable->contract_no = $collectionInd[16];
                    $fillable->tender_name = $collectionInd[17];
                    $fillable->vendor_number = $collectionInd[18];
                    $fillable->vendor_name = $collectionInd[19];
                    $fillable->country_of_origion = $collectionInd[20];
                    $fillable->manfacturing_co = $collectionInd[21];
                    $fillable->contract_start_date = $collectionInd[22];
                    $fillable->contract_start_hijri = $collectionInd[23];
                    $fillable->contract_end_date = $collectionInd[24];
                    $fillable->contract_end_date_hijri = $collectionInd[25];
                    $fillable->region_code = $collectionInd[26];
                    $fillable->store = $collectionInd[27];
                    $fillable->shipments = $collectionInd[28];
                    $fillable->trade_date =Carbon::now();
                    $fillable->save();
                }

              return redirect()->back()->with('success', 'data uploaded successfully');
            }

            return redirect()->back()->with('error', 'something went wrong');

        }

    }

    public function render()
    {

        return view('livewire.po.po-import-component');
    }
}
