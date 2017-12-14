<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MentorMiddleware
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
            return redirect()->route('home')->with(['fail' => 'Only accessible to mentors ?']);
        }

        if (Auth::user()->role != 'mentor') {
            return redirect()->back()->with(['fail' => 'U must be some kind of a hacker ?']);
        }

        return $next($request);
    }
}
