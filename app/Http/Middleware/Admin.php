<?php

namespace App\Http\Middleware;

use Closure;
use Helpers;

class Admin
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
        if (Helpers::isLogin() == 1) {
            return $next($request);
        }
        alert()->error('Silahkan login terlebih dahulu!', 'Perhatian!')->persistent("OK");
        return redirect('/');
    }
}
