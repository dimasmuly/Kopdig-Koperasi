<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BlockAccessUser
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
        $data = session()->get('data');

        // if user already logged in, redirect to home page
        if(isset($data['user'])) {
            return back();
        } else {
            return $next($request);
        }
    }
}
