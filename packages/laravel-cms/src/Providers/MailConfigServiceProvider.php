<?php


namespace rifrocket\LaravelCms\Providers;


use rifrocket\LaravelCms\Models\LbsSetting;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $LbsAppSession = [];
        $emailServices='';
        $appSession = LbsSetting::all()->toArray();
        if ($appSession and !empty($appSession)) {

            foreach ($appSession as $key => $value) {

                $LbsAppSession["{$value['setting_meta_key']}"] = $value['setting_meta_value'];
            }
            $slice = Arr::only($LbsAppSession, [
                'app_mailer_host',
                'app_mailer_login',
                'app_mailer_pass',
                'app_mailer_mail',
                'app_mailer_port',
                'app_mailer_encrypt',
                'app_company',
            ]);
            $emailServices = json_decode(json_encode($slice));
        }


        if ($emailServices and !empty($emailServices)) {

            $app_mailer_host= $emailServices->app_mailer_host;
            $app_mailer_port= $emailServices->app_mailer_port;
            $app_mailer_encrypt= $emailServices->app_mailer_encrypt;
            $app_mailer_login= $emailServices->app_mailer_login;
            $app_mailer_pass= $emailServices->app_mailer_pass;

            $mailer_mail=$emailServices->app_mailer_mail;
            $mailer_name=$emailServices->app_company;

        }
        else
        {

            $app_mailer_host= env('MAIL_HOST', 'smtp.mailgun.org');
            $app_mailer_port= env('MAIL_PORT', 587);
            $app_mailer_encrypt=env('MAIL_ENCRYPTION', 'tls');
            $app_mailer_login= env('MAIL_USERNAME');
            $app_mailer_pass=  env('MAIL_PASSWORD');

            $mailer_mail=env('MAIL_FROM_ADDRESS', 'hello@example.com');
            $mailer_name=env('MAIL_FROM_NAME', 'Example');

        }


        $config = array(
            /*
            |--------------------------------------------------------------------------
            | Default Mailer
            |--------------------------------------------------------------------------
            |
            | This option controls the default mailer that is used to send any email
            | messages sent by your application. Alternative mailers may be setup
            | and used as needed; however, this mailer will be used by default.
            |
            */

            'default' => env('MAIL_MAILER', 'smtp'),

            /*
            |--------------------------------------------------------------------------
            | Mailer Configurations
            |--------------------------------------------------------------------------
            |
            | Here you may configure all of the mailers used by your application plus
            | their respective settings. Several examples have been configured for
            | you and you are free to add your own as your application requires.
            |
            | Laravel supports a variety of mail "transport" drivers to be used while
            | sending an e-mail. You will specify which one you are using for your
            | mailers below. You are free to add additional mailers as required.
            |
            | Supported: "smtp", "sendmail", "mailgun", "ses",
            |            "postmark", "log", "array"
            |
            */

            'mailers' => [
                'smtp' => [
                    'transport' => 'smtp',
                    'host' => $app_mailer_host,
                    'port' => $app_mailer_port,
                    'encryption' => $app_mailer_encrypt,
                    'username' => $app_mailer_login,
                    'password' => $app_mailer_pass,
                    'timeout' => null,
                    'auth_mode' => null,
                ],

                'ses' => [
                    'transport' => 'ses',
                ],

                'mailgun' => [
                    'transport' => 'mailgun',
                ],

                'postmark' => [
                    'transport' => 'postmark',
                ],

                'sendmail' => [
                    'transport' => 'sendmail',
                    'path' => '/usr/sbin/sendmail -bs',
                ],

                'log' => [
                    'transport' => 'log',
                    'channel' => env('MAIL_LOG_CHANNEL'),
                ],

                'array' => [
                    'transport' => 'array',
                ],
            ],

            /*
            |--------------------------------------------------------------------------
            | Global "From" Address
            |--------------------------------------------------------------------------
            |
            | You may wish for all e-mails sent by your application to be sent from
            | the same address. Here, you may specify a name and address that is
            | used globally for all e-mails that are sent by your application.
            |
            */

            'from' => [
                'address' => $mailer_mail,
                'name' => $mailer_name,
            ],

            /*
            |--------------------------------------------------------------------------
            | Markdown Mail Settings
            |--------------------------------------------------------------------------
            |
            | If you are using Markdown based email rendering, you may configure your
            | theme and component paths here, allowing you to customize the design
            | of the emails. Or, you may simply stick with the Laravel defaults!
            |
            */

            'markdown' => [
                'theme' => 'default',

                'paths' => [
                    resource_path('views/vendor/mail'),
                ],
            ]);

        Config::set('mail', $config);
    }
}
