<?php


namespace rifrocket\LaravelCms\Http\Middlewares;


use rifrocket\LaravelCms\Facades\LaravelCmsFacade;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class LbsUserSession
{
    public function handle($request, Closure $next, $guard = null,$model=null)
    {
        $LbsLteSession=[];
        switch ($guard) {
            case 'admin':
                if (Auth::guard($guard)->check()) {
                    $userInfo=LaravelCmsFacade::lbs_getUserInfo($model,['email'=>Auth::guard($guard)->user()->email]);
                    Session::put('_LbsUserSession',$userInfo);
                    Session::save();
                    if (self::lbs_get_LteSettingInfo($model,[])){
                        $LbsLteSession=self::lbs_get_LteSettingInfo($model,[]);
                    }
                    Session::put('_LbsLteSession',$LbsLteSession);
                    Session::save();
                }
                break;

            default:
                if (Auth::guard($guard)->check()) {
//                    return redirect('/home');
                }
                break;
        }

        return $next($request);
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

        $userInfo= LaravelCmsFacade::lbs_list_model_meta_data($model, $requests, $restrictFilters, $isNotFilters, true,$customSearch,$groupBy,$paginate);
        if (gettype($userInfo)=='array' and !empty($userInfo) and !$userInfo->isEmpty()){
            return (object)collect($userInfo[0])->all();
        }
        return null;
    }
}
