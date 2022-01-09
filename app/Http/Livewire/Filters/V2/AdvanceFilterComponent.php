<?php

namespace App\Http\Livewire\Filters\V2;

use App\Models\LbsUserSearchSet;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Livewire\Component;

class AdvanceFilterComponent extends Component
{
    public function emitNotifications($message, $msgType)
    {
        $this->emit('toast-notification-component',$message,$msgType);
    }

    public $isUpdateRequest=null;
    public $templateName=null;
    public $template_for_table=LbsUserSearchSet::TEMPLATE_SAP_LINE_ITEM;
    public $tender_no = [];
    public $tender_desc = [];
    public $document_type = [];
    public $document_type_desc = [];  //string
    public $init_po_number = [];
    public $purchasing_group = [];
    public $purchasing_organization = [];
    public $customer_no = [];
    public $nupco_delivery_date = [];
    public $po_created_on = [];
    public $generic_mat_code = [];
    public $vendor_code = [];
    public $storage_location = [];
    public $plant = [];
    public $customer_name = [];
    public $delivery_address = [];
    public $supply_ratio = [];
    public $mat_description = [];
    public $cust_gen_code = [];
    public $vendor_name_en = [];
    public $supplier_comment = [];
    public $customer_po_no=[];
    public $customer_po_item=[];
    public $pur_grp_name=[];
    public $notified=[];
    public $asn = [];


    protected $listeners =['advance-sap-filter-create-edit'=>'advance_sap_filter_create_edit'];

    public function advance_sap_filter_create_edit($id=null){
        if($id){
            $this->isUpdateRequest=$id;
            $this->fetch_advance_sap_filter_create_edit();
        }
    }

    public function fetch_advance_sap_filter_create_edit()
    {
        $this-> resetInputs();
        $update =  LbsUserSearchSet::find($this->isUpdateRequest);
         $jsonData=json_decode($update->json_data, true);
         $this->templateName=$update->template_name;
         foreach ($jsonData as $key => $toString){
            $this->{$toString['queryCol']}['from']=$toString['queryVal'] ;
        }
        // dd();
    }

    protected function createTemplateJson()
    {
        $holdArray=array();

        if (Arr::has($this->tender_no, ['from'])){
            array_push($holdArray,['queryCol'=>'tender_no' , 'queryOpr'=>'IN' , 'queryVal'=>$this->tender_no['from']]);
        }
        if (Arr::has($this->tender_desc, ['from'])){
            array_push($holdArray,['queryCol'=>'tender_desc' , 'queryOpr'=>'IN' , 'queryVal'=>$this->tender_desc['from']]);
        }
       if (Arr::has($this->document_type, ['from'])){
            array_push($holdArray,['queryCol'=>'document_type' , 'queryOpr'=>'IN' , 'queryVal'=>$this->document_type['from']]);
        }
        if (Arr::has($this->document_type_desc, ['from'])){
            array_push($holdArray,['queryCol'=>'document_type_desc' , 'queryOpr'=>'IN' , 'queryVal'=>$this->document_type_desc['from']]);
        }
        if (Arr::has($this->init_po_number, ['from'])){
             array_push($holdArray,['queryCol'=>'po_number' , 'queryOpr'=>'IN' , 'queryVal'=>$this->init_po_number['from']]);
        }
        if (Arr::has($this->purchasing_group, ['from'])){
             array_push($holdArray,['queryCol'=>'purchasing_group' , 'queryOpr'=>'IN' , 'queryVal'=>$this->purchasing_group['from']]);
        }
        if (Arr::has($this->purchasing_organization, ['from'])){
             array_push($holdArray,['queryCol'=>'purchasing_organization' , 'queryOpr'=>'IN' , 'queryVal'=>$this->purchasing_organization['from']]);
        }
        if (Arr::has($this->customer_no, ['from'])){
             array_push($holdArray,['queryCol'=>'customer_no' , 'queryOpr'=>'IN' , 'queryVal'=>$this->customer_no['from']]);
        }
        if (Arr::has($this->nupco_delivery_date, ['from'])){
             array_push($holdArray,['queryCol'=>'nupco_delivery_date' , 'queryOpr'=>'IN' , 'queryVal'=>$this->nupco_delivery_date['from']]);
        }
        if (Arr::has($this->po_created_on, ['from'])){
             array_push($holdArray,['queryCol'=>'po_created_on' , 'queryOpr'=>'IN' , 'queryVal'=>$this->po_created_on['from']]);
        }
        if (Arr::has($this->generic_mat_code, ['from'])){
             array_push($holdArray,['queryCol'=>'generic_mat_code' , 'queryOpr'=>'IN' , 'queryVal'=>$this->generic_mat_code['from']]);
        }
        if (Arr::has($this->vendor_code, ['from'])){
             array_push($holdArray,['queryCol'=>'vendor_code' , 'queryOpr'=>'IN' , 'queryVal'=>$this->vendor_code['from']]);
        }
        if (Arr::has($this->storage_location, ['from'])){
             array_push($holdArray,['queryCol'=>'storage_location' , 'queryOpr'=>'IN' , 'queryVal'=>$this->storage_location['from']]);
        }
        if (Arr::has($this->plant, ['from'])){
             array_push($holdArray,['queryryCol'=>'plant' , 'queryOpr'=>'IN' , 'queryVal'=>$this->plant['from']]);
        }
        if (Arr::has($this->customer_name, ['from'])){
             array_push($holdArray,['queryCol'=>'customer_name' , 'queryOpr'=>'IN' , 'queryVal'=>$this->customer_name['from']]);
        }
        if (Arr::has($this->supply_ratio, ['from'])){
             array_push($holdArray,['queryCol'=>'supply_ratio' , 'queryOpr'=>'IN' , 'queryVal'=>$this->supply_ratio['from']]);
        }
        if (Arr::has($this->delivery_address, ['from'])){
             array_push($holdArray,['queryCol'=>'delivery_address' , 'queryOpr'=>'IN' , 'queryVal'=>$this->delivery_address['from']]);
        }
        if (Arr::has($this->mat_description, ['from'])){
             array_push($holdArray,['queryCol'=>'mat_description' , 'queryOpr'=>'IN' , 'queryVal'=>$this->mat_description['from']]);
        }
        if (Arr::has($this->cust_gen_code, ['from'])){
             array_push($holdArray,['queryCol'=>'cust_gen_code' , 'queryOpr'=>'IN' , 'queryVal'=>$this->cust_gen_code['from']]);
        }
        if (Arr::has($this->vendor_name_en, ['from'])){
             array_push($holdArray,['queryCol'=>'vendor_name_en' , 'queryOpr'=>'IN' , 'queryVal'=>$this->vendor_name_en['from']]);
        }
        if(Arr::has($this->supplier_comment, ['from']) and $this->supplier_comment['from'] !='0' ){
            array_push($holdArray,['queryCol'=>'supplier_comment' , 'queryOpr'=>'IN' , 'queryVal'=>$this->supplier_comment['from']]);
        }
        if (Arr::has($this->customer_po_no, ['from'])){
            array_push($holdArray,['queryCol'=>'customer_po_no' , 'queryOpr'=>'IN' , 'queryVal'=>$this->customer_po_no['from']]);
        }
        if (Arr::has($this->customer_po_item, ['from'])){
            array_push($holdArray,['queryCol'=>'customer_po_item' , 'queryOpr'=>'IN' , 'queryVal'=>$this->customer_po_item['from']]);
        }
        if (Arr::has($this->pur_grp_name, ['from'])){
            array_push($holdArray,['queryCol'=>'pur_grp_name' , 'queryOpr'=>'IN' , 'queryVal'=>$this->pur_grp_name['from']]);
        }
        if (Arr::has($this->notified, ['from'])){
            array_push($holdArray,['queryCol'=>'notified' , 'queryOpr'=>'IN' , 'queryVal'=>$this->notified['from']]);
        }
        if (Arr::has($this->asn, ['from'])){
            array_push($holdArray,['queryCol'=>'asn' , 'queryOpr'=>'LIKE' , 'queryVal'=>$this->asn['from']]);
        }
        return $holdArray;
    }


    protected $rules = [
        'templateName' => 'required|unique:lbs_user_search_sets,template_name',
    ];

    public function saveTemplateInRepo()
    {

        $json_data=json_encode($this->createTemplateJson());

        if ($json_data =='[]'){
            return $this->emitNotifications('Please select at least one condition','error');
        }



        if(empty($this->isUpdateRequest)){
            $this->validate();
            $insert = new LbsUserSearchSet();
        }

        if($this->isUpdateRequest){
            $insert =  LbsUserSearchSet::find($this->isUpdateRequest);
        }

        $insert->user_id=auth()->user()->id;
        $insert->template_name=$this->templateName;
        $insert->template_for_table=$this->template_for_table;
        $insert->json_data=$json_data;
        if ($insert->save()){
            $this->resetInputs();
            $this->emit('update-users-filter-template');
            return $this->emitNotifications('Filter Saved successfully','success');

        }
        return $this->emitNotifications('Something Went Wrong Please try after some time','error');
    }



    public function resetInputs()
    {
        $this->templateName=null;
        $this->tender_no = [];
        $this->tender_desc = [];
        $this->document_type = [];
        $this->document_type_desc = [];  //string
        $this->po_number = [];
        $this->purchasing_group = [];
        $this->purchasing_organization = [];
        $this->customer_no = [];
        $this->nupco_delivery_date = [];
        $this->po_created_on = [];
        $this->generic_mat_code = [];
        $this->vendor_code = [];
        $this->storage_location = [];
        $this->plant = [];
        $this->customer_name = [];
        $this->delivery_address = [];
        $this->supply_ratio = [];
        $this->mat_description = [];
        $this->cust_gen_code = [];
        $this->vendor_name_en = [];
    }

    public function render()
    {
        return view('livewire.filters.v2.advance-filter-component');
    }
}
