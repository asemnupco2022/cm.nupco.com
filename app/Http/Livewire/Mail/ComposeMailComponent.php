<?php

namespace App\Http\Livewire\Mail;


use App\Helpers\PoHelper;
use App\Models\LbsUserSearchSet;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use rifrocket\LaravelCms\Facades\LaravelCmsFacade;
use rifrocket\LaravelCms\Models\LbsMember;


class ComposeMailComponent extends Component
{

    public $mail_to, $mail_subject, $mail_content,$mailType_pro,$tableType, $mailableData;



    protected $listeners = ['event-show-compose-email' => 'prepareComposerModal'];

    protected $rules = [
        'mail_to' => 'required',
        'mail_subject' => 'required',
        'mail_content' => 'required',
    ];


    public function prepareComposerModal($mailType, $mail_data, $tableType, $to)
    {

       
        $this->mail_to=$to;
        $this->mailableData=$mail_data;
        $this->mail_content=null;
        $this->mailType_pro=$mailType;
        $this->tableType=$tableType;
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
                $this->mail_subject=PoHelper::NormalizeColString('enquiry email');
                return $getView= view('mail-templates.enquiry-email',compact('mail_data'))->render();

                break;
            case 'expedite-email':
                $this->mail_subject=PoHelper::NormalizeColString('expedite email');
                return $getView= view('mail-templates.expedite-email',compact('mail_data'))->render();
                break;
                case 'warning-email':
                $this->mail_subject=PoHelper::NormalizeColString('warning email');
                return $getView= view('mail-templates.warning-email',compact('mail_data'))->render();
                break;
            case 'penalty-email':
                $this->mail_subject=PoHelper::NormalizeColString('penalty email');
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
                $message->to($emails_to)->subject($emails_subject)->bcc('developer.tech.dev@gmail.com');
            });

            if (Mail::failures()) {
                return redirect()->back()->with('error','mail sending failed, check log for more details');
            }

            $messageBody =view('mail-templates.mail-container',$mailData)->render();
            $vendorDetails=LbsMember::where('vendor_code',$this->mailableData['vendor_code'])->first();
            $ticket_number=LaravelCmsFacade::lbs_random_generator(16,true,false,true,false);
            $ticket_hash=Hash::make($ticket_number);
            $notifiable=  [
                'broadcast_type'=>'manual',
                'mail_ticket_number'=>$ticket_number,
                'mail_ticket_hash'=>$ticket_hash,
                'mail_type'=>$this->mailType_pro,
                'table_type'=>$this->tableType,
                'sender_user_id'=>auth()->user()->id,
                'sender_user_model'=>"rifrocket\\LaravelCms\\Models\\LbsAdmin",
                'sender_name'=>auth()->user()->display_name,
                'sender_email'=>auth()->user()->email,
                'recipient_user_id'=>$vendorDetails?$vendorDetails->id:null,
                'recipient_user_model'=>"rifrocket\\LaravelCms\\Models\\LbsMember",
                'recipient_email'=>$this->mail_to,
                'msg_subject'=>$this->mail_subject,
                'msg_body'=>$messageBody,
                'execute_at_date'=>Carbon::now()->format('Y-m-d'),
                'execute_at_time'=>Carbon::now()->format('h:m'),
                'last_executed_at'=>Carbon::now()->format('Y-m-d'),
                'meta'=>null,
                'json_data'=>null,
            ];
            PoHelper::SaveNotificationHistory($notifiable, $this->mailableData);



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
