<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
       if (Auth::user() && in_array(Auth::user()->role, [1, 2, 3, 4])) {
    return $next($request);
}
        
         else
        {
             return redirect()->route('login.page'); // Redirect unauthorized users to the home page or a login page.
        }

    }
}
