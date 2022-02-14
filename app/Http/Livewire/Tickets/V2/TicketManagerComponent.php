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
            $query=$query->whereIn('message_type',$this->message_type['from']);
        }
        if (Arr::has($this->tender_num, ['from'])){
            $query=$query->whereIn('tender_num',$this->tender_num['from']);
        }
        if (Arr::has($this->vendor_num, ['from'])){
            $query=$query->whereIn('vendor_num',$this->vendor_num['from']);
        }
        if (Arr::has($this->vendor_name_en, ['from'])){
            $query=$query->whereIn('vendor_name_en',$this->vendor_name_en['from']);
        }
        if (Arr::has($this->customer_name, ['from'])){
            $query=$query->whereIn('customer_name',$this->customer_name['from']);
        }
        if (Arr::has($this->cust_code, ['from'])){
            $query=$query->whereIn('cust_code',$this->cust_code['from']);
        }
        if (Arr::has($this->po_item_num , ['from'])){
            $query=$query->whereIn('po_item_num ',$this->po_item_num ['from']);
        }
        if (Arr::has($this->po_num, ['from'])){
            $query=$query->whereIn('po_num',$this->po_num['from']);
        }
        if (Arr::has($this->uom, ['from'])){
            $query=$query->whereIn('uom',$this->uom['from']);
        }
        if (Arr::has($this->plant, ['from'])){
            $query=$query->whereIn('plant',$this->plant['from']);
        }
        if (Arr::has($this->delivery_address, ['from'])){
            $query=$query->whereIn('delivery_address',$this->delivery_address['from']);
        }
        if (Arr::has($this->item_desc, ['from'])){
            $query=$query->whereIn('item_desc',$this->item_desc['from']);
        }
        if (Arr::has($this->mat_num, ['from'])){
            $query=$query->whereIn('mat_num',$this->mat_num['from']);
        }
        if (Arr::has($this->tender_desc, ['from'])){
            $query=$query->whereIn('tender_desc',$this->tender_desc['from']);
        }
        if (Arr::has($this->customer_po_no, ['from'])){
            $query=$query->whereIn('customer_po_no',$this->customer_po_no['from']);
        }
        if (Arr::has($this->customer_po_item, ['from'])){
            $query=$query->whereIn('customer_po_item',$this->customer_po_item['from']);
        }
        if (Arr::has($this->importance, ['from'])){
            $query=$query->whereIn('importance',$this->importance['from']);
        }
        if (Arr::has($this->delivery_date, ['from'])){
            $query=$query->whereBetween('delivery_date',[$this->delivery_date['from'],$this->delivery_date['to']]);
        }
        if (Arr::has($this->line_status, ['from'])){
            $query=$query->whereIn('line_status',$this->line_status['from']);
        }
        if (Arr::has($this->supplier_comment, ['from'])){

            $query= $query->whereHas('has_chat', function($query) {
                $query->whereIn('msg_body',$this->supplier_comment['from']);
            });
        }
        return $query;
    }


    public function mount()
    {
        $StaffColumnSet = StaffColumnSet::where('table_type', $this->tableType)->where('user_id', auth()->user()->id)->first();
        if ($StaffColumnSet) {
            $this->columns = json_decode($StaffColumnSet->columns, true);
        }
    }

    public function save_staff_col_set()
    {
        $uniue_line = $this->tableType . '_' . auth()->user()->id;
        $attributes = [
            'unique_line' => $this->tableType . '_' . auth()->user()->id,
            'user_id' => auth()->user()->id,
            'table_type' => $this->tableType,
            'columns' => json_encode($this->columns),
        ];

        if (StaffColumnSet::where('unique_line', $uniue_line)->exists()) {
            $result = StaffColumnSet::where('unique_line', $uniue_line)->first()->update($attributes);
        } else {
            $result = StaffColumnSet::create($attributes);
        }

        // dd($result);
        if ($result) {
            return $this->emitNotifications('colunm set saved', 'success');
        }
        return $this->emitNotifications('There is Something Wrong', 'error');
    }

    public function search_reset()
    {
        return redirect()->route('web.route.ticket.manager.list');
    }




    public function search_filter_submit()
    {
        $this->searchEngine();
    }



    public function searchEngine()
    {

        $query=TicketMasterHeadr::NotDel()->where('meta','!=','init')->orderBy('updated_at', 'DESC');

        $query = $this->hitSearchInt($query);
        // dd($this->customer_name);
        // dd($query->toSql());
        return  $query->paginate($this->number_of_rows);

    }

    public function render()
    {
        $collections= $this->searchEngine();
        return view('livewire.tickets.v2.ticket-manager-component')->with('collections', $collections);
    }
}

