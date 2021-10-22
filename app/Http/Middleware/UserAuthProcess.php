<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserAuthProcess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!empty(session('user'))){
            return redirect()->route('user.dashboard');
        }else {
            return $next($request);
        }
    }
}
