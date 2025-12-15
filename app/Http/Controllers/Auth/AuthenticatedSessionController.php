<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'phone_no';

        $user = User::where($loginField, $request->login)->first();

        if (!$user || !\Hash::check($request->password, $user->password)) {
            return back()->withErrors(['login' => 'Invalid credentials.']);
        }

        // ✅ 2FA enabled
        if ($user->two_factor_enabled) {

            $otp = rand(100000, 999999);

            $user->otp = $otp;
            $user->otp_expires_at = Carbon::now()->addMinutes(10);
            $user->save();

            Mail::raw("Your login OTP is: $otp", function ($message) use ($user) {
                $message->to($user->email)->subject('Login OTP');
            });
            
            // ✅ ONLY store session value — DO NOT regenerate / invalidate
            $request->session()->put('2fa:user:id', $user->user_id);
            
            return redirect()->route('2fa.verify.form');
        }

        // ❌ No 2FA → normal login
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
