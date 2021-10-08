<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PrivateTokenMiddleware
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
        if (
            !(App::environment('local'))
            && (
                !$request->header('private-access-token')
                || $request->header('private-access-token') !== env('PRIVATE_APP_API_TOKEN')
            )
        ) {
            return response()->json(['success'=>false,'msg' => 'You do not access to this api.'], 403);
        }

        return $next($request);
    }
}
