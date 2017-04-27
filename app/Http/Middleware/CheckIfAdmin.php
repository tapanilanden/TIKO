<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;

class CheckIfAdmin
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
        if (Auth::user()->role < 2) {
            return $next($request);
        }
        else {
            Session::flash('error', 'Sinulla ei ole oikeutta tähän toimintoon');
            return redirect('/');
        }
        
    }
}
