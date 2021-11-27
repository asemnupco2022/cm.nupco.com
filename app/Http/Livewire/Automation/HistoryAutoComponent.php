<?php

namespace App\Http\Livewire\Automation;

use App\Helpers\PoHelper;
use App\Models\HosPostHistory;
use App\Models\LbsUserSearchSet;
use App\Models\SchedulerNotificationHistory;
use App\Models\StaffColumnSet;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use rifrocket\LaravelCms\Helpers\Classes\LbsConstants;
use PDF;

class HistoryAutoComponent extends Component
{

    public function emitNotifications($message, $msgType)
    {
        $this->emit('toast-notification-component',$message,$msgType);
    }

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['update-users-filter-template' => 'fetchBaseInfo'];
    public $tableType=LbsUserSearchSet::TEMPLATE_NOTIFICATION_HISTORY;

    //Search Params
    public $searchable_col='table_type';
    public $searchable_operator='LIKE';
    public $searchable_col_val=null;
    public $selected_staff='';


    public $columns=SchedulerNotificationHistory::CONS_COLUMNS;   //table columns for this table
    public $templateArray=LbsUserSearchSet::TEMPLATE_ARRAY;
    public $operators=LbsConstants::CONST_OPERATOR;
    public $number_of_rows=10;
    public $num_rows=LbsConstants::CONST_PAGE_NUMBERS;


    public $userFilterTemplates=[];
    public $getFilterTemplate='';
    public $json_data=null;
    public $json_data_to_string='';

    public $staffs=[];


    public $selectedPo=[];
    public $selectAll=false;

    public $showEmailStructure=null;
    public $showEmailStructureDate=null;


    public $tender_num=[];
    public $vendor_num=[];
    public $po_num=[];
    public $cust_code=[];
    public $po_item_num=[];
    public $uom=[];
    public $plant=[];
    public $mat_num=[];

    public $mailHash;


    public function hitSearchInt($query)
    {
        if (Arr::has($this->tender_num, ['from'])){
            $query=$query->where('tender_num',$this->tender_num['from']);
        }
        if (Arr::has($this->vendor_num, ['from'])){
            $query=$query->where('vendor_num',$this->vendor_num['from']);
        }
        if (Arr::has($this->po_num, ['from'])){
            $query=$query->where('po_num',$this->po_num['from']);
        }
        if (Arr::has($this->cust_code, ['from'])){
            $query=$query->where('cust_code',$this->cust_code['from']);
        }
        if (Arr::has($this->po_item_num, ['from'])){
            $query=$query->where('po_item_num',$this->po_item_num['from']);
        }
        if (Arr::has($this->uom, ['from'])){
            $query=$query->where('uom',$this->uom['from']);
        }
        if (Arr::has($this->plant, ['from'])){
            $query=$query->where('plant',$this->plant['from']);
        }
        if (Arr::has($this->mat_num, ['from'])){
            $query=$query->whereDate('mat_num',$this->mat_num['from']);
        }

        return $query;
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
            $this->selectedPo = [];
        }
    }

    public function search_reset()
    {
        $this->selected_bulk_action='';
        $this->searchable_col='id';
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

        $StaffColumnSet = StaffColumnSet::where('table_type', $this->tableType)->where('user_id',auth()->user()->id)->first();
        if ( $StaffColumnSet) {
            $this->columns = json_decode($StaffColumnSet->columns, true);
        }
    }

    public function save_staff_col_set()
    {
        $uniue_line=$this->tableType.'_'.auth()->user()->id;
        $attributes=[
            'unique_line'=>$this->tableType.'_'.auth()->user()->id,
            'user_id'=>auth()->user()->id,
            'table_type'=>$this->tableType,
            'columns'=>json_encode($this->columns),
        ];

        if (StaffColumnSet::where('unique_line',$uniue_line)->exists()) {
            $result = StaffColumnSet::where('unique_line',$uniue_line)->first()->update($attributes);
        }else{
            $result = StaffColumnSet::create($attributes);
        }

        // dd($result);
        if($result){
            return $this->emitNotifications('colunm set saved' ,'success');
        }
        return $this->emitNotifications('There is Something Wrong','error');

    }

    public function export_data($type)
    {

        $ColKeys = array_keys(array_filter($this->columns));
        $selectedRows = array_keys(array_filter($this->selectedPo));
        $collection = SchedulerNotificationHistory::whereIn('id',$selectedRows)->select($ColKeys)->get();
        $dateTime=Carbon::now(config('app.timezone'))->format('D-M-Y h.m.s');

        if ($type=='PDF'){
            $fileName='notification_history'.'-'.$dateTime.'.pdf';
            PoHelper::export_pdf($ColKeys,$collection,$fileName);
            return Storage::disk('local')->download('export/'.$fileName);
        }
        if ($type=='EXCEL'){
            $ColKeys= PoHelper::NormalizeColString(null, $ColKeys);
            $collection=collect(array_merge([$ColKeys],$collection->toArray()));
            $fileName='notification_history'.'-'.$dateTime.'.xlsx';
            PoHelper::excel_export($collection, $fileName);
            return Storage::disk('local')->download('export/'.$fileName);
        }

    }

    public function view_email($id)
    {
        $notificationHistoryData=SchedulerNotificationHistory::find($id);
        $this->showEmailStructure=$notificationHistoryData->msg_body;
        $this->showEmailStructureDate=$notificationHistoryData->created_at;
        $this->dispatchBrowserEvent('open-mail-views');
    }

    public function search_filter_submit()
    {

        $HosHistoryQuery =HosPostHistory::orderBy('unique_hash', 'DESC');
        $this->mailHash = $this->hitSearchInt($HosHistoryQuery)->select('mail_hash')->get()->toArray();

    }


    public function searchEngineForAll()
    {
        $query=SchedulerNotificationHistory::NotDel();
        if (!empty($this->selected_staff)){
            $query= $query->where('user_id',$this->selected_staff);
        }

        if ($this->json_data and !empty($this->json_data)){
            $searchableItems=json_decode($this->json_data, true);
            if ($searchableItems and !empty($searchableItems)){
                foreach ($searchableItems as $key => $searchableItem){
                    $operator=$searchableItem['queryOpr'];
                    $query = $query->where(trim($searchableItem['queryCol']),trim("$operator"),trim($searchableItem['queryVal']));
                }
                return  $query->orderBy('po_item', 'DESC')->paginate($this->number_of_rows);
            }
        }
        if ($this->searchable_operator=='LIKE'){
            return    $query= $query->where($this->searchable_col,'LIKE', '%'.$this->searchable_col_val.'%')->orderBy('id', 'DESC')->paginate($this->number_of_rows);
        }else{
            if (!empty($this->searchable_col_val) and !empty($this->searchable_operator)){
                return $query= $query->where(trim($this->searchable_col),trim("$this->searchable_operator"), trim($this->searchable_col_val))->orderBy('id', 'DESC')->paginate($this->number_of_rows);
            }else{
                return  $query= $query->where($this->searchable_col,'LIKE', '%'.$this->searchable_col_val.'%')->orderBy('id', 'DESC')->paginate($this->number_of_rows);
            }
        }
    }

    public function searchEngine()
    {

        $query=SchedulerNotificationHistory::NotDel();
        if (!empty($this->selected_staff)){
            $query= $query->where('user_id',$this->selected_staff);
        }

        if ($this->json_data and !empty($this->json_data)){
            $searchableItems=json_decode($this->json_data, true);
            if ($searchableItems and !empty($searchableItems)){
                foreach ($searchableItems as $key => $searchableItem){
                    $operator=$searchableItem['queryOpr'];
                    $query = $query->where(trim($searchableItem['queryCol']),trim("$operator"),trim($searchableItem['queryVal']));
                }
                return  $query->orderBy('po_item', 'DESC')->paginate($this->number_of_rows);
            }
        }

        if ( $this->mailHash) {
            $query =$query->whereIn('mail_ticket_hash', $this->mailHash)->where($this->searchable_col,'LIKE', '%'.$this->searchable_col_val.'%');
        }

        if ($this->searchable_operator=='LIKE'){
               $query= $query->where($this->searchable_col,'LIKE', '%'.$this->searchable_col_val.'%')->orderBy('id', 'DESC')->paginate($this->number_of_rows);
               return $query;
        }else{
            if (!empty($this->searchable_col_val) and !empty($this->searchable_operator)){
                return $query= $query->where(trim($this->searchable_col),trim("$this->searchable_operator"), trim($this->searchable_col_val))->orderBy('id', 'DESC')->paginate($this->number_of_rows);
            }else{
                 $query= $query->where($this->searchable_col,'LIKE', '%'.$this->searchable_col_val.'%')->orderBy('id', 'DESC')->paginate($this->number_of_rows);
                return  $query;
            }
        }


    }

    public function render()
    {
        $collections= $this->searchEngine();
        return view('livewire.automation.history-auto-component')->with('collections', $collections);
    }
}
