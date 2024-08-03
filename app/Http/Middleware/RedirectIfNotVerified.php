<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotVerified
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
        if(Auth::check()){
            if (Auth::check() && !Auth::user()->hasVerifiedEmail()) {
                return redirect()->route('verification.notice');
            }elseif (Auth::check() && Auth::user()->hasVerifiedEmail()) {
                return redirect()->route('dashboard');
            }
        }

        return $next($request);
    }
}
