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
        if (Arr::has($this->delivery_address, ['from'])){
            $query=$query->where('delivery_address','LIKE','%'.$this->delivery_address['from'].'%');
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
        if (Arr::has($this->delivery_date, ['from'])){
            $query=$query->whereBetween('delivery_date',[$this->delivery_date['from'],$this->delivery_date['to']]);
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

