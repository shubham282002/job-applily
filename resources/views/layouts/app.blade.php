<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - JobApplily</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        * {
            font-family: 'Inter', sans-serif;
        }
        .stat-card {
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
        }
     </style>
</head>
<body class="bg-gray-50" x-data="{ sidebarOpen: false }">

    <!-- Header -->
    @include('components.app-header')

    <!-- Main Content Wrapper -->
    <div class="flex">
        <!-- Sidebar -->
        @include('components.app-sidebar')

        <!-- Main Content -->
        <main class="flex-1 min-h-screen">
            @yield('content')
        </main>
    </div>

</body>
</html>
