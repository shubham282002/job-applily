@extends('layouts.app')

@section('title', 'Settings')

@section('content')

<div class="max-w-4xl mx-auto px-6 py-10">

    <!-- Header -->
    <div class="mb-10">
        <h2 class="text-3xl font-bold text-gray-900">Settings</h2>
        <p class="text-gray-600 mt-2">Manage your account and preferences</p>
    </div>

    <!-- Success Message -->
    @if($message = Session::get('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
            {{ $message }}
        </div>
    @endif

    <!-- Grid Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        <!-- Profile Settings -->
        <div class="bg-white rounded-xl border border-gray-100 p-8">
            <h3 class="text-xl font-bold text-gray-900 mb-6">Profile Settings</h3>

            <form action="/settings/profile" method="POST" class="space-y-5">
                @csrf

                <!-- Name -->
                <div>
                    <label class="block text-sm font-600 text-gray-900 mb-2">Full Name</label>
                    <input
                        type="text"
                        name="name"
                        value="{{ auth()->user()->name }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                        required
                    >
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-600 text-gray-900 mb-2">Email Address</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ auth()->user()->email }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                        required
                    >
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Save Button -->
                <button
                    type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-600 py-3 rounded-lg transition"
                >
                    Save Profile
                </button>

            </form>
        </div>

        <!-- Change Password -->
        <div class="bg-white rounded-xl border border-gray-100 p-8">
            <h3 class="text-xl font-bold text-gray-900 mb-6">Change Password</h3>

            <form action="/settings/password" method="POST" class="space-y-5">
                @csrf

                <!-- Current Password -->
                <div>
                    <label class="block text-sm font-600 text-gray-900 mb-2">Current Password</label>
                    <input
                        type="password"
                        name="current_password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                        required
                    >
                    @error('current_password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Password -->
                <div>
                    <label class="block text-sm font-600 text-gray-900 mb-2">New Password</label>
                    <input
                        type="password"
                        name="password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                        required
                    >
                    @error('password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-sm font-600 text-gray-900 mb-2">Confirm Password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                        required
                    >
                </div>

                <!-- Save Button -->
                <button
                    type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-600 py-3 rounded-lg transition"
                >
                    Update Password
                </button>

            </form>
        </div>

    </div>

    <!-- Gmail Connection Section -->
    <div class="mt-8 bg-white rounded-xl border border-gray-100 p-8">
        <div class="flex items-start gap-4 mb-6">
            <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center text-2xl">
                📧
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900">Gmail Connection</h3>
                <p class="text-gray-600 text-sm mt-1">Connect your Gmail account to send emails securely via OAuth</p>
            </div>
        </div>

        @if(auth()->user()->gmail_connected)
            <!-- Already Connected -->
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                <p class="text-green-700 font-500">✓ Gmail connected</p>
                <p class="text-green-600 text-sm mt-1">{{ auth()->user()->google_email }}</p>
                <p class="text-green-600 text-xs mt-2">
                    Token expires: {{ auth()->user()->google_token_expires_at->format('M d, Y H:i') }}
                </p>
            </div>

            <!-- Disconnect Button -->
            <form action="/auth/google/disconnect" method="POST">
                @csrf
                <button
                    type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white font-600 px-6 py-3 rounded-lg transition"
                    onclick="return confirm('Are you sure? You won\'t be able to send emails after this.')"
                >
                    Disconnect Gmail
                </button>
            </form>
        @else
            <!-- Connect Button -->
            <a
                href="/auth/google"
                class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-600 px-6 py-3 rounded-lg transition"
            >
                🔗 Connect Gmail with OAuth
            </a>
            <p class="text-sm text-gray-500 mt-3">
                Click the button above to securely connect your Gmail account. You'll be redirected to Google for authentication.
            </p>
        @endif
    </div>

    <!-- Account Info -->
    <div class="mt-8 bg-gray-50 rounded-xl border border-gray-200 p-8">
        <h3 class="text-xl font-bold text-gray-900 mb-6">Account Information</h3>

        <div class="space-y-4">
            <div class="flex justify-between items-center py-3 border-b border-gray-200">
                <p class="text-gray-600 font-500">Account Status</p>
                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-600">Active</span>
            </div>

            <div class="flex justify-between items-center py-3 border-b border-gray-200">
                <p class="text-gray-600 font-500">Member Since</p>
                <p class="text-gray-900 font-500">{{ auth()->user()->created_at->format('M d, Y') }}</p>
            </div>

            <div class="flex justify-between items-center py-3">
                <p class="text-gray-600 font-500">Last Login</p>
                <p class="text-gray-900 font-500">{{ auth()->user()->updated_at->format('M d, Y H:i') }}</p>
            </div>
        </div>
    </div>

</div>

@endsection
