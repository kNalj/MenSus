<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class StudentMiddleware
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

        if (!Auth::user()) {
            return redirect()->route('home')->with(['fail' => 'Only accessible to logged in users']);
        }

        if (Auth::user()->role != 'student') {
            return redirect()->back()->with(['fail' => 'Only accessible to students']);
        }

        return $next($request);
    }
}
