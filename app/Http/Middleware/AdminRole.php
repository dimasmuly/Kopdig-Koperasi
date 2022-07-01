<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminRole
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
        // get session
        $data = session()->get('data');
        if(!isset($data['user']['role_id']) || $data['user']['role_id'] != 2) {
            return redirect()->route('login')->with('error', 'You are not authorized to access this page.');
        } else {
            return $next($request);
        }
    }
}
