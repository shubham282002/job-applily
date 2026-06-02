<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterSubjectController;
use App\Http\Controllers\MasterDescriptionController;
use App\Http\Controllers\GoogleController;


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

// Home
Route::get('/', function() {
    return redirect('/login');
});




Route::get('/google/connect',
    [GoogleController::class,'redirect']);

Route::get('/google/callback',
    [GoogleController::class,'callback']);
