<?php

namespace App\Http\Livewire\Staffs;

use App\Models\LbsUserSearchSet;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Livewire\Component;
use Livewire\WithPagination;
use rifrocket\LaravelCms\Facades\LaravelCmsFacade;
use rifrocket\LaravelCms\Helpers\Classes\LbsConstants;
use rifrocket\LaravelCms\Models\LbsAdmin;

class StaffComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $parentModel='lbs_admin';

    public function emitNotifications($message, $msgType)
    {
        $this->emit('toast-notification-component',$message,$msgType);
    }

    public $searchable_col='username';
    public $searchable_operator='LIKE';
    public $searchable_col_val=null;


    public $columns=LbsAdmin::CONS_COLUMNS;   //table columns for this table

    public $number_of_rows=10;
    public $num_rows=LbsConstants::CONST_PAGE_NUMBERS;

    public $selected_bulk_action='';
    public $actions=LbsConstants::CONST_ACTIONS;

    public $staffs=[];
    public $selectAll=false;

    public function mount()
    {
        $this->fetchBaseInfo();
    }


    public function fetchBaseInfo()
    {
        $this->staffs=LbsAdmin::OnlyActive()->where('id','!=',auth()->user()->id)->get();
    }


    public function search_reset()
    {
        $this->selected_bulk_action='';
        $this->searchable_col='username';
        $this->searchable_operator='LIKE';
        $this->searchable_col_val=null;
        $this->number_of_rows=10;
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
        $findModel = LbsAdmin::find($model_id);
        if ($findModel) {

            if ($statusType == LbsConstants::STATUS_DELETED) {
                $findModel->deleted_at = Carbon::now();
                $findModel->save();
                return $this->emitNotifications('deleted successfully', 'success');
            } else {
                $findModel->status = $this->selected_bulk_action;
                $findModel->save();
            }
        }
    }


    public function editStaff($staff_id)
    {
        $this->emit('update-staff-data',$staff_id);
        $this->dispatchBrowserEvent('update-staff-data');
    }


    public function searchEngine()
    {
        $query=LbsAdmin::NotDel()->where('role', '!=' , LbsConstants::SUPER_ADMIN_ROLE);

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
        return view('livewire.staffs.staff-component')->with('collections', $collections);
    }
}
