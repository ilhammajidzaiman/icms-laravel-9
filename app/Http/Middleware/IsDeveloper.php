<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsDeveloper
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
        if (!auth()->check() || auth()->user()->user_level_id !== 1) :
            abort(403);
        else :
            return $next($request);
        endif;
    }
}
