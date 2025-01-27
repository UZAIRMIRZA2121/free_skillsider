<?php

namespace App\Http\Middleware;


use Auth;
use Closure;
use Illuminate\Http\Request;

class StudentMiddleware
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
       if(Auth::check() && Auth::user()->role == 0 &&  Auth::user()->status == 1)
        {
            return $next($request);
        }   
        else
        {
             return redirect()->route('login.page'); // Redirect unauthorized users to the home page or a login page.
        }

      
    }
}
