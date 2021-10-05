<?php


namespace rifrocket\LaravelCms\Http\Middlewares;

use rifrocket\LaravelCms\Facades\LaravelCmsFacade;
use rifrocket\LaravelCms\Models\LbsSetting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class LbsAppSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $LbsAppSession=[];
        $slice =  [
            'app_company',
            'app_domain',
            'app_url',
            'app_local',
            'app_logo',
            'app_favicon',
            'app_title',
            'app_email',
            'app_meta_key',
            'app_meta_disruption',
            'app_recaptcha',
            'app_meta_key',
            'app_meta_disruption',
            'app_version',
            'app_media_resize'
        ];
        $appSession=LbsSetting::AppSetting($slice);

        if ($appSession AND !empty($appSession)){

            $LbsAppSession=json_decode(json_encode($appSession));

            $reCaptcha_key=LaravelCmsFacade::lbs_object_key_exists('app_recaptcha_key',Session::get('_LbsAppSession'));
            $reCaptcha_secret=LaravelCmsFacade::lbs_object_key_exists('app_recaptcha_secret',Session::get('_LbsAppSession'));

            Config::set('captcha.secret',$reCaptcha_secret);
            Config::set('captcha.sitekey',$reCaptcha_key);

        }
        Session::put('_LbsAppSession',$LbsAppSession);
        Session::save();
        return $next($request);
    }
}
