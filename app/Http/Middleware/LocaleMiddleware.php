<?php

namespace App\Http\Middleware;

use App\Setting;
use Closure;

class LocaleMiddleware
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
        $locale = session('locale');
        if (empty($locale)){
            $locale = app()->getLocale();
        }
        app()->setLocale($locale);
        session(['locale'=>$locale]);
        return $next($request);
    }
}
