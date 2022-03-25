<?php

namespace App\Jobs\SapAutomation;

use App\Helpers\PoHelper;
use App\Models\LbsUserSearchSet;
use App\Models\NupAutoSetting;
use Carbon\Carbon;
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
use rifrocket\LaravelCms\Models\LbsMember;

class FullAutomationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $mailType, $mail_data, $to;
    public $mail_to, $mail_subject, $mail_content, $mailType_pro, $tableType, $mailableData, $importance;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mailType, $mail_data, $tableType, $to)
    {
        $this->mailType=$mailType;
        $this->mail_data=$mail_data;
        $this->mailableData = $mail_data;
        $this->tableType= $tableType;
        $this->mailType_pro = $mailType;
        $this->to=$to;
        $this->mail_to = $to;
        $this->importance =0;
        $this->mail_content = null;

    }


    public function fetchTemplate($mailType, $mail_data)
    {

        if (empty($mailType)) {
            return "write something...";
        }
        switch ($mailType) {
            case 'enquiry-email':
                $this->mail_subject = PoHelper::NormalizeColString('warning email');
                return $getView = view('mail-templates.enquiry-email', compact('mail_data'))->render();

                break;
            case 'expedite-email':
                $this->mail_subject = PoHelper::NormalizeColString('remider email');
                return $getView = view('mail-templates.expedite-email', compact('mail_data'))->render();
                break;
            case 'warning-email':
                $this->mail_subject = PoHelper::NormalizeColString('warning email');
                return $getView = view('mail-templates.warning-email', compact('mail_data'))->render();
                break;
            case 'penalty-email':
                $this->mail_subject = PoHelper::NormalizeColString('penalty email');
                return $getView = view('mail-templates.penalty-email', compact('mail_data'))->render();
                break;
            default:
                echo "no default template found";
        }
    }


    public function sendEmail()
    {
        switch ($this->mailType_pro) {
            case 'enquiry-email':
                $this->mailType_pro = 'warning-email';
                break;

            case 'expedite-email':
                $this->mailType_pro = 'reminder-email';
                break;

            default:
                $this->mailType_pro = 'reminder-email';
                break;
        }



        $mailData = ['msg_content' => $this->mail_content, 'msg_subject' => $this->mail_subject];

        $emails_to = $this->mail_to;
        $this->mail_to = $emails_to;

        $autoSetting = NupAutoSetting::where('setting_for_table', LbsUserSearchSet::TEMPLATE_SAP_LINE_ITEM)->first();
        $currentMAils=null;
        if ($autoSetting) {
            if($autoSetting->setting_switch== 'quality'){
                 $currentMAils= $this->mail_to;
                $emails_to = $autoSetting->test_email;

                $this->mail_to = $autoSetting->test_email;
            }
        }

        $emails_subject = $this->mail_subject;

        try {

            Mail::send('livewire.mail.notice-mailable', $mailData, function ($message) use ($emails_to, $emails_subject) {
                $message->to($emails_to)->subject($emails_subject)->bcc('developer.tech.dev@gmail.com');
            });

            if (Mail::failures()) {
                PoHelper::createLogChennel('full-automate.log');
                return  Log::channel('custom_chennel')->info('mail sending failed, check email', [$emails_to]);
            }

            if ($autoSetting) {
            if($autoSetting->setting_switch == 'quality'){
                PoHelper::createLogChennel('full-automate-flight-mode.log');
                return  Log::channel('custom_chennel')->info('automated mail: ', ['mail-to'=> $currentMAils, 'brocastType' => $emails_subject,'vendor_code'=> $this->mailableData['vendor_code']]);
                }
                exit;
            }




            $messageBody = view('livewire.mail.notice-mailable', $mailData)->render();
            $vendorDetails = LbsMember::where('vendor_code', $this->mailableData['vendor_code'])->first();
            $ticket_number = LaravelCmsFacade::lbs_random_generator(16, true, false, true, false);
            $ticket_hash = Hash::make($ticket_number);
            $notifiable =  [
                'broadcast_type' => 'automation',
                'mail_ticket_number' => $ticket_number,
                'mail_ticket_hash' => $ticket_hash,
                'mail_type' => $this->mailType_pro,
                'table_type' => $this->tableType,
                'sender_user_id' =>null,
                'sender_user_model' => null,
                'sender_name' => null,
                'sender_email' => 'automated-no-reply@nupco.com',
                'recipient_user_id' => $vendorDetails ? $vendorDetails->id : null,
                'recipient_user_model' => "rifrocket\\LaravelCms\\Models\\LbsMember",
                'recipient_name' => $vendorDetails ? $vendorDetails->display_name : null,
                'recipient_email' => $this->mail_to,
                'msg_subject' => $this->mail_subject,
                'msg_body' => $messageBody,
                'execute_at_date' => Carbon::now()->format('Y-m-d'),
                'execute_at_time' => Carbon::now()->format('h:m'),
                'last_executed_at' => Carbon::now(),
                'importance' => $this->importance,
                'meta' => null,
                'json_data' => null,
            ];
            $this->mailableData['mail_objects']['importance'] = $this->importance;

            PoHelper::SaveNotificationHistory($notifiable, $this->mailableData);

            PoHelper::createLogChennel('full-automate.log');
            return  Log::channel('custom_chennel')->info('done', [$emails_to]);

        } catch (\Throwable $exception) {

            PoHelper::createLogChennel('full-automate.log');
            return  Log::channel('custom_chennel')->info('mail sending failed, check log for more details', [$exception->getMessage()]);

        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->mail_content = $this->fetchTemplate($this->mailType, $this->mail_data);
        $this->sendEmail();
    }
}
