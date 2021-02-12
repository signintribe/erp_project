<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Middleware;

use Closure;
use Auth;

/**
 * Description of IsUser
 *
 * @author Attique
 */
class IsUser {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (auth()->user()->is_admin == 2) {
            if (auth()->user()->is_verify == 1) {
                return $next($request);
            } else {
                Auth::logout();
                return redirect()->route('login')->withInput()->withErrors(['status' => 'Your account is not activate']);
            }
        } else {
            Auth::logout();
            return redirect(route('login'))->withInput()->withErrors(['status' => 'Sorry… You are not user this page is only for user account']);
        }
    }

}
