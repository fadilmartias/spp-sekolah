<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // session()->forget('locales');
        // session()->forget('locale');

        $locales = [
            [
                'code' => 'en',
                'name' => 'English',
                'flag_code' => 'us'
            ],
            [
                'code' => 'id',
                'name' => 'Indonesia',
                'flag_code' => 'id'
            ],
        ];
        if (!session()->has('locales')) {
            session(['locales' => $locales]);
        }
        if (session()->has('locale')) {
            App::setLocale(session('locale')['code']);
        }
        return $next($request);
    }
}
