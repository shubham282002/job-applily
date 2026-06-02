@extends('layouts.guest')
@section('title', 'Register')

@section('content')

<div x-data="registerForm()" class="w-full max-w-md">

    <!-- Card -->
    <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">

        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Create Account</h1>
            <p class="text-gray-600 mt-2">Join JobApplily aur emails send kro easily!</p>
        </div>

        <!-- Form -->
        <form @submit.prevent="submitForm()" class="space-y-5">

            <!-- Name Field -->
            <div>
                <label class="block text-sm font-600 text-gray-700 mb-2">Full Name</label>
                <input
                    type="text"
                    x-model="form.name"
                    @blur="validateName()"
                    placeholder="Aapka naam likho"
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                    :class="errors.name ? 'border-red-500 bg-red-50' : 'border-gray-300'"
                >
                <p x-show="errors.name" class="text-red-600 text-sm mt-1" x-text="errors.name"></p>
            </div>

            <!-- Email Field -->
            <div>
                <label class="block text-sm font-600 text-gray-700 mb-2">Email Address</label>
                <input
                    type="email"
                    x-model="form.email"
                    @blur="validateEmail()"
                    placeholder="email@example.com"
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                    :class="errors.email ? 'border-red-500 bg-red-50' : 'border-gray-300'"
                >
                <p x-show="errors.email" class="text-red-600 text-sm mt-1" x-text="errors.email"></p>
            </div>

            <!-- Password Field -->
            <div>
                <label class="block text-sm font-600 text-gray-700 mb-2">Password</label>
                <div class="relative">
                    <input
                        :type="showPassword ? 'text' : 'password'"
                        x-model="form.password"
                        @blur="validatePassword()"
                        placeholder="Minimum 8 characters"
                        class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition pr-12"
                        :class="errors.password ? 'border-red-500 bg-red-50' : 'border-gray-300'"
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

                <!-- Password Strength Indicator -->
                <div class="mt-3">
                    <div class="flex gap-2 mb-2">
                        <div class="h-1 flex-1 rounded bg-gray-200" :class="passwordStrength >= 1 ? 'bg-red-500' : ''"></div>
                        <div class="h-1 flex-1 rounded bg-gray-200" :class="passwordStrength >= 2 ? 'bg-yellow-500' : ''"></div>
                        <div class="h-1 flex-1 rounded bg-gray-200" :class="passwordStrength >= 3 ? 'bg-green-500' : ''"></div>
                    </div>
                    <p class="text-xs text-gray-600" x-text="passwordStrengthText()"></p>
                </div>
            </div>

            <!-- Confirm Password Field -->
            <div>
                <label class="block text-sm font-600 text-gray-700 mb-2">Confirm Password</label>
                <div class="relative">
                    <input
                        :type="showConfirmPassword ? 'text' : 'password'"
                        x-model="form.password_confirmation"
                        @blur="validateConfirmPassword()"
                        placeholder="Password dobara likho"
                        class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition pr-12"
                        :class="errors.password_confirmation ? 'border-red-500 bg-red-50' : 'border-gray-300'"
                    >
                    <button
                        type="button"
                        @click="showConfirmPassword = !showConfirmPassword"
                        class="absolute right-4 top-3 text-gray-500 hover:text-gray-700"
                    >
                        <span x-text="showConfirmPassword ? '👁️' : '🔒'"></span>
                    </button>
                </div>
                <p x-show="errors.password_confirmation" class="text-red-600 text-sm mt-1" x-text="errors.password_confirmation"></p>
            </div>

            <!-- Terms -->
            <div class="flex items-start gap-3">
                <input
                    type="checkbox"
                    x-model="agreedToTerms"
                    class="w-5 h-5 mt-1 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                >
                <label class="text-sm text-gray-600">
                    I agree to the <a href="#" class="text-blue-600 hover:underline">Terms of Service</a>
                </label>
            </div>

            <!-- Submit Button -->
            <button
                type="submit"
                :disabled="loading || !agreedToTerms"
                class="w-full bg-blue-600 hover:bg-blue-700 disabled:bg-gray-400 text-white font-600 py-3 rounded-lg transition duration-200 flex items-center justify-center gap-2"
            >
                <span x-text="loading ? 'Creating account...' : 'Create Account'"></span>
                <span x-show="!loading">→</span>
            </button>

            <!-- General Error -->
            <div x-show="serverError" class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                <span x-text="serverError"></span>
            </div>

        </form>

        <!-- Login Link -->
        <p class="text-center text-gray-600 mt-6">
            Pehle se account hai?
            <a href="/login" class="text-blue-600 font-600 hover:underline">Login karo</a>
        </p>

    </div>

</div>

<script>
    function registerForm() {
        return {
            form: {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
            },
            errors: {},
            serverError: '',
            showPassword: false,
            showConfirmPassword: false,
            agreedToTerms: false,
            loading: false,

            validateName() {
                this.errors.name = '';
                if (!this.form.name) {
                    this.errors.name = 'Naam likho bhai!';
                } else if (this.form.name.length < 3) {
                    this.errors.name = 'Minimum 3 characters chahiye!';
                }
            },

            validateEmail() {
                this.errors.email = '';
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!this.form.email) {
                    this.errors.email = 'Email zaroori hai!';
                } else if (!emailRegex.test(this.form.email)) {
                    this.errors.email = 'Valid email likho!';
                }
            },

            validatePassword() {
                this.errors.password = '';
                if (!this.form.password) {
                    this.errors.password = 'Password zaroori hai!';
                } else if (this.form.password.length < 8) {
                    this.errors.password = 'Minimum 8 characters chahiye!';
                }
            },

            validateConfirmPassword() {
                this.errors.password_confirmation = '';
                if (!this.form.password_confirmation) {
                    this.errors.password_confirmation = 'Password confirm karo!';
                } else if (this.form.password !== this.form.password_confirmation) {
                    this.errors.password_confirmation = 'Passwords match nahi kar rahe!';
                }
            },

            get passwordStrength() {
                let strength = 0;
                if (this.form.password.length >= 8) strength++;
                if (/[A-Z]/.test(this.form.password) && /[0-9]/.test(this.form.password)) strength++;
                if (/[!@#$%^&*]/.test(this.form.password)) strength++;
                return strength;
            },

            passwordStrengthText() {
                const strength = this.passwordStrength;
                if (strength === 0) return 'Kuch strong likho!';
                if (strength === 1) return 'Weak password';
                if (strength === 2) return 'Medium strength';
                return 'Strong password ✓';
            },

            async submitForm() {
                // Validate all
                this.validateName();
                this.validateEmail();
                this.validatePassword();
                this.validateConfirmPassword();

                // Check if any errors
                if (Object.keys(this.errors).some(key => this.errors[key])) {
                    this.serverError = 'Sab fields properly fill karo!';
                    return;
                }

                if (!this.agreedToTerms) {
                    this.serverError = 'Terms accept karna padega!';
                    return;
                }

                this.loading = true;
                this.serverError = '';

                try {
                    const response = await fetch('/register', {
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
                        this.serverError = data.message || 'Kuch error aa gaya!';
                        if (data.errors) {
                            this.errors = data.errors;
                        }
                    }
                } catch (error) {
                    this.serverError = 'Network error! Dobara try karo!';
                } finally {
                    this.loading = false;
                }
            }
        }
    }
</script>

@endsection
