<?php

namespace App\Http\Livewire\Logs;

use Livewire\Component;
use Livewire\WithPagination;
use rifrocket\LaravelCms\Helpers\Classes\LbsConstants;
use Spatie\Activitylog\Models\Activity;

class UserLogComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['update-users-filter-template' => 'fetchBaseInfo'];


    public $searchable_col='causer_id';
    public $searchable_operator='LIKE';
    public $searchable_col_val=null;

    public $baseInfo=null;


    public $columns=[
        "log_name"=>true,
        "causer_type"=>true,
        "description"=>true,
        // "subject_type"=>true,
        // "subject_id"=>true,
        // "causer_id"=>true,
        // "properties"=>true,
        "created_at"=>true,
        // "updated_at"=>false,
    ];

    public function mount()
    {
        // $lastcLoggedActivity->description);
    }

    public $selectedPo=[];
    public $selectAll=false;

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


    public $number_of_rows=10;
    public $num_rows=LbsConstants::CONST_PAGE_NUMBERS;
    public $operators=LbsConstants::CONST_OPERATOR;

    public function search_reset()
    {
        $this->searchable_col='id';
        $this->searchable_operator='LIKE';
        $this->searchable_col_val=null;
        $this->number_of_rows=10;
    }





    public function searchEngine()
    {
        if ($this->searchable_operator=='LIKE'){
            return    Activity::where($this->searchable_col,'LIKE', '%'.$this->searchable_col_val.'%')->orderBy('id', 'DESC')->paginate($this->number_of_rows);
        }else{
            if (!empty($this->searchable_col_val) and !empty($this->searchable_operator)){
                return Activity::where(trim($this->searchable_col),trim("$this->searchable_operator"), trim($this->searchable_col_val))->orderBy('id', 'DESC')->paginate($this->number_of_rows);
            }else{
                return  Activity::where($this->searchable_col,'LIKE', '%'.$this->searchable_col_val.'%')->orderBy('id', 'DESC')->paginate($this->number_of_rows);
            }
        }
    }


    public function render()
    {
        $collections= $this->searchEngine();
        return view('livewire.logs.user-log-component')->with('collections', $collections);
    }
}
