<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next): Response
    {   
        if (Auth::guard()->check()) {
            return $next($request);
        }
        else
        {
            Auth::logout();
            return redirect(url(''));
        }
        // Redirect unauthenticated users to the admin login page
        // return redirect()->route('admin.login')->with('error', 'Please log in as an admin.');
        


        // // Check the current guard
        // if ($role == 'admin' && Auth::guard('admin')->check()) {
        //     return $next($request);
        // }

        // if ($role == 'bdm' && Auth::guard('bdm')->check()) {
        //     return $next($request);
        // }

        // if ($role == 'recruiter' && Auth::guard('recruiter')->check()) {
        //     return $next($request);
        // }

        // // If the user is not logged in for the specified role, redirect to login
        // return redirect()->route("{$role}.login");
    }
}
