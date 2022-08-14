<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetAppLocale
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
        $accept_language = $request->header('accept_language');
        $array_lang = explode(',',$accept_language);
        $locale =$array_lang[0] ?? 'en' ;
        $locale = $request->query('lang',Session::get('lang',$locale));
        Session::put('lang',$locale);
        App::setLocale($locale);

        return $next($request);
    }
}
