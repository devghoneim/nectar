<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
          $lang = $request->query('lang', $request->header('X-Lang', config('app.locale')));
            app()->setLocale(in_array($lang, ['ar','en']) ? $lang : config('app.locale'));
        return $next($request);
    }
}
