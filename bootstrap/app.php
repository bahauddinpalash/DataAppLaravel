<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectTo(function () {
            // Check if the user is logged in as 'admin', 'bdm', or 'recruiter'
            if (Auth::guard('admin')->check()) {
                session(['role' => 'admin']);  // Store 'admin' role in session
                return '/admin/dashboard';  // Redirect admin to the dashboard
            }

            if (Auth::guard('bdm')->check()) {
                session(['role' => 'bdm']);  // Store 'bdm' role in session
                return '/bdm/dashboard';  // Redirect bdm to the dashboard
            }

            if (Auth::guard('recruiter')->check()) {
                session(['role' => 'recruiter']);  // Store 'recruiter' role in session
                return '/recruiter/dashboard';  // Redirect recruiter to the dashboard
            }

            // Prevent login to another role if the user is already logged in with a different role
            if (session()->has('role')) {
                $currentRole = session('role');

                // Block login attempts for a different role if the session has a role
                if ($currentRole === 'admin' && (request()->routeIs('bdm.login') || request()->routeIs('recruiter.login'))) {
                    return redirect('/admin/dashboard');
                }
                if ($currentRole === 'bdm' && (request()->routeIs('admin.login') || request()->routeIs('recruiter.login'))) {
                    return redirect('/bdm/dashboard');
                }
                if ($currentRole === 'recruiter' && (request()->routeIs('admin.login') || request()->routeIs('bdm.login'))) {
                    return redirect('/recruiter/dashboard');
                }
            }

            // For guests (not authenticated users)
            if (Auth::guard('admin')->guest()) {
                return '/admin/login';  // Redirect guest users to the admin login page
            }

            if (Auth::guard('bdm')->guest()) {
                return '/bdm/login';  // Redirect guest users to the bdm login page
            }

            if (Auth::guard('recruiter')->guest()) {
                return '/recruiter/login';  // Redirect guest users to the recruiter login page
            }

            // Default fallback redirect for unspecified conditions
            return '/login';  // Redirect to general login if no specific role matches
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Handle exceptions here if necessary
    })
    ->create();
    // $middleware->alias([
    //     'useradmin' => RoleMiddleware::class,
    // ]);