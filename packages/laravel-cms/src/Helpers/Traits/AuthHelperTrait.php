<?php


namespace rifrocket\LaravelCms\Helpers\Traits;

use rifrocket\LaravelCms\Facades\LaravelCmsFacade;
use rifrocket\LaravelCms\Helpers\Classes\LbsConstants;
use rifrocket\LaravelCms\Models\LbsResetPassword;
use Illuminate\Mail\Message;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

trait AuthHelperTrait
{
    public static function lbs_login($model, array $requests,$redirect,$guard)
    {

        try {

           $userInfo=self::lbs_getUserInfo($model, $requests);
            if (empty($userInfo)){
                return session()->flash('error','email address or password does not exist.');
            }

            if ($userInfo and $userInfo->deleted_at != null){
                return session()->flash('error','This account does not  exist anymore');
            }

            if ($userInfo->status != LbsConstants::STATUS_ACTIVE){
                return session()->flash('error','your account has been '.$userInfo->status);
            }
            if (self::attemptLogin($requests,$guard)) {

                self::lbs_userSession($guard,$model);
                return redirect(self::redirectPath($redirect));
            }
            return session()->flash('error','email address or password does not exist.');

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

    }

    public static function lsb_logout($guard,$redirect)
    {
        Auth::guard($guard)->logout();
        Session::invalidate();
        Session::regenerateToken();
        return redirect(self::redirectPath($redirect));
    }


    public static function lbs_forgetPassword($model,$requests)
    {
        try {

            $userInfo=self::lbs_getUserInfo($model, $requests);
            if (!$userInfo){
                return session()->flash('error','email address or password does not exist.');
            }
            if ($userInfo->deleted_at != null){
                return session()->flash('error','This account does not  exist anymore');
            }
            if ($userInfo->status != LbsConstants::STATUS_ACTIVE){
                return session()->flash('error','your account has been '.$userInfo->status);
            }

            $company_email=(LaravelCmsFacade::lbs_object_key_exists('app_mailer_mail',Session::get('_LbsAppSession')));
            $from=$company_email==null?config('lbs-laravel-cms.application.default_email'):$company_email;
            if (config('lbs-laravel-cms.passport_api_token.api_forget_password_otp_length') != 'false'){
                $resetToken=LaravelCmsFacade::lbs_random_generator(config('lbs-laravel-cms.passport_api_token.api_forget_password_otp_length'));
            }else{
                $resetToken=LaravelCmsFacade::lbs_random_generator(15,true,true,false);
            }

            $email=$requests['email'];
            $resetPassword=new LbsResetPassword();
            $resetPassword->email=$email;
            $resetPassword->token=$resetToken;
            $resetPassword->provider=$model;
            $resetPassword->expires_at=now()->addHours(1);
            $resetPassword->save();
            $data=[
                'email'=>$email,
                'token'=>$resetToken,
            ];
            Mail::send('LbsViews::mails.reset_password',$data,function (Message  $message) use ($email,$from){
                $message->from($from);
                $message->to($email);
                $message->subject('Reset your password');
            });
           return 'An Email is sent to you registered email address';

        }catch (\Exception $exception){

            return $exception->getMessage();
        }
    }


    public static function lbs_restPassword($model,$requests,$guard,$redirect)
    {
        $requests= Arr::only($requests, ['id','password']);
        $userInfo= LaravelCmsFacade::lbs_model_update($requests['id'], $requests, $model);
        if ($userInfo and !empty($userInfo) and gettype($userInfo)=='array'){
            if (self::attemptLogin($requests,$guard)) {
                return redirect(self::redirectPath($redirect));
            }
        }
        return $userInfo;
    }

    public static function lbs_userSession($guard,$model)
    {
        if (Auth::guard($guard)->check()) {
            $userInfo=self::lbs_getUserInfo($model,['email'=>Auth::guard($guard)->user()->email]);
            Session::put('_LbsUserSession',$userInfo);
            Session::save();
            $LbsLteSession=[];
            if (self::lbs_get_LteSettingInfo('lsb_lte_setting',['admin_id'=>$userInfo->id])){
                $LbsLteSession=self::lbs_get_LteSettingInfo('lsb_lte_setting',['admin_id'=>$userInfo->id]);
            }
            Session::put('_LbsLteSession',$LbsLteSession);
            Session::save();
        }
    }


    public static function lbs_getUserInfo($model,$requests)
    {
        //Requests -- Grab  Request Filters
//            $requests = $request->all();
       $requests= Arr::only($requests, ['email']);

        //filters -- Set Additional Filters
//            $requests['deleted_at']='null';

        //plucks -- Plucks Special Records Only
//            $requests['pluck_id']='pluck_id';

        //restrictions -- Restrict Special Records
        $restrictFilters=['meta_password'];

        //isNotFilters -- Where Not Equal to Value
        $isNotFilters=[];

        //customSearch
        $customSearch=[];
//            $customSearch['column']='category_id';                                   //column name
//            $customSearch['value']=$categoryId;                                   //value name
//            $customSearch['operator']=Constants::SEARCH_CONDTION_ANYWHERE;         //operator name


//            Group by column data
        $groupBy=null;

//            Pagination
        $paginate=[];
//            $paginate['pageNo']=1;   //page number
//            $paginate['perPage']=5;  //data on per page

       $userInfo= LaravelCmsFacade::lbs_list_model_meta_data($model, $requests, $restrictFilters, $isNotFilters, true,$customSearch,$groupBy,$paginate);

       if (!empty($userInfo) and !$userInfo->isEmpty()){

            return (object)collect($userInfo[0])->all();
        }
        return [];
    }


    public static function lbs_get_LteSettingInfo($model, array $requests)
    {
        //Requests -- Grab  Request Filters
//            $requests = $request->all();

        //filters -- Set Additional Filters
//            $requests['deleted_at']='null';

        //plucks -- Plucks Special Records Only
//            $requests['pluck_id']='pluck_id';

        //restrictions -- Restrict Special Records
        $restrictFilters=[];

        //isNotFilters -- Where Not Equal to Value
        $isNotFilters=[];

        //customSearch
        $customSearch=[];
//            $customSearch['column']='category_id';                                   //column name
//            $customSearch['value']=$categoryId;                                   //value name
//            $customSearch['operator']=Constants::SEARCH_CONDTION_ANYWHERE;         //operator name


//            Group by column data
        $groupBy=null;

//            Pagination
        $paginate=[];
//            $paginate['pageNo']=1;   //page number
//            $paginate['perPage']=5;  //data on per page

        $userLteSetting= LaravelCmsFacade::lbs_list_model_meta_data($model, $requests, $restrictFilters, $isNotFilters, true,$customSearch,$groupBy,$paginate);
        if (!empty($userLteSetting) and !$userLteSetting->isEmpty()){
            return (object)collect($userLteSetting[0])->all();
        }
        return null;
    }

    public static function attemptLogin($requests,$guard)
    {

        $requests= Arr::only($requests, ['email','password','rememberMe']);
        return self::guard($guard)->attempt(
            ['email' =>$requests['email'],'password' =>$requests['password']], $requests['rememberMe'] );
    }

    protected static function redirectPath($redirect)
    {
        return route($redirect);
    }

    protected static function guard($guard)
    {
        return Auth::guard($guard);
    }
}
