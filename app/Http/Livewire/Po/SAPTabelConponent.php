<?php

namespace App\Http\Livewire\Po;



use App\Models\SapView;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Livewire\Component;
use Livewire\WithPagination;
use rifrocket\LaravelCms\Helpers\Classes\LbsConstants;

class SAPTabelConponent extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    //initial PO search
    public $initSearch = true;
    protected $initiateSearch=false;
    public $initTenderNo = [];
    public $initPurchaseNo = [];
    public $iniVendorNo = [];
    public $initOrderQty = [];
    public $initPendQty = [];
    public $initTotaRecelQty = [];
    public $initTotalQty = [];
    public $initGrAmt = [];
    public $initTradeDate = [];
    public function initSearchFilter(){
        $this->initiateSearch=true;
    }

    public function hitSearchInt($query)
    {
        if (Arr::has($this->initTenderNo, ['from','to'])){

            $query=$query->whereBetween('tender_no',[$this->initTenderNo['from'],$this->initTenderNo['to']]);

        }
        if (Arr::has($this->initPurchaseNo, ['from','to'])){

            $query=$query->whereBetween('purchasing_document',[$this->initPurchaseNo['from'],$this->initPurchaseNo['to']]);
        }
        if (Arr::has($this->iniVendorNo, ['from','to'])){
            $query=$query->whereBetween('vendor_code',[$this->iniVendorNo['from'],$this->iniVendorNo['to']]);
        }
        if (Arr::has($this->initOrderQty, ['from','to'])){
            $query=$query->whereBetween('Ordered_quantity',[$this->initOrderQty['from'],$this->initOrderQty['to']]);
        }
        if (Arr::has($this->initPendQty, ['from','to'])){
            $query=$query->whereBetween('pending_qty',[$this->initPendQty['from'],$this->initPendQty['to']]);
        }
        if (Arr::has($this->initTotalQty, ['from','to'])){
            $query=$query->whereBetween('order_total',[$this->initTotalQty['from'],$this->initTotalQty['to']]);
        }
        if (Arr::has($this->initTotaRecelQty, ['from','to'])){
            $query=$query->whereBetween('total_recived_qty',[$this->initTotaRecelQty['from'],$this->initTotaRecelQty['to']]);
        }
        if (Arr::has($this->initGrAmt, ['from','to'])){
            $query=$query->whereBetween('gr_amount',[$this->initGrAmt['from'],$this->initGrAmt['to']]);
        }
        if (Arr::has($this->initTradeDate, ['from','to'])){
            $query=$query->whereBetween('trade_date',[Carbon::parse($this->initTradeDate['from'])->format('Y-m-d'),Carbon::parse($this->initTradeDate['to'])->format('Y-m-d')]);
        }


        return $query;
    }






    public $dateRangePicker=null;
    public $startDate=null;
    public $endDate=null;

    public function updatedDateRangePicker($value)
    {
        $dates= explode(' - ',$value);
        $this->startDate=$dates[0];
        $this->endDate=$dates[1];
    }

    public $searchable_col='tender_no';
    public $searchable_operator='LIKE';
    public $searchable_col_val=null;


    protected $queryString = ['searchable_col_val'];

    public $columns=SapView::CONS_COLUMNS;
    public $operators=LbsConstants::CONST_OPERATOR;
    public $num_rows=LbsConstants::CONST_PAGE_NUMBERS;

    public function search_reset()
    {
        $this->dateRangePicker=null;
        $this->startDate=null;
        $this->endDate=null;
        $this->searchable_col='tender_no';
        $this->searchable_operator='LIKE';
        $this->searchable_col_val=null;
    }

    public function searchEngine()
    {
        $query=SapView::orderBy('tender_no', 'DESC');

        if ($this->initiateSearch){
            $this->initSearch=false;
//            dd($this->hitSearchInt($query)->paginate(10));
           return $this->hitSearchInt($query)->paginate(10);
        }

        if ($this->dateRangePicker !=null){
            $query=$query->whereBetween('trade_date',[$this->startDate,$this->endDate]);
        }
        if ($this->searchable_operator=='LIKE'){
                 $query=$query->where($this->searchable_col,"LIKE", '%'.$this->searchable_col_val.'%')->paginate(10);
        }else{
            if (!empty($this->searchable_col_val) and !empty($this->searchable_operator)) {
                 $query=$query->where($this->searchable_col, trim("$this->searchable_operator"), $this->searchable_col_val)->paginate(10);
            }else{
                 $query=$query->where($this->searchable_col,"LIKE", '%'.$this->searchable_col_val.'%')->paginate(10);
            }
        }

        return $query;
    }


    public function render()
    {
        $collections= $this->searchEngine();
        return view('livewire.po.s-a-p-tabel-conponent')->with('collections', $collections);
    }
}
