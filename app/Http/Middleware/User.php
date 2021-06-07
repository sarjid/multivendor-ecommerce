<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class User
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
        // if (auth()->user()->role =='user') {
        //     return $next($request);
        // }else {
        //     return redirect()->route(auth()->user()->role)->with('error','you dont have access');
        // }

        //we are using custom login resgister system.. so we get data from session
        if(empty(session('user'))){
            return redirect()->route('user.auth');
        }else {
            return $next($request);
        }



    }
}
