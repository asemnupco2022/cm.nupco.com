<?php

namespace App\Http\Livewire\Automation;

use App\Models\LbsUserSearchSet;
use App\Models\ScheduleNotification;
use Carbon\Carbon;
use Livewire\Component;


class CreateAutoComponent extends Component
{

    public function emitNotifications($message, $msgType)
    {
        $this->emit('toast-notification-component',$message,$msgType);
    }
    public $confirmBox=false;

    public $templateArray=LbsUserSearchSet::TEMPLATE_ARRAY;
    public $availableQuery=[];
    public $json_data_to_string;

   public $poTable='';
   public $poQuery='';
   public $subject=null;
   public $startTime=null;
   public $startDate=null;
   public $endDate=null;

   public $poTableName;
   public $selectedFilterName;

    public $selectedDays=[
        "mon",
        "tue",
        "wed",
        "thu",
        "fri",
        "sat",
        "sun"
    ];



    public function reset_schedule_input()
    {
        $this->poTable='';
        $this->poQuery='';
        $this->subject=null;
        $this->startTime=null;
        $this->startDate=null;
        $this->endDate=null;
        $this->selectedDays=[];

    }

    protected $rules = [
        'poTable' => 'required',
        'poQuery' => 'required',
        'subject' => 'required',
        'startTime' => 'required',
        'startDate' => 'required',
        'endDate' => 'required',
        'selectedDays' => 'required',
    ];


    public function updatedStartTime($value)
    {
        $this->startTime=Carbon::parse($value)->format('h:m');
    }

    public function updatedStartDate($value)
    {
        $this->startDate=Carbon::parse($value)->format('Y-m-d');
    }

    public function updatedEndDate($value)
    {
        $this->endDate=Carbon::parse($value)->format('Y-m-d');
    }

    public function dismiss_confirm_box()
    {
        $this->dispatchBrowserEvent('close-confirmation-box');
    }
    public function confirm_confirm_box()
    {
        $this->confirmBox=true;
        $this->save_scheduler();
    }

    public function save_scheduler()
    {

        $this->validate();

        if (!$this->confirmBox){

            return  $this->dispatchBrowserEvent('open-confirmation-box');
        }
        $store=new ScheduleNotification();
        $store->subject=$this->subject;
        $store->user_id=auth()->user()->id;
        $store->user_model='rifrocket\LaravelCms\Models\LbsAdmin';
        $store->table_type=$this->templateArray[$this->poTable] ;
        $store->table_model=$this->poTable;
        $store->filter_id=$this->poQuery;
        $store->json_data=LbsUserSearchSet::find($this->poQuery)->json_data;
        $store->day_recurrence='on';
        $store->recurrent_days=json_encode($this->selectedDays);
        $store->execute_at_date= $this->startDate;
        $store->execute_at_time=$this->startTime;
        $store->expires_at=$this->endDate;

        if ($store->save()){
            $this->reset_schedule_input();

            $this->emitNotifications('Schedules saved','success');
            return   $this->dispatchBrowserEvent('close-confirmation-box');
        }
        return  $this->emitNotifications('There is something error','error');
    }



    public function updatedPoTable($value)
    {
        $this->poTableName= $this->templateArray[$this->poTable];
        $tableTpe=$this->templateArray[$value];
        if (auth()->user()->role =='super_admin'){
            $userQueries=LbsUserSearchSet::onlyActive()->where('template_for_table',$tableTpe)->get();
        }else{
            $userQueries=LbsUserSearchSet::onlyActive()->where('template_for_table',$tableTpe)->where('user_id',auth()->user()->id )->get();
        }
        $this->availableQuery=$userQueries->pluck('template_name','id');
    }

    public function updatedpoQuery($value)
    {
        $this->selectedFilterName= $this->availableQuery[$value];
        $this->json_data_to_string=LbsUserSearchSet::find($value)->json_to_string;
    }

    public function render()
    {
        return view('livewire.automation.create-auto-component');
    }
}
