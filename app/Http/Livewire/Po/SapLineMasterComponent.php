<?php

namespace App\Http\Livewire\Po;

use App\Helpers\PoHelper;
use App\Models\LbsUserSearchSet;
use App\Models\PoSapMaster;
use App\Models\SapMasterView;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use rifrocket\LaravelCms\Helpers\Classes\LbsConstants;

class SapLineMasterComponent extends Component
{

    public $tableType=LbsUserSearchSet::TEMPLATE_SAP_LINE_ITEM;


    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['update-users-filter-template' => 'fetchBaseInfo'];

    public $searchable_col='po_item';
    public $searchable_operator='LIKE';
    public $searchable_col_val=null;

    public $po_number;
    public $baseInfo=null;

    public $userFilterTemplates=[];
    public $getFilterTemplate='';
    public $json_data=null;
    public $json_data_to_string='';

    public $selectedPo=[];
    public $selectAll=false;


    public $number_of_rows=10;


    protected $queryString = ['searchable_col_val'];

    public $columns=PoSapMaster::CONS_COLUMNS;
    public $operators=LbsConstants::CONST_OPERATOR;
    public $num_rows=LbsConstants::CONST_PAGE_NUMBERS;

    //initial PO search
    public $initSearch = true;
    protected $initiateSearch=false;
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
//    ========


    public function hitSearchInt($query)
    {
        if (Arr::has($this->tender_no, ['from','to'])){
            $query=$query->whereBetween('tender_no',[$this->tender_no['from'],$this->tender_no['to']]);
        }
        if (Arr::has($this->tender_desc, ['from','to'])){
            $query=$query->whereBetween('tender_desc',[$this->tender_desc['from'],$this->tender_desc['to']]);
        }
        if (Arr::has($this->document_type, ['from','to'])){
            $query=$query->whereBetween('document_type',[$this->document_type['from'],$this->document_type['to']]);
        }
        if (Arr::has($this->document_type_desc, ['from','to'])){
            $query=$query->whereBetween('document_type_desc',[$this->document_type_desc['from'],$this->document_type_desc['to']]);
        }
        if (Arr::has($this->init_po_number, ['from','to'])){
            $query=$query->whereBetween('po_number',[$this->init_po_number['from'],$this->init_po_number['to']]);
        }
        if (Arr::has($this->purchasing_group, ['from','to'])){
            $query=$query->whereBetween('total_recived_qty',[$this->purchasing_group['from'],$this->purchasing_group['to']]);
        }
        if (Arr::has($this->purchasing_organization, ['from','to'])){
            $query=$query->whereBetween('purchasing_organization',[$this->purchasing_organization['from'],$this->purchasing_organization['to']]);
        }
        if (Arr::has($this->customer_no, ['from','to'])){
            $query=$query->whereBetween('customer_no',[$this->customer_no['from'],$this->customer_no['to']]);
        }
        if (Arr::has($this->nupco_delivery_date, ['from','to'])){
            $query=$query->whereDate('nupco_delivery_date','<=',Carbon::parse($this->nupco_delivery_date['from'])->format('Y-m-d'))->whereDate('trade_date','>=',Carbon::parse($this->nupco_delivery_date['to'])->format('Y-m-d'));
        }
        if (Arr::has($this->po_created_on, ['from','to'])){
            $query=$query->whereDate('po_created_on','<=',Carbon::parse($this->po_created_on['from'])->format('Y-m-d'))->whereDate('trade_date','>=',Carbon::parse($this->po_created_on['to'])->format('Y-m-d'));
        }
        if (Arr::has($this->generic_mat_code, ['from','to'])){
            $query=$query->whereBetween('generic_mat_code',[$this->generic_mat_code['from'],$this->generic_mat_code['to']]);
        }
        if (Arr::has($this->vendor_code, ['from','to'])){
            $query=$query->whereBetween('vendor_code',[$this->vendor_code['from'],$this->vendor_code['to']]);
        }
        if (Arr::has($this->storage_location, ['from','to'])){
            $query=$query->whereBetween('storage_location',[$this->storage_location['from'],$this->storage_location['to']]);
        }
        if (Arr::has($this->plant, ['from','to'])){
            $query=$query->whereBetween('plant',[$this->plant['from'],$this->plant['to']]);
        }
        return $query;
    }

    public function initSearchFilter(){
        $this->initiateSearch=true;
    }


    public function updatedSelectAll($value)
    {
        if ($value)
        {
            $this->selectedPo = $this->searchEngine()->pluck('id')->toArray();
            $this->selectedPo =   array_fill_keys($this->selectedPo, true);
        }
        else
        {
            // $this->selectedPo =   array_fill_keys($this->selectedPo, false);
            $this->selectedPo = [];
        }
    }


    public function export_data($type)
    {

        $ColKeys = array_keys(array_filter($this->columns));
        $selectedRows = array_keys(array_filter($this->selectedPo));
        $collection = PoSapMaster::whereIn('id',$selectedRows)->select($ColKeys)->get();
        $dateTime=Carbon::now(config('app.timezone'))->format('D-M-Y h.m.s');

        if ($type=='PDF'){
            $fileName=$this->po_number.'-'.$dateTime.'.pdf';
            PoHelper::export_pdf($ColKeys,$collection,$fileName);
            return Storage::disk('local')->download('export/'.$fileName);
        }
        if ($type=='EXCEL'){
            $ColKeys= PoHelper::NormalizeColString(null, $ColKeys);
            $collection=collect(array_merge([$ColKeys],$collection->toArray()));
            $fileName=$this->po_number.'-'.$dateTime.'.xlsx';
            PoHelper::excel_export($collection, $fileName);
            return Storage::disk('local')->download('export/'.$fileName);
        }
        return 1;

    }

    public function emitMailComposerReq($reqType)
    {

        $check=PoSapMaster::whereIn('id',array_keys($this->selectedPo))->pluck('po_number','po_item')->toArray();
        $count = count(array_unique($check));
        if ($count>1){
            return $this->dispatchBrowserEvent('mail-can-not-be-sent');
        }

        $collections=PoSapMaster::whereIn('id',array_keys($this->selectedPo))->get();
        $this->baseInfo=PoSapMaster::find($collections[0]->id);
//        $to=$this->baseInfo->vendorInfo->email;
        if ($this->baseInfo->vendorInfo){
            return $this->dispatchBrowserEvent('jq-confirm-alert');
        }

        $sendData=[
            'purchasing_code'=>$this->po_number,
            'vendor_code'=>$this->baseInfo->vendorInfo->vendor_code,
            'vendor_name'=>$this->baseInfo->vendorInfo->display_name,
            'customer_name'=>$this->baseInfo->customer_name,
            'po_items'=>$this->selectedPo,
            'sap_object'=>$collections
        ];

        $this->emit('event-show-compose-email', $reqType,$sendData,$this->tableType,$to);
    }


    public function open_comment_modal($poNo)
    {
        $this->emit('open-edit-internal-comment', $this->po_number,$poNo,$this->tableType);
    }



    public function UpdatedGetFilterTemplate($value)
    {
        $this->json_data_to_string='';
        $selectedTemplate = LbsUserSearchSet::find($value);
        $this->json_data=$selectedTemplate->json_data;
        $this->json_data_to_string=$selectedTemplate->json_to_string;
    }




    public function search_reset()
    {
        $this->getFilterTemplate='';
        $this->json_data=null;
        $this->json_data_to_string='';
        $this->searchable_col='po_item';
        $this->searchable_operator='LIKE';
        $this->searchable_col_val=null;
        $this->number_of_rows=10;
    }

    public function mount()
    {
        $this->fetchBaseInfo();
    }


    public function fetchBaseInfo()
    {
        $this->userFilterTemplates = LbsUserSearchSet::NotDel()->where('user_id',auth()->user()->id)->where('template_for_table',$this->tableType)->get();
        $getFavFilter=LbsUserSearchSet::OnlyActive()->where('user_id',auth()->user()->id)->where('template_for_table',$this->tableType)->where('make_fav','!=', null)->first();
    }




    public function search_enter()
    {

        $this->searchEngine();
    }

    public function searchEngine()
    {

        $query=PoSapMaster::orderBy('tender_no', 'ASC');

        if ($this->initiateSearch){
            $this->initSearch=false;
            return $this->hitSearchInt($query)->paginate(10);
        }

        if ($this->json_data and !empty($this->json_data)){
            $searchableItems=json_decode($this->json_data, true);
            if ($searchableItems and !empty($searchableItems)){
                $query = PoSapMaster::orderBy('tender_no', 'ASC');
                foreach ($searchableItems as $key => $searchableItem){
                    $operator=$searchableItem['queryOpr'];
                    $query = $query->where(trim($searchableItem['queryCol']),trim("$operator"),trim($searchableItem['queryVal']));
                }
                return  $query->paginate($this->number_of_rows);
            }
        }

        if ($this->searchable_operator=='LIKE'){
            return PoSapMaster::where($this->searchable_col,'LIKE', '%'.$this->searchable_col_val.'%')->orderBy('po_item', 'DESC')->paginate($this->number_of_rows);
        }else{
            if (!empty($this->searchable_col_val) and !empty($this->searchable_operator)){
                return PoSapMaster::where(trim($this->searchable_col),trim("$this->searchable_operator"), trim($this->searchable_col_val))->orderBy('po_item', 'DESC')->paginate($this->number_of_rows);
            }else{
                return  PoSapMaster::where($this->searchable_col,'LIKE', '%'.$this->searchable_col_val.'%')->orderBy('po_item', 'DESC')->paginate($this->number_of_rows);
            }
        }
    }


    public function render()
    {
        $collections= $this->searchEngine();
        return view('livewire.po.sap-line-master-component')->with('collections', $collections);
    }
}
