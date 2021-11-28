<?php

namespace App\Http\Livewire\Staffs;

use App\Mail\UserRegister;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use rifrocket\LaravelCms\Helpers\Classes\LbsConstants;
use rifrocket\LaravelCms\Models\LbsAdmin;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class CreateStaffComponent extends Component
{
    public function emitNotifications($message, $msgType)
    {
        $this->emit('toast-notification-component',$message,$msgType);
    }

    public $permissionArray=[];
    public $employee_num=null;
    public $first_name=null;
    public $last_name=null;
    public $username=null;
    public $email=null;
    public $phone=null;
    public $permissions=[];

    protected $rules = [
     'employee_num'=>'required|unique:lbs_admins',
     'first_name'=>'required',
     'last_name'=>'required',
     'email'=>'required',
     'phone'=>'required',
    ];

    public function updatedFirstName($value)
    {
        if ($this->first_name and $this->last_name){
            $this->username=Str::replace(' ', '', ($this->first_name.$this->last_name));
        }
    }

    public function updatedLastName($value)
    {
        if ($this->first_name and $this->last_name){
            $this->username=Str::replace(' ', '', ($this->first_name.$this->last_name));
        }
    }

    public function mount()
    {
       $this->permissionArray= Permission::where('deleted_at', null)->where('status','active')->pluck('display_name','name');
    }


    public function saveStaff()
    {

        $this->validate();
        $saveStaff=new LbsAdmin();
        $saveStaff->employee_num = $this->employee_num;
        $saveStaff->first_name = $this->first_name;
        $saveStaff->last_name = $this->last_name;
        $saveStaff->username = $this->username;
        $saveStaff->password = Hash::make($this->username);
        $saveStaff->display_name = $this->first_name.' '.$this->last_name;
        $saveStaff->email = $this->email;
        $saveStaff->role = LbsConstants::STAFF_ROLE;
        $saveStaff->phone = $this->phone;

        if ($saveStaff->save()){
            Mail::to($saveStaff)->send(new UserRegister($this->email, $this->username));
            $saveStaff->syncPermissions($this->permissions);
            $this->search_reset();
            return $this->emitNotifications('data updated successfully','success');
        }else{
            return $this->emitNotifications('There is something wrong','error');
        }
    }

    public function search_reset()
    {
        $this->employee_num=null;
        $this->first_name=null;
        $this->last_name=null;
        $this->username=[];
        $this->email=null;
        $this->phone=null;
        $this->dispatchBrowserEvent('reset-permission-select2');
    }

    public function render()
    {
        return view('livewire.staffs.create-staff-component');
    }
}
