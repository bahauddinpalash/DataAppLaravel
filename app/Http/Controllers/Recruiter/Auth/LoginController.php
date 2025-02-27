<?php

namespace App\Http\Controllers\Recruiter\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RecruiterLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('recruiter.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(RecruiterLoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('recruiter.dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('recruiter')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/recruiter/login');
    }
}
