<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    // Redirect to Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->scopes(['https://www.googleapis.com/auth/gmail.send'])
            ->redirect();
    }

    // Handle Google callback
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Check if user exists
            $user = User::where('google_id', $googleUser->getId())->first();

            if ($user) {
                // Update tokens
                $user->update([
                    'google_access_token' => $googleUser->token,
                    'google_refresh_token' => $googleUser->refreshToken,
                    'google_email' => $googleUser->email,
                    'gmail_connected' => true,
                    'google_token_expires_at' => now()->addSeconds(3600), // 1 hour
                ]);
            } else {
                // Create new user (agar existing user login kar raha hai)
                $user = User::where('email', $googleUser->email)->first();

                if ($user) {
                    // Update existing user
                    $user->update([
                        'google_id' => $googleUser->getId(),
                        'google_access_token' => $googleUser->token,
                        'google_refresh_token' => $googleUser->refreshToken,
                        'google_email' => $googleUser->email,
                        'gmail_connected' => true,
                        'google_token_expires_at' => now()->addSeconds(3600),
                    ]);
                }
            }

            Auth::login($user);

            return redirect('/settings')->with('success', 'Gmail connected successfully!');

        } catch (\Exception $e) {
            return redirect('/settings')->withErrors(['error' => 'Failed to connect Gmail: ' . $e->getMessage()]);
        }
    }

    // Disconnect Gmail
    public function disconnectGmail()
    {
        auth()->user()->update([
            'google_id' => null,
            'google_access_token' => null,
            'google_refresh_token' => null,
            'google_email' => null,
            'gmail_connected' => false,
        ]);

        return back()->with('success', 'Gmail disconnected successfully!');
    }
}
