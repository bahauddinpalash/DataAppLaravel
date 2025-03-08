<?php

namespace App\Http\Controllers\Bdm\Auth;

use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('bdm.auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);
    
        // Manually check if the email exists in the recruiters table
        $exists = DB::table('bdms')->where('email', $request->email)->exists();
    
        if (!$exists) {
            return back()->withErrors(['email' => 'We can’t find a user with that email address.']);
        }
    
        // Use the custom broker for recruiters
        $status = Password::broker('bdms')->sendResetLink(
            $request->only('email')
        );
    
        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }
    
}
