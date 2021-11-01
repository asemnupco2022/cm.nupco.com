<?php

namespace App\Jobs\Po;

use App\Models\LbsUserSearchSet;
use App\Models\SchedulerNotificationHistory;
use App\Models\ScheduleNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use rifrocket\LaravelCms\Facades\LaravelCmsFacade;
use rifrocket\LaravelCms\Models\LbsMember;

class NotifySap implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $mail_to, $mail_subject, $pur_doc;

    public $vendor_code, $collection,$schedulerId, $mail_type;
    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct($vendor_code,$schedulerId, $collection,$mail_type)
    {
        $this->vendor_code=$vendor_code;
        $this->schedulerId=$schedulerId;
        $this->collection=$collection;
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
                return $getView= view('mail-templates.enquiry-email',compact('mail_data'))->render();

                break;
            case 'expedite-email':
                $this->mail_subject='expedite email';
                return $getView= view('mail-templates.expedite-email',compact('mail_data'))->render();
                break;
            case 'warning-email':
                $this->mail_subject='warning email';
                return $getView= view('mail-templates.warning-email',compact('mail_data'))->render();
                break;
            case 'penalty-email':
                $this->mail_subject='penalty email';
                return $getView= view('mail-templates.penalty-email',compact('mail_data'))->render();
                break;
            default:
                Log::error('mail-template-not-fount:'. $mailType);
                return null;
        }
    }


    public function sendEmail()
    {

        $ticket_number=LaravelCmsFacade::lbs_random_generator(16,true,false,true,false);
        $ticket_hash=Hash::make($ticket_number);
        $scheduler_colect=ScheduleNotification::find($this->schedulerId);
        $vendorInfo=LbsMember::where('vendor_code', $this->vendor_code)->first();

        if (!$vendorInfo){
            $logMessage= 'vendor not found for scheduler: '.$scheduler_colect->id; // do some code...
        }
        else{

            $mail_data=[
                'vendor_code'=>$vendorInfo->vendor_code,
                'vendor_name'=>$vendorInfo->dislay_name,
                'customer_name'=>'',
                'sap_object'=>$this->collection,
                'hash_token'=>$ticket_hash
            ];

            $mailData=['msg_content'=>$this->fetchTemplate($this->mail_type,$mail_data),'msg_subject'=>$this->mail_subject];
            $messageBody =view('mail-templates.mail-container',$mailData)->render();

            // $emails_to=$this->mail_to=$vendorInfo->email;
            $emails_to=$this->mail_to='aasorayea@nupco.com';
            $emails_subject=$scheduler_colect->subject;

            try {

                Mail::send('mail-templates.mail-container', $mailData, function ($message) use ($emails_to,$emails_subject) {
                    $message->to($emails_to)->subject($emails_subject);
                });

                if (Mail::failures()) {
                    $logMessage='mail sending failed, check log for more details';
                }else{
                    $logMessage='mail send successfully-';


                    $schedulerHistory=new SchedulerNotificationHistory();

                    $schedulerHistory->broadcast_type ='automation';
                    $schedulerHistory->mail_ticket_number   =$ticket_number;
                    $schedulerHistory->mail_ticket_hash   = $ticket_hash;  // ;
                    $schedulerHistory->mail_type =$this->mail_type;
                    $schedulerHistory->table_type =LbsUserSearchSet::TEMPLATE_SAP_LINE_ITEM;
                    $schedulerHistory->sender_user_id =$scheduler_colect->user_id;
                    $schedulerHistory->sender_user_model =$scheduler_colect->user_model;
                    $schedulerHistory->sender_name =$scheduler_colect->userName->username;
                    $schedulerHistory->sender_email = $scheduler_colect->user_model::find($scheduler_colect->user_id)->display_name;    ///need to change
                    $schedulerHistory->recipient_user_id =$vendorInfo->id;    ///need to change
                    $schedulerHistory->recipient_user_model ="rifrocket\\LaravelCms\\Models\\LbsMember";    ///need to change
                    $schedulerHistory->recipient_email =$vendorInfo->email;
                    $schedulerHistory->msg_subject =$scheduler_colect->subject;
                    $schedulerHistory->msg_body =$messageBody;
                    $schedulerHistory->execute_at_date =$scheduler_colect->execute_at_date;
                    $schedulerHistory->execute_at_time =$scheduler_colect->execute_at_time;
                    $schedulerHistory->last_executed_at =$scheduler_colect->last_executed_at;
                    $schedulerHistory->meta =$scheduler_colect->meta;
                    $schedulerHistory->json_data =$scheduler_colect->json_data;
                    $schedulerHistory->save();

                    dispatch(new HosAPI($this->vendor_code,$this->mail_type,$this->collection,$ticket_number,$ticket_hash));

                }


            }catch (\Throwable $exception){
                $logMessage= $exception->getMessage();
            }
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
