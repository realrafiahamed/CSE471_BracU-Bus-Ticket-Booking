<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    // Redirect user to Google for authentication
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    // Handle callback from Google
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::where('email', $googleUser->email)->first();

        if (!$user) {
            // Create new Google user
            $user = User::create([
                'first_name'       => explode(' ', $googleUser->name)[0],
                'last_name'        => explode(' ', $googleUser->name)[1] ?? '',
                'name'             => $googleUser->name,
                'email'            => $googleUser->email,
                'password'         => Hash::make(uniqid()), // dummy password
                'email_verified_at'=> now(),
                'is_google_user'   => 1,
            ]);
        }

        // Log in user (existing or new)
        Auth::login($user, false);
        session()->regenerate();

        return redirect()->route('dashboard');
    }
}
