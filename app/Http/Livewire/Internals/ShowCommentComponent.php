<?php

namespace App\Http\Livewire\Internals;

use App\Models\InternalComment;
use App\Models\LbsUserSearchSet;
use Livewire\Component;
use Livewire\WithFileUploads;

class ShowCommentComponent extends Component
{
    use WithFileUploads;

    public function emitNotifications($message, $msgType)
    {
        $this->emit('toast-notification-component',$message,$msgType);
    }

    protected $listeners =['open-edit-internal-comment'=>'fetchBaseInfo'];

    public $collections, $purchasing_doc_no=null, $line_item_no=null, $tableType;
    public $msg_body=null, $attachment=null ,$attachmentName =null;
    protected $rules = [
        'msg_body' => 'required',
    ];



    public function fetchBaseInfo($purchasing_doc_no, $line_item_no, $tableType ){

        $this->restInputs();
        $this->purchasing_doc_no=$purchasing_doc_no;
        $this->line_item_no=$line_item_no;
        $this->tableType=$tableType;
        $this->collections = InternalComment::where('table_type',$this->tableType)->where('purchasing_doc_no',$this->purchasing_doc_no)->where('line_item_no',$this->line_item_no)->get();
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
            $filename=$this->attachment->getClientOriginalName();
            $filepath = $this->attachment->storeAs('uploads',$filename,'public_uploads');
        }

        $insert= new InternalComment();
        $insert->admin_id=auth()->user()->id;
        $insert->name=auth()->user()->display_name;
        $insert->table_type=$this->tableType;
        $insert->purchasing_doc_no=$this->purchasing_doc_no;
        $insert->line_item_no=$this->line_item_no;
        $insert->msg_body=$this->msg_body;
        $insert->attachment=$filepath;
        if ($insert->save()){
            $this->dispatchBrowserEvent('scroll-down-chat');
            $this->restInputs();
            $this->fetchBaseInfo( $this->purchasing_doc_no, $this->line_item_no, $this->tableType );
            return $this->emitNotifications('data updated successfully','success');

        }
        return $this->emitNotifications('Something Went Wrong Please try after some time','error');
    }

    public function restInputs()
    {
        $this->msg_body=null;
        $this->attachment=null;
        $this->attachmentName =null;
    }

    public function render()
    {
        return view('livewire.internals.show-comment-component');
    }
}
