<?php

namespace App\Http\Livewire\Automation;

use App\Models\LbsUserSearchSet;
use App\Models\ScheduledHistory;
use App\Models\ScheduleNotification;
use Livewire\Component;
use Livewire\WithPagination;
use rifrocket\LaravelCms\Helpers\Classes\LbsConstants;

class HistoryAutoComponent extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    //Search Params
    public $searchable_col='table_type';
    public $searchable_operator='LIKE';
    public $searchable_col_val=null;
    public $selected_staff='';


    public $columns=ScheduledHistory::CONS_COLUMNS;   //table columns for this table
    public $templateArray=LbsUserSearchSet::TEMPLATE_ARRAY;
    public $operators=LbsConstants::CONST_OPERATOR;
    public $number_of_rows=10;
    public $num_rows=LbsConstants::CONST_PAGE_NUMBERS;


    public $staffs=[];


    public function search_reset()
    {
        $this->selected_bulk_action='';
        $this->searchable_col='id';
        $this->searchable_operator='LIKE';
        $this->searchable_col_val=null;
        $this->number_of_rows=10;
    }


    public function searchEngine()
    {
        $query=ScheduledHistory::NotDel();
        if (!empty($this->selected_staff)){
            $query= $query->where('user_id',$this->selected_staff);
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

    public function render()
    {
        $collections= $this->searchEngine();
        return view('livewire.automation.history-auto-component')->with('collections', $collections);
    }
}
