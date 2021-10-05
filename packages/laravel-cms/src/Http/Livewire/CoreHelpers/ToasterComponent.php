<?php
namespace rifrocket\LaravelCms\Http\Livewire\CoreHelpers;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ToasterComponent  extends Component
{
    protected $listeners = ['toast-notification-component' => 'set_session_toaster'];

    public function set_session_toaster($message, $msgType)
    {
        if ($msgType=='success'){
            $this->dispatchBrowserEvent('alert',['type' => 'success',  'message' => $message]);
        }
        if ($msgType=='error'){
            $this->dispatchBrowserEvent('alert',['type' => 'error',  'message' =>$message]);
        }
    }


    public function render()
    {
        return view('LbsViews::livewire.CoreHelpers.core-helper-toaster-component');
    }
}
