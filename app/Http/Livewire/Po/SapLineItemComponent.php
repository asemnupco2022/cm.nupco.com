<?php

namespace App\Http\Livewire\Po;

use App\Helpers\PoHelper;
use App\Jobs\Hos\SapMailHeader;
use App\Models\LbsUserSearchSet;
use App\Models\PoSapMaster;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use rifrocket\LaravelCms\Helpers\Classes\LbsConstants;

class SapLineItemComponent extends Component
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


    public function emitMailComposerReq($reqType)
    {
        $collections=PoSapMaster::whereIn('po_item',array_keys($this->selectedPo))->where('po_number',$this->po_number)->get();


        $sendData=[
            'purchasing_code'=>$this->po_number,
            'vendor_code'=>$this->baseInfo->vendor_code,
            'vendor_name'=>$this->baseInfo->vendor_name,
            'customer_name'=>$this->baseInfo->customer_name,
            'po_items'=>$this->selectedPo,
            'sap_object'=>$collections
        ];
        dispatch(new SapMailHeader($collections, $reqType));
        $this->emit('event-show-compose-email', $reqType,$sendData,$this->tableType);
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


    public function updatedSelectAll($value)
    {
        if ($value)
        {
            $this->selectedPo = $this->searchEngine()->pluck('po_item')->toArray();
            $this->selectedPo =   array_fill_keys($this->selectedPo, true);
        }
        else
        {
            // $this->selectedPo =   array_fill_keys($this->selectedPo, false);
            $this->selectedPo = [];
        }
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
       $this->baseInfo= PoSapMaster::where('po_number',$this->po_number)->first();
       $this->userFilterTemplates = LbsUserSearchSet::NotDel()->where('user_id',auth()->user()->id)->where('template_for_table',$this->tableType)->get();
       $getFavFilter=LbsUserSearchSet::OnlyActive()->where('user_id',auth()->user()->id)->where('template_for_table',$this->tableType)->where('make_fav','!=', null)->first();
    }

    public function export_data($type)
    {

        $ColKeys = array_keys(array_filter($this->columns));
        $selectedRows = array_keys(array_filter($this->selectedPo));
        $collection = PoSapMaster::where('po_number', $this->po_number)->whereIn('po_item',$selectedRows)->select($ColKeys)->get();
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

    }


    public function searchEngine()
    {

        if ($this->json_data and !empty($this->json_data)){
            $searchableItems=json_decode($this->json_data, true);
            if ($searchableItems and !empty($searchableItems)){
                $query = PoSapMaster::where('po_number', $this->po_number);
                foreach ($searchableItems as $key => $searchableItem){
                    $operator=$searchableItem['queryOpr'];
                    $query = $query->where(trim($searchableItem['queryCol']),trim("$operator"),trim($searchableItem['queryVal']));
                }
              return  $query->orderBy('po_item', 'DESC')->paginate($this->number_of_rows);
            }
        }

        if ($this->searchable_operator=='LIKE'){
           return PoSapMaster::where($this->searchable_col,'LIKE', '%'.$this->searchable_col_val.'%')->where('po_number',$this->po_number)->orderBy('po_item', 'DESC')->paginate($this->number_of_rows);
        }else{
            if (!empty($this->searchable_col_val) and !empty($this->searchable_operator)){
               return PoSapMaster::where(trim($this->searchable_col),trim("$this->searchable_operator"), trim($this->searchable_col_val))->where('po_number',$this->po_number)->orderBy('po_item', 'DESC')->paginate($this->number_of_rows);
            }else{
              return  PoSapMaster::where($this->searchable_col,'LIKE', '%'.$this->searchable_col_val.'%')->where('po_number',$this->po_number)->orderBy('po_item', 'DESC')->paginate($this->number_of_rows);
            }
        }
    }


    public function render()
    {
        $collections= $this->searchEngine();
        return view('livewire.po.sap-line-item-component')->with('collections', $collections);
    }
}
