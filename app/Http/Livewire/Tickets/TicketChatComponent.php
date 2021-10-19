<?php

namespace App\Http\Livewire\Tickets;

use App\Models\HosPostHistory;
use App\Models\InternalComment;
use App\Models\NotificationHistory;
use App\Models\TicketManager;
use Livewire\Component;
use Livewire\WithFileUploads;

class TicketChatComponent extends Component
{

    use WithFileUploads;
    public function emitNotifications($message, $msgType)
    {
        $this->emit('toast-notification-component',$message,$msgType);
    }


    public $mail_ticket_hash, $notificationHistory, $allLineItems;
    public $collections;

    public $msg_body=null, $attachment=null ,$attachmentName =null , $ticketHash=null, $ticketParent;

    protected $rules = [
        'msg_body' => 'required',
    ];

    public function mount()
    {
        $this->fetchBaseInfo();
    }


    public function fetchBaseInfo(){

        $this->notificationHistory =NotificationHistory::where('mail_ticket_hash',base64_decode($this->mail_ticket_hash))->first();
        $this->allLineItems=HosPostHistory::where('mail_hash',base64_decode($this->mail_ticket_hash))->get();
    }

    public function fetchChat($value)
    {

        $this->restInputs();
        $this->ticketHash=$value;
        $this->collections = TicketManager::where('ticket_hash',$value)->get();
        $this->ticketParent = HosPostHistory::with('VendorData')->where('unique_hash',$value)->first();
        $this->dispatchBrowserEvent('scroll-down-chat');
    }

    public function updatedAttachment($value)
    {
        $this->validate([
            'attachment' => 'max:1024',
        ]);
        $this->attachmentName=$this->attachment->getClientOriginalName();
    }

    public function saveComment()
    {
        $this->validate();
        $filepath=null;
        if ($this->attachment){
            $filename=date('ymdHis').'_'.$this->attachment->getClientOriginalName();
            $filepath = $this->attachment->storeAs('uploads/vendorChat',$filename,'public_uploads');
        }

        $insert= new TicketManager();
        $insert->ticket_hash=$this->ticketHash;
        $insert->staff_user_id=auth()->user()->id;
        $insert->staff_user_model="rifrocket\\LaravelCms\\Models\\LbsAdmin";
        $insert->staff_name=auth()->user()->display_name;
        $insert->staff_email=auth()->user()->email;
        $insert->vendor_user_id=$this->ticketParent->VendorData->id;
        $insert->vendor_user_model="rifrocket\\LaravelCms\\Models\\LbsMember";
        $insert->vendor_name=$this->ticketParent->VendorData->display_name;
        $insert->vendor_email=$this->ticketParent->VendorData->email;
        $insert->msg_sender_id='staff';
        $insert->msg_body=$this->msg_body;
        $insert->msg_receiver_id='vendor';
        $insert->attachment=$filepath;
        if ($insert->save()){
            $this->dispatchBrowserEvent('scroll-down-chat');
            $this->restInputs();
            $this->fetchBaseInfo();
            $this->collections = TicketManager::where('ticket_hash',$this->ticketHash)->get();
            return $this->emitNotifications('data updated successfully','success');
        }
        return $this->emitNotifications('Something Went Wrong Please try after some time','error');
    }

    public function restInputs()
    {
        $this->msg_body=null;
        $ticketHash=null;
        $ticketParent=null;
        $attachment=null;
        $attachmentName =null;
    }

    public function render()
    {
        return view('livewire.tickets.ticket-chat-component');
    }
}
