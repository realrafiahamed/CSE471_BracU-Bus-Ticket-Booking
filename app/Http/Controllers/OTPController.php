<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OTPController extends Controller
{
    // Show 2FA password/confirmation page
    public function passwordForm()
    {
        session()->forget('2fa:otp'); // Clear previous OTP if any
        return view('auth.2fa-toggle');
    }

    // Verify password and generate OTP string
    public function verifyPassword(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);

        $user = auth()->user();

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Incorrect password']);
        }

        // Generate random 12-character string
        $randomString = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 12);
        $user->otp = $randomString;
        $user->otp_expires_at = now()->addMinutes(10); // valid 10 mins
        $user->save();

        session(['2fa:otp' => $randomString]);

        return view('auth.2fa-toggle', ['otp' => $randomString]); // reload same page with OTP
    }

    // Toggle 2FA using generated OTP
    public function toggle2FA(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|min:10|max:12'
        ]);

        $user = auth()->user();

        if ($request->otp !== session('2fa:otp') || now()->gt($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'Invalid or expired code']);
        }

        $user->two_factor_enabled = !$user->two_factor_enabled;
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        session()->forget('2fa:otp');

        return redirect()->route('dashboard')->with('success', '2FA status updated successfully');
    }

    // Legacy OTP login functions (if you still need OTP login)
    public function showVerifyForm(Request $request)
    {
        $userId = $request->session()->get('2fa:user:id');
        if (!$userId) {
            return redirect('/login')->withErrors(['login' => 'Session expired, please login again.']);
        }
        return view('auth.otp-verify');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|string']);
        $userId = $request->session()->get('2fa:user:id');
        $user = User::where('user_id', $userId)->firstOrFail();

        if (!$userId) {
            return redirect('/login')->withErrors(['login' => 'Session expired, please login again.']);
        }

        if ($user->otp !== $request->otp || Carbon::now()->gt($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP']);
        }

        Auth::login($user);
        $request->session()->forget('2fa:user:id');
        $request->session()->regenerate();

        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        return redirect()->route('dashboard');
    }
}

