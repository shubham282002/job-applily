<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterSubjectController;
use App\Http\Controllers\MasterDescriptionController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\OAuthController;


// Public routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


    // Master Routes
    Route::resource('masters/subjects', MasterSubjectController::class);
    Route::resource('masters/descriptions', MasterDescriptionController::class);

});

// Settings Routes
Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
Route::post('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile');
Route::post('/settings/password', [SettingsController::class, 'changePassword'])->name('settings.password');

// OAuth routes
Route::get('/auth/google', [OAuthController::class, 'redirectToGoogle'])->name('oauth.google');
Route::get('/auth/google/callback', [OAuthController::class, 'handleGoogleCallback'])->name('oauth.google.callback');
Route::post('/auth/google/disconnect', [OAuthController::class, 'disconnectGmail'])->name('oauth.google.disconnect');

// Home
Route::get('/', function() {
    return redirect('/login');
});
