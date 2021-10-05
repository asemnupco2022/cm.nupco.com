<?php

namespace App\Http\Livewire\Po;

use App\Models\PoMowaredMaster;
use Livewire\Component;
use Livewire\WithPagination;

class MawLineItemComponent extends Component
{


    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $searchable_col='tender_no';
    public $searchable_operator='LIKE';
    public $searchable_col_val=null;
    public $item_code;



    protected $queryString = ['searchable_col_val'];

    public $columns=[
            "item_code"=>true,
            "desc"=>true,
            "region_qtye"=>true,
            "recived"=>true,
            "initial_recived"=>true,
            "unit_price"=>true,
            "pending_qty"=>true,
            "total_recived_qty"=>true,
            "initial_reciving_value"=>true,
            "item_total_value"=>true,
            "final_reciving_value"=>true,
            "value_of_delivered"=>true,
            "available_qty_for_main_store"=>true,
            "available_qty_for_all_locations"=>true,
            "monthly_consumption"=>true,
            "tender_no"=>true,
            "contract_no"=>true,
            "tender_name"=>true,
            "vendor_number"=>true,
            "vendor_name"=>true,
            "country_of_origion"=>true,
            "manfacturing_co"=>true,
            "contract_start_date"=>true,
            "contract_start_hijri"=>true,
            "contract_end_date"=>true,
            "contract_end_date_hijri"=>true,
            "region_code"=>true,
            "store"=>true,
            "shipments"=>true,
            "trade_date"=>true,
        ];

    public $operators=[
        '='=>'EQUAL',
        '<'=>'LESS THAN',
        '>'=>'GREATER THAN',
        '!='=>'NOT EQUAL',
        'LIKE'=>'LIKE',
    ];

    public function search_reset()
    {
        $this->searchable_col='tender_no';
        $this->searchable_operator='LIKE';
        $this->searchable_col_val=null;
    }

    public function searchEngine()
    {
        if ($this->searchable_operator=='LIKE'){
        return PoMowaredMaster::where($this->searchable_col,"LIKE", '%'.$this->searchable_col_val.'%')->where('item_code',$this->item_code)->paginate(10);
        }else{
            if (!empty($this->searchable_col_val) and !empty($this->searchable_operator)) {
                return PoMowaredMaster::where($this->searchable_col, trim("$this->searchable_operator"), $this->searchable_col_val)->where('item_code', $this->item_code)->paginate(10);
            }else{
                return PoMowaredMaster::where($this->searchable_col,"LIKE", '%'.$this->searchable_col_val.'%')->where('item_code',$this->item_code)->paginate(10);
            }
        }
    }


    public function render()
    {
        $collections= $this->searchEngine();
        return view('livewire.po.maw-line-item-component')->with('collections', $collections);
    }
}
