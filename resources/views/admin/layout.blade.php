<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin | TravelBuddy')</title>
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-50 text-gray-900 font-inter" 
      x-data="{ sidebarOpen: false }" 
      x-init="sidebarOpen = window.innerWidth >= 1024">

    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-40 w-72 bg-white shadow-lg border-r border-gray-200 transform transition-transform duration-200 ease-in-out lg:translate-x-0"
               :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }"
               x-on:keyup.escape.window="sidebarOpen = false">
            
            <!-- Branding -->
            <div class="h-20 flex items-center px-6 border-b border-gray-200">
                <img src="{{ asset('images/logo.png') }}" alt="TravelBuddy Logo" class="h-16 w-auto">
                <div class="ml-3">
                    <div class="text-lg font-extrabold tracking-tight">TravelBuddy</div>
                    <div class="text-xs text-gray-500">Admin Panel</div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center px-3 py-2 rounded-lg text-m font-medium hover:bg-blue-100 hover:text-blue-700 transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-600' }}">
                    <i class="fa-solid fa-chart-line w-5 mr-3"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.attractions.index') }}" 
                   class="flex items-center px-3 py-2 rounded-lg text-m font-medium hover:bg-blue-100 hover:text-blue-700 transition {{ request()->routeIs('admin.attractions.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600' }}">
                    <i class="fa-solid fa-map-location-dot w-5 mr-3"></i>
                    <span>Attractions</span>
                </a>
                <a href="#" 
                   class="flex items-center px-3 py-2 rounded-lg text-m font-medium text-gray-600 hover:bg-blue-100 hover:text-blue-700 transition">
                    <i class="fa-solid fa-route w-5 mr-3"></i>
                    <span>Itineraries</span>
                </a>
                <a href="{{ route('admin.customers.index') }}" 
                   class="flex items-center px-3 py-2 rounded-lg text-m font-medium hover:bg-blue-100 hover:text-blue-700 transition {{ request()->routeIs('admin.customers.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600' }}">
                    <i class="fa-solid fa-users w-5 mr-3"></i>
                    <span>Customers</span>
                </a>
                <a href="#" 
                   class="flex items-center px-3 py-2 rounded-lg text-m font-medium text-gray-600 hover:bg-blue-100 hover:text-blue-700 transition">
                    <i class="fa-solid fa-cart-shopping w-5 mr-3"></i>
                    <span>Bookings</span>
                </a>
            </nav>
        </aside>

        <!-- Content Wrapper -->
        <div class="flex-1 flex flex-col lg:ml-72" :class="{ 'ml-0': !sidebarOpen, 'ml-72': sidebarOpen }">
            
            <!-- Top Bar -->
            <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-6 sticky top-0 z-30 shadow-sm">
                <div class="flex items-center">
                    <button class="lg:hidden mr-3 p-2 rounded-lg border border-gray-200 hover:bg-gray-100" 
                            @click="sidebarOpen = !sidebarOpen">
                        <i class="fa-solid fa-bars text-gray-600"></i>
                    </button>
                    <h1 class="text-xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h1>
                </div>
                <div class="flex items-center space-x-3">
                    <!-- Search -->
                    <div class="relative hidden md:block">
                        <input type="text" placeholder="Search..." 
                               class="pl-10 pr-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    </div>
                    <!-- Notifications -->
                    <button class="relative p-2 rounded-lg hover:bg-gray-100">
                        <i class="fa-solid fa-bell text-gray-600"></i>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>
                    <!-- Profile -->
                 @php
    $user = auth()->user();
@endphp

@if ($user)
<div x-data="{ open: false }" class="relative inline-block text-left">
    <button @click="open = !open" class="relative flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-100">
        <!-- initials (first + last char of name) -->
        @php
            $fullName = trim($user->name ?? '');
            // get first char
            $first = $fullName ? strtoupper(mb_substr($fullName, 0, 1)) : '';
            // get last name's first char (if exists)
            $lastInitial = '';
            if ($fullName && strpos($fullName, ' ') !== false) {
                $parts = preg_split('/\s+/', $fullName);
                $last = end($parts);
                $lastInitial = $last ? strtoupper(mb_substr($last, 0, 1)) : '';
            }
            $initials = $first . $lastInitial;
        @endphp

        @if (!empty($user->profile_picture))
            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile" class="w-8 h-8 rounded-full object-cover">
        @else
            <div class="w-8 h-8 flex items-center justify-center bg-gray-300 text-gray-700 font-semibold rounded-full">
                {{ $initials ?: 'U' }}
            </div>
        @endif

        <span class="font-medium text-gray-800">{{ $user->name }}</span>
    </button>

    <div x-show="open" @click.away="open = false" x-transition
         class="absolute right-0 mt-2 w-48 bg-white text-gray-800 rounded-lg shadow-lg z-50 py-2">
        <a href="" class="block px-4 py-2 hover:bg-gray-100 flex items-center">
            <i class="fa-regular fa-user mr-2"></i> View Profile
        </a>

        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center">
                <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i> Logout
            </button>
        </form>
    </div>
</div>
@else
    <!-- Not logged in: show sign-in link -->
    <a href="{{ route('login.form') }}" class="px-3 py-2 rounded hover:bg-gray-100">Sign in</a>
@endif


                </div>
            </header>

            <!-- Main Content -->
            <main class="p-6">
                @yield('content')
            </main>

            <footer class="px-6 py-4 text-sm text-gray-500 border-t border-gray-200 text-center">
                © {{ date('Y') }} TravelBuddy Admin. All rights reserved.
            </footer>
        </div>
    </div>

    <script>
        // Keep sidebar open when resizing
        window.addEventListener('resize', () => {
            const alpine = document.querySelector('body').__x;
            if (!alpine) return;
            alpine.$data.sidebarOpen = window.innerWidth >= 1024 ? true : alpine.$data.sidebarOpen;
        });
    </script>
</body>
</html>
