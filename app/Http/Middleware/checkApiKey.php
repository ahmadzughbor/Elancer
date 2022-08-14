<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class checkApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $key = $request->header('x-api-key');
        // return Response::json(['key'=> $key]);
        if($key !== config('app.api_key'))
        {
            return Response::json([
                'message' => 'invalid api key'
            ],400);
        }
        $user=Auth::guard('sanctum')->user();
        if($user){
        $user->currentAccessToken()->forceFill([
            'ip_address' => $request->ip()
        ])->save();
        }
        return $next($request);
    }
}
