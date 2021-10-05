<?php

namespace App\Http\Livewire\Automation;

use App\Models\LbsUserSearchSet;
use App\Models\ScheduleNotification;
use Carbon\Carbon;
use Livewire\Component;
use rifrocket\LaravelCms\Helpers\Classes\LbsConstants;
use rifrocket\LaravelCms\Models\LbsAdmin;

class ListAutoComponent extends Component
{

    public function emitNotifications($message, $msgType)
    {
        $this->emit('toast-notification-component',$message,$msgType);
    }

    //Search Params
    public $searchable_col='subject';
    public $searchable_operator='LIKE';
    public $searchable_col_val=null;
    public $selected_staff='';

    public $columns=ScheduleNotification::CONS_COLUMNS;   //table columns for this table
    public $templateArray=LbsUserSearchSet::TEMPLATE_ARRAY;
    public $operators=LbsConstants::CONST_OPERATOR;
    public $number_of_rows=10;
    public $num_rows=LbsConstants::CONST_PAGE_NUMBERS;

    public $staffs=[];


    public $selected_bulk_action='';
    public $actions=LbsConstants::CONST_ACTIONS;

    public $selectedPo=[];
    public $selectAll=false;


    public function updatedSelectAll($value)
    {
        if ($value)
        {
            $this->selectedPo = $this->searchEngine()->pluck('id')->toArray();
            $this->selectedPo =   array_fill_keys($this->selectedPo, true);
        }
        else
        {
            // $this->selectedPo =   array_fill_keys($this->selectedPo, false);
            $this->selectedPo = [];
        }
    }

    public function bulk_action()
    {
        $selectedRows = array_keys(array_filter($this->selectedPo));
        if ($selectedRows and !empty($selectedRows) and $this->selected_bulk_action){

            foreach ($selectedRows as $selectedRow){
                $this->updateModelStatus($selectedRow, $this->selected_bulk_action);
            }
            $this->search_reset();
            $this->selectedPo = [];
            $this->selectAll=false;
            return $this->emitNotifications('data updated successfully','success');

        }

        return $this->emitNotifications('something went wrong','error');
    }


    public function updateModelStatus($model_id, $statusType, $showAlert=null)
    {
        $findModel = ScheduleNotification::find($model_id);

        if ($findModel){

            if ($statusType ==LbsConstants::STATUS_DELETED){
                $findModel->deleted_at = Carbon::now();
                $findModel->save();
                return $this->emitNotifications('deleted successfully','success');
            }
            else
            {
                $findModel->status = $this->selected_bulk_action;
                $findModel->save();
            }
        }

        if ($showAlert) {  return $this->emitNotifications('data updated successfully','success');}

        $this->fetchBaseInfo();
        $this->searchEngine();
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
        $this->staffs=LbsAdmin::OnlyActive()->where('id','!=',auth()->user()->id)->get();
    }

    public function searchEngine()
    {
        $query=ScheduleNotification::NotDel();
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
//        dd($collections);
        return view('livewire.automation.list-auto-component')->with('collections', $collections);
    }
}
