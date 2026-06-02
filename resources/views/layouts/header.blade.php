<nav class="bg-white border-b border-gray-200 shadow-sm" x-data="{ masterOpen: false }">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

        <!-- Logo -->
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-600 to-purple-600 flex items-center justify-center text-white font-bold text-lg">
                J
            </div>

            <div>
                <h1 class="text-xl font-bold text-gray-900">JobApplily</h1>
                <p class="text-xs text-gray-500">
                    {{ $pageSubtitle ?? 'Job Management System' }}
                </p>
            </div>
        </div>

        <!-- Navigation -->
        <div class="hidden md:flex items-center gap-8">

            <!-- Dashboard -->
            <a href="/dashboard"
               class="text-gray-700 hover:text-blue-600 font-medium transition">
                Dashboard
            </a>

            <!-- Master Dropdown -->
            <div class="relative">

                <button
                    @click="masterOpen = !masterOpen"
                    class="flex items-center gap-2 text-gray-700 hover:text-blue-600 font-medium transition"
                >
                    Master
                    <svg class="w-4 h-4"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <!-- Dropdown -->
                <div x-show="masterOpen"
                     @click.away="masterOpen = false"
                     x-transition
                     class="absolute left-0 mt-3 w-56 bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden z-50">

                    <a href="/subject-master/create"
                       class="block px-5 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                        Subject Master
                    </a>

                    <a href="/description-master/create"
                       class="block px-5 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                        Description Master
                    </a>

                </div>
            </div>

            <!-- Templates -->
            <a href="/templates"
               class="text-gray-700 hover:text-blue-600 font-medium transition">
                Templates
            </a>
        </div>

        <!-- User Section -->
        <div class="flex items-center gap-5">
            <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold">
                {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
            </div>

            <div class="hidden sm:block">
                <p class="text-sm font-semibold text-gray-900">
                    {{ auth()->user()->name ?? 'Guest' }}
                </p>
                <p class="text-xs text-gray-500">
                    {{ auth()->user()->email ?? '' }}
                </p>
            </div>

            <form action="/logout" method="POST">
                @csrf
                <button type="submit"
                        class="text-gray-600 hover:text-red-600 text-sm font-medium transition">
                    Logout
                </button>
            </form>
        </div>

    </div>
</nav>
