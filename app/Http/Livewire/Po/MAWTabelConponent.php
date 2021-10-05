<?php

namespace App\Http\Livewire\Po;


use App\Models\MowaredViews;
use Livewire\Component;
use Livewire\WithPagination;

class MAWTabelConponent extends Component
{


    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $searchable_col = 'item_code';
    public $searchable_operator = 'LIKE';
    public $searchable_col_val = null;


    protected $queryString = ['searchable_col_val'];
    public $columns = [

        'tender_no' => true,
        'item_code' => true,
        'vendor_code' => true,
        'vendor_name' => true,
        'Ordered_quantity' => true,
        'pending_qty' => true,
        'total_recived_qty' => true,
        'order_total' => true,

    ];

    public $operators = [
        '=' => 'EQUAL',
        '<' => 'LESS THAN',
        '>' => 'GREATER THAN',
        '!=' => 'NOT EQUAL',
        'LIKE' => 'LIKE',
    ];

    public function search_reset()
    {
        $this->searchable_col='tender_no';
        $this->searchable_operator='LIKE';
        $this->searchable_col_val=null;
    }

    public function searchEngine()
    {

        if ($this->searchable_operator == 'LIKE') {
            return MowaredViews::where($this->searchable_col, 'LIKE', '%' . $this->searchable_col_val . '%')->paginate(10);
        } else {
            if (!empty($this->searchable_col_val) and !empty($this->searchable_operator)) {
                return MowaredViews::where($this->searchable_col,trim("$this->searchable_operator"), $this->searchable_col_val)->paginate(10);
            } else {
                return MowaredViews::where($this->searchable_col, 'LIKE', '%' . $this->searchable_col_val . '%')->paginate(10);
            }
        }
    }


    public function render()
    {
        $collections = $this->searchEngine();
        return view('livewire.po.m-a-w-tabel-conponent')->with('collections', $collections);
    }
}
