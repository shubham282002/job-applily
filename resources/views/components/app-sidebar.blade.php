<aside
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    class="w-64 bg-white border-r border-gray-200 h-screen transition-transform duration-300 overflow-y-auto fixed lg:relative z-30"
>
    <!-- Logo (Mobile Only) -->
    <div class="lg:hidden px-6 py-6 border-b border-gray-200">
        <div class="flex items-center gap-2">
            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-600 to-purple-600 flex items-center justify-center text-white font-bold">
                J
            </div>
            <h1 class="text-lg font-bold text-gray-900">JobApplily</h1>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="px-4 py-6 space-y-2">

        <!-- 1. Dashboard -->
        <a href="/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->is('dashboard') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-100' }} transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 16l-7-4m0 0l-2-1m9 5l7-4m0 0l2-1"></path>
            </svg>
            <span class="font-500">Dashboard</span>
        </a>

        <!-- Divider -->
        <hr class="my-3">

        <!-- 2. Masters Section (Collapsible) -->
        <div x-data="{ masterOpen: false }">
            <button
                @click="masterOpen = !masterOpen"
                class="w-full flex items-center justify-between gap-3 px-4 py-3 rounded-lg {{ request()->is('masters*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-100' }} transition"
            >
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                    </svg>
                    <span class="font-500">Masters</span>
                </div>
                <svg
                    :class="masterOpen ? 'rotate-180' : ''"
                    class="w-4 h-4 transition-transform"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </button>

            <!-- Submenu -->
            <div x-show="masterOpen" class="pl-4 space-y-2 mt-2">

                <!-- Subject Master -->
                <a
                    href="/masters/subjects"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->is('masters/subjects*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-100' }} transition text-sm"
                >
                    <div class="w-2 h-2 rounded-full {{ request()->is('masters/subjects*') ? 'bg-blue-600' : 'bg-gray-400' }}"></div>
                    <span class="font-500">Subject Master</span>
                </a>

                <!-- Description Master -->
                <a
                    href="/masters/descriptions"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->is('masters/descriptions*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-100' }} transition text-sm"
                >
                    <div class="w-2 h-2 rounded-full {{ request()->is('masters/descriptions*') ? 'bg-blue-600' : 'bg-gray-400' }}"></div>
                    <span class="font-500">Description Master</span>
                </a>

            </div>
        </div>

        <!-- Divider -->
        <hr class="my-3">

        <!-- 3. Templates -->
        <a href="/templates" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->is('templates*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-100' }} transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
            </svg>
            <span class="font-500">Templates</span>
        </a>

        <!-- Divider -->
        <hr class="my-3">

        <!-- 4. Other Items -->

        <!-- Sent Emails -->
        <a href="/emails" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->is('emails*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-100' }} transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
            <span class="font-500">Sent Emails</span>
        </a>

        <!-- Resumes -->
        <a href="/resumes" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->is('resumes*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-100' }} transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <span class="font-500">Resumes</span>
        </a>

        <!-- Analytics -->
        <a href="/analytics" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->is('analytics*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-100' }} transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            <span class="font-500">Analytics</span>
        </a>

    </nav>

    <!-- Divider -->
    <hr class="my-6">

    <!-- Settings Section -->
    <nav class="px-4 space-y-2">

        <!-- Settings -->
        <a href="/settings" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <span class="font-500">Settings</span>
        </a>

        <!-- Help -->
        <a href="/help" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="font-500">Help & Support</span>
        </a>

    </nav>

</aside>
