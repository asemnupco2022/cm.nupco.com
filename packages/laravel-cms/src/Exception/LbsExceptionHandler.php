<?php


namespace rifrocket\LaravelCms\Exception;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as AppHandler;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Throwable;
use Exception;

class LbsExceptionHandler extends AppHandler
{

    public function render($request, Throwable  $exception)
    {
        if ($request->wantsJson()) {   //add Accept: application/json in request

            return $this->handleApiException($request, $exception);
        } else {
            $retval = parent::render($request, $exception);
        }
        return $retval;
    }

    private function handleApiException($request, Exception $exception)
    {
        $exception = $this->prepareException($exception);

        if ($exception instanceof HttpResponseException) {
            $exception = $exception->getResponse();
        }

        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            return  $exception = $this->unauthenticated($request, $exception);
        }

        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            $exception = $this->convertValidationExceptionToResponse($exception, $request);
        }

        return $this->customApiResponse($exception);
    }

    private function customApiResponse($exception)
    {
        if (method_exists($exception, 'getCode')) {

            $statusCode = $exception->getCode();
            $statusCode= $statusCode==0?401:$statusCode;
        } else {
            $statusCode = 500;
        }

        $response = [];

        switch ($statusCode) {
            case 0:
                $response['response_status'] = 'error';
                $response['response_message'] = 'Unauthorized ';
                $response['response_body'] = [];
                $response['response_description'] = ['Passed_Records','Failed_Records','Excluded_Records','Excluded_Records','Error_Records'];
                break;

            case 401:
                $response['response_status'] = 'error';
                $response['response_message'] = 'Unauthorized';
                $response['response_body'] = [];
                $response['response_description'] = ['Passed_Records','Failed_Records','Excluded_Records','Excluded_Records','Error_Records'];
                break;
            case 403:
                $response['response_status'] = 'error';
                $response['response_message'] = 'Forbidden';
                $response['response_body'] = [];
                $response['response_description'] = ['Passed_Records','Failed_Records','Excluded_Records','Excluded_Records','Error_Records'];
                break;
            case 404:
                $response['response_status'] = 'error';
                $response['response_message'] = 'Not Found';
                $response['response_body'] = [];
                $response['response_description'] = ['Passed_Records','Failed_Records','Excluded_Records','Excluded_Records','Error_Records'];
                break;
            case 405:
                $response['response_status'] = 'error';
                $response['response_message'] = 'Method Not Allowed';
                $response['response_body'] = [];
                $response['response_description'] = ['Passed_Records','Failed_Records','Excluded_Records','Excluded_Records','Error_Records'];
                break;
            case 422:
                $response['response_status'] = 'error';
                $response['response_message'] = $exception->original['message'];
                $response['response_body'] = [];
                $response['response_description'] = ['Passed_Records','Failed_Records','Excluded_Records','Excluded_Records','Error_Records'];
                break;
            default:
                $response['response_status'] = 'error';
                $response['response_message'] = ($statusCode == 500) ? 'Whoops, looks like something went wrong' : $exception->getMessage();
                $response['response_body'] = [];
                $response['response_description'] = ['Passed_Records','Failed_Records','Excluded_Records','Excluded_Records','Error_Records'];
                break;
        }

        if (config('app.debug')) {
            $response['trace'] = $exception->getTrace();
            $response['code'] = $exception->getCode();
        }

        $response['response_code'] = $statusCode;

        return response()->json($response, $statusCode);
    }


//    Error path for admin side and web side
    protected function registerErrorViewPaths()
    {
        $paths = collect(config('laravelcrm.exception.member_exception_views'));

        if (config('laravelcrm.application.ssl')=='true'){
            $admin_root='https://'.config('laravelcrm.application.route_domain').'.'.env('APP_DOMAIN');
        }
        else{
            $admin_root='http://'.config('laravelcrm.application.route_domain').'.'.env('APP_DOMAIN');
        }

        if ((Request::root()==$admin_root) )
        {
            $paths = collect(config('laravelcrm.exception.admin_exception_views'));
            View::replaceNamespace('errors', $paths->map(function ($path) {
                return "{$path}";
            })->push(__DIR__.'/views')->all());
        }
        else
        {
            View::replaceNamespace('errors', $paths->map(function ($path) {
                return "{$path}";
            })->push(__DIR__.'/views')->all());
        }

    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {

        if ( $request->expectsJson()){

            return $this->customApiResponse($exception);
        }
        $guard=$exception->guards()[0];
        switch ($guard)
        {
            case 'admin':
                return redirect()->route('lbs.auth.admin.login');
                break;

            case 'member_api':
                return $this->customApiResponse($exception);
                break;

            default:
                return redirect()->guest('/login');
                break;
        }

    }
}
