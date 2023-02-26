<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
     public function handle($request, Closure $next, ...$roles)
    {
        if(! Auth::user())
            return redirect()->back();
        foreach($roles as $role) {
            if(Auth::user()->role === $role){
                return $next($request);
             }
        }
        return redirect()->back(); 
    }
}
