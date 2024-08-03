<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureEmailIsVerified
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
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->hasVerifiedEmail()) {
                // Redirect verified users to the dashboard or another page
                return redirect('/dashboard');
            }

            // Redirect users who need to verify their email
            if (!$user->hasVerifiedEmail()) {
                return redirect()->route('verification.notice');
            }
        }

        // If the user is not authenticated, proceed with the request
        return $next($request);
    }
}
