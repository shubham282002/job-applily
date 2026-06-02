<header class="bg-white border-b border-gray-200 sticky top-0 z-40">
    <div class="px-6 py-4 flex justify-between items-center">

        <!-- Left Side - Logo & Menu -->
        <div class="flex items-center gap-4">
            <!-- Mobile Menu Button -->
            <button
                @click="sidebarOpen = !sidebarOpen"
                class="lg:hidden w-10 h-10 rounded-lg hover:bg-gray-100 flex items-center justify-center transition"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

            <!-- Logo -->
            <div class="hidden sm:flex items-center gap-2">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-600 to-purple-600 flex items-center justify-center text-white font-bold">
                    J
                </div>
                <h1 class="text-xl font-bold text-gray-900">JobApplily</h1>
            </div>
        </div>

        <!-- Right Side - User Menu -->
        <div class="flex items-center gap-6" x-data="{ userMenuOpen: false }">

            <!-- Search (Hidden on Mobile) -->
            <div class="hidden md:block">
                <div class="relative">
                    <input
                        type="text"
                        placeholder="Search templates..."
                        class="pl-10 pr-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm w-64"
                    >
                    <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Notifications -->
            <button class="relative w-10 h-10 rounded-lg hover:bg-gray-100 flex items-center justify-center transition">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
                <span class="absolute top-2 right-2 w-2 h-2 bg-red-600 rounded-full"></span>
            </button>

            <!-- User Profile Dropdown -->
            <div class="relative">
                <button
                    @click="userMenuOpen = !userMenuOpen"
                    class="flex items-center gap-3 hover:bg-gray-100 px-3 py-2 rounded-lg transition"
                >
                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold text-sm">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="hidden sm:block text-left">
                        <p class="text-sm font-600 text-gray-900">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                    </div>
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div
                    x-show="userMenuOpen"
                    @click.away="userMenuOpen = false"
                    class="absolute right-0 mt-2 w-48 bg-white rounded-lg border border-gray-200 shadow-lg py-2 z-50"
                >
                    <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                        Profile Settings
                    </a>
                    <a href="/account" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                        Account Settings
                    </a>
                    <hr class="my-2">
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-50">
                            Logout
                        </button>
                    </form>
                </div>
            </div>

        </div>

    </div>
</header>
