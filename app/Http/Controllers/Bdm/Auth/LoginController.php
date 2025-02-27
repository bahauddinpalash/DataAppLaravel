<?php

namespace App\Http\Controllers\Bdm\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\BdmLoginRequest;
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
        if(!empty(Auth::check())){
            return redirect('dashboard')->route('bdm.dashboard');
        }
        return view('bdm.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(BdmLoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('bdm.dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('bdm')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/bdm/login');
    }
}
