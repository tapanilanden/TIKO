<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;

class CheckTask
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
        if ((Auth::user()->role == 1)
        || (Auth::user()->id == \App\Task::find($request->id)->user_id)) {
            return $next($request);
        }
        else {
            Session::flash('error', 'Sinulla ei ole oikeutta tähän toimintoon');
            return redirect('/');
        }
        
    }
}
