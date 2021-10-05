<?php

namespace App\Http\Livewire\Po;

use App\Models\LbsUserSearchSet;
use Illuminate\Support\Arr;
use Livewire\Component;
use rifrocket\LaravelCms\Helpers\Classes\LbsConstants;


class UserFiltersComponent extends Component
{

    public function emitNotifications($message, $msgType)
    {
        $this->emit('toast-notification-component',$message,$msgType);
    }

    public $columns=[];
    public $operators=LbsConstants::CONST_OPERATOR;


    public  $templateName;
    public  $template_for_table;
    public  $templateLoops = [];
    public  $queryCol = [];
    public  $queryOpr = [];
    public  $queryVal = [];

    protected $listeners =['open-create-user-search-template'=>'fromListFilterCompo'];

    public function fromListFilterCompo($create_for_cols,$create_for_tableType){

        $this->columns=$create_for_cols;
        $this->template_for_table=$create_for_tableType;
    }

    protected $rules = [
        'templateName' => 'required|unique:lbs_user_search_sets,template_name',
    ];


    public function mount()
    {
        $this->addNewRow();
    }

    public function addNewRow()
    {
        $this->templateLoops[] = '';
        $this->queryCol[] = '';
        $this->queryOpr[] = '';
    }

    public function removeTemplate($index)
    {
        Arr::pull($this->templateLoops, $index);
        Arr::pull($this->queryCol, $index);
        Arr::pull($this->queryOpr, $index);
        Arr::pull($this->queryVal, $index);
    }

    protected function createTemplateJson()
    {
        $holdArray=array();
        if ($this->templateLoops and !empty($this->templateLoops)){
            foreach ($this->templateLoops as $key => $templateLoop){
                if (empty($this->queryCol[$key]) or empty($this->queryOpr[$key]) or empty($this->queryVal[$key])){
                    continue;
                }
                array_push($holdArray,['queryCol'=>$this->queryCol[$key] , 'queryOpr'=>$this->queryOpr[$key] , 'queryVal'=>$this->queryVal[$key] ]);
            }
        }
        return $holdArray;
    }



    public function saveTemplateInRepo()
    {
        $this->validate();

        $json_data=json_encode($this->createTemplateJson());
        if ($json_data =='[]'){
            return $this->emitNotifications('Please select at least one condition','error');
        }

        $insert = new LbsUserSearchSet();
        $insert->user_id=auth()->user()->id;
        $insert->template_name=$this->templateName;
        $insert->template_for_table=$this->template_for_table;
        $insert->json_data=$json_data;
        if ($insert->save()){
            $this->resetInputs();
            $this->emit('update-users-filter-template');
            return $this->emitNotifications('Filter Saved successfully','success');

        }
        return $this->emitNotifications('Something Went Wrong Please try after some time','error');
    }

    public function resetInputs()
    {
        $this->templateName='';
        $this->templateLoops=[];
        $this->queryCol=[];
        $this->queryOpr=[];
        $this->queryVal=[];
        $this->templateLoops[] = '';
    }


    public function search_reset($index)
    {
        $this->queryCol[$index] = '';
        $this->queryOpr[$index] = '';
        $this->queryVal[$index] = '';
    }

    public function render()
    {
        return view('livewire.po.user-filters-component');
    }
}
