<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceLogoutMiddleware
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
        if (auth()->check() && auth()->user()->approved_status == 0) {
            auth()->logout(); // Log the user out
            return redirect()->route('login')->with('message', 'You have been logged out.');
        }

        return $next($request);
    }
}
