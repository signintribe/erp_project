<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class SuperAdmin
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
        if(auth()->user()->is_admin == 4){
            return $next($request);
        }
   
        Auth::logout();
        return redirect(route('login'))->withInput()->withErrors(['status' => 'Sorry… You are not super this page is only for super account']);
    }
}
