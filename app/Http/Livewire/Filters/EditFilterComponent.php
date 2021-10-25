<?php

namespace App\Http\Livewire\Filters;

use App\Helpers\PoHelper;
use App\Models\LbsUserSearchSet;
use App\Models\PoSapMaster;
use App\Models\SapLineView;
use Illuminate\Support\Arr;
use Livewire\Component;
use rifrocket\LaravelCms\Helpers\Classes\LbsConstants;

class EditFilterComponent extends Component
{
    public function emitNotifications($message, $msgType)
    {
        $this->emit('toast-notification-component',$message,$msgType);
    }

    public $model_id;
    public  $template_for_table=LbsUserSearchSet::TEMPLATE_SAP_LINE_ITEM;
    public $columns=PoSapMaster::CONS_COLUMNS;
    public $operators=LbsConstants::CONST_OPERATOR;


    public  $templateName;
    public  $templateLoops = [];
    public  $queryCol = [];
    public  $queryOpr = [];
    public  $queryVal = [];

    protected $listeners =['open-edit-user-search-template'=>'editFromListFilterCompo'];

    public function editFromListFilterCompo($model_id){

        $this->resetInputs();
        $this->model_id=$model_id;
        $this->fetchBaseInfo();
    }

    protected $rules = [
        'templateName' => 'required',
    ];


    public function mount()
    {
        $this->addNewRow();
    }

    public function fetchBaseInfo()
    {
        $fetch_Data= LbsUserSearchSet::find($this->model_id);
        $jsonData=json_decode($fetch_Data->json_data, true);

        $this->templateName=$fetch_Data->template_name;
        foreach ($jsonData as $key => $toString){

            $this->queryCol[$key]=$toString['queryCol'] ;
            $this->queryOpr[$key]=$toString['queryOpr'] ;
            $this->queryVal[$key]=$toString['queryVal'] ;
            $this->templateLoops[]=$key;
        }


        $this->queryCol[] = '';
        $this->queryOpr[] = '';

//        dd($this->templateLoops);
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
            return redirect()->back()->with('filter_error','Please select at least one condition');
        }

        $insert = LbsUserSearchSet::find($this->model_id);
        $insert->user_id=auth()->user()->id;
        $insert->template_name=$this->templateName;
        $insert->template_for_table=$this->template_for_table;
        $insert->json_data=$json_data;
        if ($insert->save()){
            $this->resetInputs();
            $this->emit('update-users-filter-template');
//            return redirect()->back()->with('filter_success','Data Saved Successfully');
            return $this->emitNotifications('data updated successfully','success');

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
        return view('livewire.filters.edit-filter-component');
    }
}
