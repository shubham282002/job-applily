@extends('layouts.guest')

@section('title', 'Login')

@section('content')

<div x-data="loginForm()" class="w-full max-w-md">

    <!-- Card -->
    <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">

        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Welcome Back!</h1>
            <p class="text-gray-600 mt-2">Login to your account</p>
        </div>

        <!-- Form -->
        <form @submit.prevent="submitForm()" class="space-y-5">

            <!-- Email Field -->
            <div>
                <label class="block text-sm font-600 text-gray-700 mb-2">Email Address</label>
                <input
                    type="email"
                    x-model="form.email"
                    placeholder="email@example.com"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                >
                <p x-show="errors.email" class="text-red-600 text-sm mt-1" x-text="errors.email"></p>
            </div>

            <!-- Password Field -->
            <div>
                <div class="flex justify-between items-center mb-2">
                    <label class="block text-sm font-600 text-gray-700">Password</label>
                    <a href="#" class="text-blue-600 text-sm hover:underline">Forgot?</a>
                </div>
                <div class="relative">
                    <input
                        :type="showPassword ? 'text' : 'password'"
                        x-model="form.password"
                        placeholder="Your password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition pr-12"
                    >
                    <button
                        type="button"
                        @click="showPassword = !showPassword"
                        class="absolute right-4 top-3 text-gray-500 hover:text-gray-700"
                    >
                        <span x-text="showPassword ? '👁️' : '🔒'"></span>
                    </button>
                </div>
                <p x-show="errors.password" class="text-red-600 text-sm mt-1" x-text="errors.password"></p>
            </div>

            <!-- Remember Me -->
            <div class="flex items-center gap-2">
                <input
                    type="checkbox"
                    x-model="form.remember"
                    id="remember"
                    class="w-4 h-4 rounded border-gray-300 text-blue-600"
                >
                <label for="remember" class="text-sm text-gray-600">Mujhe yaad rakho</label>
            </div>

            <!-- Error Message -->
            <div x-show="serverError" class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                <span x-text="serverError"></span>
            </div>

            <!-- Submit Button -->
            <button
                type="submit"
                :disabled="loading"
                class="w-full bg-blue-600 hover:bg-blue-700 disabled:bg-gray-400 text-white font-600 py-3 rounded-lg transition duration-200 flex items-center justify-center gap-2"
            >
                <span x-text="loading ? 'Logging in...' : 'Login'"></span>
                <span x-show="!loading">→</span>
            </button>

        </form>

        <!-- Register Link -->
        <p class="text-center text-gray-600 mt-6">
            Account nahi hai?
            <a href="/register" class="text-blue-600 font-600 hover:underline">Register karo</a>
        </p>

    </div>

</div>

<script>
    function loginForm() {
        return {
            form: {
                email: '',
                password: '',
                remember: false,
            },
            errors: {},
            serverError: '',
            showPassword: false,
            loading: false,

            async submitForm() {
                this.serverError = '';
                this.errors = {};

                if (!this.form.email || !this.form.password) {
                    this.serverError = 'Email aur password dono likho!';
                    return;
                }

                this.loading = true;

                try {
                    const response = await fetch('/login', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                        },
                        body: JSON.stringify(this.form)
                    });

                    if (response.ok) {
                        window.location.href = '/dashboard';
                    } else {
                        const data = await response.json();
                        this.serverError = data.email || 'Login failed!';
                        if (data.errors) {
                            this.errors = data.errors;
                        }
                    }
                } catch (error) {
                    this.serverError = 'Network error! try Again!';
                } finally {
                    this.loading = false;
                }
            }
        }
    }
</script>

@endsection
