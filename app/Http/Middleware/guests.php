<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class guests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::check){
            return $next($request);
        }if(Auth::check && Auth::user()->hasVerifiedEmail()){
            return redirect('/dashboard');
        }if(Auth::check && !Auth::user()->hasVerifiedEmail()){
            return redirect()->route('verification.notice');
        }
    }
}
