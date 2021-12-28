<?php

namespace App\Http\Livewire\Tickets\V2;

use App\Helpers\PoHelper;
use App\Models\HosPostHistory;
use App\Models\LbsUserSearchSet;
use App\Models\SchedulerNotificationHistory;
use App\Models\StaffColumnSet;
use App\Models\TicketMasterHeadr;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use rifrocket\LaravelCms\Helpers\Classes\LbsConstants;
use PDF;

class TicketManagerComponent extends Component
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
    public $searchable_col='message_type';
    public $searchable_operator='LIKE';
    public $searchable_col_val=null;
    public $selected_staff='';


    public $columns=TicketMasterHeadr::CONS_COLUMNS;   //table columns for this table
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


    public $message_type=[];
    public $tender_num=[];
    public $vendor_num=[];
    public $vendor_name_en=[];
    public $customer_name=[];
    public $cust_code=[];
    public $po_item_num =[];
    public $po_num=[];
    public $uom=[];
    public $plant=[];
    public $delivery_date=[];
    public $item_desc=[];
    public $mat_num=[];
    public $tender_desc=[];
    public $customer_po_no=[];
    public $customer_po_item=[];
    public $importance=[];
    public $delivery_address=[];
    public $line_status=[];
    public $supplier_comment=[];


    public $last_executed_at=[];   // need to remove


    public $mailHash;


    public function hitSearchInt($query)
    {
        if (Arr::has($this->message_type, ['from'])){
            $query=$query->where('message_type',$this->message_type['from']);
        }
        if (Arr::has($this->tender_num, ['from'])){
            $query=$query->where('tender_num',$this->tender_num['from']);
        }
        if (Arr::has($this->vendor_num, ['from'])){
            $query=$query->where('vendor_num',$this->vendor_num['from']);
        }
        if (Arr::has($this->vendor_name_en, ['from'])){
            $query=$query->where('vendor_name_en',$this->vendor_name_en['from']);
        }
        if (Arr::has($this->customer_name, ['from'])){
            $query=$query->where('customer_name','LIKE','%'.$this->customer_name['from'].'%');
        }
        if (Arr::has($this->cust_code, ['from'])){
            $query=$query->where('cust_code',$this->cust_code['from']);
        }
        if (Arr::has($this->po_item_num , ['from'])){
            $query=$query->where('po_item_num ',$this->po_item_num ['from']);
        }
        if (Arr::has($this->po_num, ['from'])){
            $query=$query->where('po_num',$this->po_num['from']);
        }
        if (Arr::has($this->uom, ['from'])){
            $query=$query->where('uom',$this->uom['from']);
        }
        if (Arr::has($this->plant, ['from'])){
            $query=$query->where('plant','LIKE','%'.$this->plant['from'].'%');
        }
        if (Arr::has($this->delivery_date, ['from'])){
            $query=$query->where('delivery_date','LIKE','%'.$this->delivery_date['from'].'%');
        }
        if (Arr::has($this->item_desc, ['from'])){
            $query=$query->where('item_desc','LIKE','%'.$this->item_desc['from'].'%');
        }
        if (Arr::has($this->mat_num, ['from'])){
            $query=$query->where('mat_num','LIKE','%'.$this->mat_num['from'].'%');
        }
        if (Arr::has($this->tender_desc, ['from'])){
            $query=$query->where('tender_desc','LIKE','%'.$this->tender_desc['from'].'%');
        }
        if (Arr::has($this->customer_po_no, ['from'])){
            $query=$query->where('customer_po_no','LIKE','%'.$this->customer_po_no['from'].'%');
        }
        if (Arr::has($this->customer_po_item, ['from'])){
            $query=$query->where('customer_po_item','LIKE','%'.$this->customer_po_item['from'].'%');
        }
        if (Arr::has($this->importance, ['from'])){
            $query=$query->where('importance','LIKE','%'.$this->importance['from'].'%');
        }
        if (Arr::has($this->delivery_address, ['from'])){
            $query=$query->whereBetween('nupco_delivery_date',[$this->delivery_address['from'],$this->delivery_address['to']]);
        }
        if (Arr::has($this->line_status, ['from'])){
            $query=$query->where('line_status','LIKE','%'.$this->line_status['from'].'%');
        }



        if (Arr::has($this->supplier_comment, ['from'])){
            $query= $query->whereHas('has_chat', function($query) {
                $query->where('msg_body','LIKE', '%'.$this->supplier_comment['from'].'%');
            });
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
        return redirect()->route('web.route.ticket.manager.list');
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

        $HosHistoryQuery =TicketMasterHeadr::orderBy('unique_line', 'DESC');
        $this->mailHash = $this->hitSearchInt($HosHistoryQuery)->select('unique_line')->get();


    }



    public function searchEngine()
    {

        $query=TicketMasterHeadr::NotDel();


        if ($this->json_data and !empty($this->json_data)){
            $searchableItems=json_decode($this->json_data, true);
            if ($searchableItems and !empty($searchableItems)){
                foreach ($searchableItems as $key => $searchableItem){
                    $operator=$searchableItem['queryOpr'];
                    $query = $query->where(trim($searchableItem['queryCol']),trim("$operator"),trim($searchableItem['queryVal']));
                }
                return  $query->orderBy('updated_at', 'DESC')->paginate($this->number_of_rows);
            }
        }

        if ( $this->mailHash) {
            $query =$query->whereIn('unique_line', $this->mailHash->toArray());
        }

        if (Arr::has($this->last_executed_at, ['from']) ) {

           return $query=$query->whereBetween('last_executed_at',[$this->last_executed_at['from'],$this->last_executed_at['to']])->orderBy('updated_at', 'DESC')->paginate($this->number_of_rows);
        }

        if ($this->searchable_operator=='LIKE'){
               $query= $query->where($this->searchable_col,'LIKE', '%'.$this->searchable_col_val.'%')->orderBy('updated_at', 'DESC')->paginate($this->number_of_rows);
               return $query;
        }else{
            if (!empty($this->searchable_col_val) and !empty($this->searchable_operator)){
                return $query= $query->where(trim($this->searchable_col),trim("$this->searchable_operator"), trim($this->searchable_col_val))->orderBy('updated_at', 'DESC')->paginate($this->number_of_rows);
            }else{
                 $query= $query->where($this->searchable_col,'LIKE', '%'.$this->searchable_col_val.'%')->orderBy('updated_at', 'DESC')->paginate($this->number_of_rows);
                return  $query;
            }
        }


    }

    public function render()
    {
        $collections= $this->searchEngine();
        return view('livewire.tickets.v2.ticket-manager-component')->with('collections', $collections);
    }
}

