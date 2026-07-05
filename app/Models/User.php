<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Http;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'google_email',
        'google_access_token',
        'google_refresh_token',
        'google_token_expires_at',
        'gmail_connected',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'google_access_token',
        'google_refresh_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'google_token_expires_at' => 'datetime',
        'gmail_connected' => 'boolean',
    ];

    // Check if Gmail connected
    public function isGmailConnected()
    {
        return $this->gmail_connected && $this->google_access_token;
    }

    // Get valid access token (refresh if expired)
    public function getValidAccessToken()
    {
        if ($this->google_token_expires_at && $this->google_token_expires_at->isPast()) {
            $this->refreshGoogleToken();
        }

        return $this->google_access_token;
    }

    // Refresh Google token
    public function refreshGoogleToken()
    {
        try {
            $response = Http::post('https://oauth2.googleapis.com/token', [
                'client_id' => config('services.google.client_id'),
                'client_secret' => config('services.google.client_secret'),
                'refresh_token' => $this->google_refresh_token,
                'grant_type' => 'refresh_token',
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $this->update([
                    'google_access_token' => $data['access_token'],
                    'google_token_expires_at' => now()->addSeconds($data['expires_in']),
                ]);

                return true;
            }
        } catch (\Exception $e) {
            \Log::error('Google token refresh failed: ' . $e->getMessage());
        }

        return false;
    }
}
