<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class AdminMiddleware
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
            return redirect()->route('home')->with(['fail' => 'U must be some kind of a hacker ?']);
        }

        if (Auth::user()->role != 'admin') {
            return redirect()->back()->with(['fail' => 'U must be some kind of a hacker ?']);
        }

        return $next($request);
    }
}
