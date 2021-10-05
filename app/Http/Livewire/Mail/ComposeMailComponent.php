<?php

namespace App\Http\Livewire\Mail;


use App\Models\LbsUserSearchSet;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ComposeMailComponent extends Component
{

    public $mail_to, $mail_subject, $mail_content;


    protected $listeners = ['event-show-compose-email' => 'prepareComposerModal'];

    protected $rules = [
        'mail_to' => 'required',
        'mail_subject' => 'required',
        'mail_content' => 'required',
    ];


    public function prepareComposerModal($mailType, $mail_data )
    {
        $this->mail_content=null;
        $this->mail_content = $this->fetchTemplate($mailType, $mail_data);
        $this->emit('set-mail-content', $this->mail_content);
        $this->dispatchBrowserEvent('open-mail-composer');

    }


    public function fetchTemplate($mailType, $mail_data)
    {

        if (empty($mailType)){
            return "write something...";
        }
        switch ($mailType){
            case 'enquiry-email':
                $this->mail_subject='enquiry email';
                return $getView= view('mail-templates.enquiry-email',compact('mail_data'))->render();

                break;
            case 'expedite-email':
                $this->mail_subject='expedite email';
                return $getView= view('mail-templates.expedite-email',compact('mail_data'))->render();
                break;
            case 'warning-email':
                $this->mail_subject='warning-email';
                return $getView= view('mail-templates.warning-email',compact('mail_data'))->render();
                break;
            case 'penalty-email':
                $this->mail_subject='penalty-email';
                return $getView= view('mail-templates.penalty-email',compact('mail_data'))->render();
                break;
            default:
                echo "no default template found";
        }
    }



    public function sendEmail()
    {

        $this->validate();

        $mailData=['msg_content'=>$this->mail_content,'msg_subject'=>$this->mail_subject];

        $emails_to=$this->mail_to;

        $emails_subject=$this->mail_subject;

        try {

            Mail::send('livewire.mail.notice-mailable', $mailData, function ($message) use ($emails_to,$emails_subject) {
                $message->to($emails_to)->subject($emails_subject);
            });

            if (Mail::failures()) {
                return redirect()->back()->with('error','mail sending failed, check log for more details');
            }
            $this->clearData();

            return redirect()->back()->with('success','mail send successfully');


        }catch (\Throwable $exception){
            return redirect()->back()->with('error',$exception->getMessage());
        }
    }

   public function clearData(){
       $this->mail_to=null;
       $this->mail_subject=null;
       $this->mail_content=null;
   }


    public function render()
    {
        return view('livewire.mail.compose-mail-component');
    }
}
