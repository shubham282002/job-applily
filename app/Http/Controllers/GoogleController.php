<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')
            ->stateless()
            ->scopes([
                'https://www.googleapis.com/auth/gmail.send'
            ])
            ->redirect();
    }

    public function callback()
{
    $googleUser = Socialite::driver('google')
                    ->stateless()
                    ->user();

                    dd($googleUser);
    $userId = session('google_connect_user_id');

    $user = User::find($userId);

    if (!$user) {
        return redirect('/login')
            ->with('error', 'User session expired.');
    }

    $user->google_access_token = $googleUser->token;
    $user->google_refresh_token = $googleUser->refreshToken ?? null;
    $user->google_email = $googleUser->email;
    $user->save();

    return redirect('/dashboard')
        ->with('success', 'Gmail Connected Successfully');
}
}
