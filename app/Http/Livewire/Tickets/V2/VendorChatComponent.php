<?php

namespace App\Http\Livewire\Tickets\V2;

use App\Helpers\PoHelper;
use App\Models\HosPostHistory;
use App\Models\TicketManager;
use App\Models\TicketMasterHeadr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;

class VendorChatComponent extends Component
{

    use WithFileUploads;

    public function emitNotifications($message, $msgType)
    {
        $this->emit('toast-notification-component',$message,$msgType);
    }

    protected $listeners =['open-edit-vendor-comment'=>'fetchBaseInfo'];

    public $mail_ticket_hash, $notificationHistory, $allLineItems;
    public $collections;
    public $headerInfo;
    public $unique_line;

    public $msg_body=null, $attachment=null ,$attachmentName =null , $ticketHash=null, $ticketParent;
    protected $rules = [
        'msg_body' => 'required',
    ];

    public function fetchBaseInfo($purchasing_doc_no, $line_item_no, $tableType )
    {


        $this->unique_line =$purchasing_doc_no.'_'.$line_item_no;

        $ticketMAnager=TicketMasterHeadr::where('unique_line',$this->unique_line)->first();


          if( !$ticketMAnager ){
              $this->dispatchBrowserEvent('close-edit-vendor-comment');
            return $this->emitNotifications('No Conversation Found','error');
          }
        $this->restInputs();
        $this->purchasing_doc_no=$purchasing_doc_no;
        $this->line_item_no=$line_item_no;
        $this->tableType=$tableType;

        $this->dispatchBrowserEvent('scroll-down-chat');
        $this->fetchChat();
        // dd($this->collections);
    }

    public function fetchChat()
    {

        $this->restInputs();
        $this->collections = TicketManager::where('unique_line',$this->unique_line)->get();
        foreach ($this->collections as $key => $value) {
            TicketManager::find($value->id)->update(['msg_read_at'=>Carbon::now()]);
        }
        $this->ticketParent =TicketMasterHeadr::where('unique_line',$this->unique_line)->first();
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
        $fileOriginalName=null;
        if ($this->attachment){
            $fileOriginalName=$this->attachment->getClientOriginalName();
            $filename=date('ymdHis').'_'.$this->attachment->getClientOriginalName();
            $filepath = $this->attachment->storeAs('uploads/vendorChat',$filename,'public_uploads');
        }

        $insert= new TicketManager();
        $insert->ticket_hash=$this->unique_line;
        $insert->unique_line=$this->unique_line;
        $insert->staff_user_id=auth()->user()->id;
        $insert->staff_user_model="rifrocket\\LaravelCms\\Models\\LbsAdmin";
        $insert->staff_name=auth()->user()->display_name;
        $insert->staff_email=auth()->user()->email;
        $insert->vendor_user_id=$this->ticketParent->has_vendor->id;
        $insert->vendor_user_model="rifrocket\\LaravelCms\\Models\\LbsMember";
        $insert->vendor_name=$this->ticketParent->has_vendor->display_name;
        $insert->vendor_email=$this->ticketParent->has_vendor->email;
        $insert->msg_sender_id='staff';
        $insert->msg_body=$this->msg_body;
        $insert->msg_receiver_id='vendor';
        $insert->attachment=$filepath;
        $insert->attachment_name=$fileOriginalName;
        $insert->msg_read_at=Carbon::now();
        if ($insert->save()){


            TicketMasterHeadr::where('unique_line',$this->unique_line)->first()->update(['updated_at'=>Carbon::now(),'line_status'=>'closed']);
            $this->sendToHos($this->ticketParent->has_vendor->vendor_code, $this->ticketHash, $this->msg_body,$filepath,$fileOriginalName);

            $this->dispatchBrowserEvent('scroll-down-chat');
            $this->restInputs();
            // $this->fetchBaseInfo();
            $this->collections =  TicketManager::where('unique_line',$this->unique_line)->get();
            return $this->emitNotifications('data updated successfully','success');
        }
        return $this->emitNotifications('Something Went Wrong Please try after some time','error');
    }

    public function sendToHos($vendor, $unique_hash, $contract_team_comment, $file=null, $fileName=null)
    {
        $url=env('HOS_API_BASE').'/HOS_S4/api/contractor-reply';
        $send=[
            "vendor_num" => $vendor,
            "unique_hash" => $unique_hash,
            "po_num"=>$this->ticketParent->po_num,
            "po_item_num"=>$this->ticketParent->po_item_num,
            "contract_team_comment" =>$contract_team_comment,
            "attachment_info"=>[
                "original_file_name" => $fileName,
                "file_path"=>$file,
                ],
        ];
       $response = Http::get($url, $send);
        Log::info('response',[$response]);

        $hosLog = PoHelper::hosLogs( $response, 'send response to HOS for sap line item: '.json_encode($send), 'SEND', 'SAP_LINE_ITEM');
                Log::info('HOS-API-LOG',[$hosLog]);

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
        return view('livewire.tickets.v2.vendor-chat-component');
    }
}
