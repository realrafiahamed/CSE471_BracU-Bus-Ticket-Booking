<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->is_google_user) {
            // Google users → ignore current_password entirely
            $validated = $request->validate([
                'password' => ['required', Password::min(6), 'confirmed'],
            ]);

            $user->password = Hash::make($validated['password']);
            $user->is_google_user = 0; // now behaves like normal user
            $user->save();

            return back()->with('success', 'Password updated successfully.');

        }

        // Normal users → must validate current_password
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::min(6), 'confirmed'],
        ]);

        $user->password = Hash::make($validated['password']);
        $user->save();

        return back()->with('success', 'Password updated successfully.');
    }

}
