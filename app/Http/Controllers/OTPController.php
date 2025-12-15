<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;

class OTPController extends Controller
{
    public function showVerifyForm(Request $request)
    {
        $userId = $request->session()->get('2fa:user:id');

        if (!$userId) {
            return redirect('/login')->withErrors([
                'login' => 'Session expired, please login again.'
            ]);
        }

        return view('auth.otp-verify');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6'
        ]);

        $userId = $request->session()->get('2fa:user:id');
        $user = User::where('user_id', $userId)->firstOrFail();

        if (!$userId) {
            return redirect('/login')->withErrors([
                'login' => 'Session expired, please login again.'
            ]);
        }

        $user = User::findOrFail($userId);

        if (
            $user->otp !== $request->otp ||
            Carbon::now()->gt($user->otp_expires_at)
        ) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP']);
        }

        // ✅ FINAL LOGIN HERE
        Auth::login($user);

        $request->session()->forget('2fa:user:id');
        $request->session()->regenerate();

        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        return redirect()->route('dashboard');
    }
}
