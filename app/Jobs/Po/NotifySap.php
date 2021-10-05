<?php

namespace App\Jobs\Po;

use App\Models\LbsUserSearchSet;
use App\Models\PoSapMasterSchedle;
use App\Models\ScheduledHistory;
use App\Models\ScheduleNotification;
use App\Models\TicketManager;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use rifrocket\LaravelCms\Facades\LaravelCmsFacade;

class NotifySap implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $mail_to, $mail_subject, $pur_doc,$mail_type;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($pur_doc, $mail_type)
    {
        $this->pur_doc=$pur_doc;
        $this->mail_type=$mail_type;
    }



    public function fetchTemplate($mailType, $mail_data)
    {

        if (empty($mailType)){
            return "write something...";
        }
        switch ($mailType){
            case 'enquiry-email':
                $this->mail_subject='enquiry email';
                return $getView= view('mail-templates.sap-enquiry-email',compact('mail_data'))->render();

                break;
            case 'expedite-email':
                $this->mail_subject='expedite email';
                return $getView= view('mail-templates.expedite-email',compact('mail_data'))->render();
                break;
            case 'warning-email':
                $this->mail_subject='warning email';
                return $getView= view('mail-templates.sap-warning-email',compact('mail_data'))->render();
                break;
            case 'penalty-email':
                $this->mail_subject='penalty email';
                return $getView= view('mail-templates.penalty-email',compact('mail_data'))->render();
                break;
            default:
                Log::error('sap-mail-template-not-fount:'. $mailType);
                return null;
        }
    }


    public function sendEmail()
    {

        $ticket_number=LaravelCmsFacade::lbs_random_generator(16,true,false,true,false);
        $ticket_hash=Hash::make($ticket_number);

        $sapDataFirst=PoSapMasterSchedle::where('vendor_code', $this->pur_doc)->first();
        $sapData=PoSapMasterSchedle::where('vendor_code', $this->pur_doc)->get();
        $mail_data=[
            'vendor_code'=>$sapDataFirst->vendor_code,
            'vendor_name'=>$sapDataFirst->vendor_name,
            'customer_name'=>$sapDataFirst->customer_name,
            'sap_object'=>$sapData,
            'hash_token'=>$ticket_hash
        ];
        $mailData=['msg_content'=>$this->fetchTemplate($this->mail_type,$mail_data),'msg_subject'=>$this->mail_subject];

        $messageBody =view('mail-templates.mail-container',$mailData)->render();
        Log::info($messageBody);
        $emails_to=$this->mail_to='developer@gmail.com';

        $emails_subject=$this->mail_subject='testing';

        try {

//            Mail::send('mail-templates.mail-container', $mailData, function ($message) use ($emails_to,$emails_subject) {
//                $message->to($emails_to)->subject($emails_subject);
//            });

//            if (Mail::failures()) {
//                $logMessage='mail sending failed, check log for more details';
//            }else{
                $logMessage='mail send successfully';

                $scheduler=ScheduleNotification::find($sapDataFirst->scheduler_id);



                $schedulerHistory=new ScheduledHistory();
                $schedulerHistory->ticket_number =$ticket_number;
                $schedulerHistory->ticket_hash  =$ticket_hash;
                $schedulerHistory->table_type  =LbsUserSearchSet::TEMPLATE_SAP_LINE_ITEM;
                $schedulerHistory->table_model ="App\\Models\\SapMasterView";
                $schedulerHistory->sender_user_id =$scheduler->user_id;
                $schedulerHistory->sender_user_model =$scheduler->user_model;
                $schedulerHistory->sender_name =$scheduler->userName->username;
                $schedulerHistory->sender_email ='mc.nupco.com';    ///need to change
                $schedulerHistory->recipient_user_id =1;    ///need to change
                $schedulerHistory->recipient_user_model ="rifrocket\\LaravelCms\\Models\\LbsMember";    ///need to change
                $schedulerHistory->recipient_email =$this->mail_to;

                $schedulerHistory->msg_subject =$this->mail_subject;
                $schedulerHistory->msg_body =$messageBody;
                $schedulerHistory->year_recurrence =$scheduler->year_recurrence;
                $schedulerHistory->month_recurrence =$scheduler->month_recurrence;
                $schedulerHistory->day_recurrence =$scheduler->day_recurrence;
                $schedulerHistory->execute_at_date =$scheduler->execute_at_date;
                $schedulerHistory->execute_at_time =$scheduler->execute_at_time;
                $schedulerHistory->last_executed_at =$scheduler->last_executed_at;
                $schedulerHistory->expires_at =$scheduler->expires_at;
                $schedulerHistory->meta =$scheduler->meta;
                $schedulerHistory->json_data =$scheduler->json_data;
                $schedulerHistory->status =$scheduler->status;
                $schedulerHistory->save();



//                $ticketManager=new TicketManager();
//                $ticketManager->ticket_number=$ticket_number;
//                $ticketManager->ticket_hash=Hash::make($ticket_number);

//            }


        }catch (\Throwable $exception){
            $logMessage= $exception->getMessage();
        }

        Log::info($logMessage);

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->sendEmail();
    }
}
