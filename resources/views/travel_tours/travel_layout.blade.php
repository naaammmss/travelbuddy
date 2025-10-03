<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Travel & Tours Dashboard | TravelBuddy</title>
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
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
                    <div class="text-xs text-gray-500">Travel & Tours Agency Panel</div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="p-4 space-y-1">
                <a href="{{ route('travel.dashboard') }}" 
                   class="flex items-center px-3 py-2 rounded-lg text-m font-medium hover:bg-blue-100 hover:text-blue-700 transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-600' }}">
                    <i class="fas fa-chart-pie mr-3 text-gray-600 group-hover:text-blue-500 transition-colors"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('travel.agency-profile') }}"
                   class="flex items-center px-3 py-2 rounded-lg text-m font-medium hover:bg-blue-100 hover:text-blue-700 transition {{ request()->routeIs('admin.attractions.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600' }}">
                    <i class="fas fa-building mr-3 text-gray-600 group-hover:text-blue-500 transition-colors"></i>
                    <span>Agency Profile</span>
                </a>
                <a href="{{ route('travel.tour-packages') }}" 
                   class="flex items-center px-3 py-2 rounded-lg text-m font-medium text-gray-600 hover:bg-blue-100 hover:text-blue-700 transition">
                    <i class="fas fa-map-marked-alt mr-3 text-gray-600 group-hover:text-blue-500 transition-colors"></i>
                    <span>Tour Packages</span>
                </a>
                <a href="{{ route('travel.bookings') }}" 
                   class="flex items-center px-3 py-2 rounded-lg text-m font-medium hover:bg-blue-100 hover:text-blue-700 transition {{ request()->routeIs('admin.customers.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600' }}">
                    <i class="fas fa-calendar-check mr-3  text-gray-600 group-hover:text-blue-500 transition-colors"></i>
                    <span>Bookings</span>
                </a>
                <a href="{{ route('travel.customers') }}" 
                   class="flex items-center px-3 py-2 rounded-lg text-m font-medium text-gray-600 hover:bg-blue-100 hover:text-blue-700 transition">
                    <i class="fas fa-users mr-3 text-gray-600 group-hover:text-blue-500 transition-colors"></i>
                    <span>Customers</span>
                </a>
                <a href="{{ route('travel.drivers-guides') }}" 
                   class="flex items-center px-3 py-2 rounded-lg text-m font-medium text-gray-600 hover:bg-blue-100 hover:text-blue-700 transition">
                    <i class="fas fa-user-tie mr-3 text-gray-600 group-hover:text-blue-500 transition-colors"></i>
                    <span>Drivers</span>
                </a>
                <a href="{{ route('travel.reports') }}"  
                   class="flex items-center px-3 py-2 rounded-lg text-m font-medium text-gray-600 hover:bg-blue-100 hover:text-blue-700 transition">
                    <i class="fas fa-chart-bar mr-3 text-gray-600 group-hover:text-blue-500 transition-colors"></i>
                    <span>Reports</span>
                </a>

                <!-- Divider -->
                <div class="my-6 border-t border-gray-200"></div>

                    <div class="px-3">
                        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Quick Actions</h3>
                        <div class="space-y-1">
                        <button class="group flex items-center w-full px-3 py-2 text-m text-gray-600 rounded-lg hover:bg-gray-100 transition-colors">
                            <i class="fas fa-plus mr-3 text-gray-600 group-hover:text-green-500 transition-colors"></i>
                            <span>New Package</span>
                        </button>
                    </div>
                </div>
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
                    <div x-data="{ open: false }" class="relative inline-block text-left">
                        <button @click="open = !open" class="relative p-2 rounded-lg hover:bg-gray-100">
                            <i class="fa-solid fa-user"></i>
                        </button>
                        <div x-show="open" @click.away="open = false" x-transition
                            class="absolute right-0 mt-2 w-40 bg-white text-gray-800 rounded-lg shadow-lg z-50 py-2">
                            <a class="block px-4 py-2"></a>
                            <form method="POST" action="">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">
                                    <i class="fa-regular fa-user mr-2"></i> View Profile 
                                </button>
                                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">
                                    <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
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