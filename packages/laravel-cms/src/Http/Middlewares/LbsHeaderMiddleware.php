<?php


namespace rifrocket\LaravelCms\Http\Middlewares;


use Closure;

class LbsHeaderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

//        $response->header('X-Frame-Options', 'DENY');
//        $response->header('Permissions-Policy', 'geolocation=(self "https://africamlive.us"), microphone=(), camera=()');
//        $response->header('X-Content-Type-Options', 'nosniff');
//        $response->header('Referrer-Policy', 'no-referrer-when-downgrade');
//        $response->header("Access-Control-Allow-Methods", "POST, PUT, GET, OPTIONS, DELETE");

//         $response->header('Access-Control-Allow-Origin','http://localhost:8080');
         $response->header('Access-Control-Allow-Origin','http://localhost:8080');
//        $response->header('Access-Control-Allow-Origin','http://crmfront.projectdemotest.com');
        $response->header('Access-Control-Allow-Credentials','true');
        $response->header('Access-Control-Allow-Headers','*');
        $response->header("Access-Control-Allow-Headers", "Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With,observe,access-control-allow-origin");
        return $response;
    }
}
