<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Travel & Tours Dashboard | TravelBuddy</title>
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="{{ asset('css/travel_style.css') }}">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
</head>
<body class="bg-gray-50 text-gray-900 font-inter" 
      x-data="{ sidebarOpen: window.innerWidth >= 1024, profileDropdownOpen: false, notificationsOpen: false }">

    <div class="min-h-screen flex">
        <!-- Mobile overlay -->
        <div x-show="sidebarOpen" 
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-30 bg-black bg-opacity-50 lg:hidden"
             @click="sidebarOpen = false">
        </div>

        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-40 w-72 sidebar-gradient sidebar-transition transform lg:translate-x-0"
               :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }"
               x-on:keyup.escape.window="sidebarOpen = false">
            
            <!-- Branding -->
            <div class="logo-section flex items-center gap-2">
                <img src="{{ asset('images/logo2.png') }}" alt="TravelBuddy Logo" class="logo-img h-14 w-auto"> 
                <div>
                    <h1 class="text-white font-bold">TravelBuddy</h1>
                    <p class="text-xs text-gray-200">Travel & Tours Agency Panel</p>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="p-4 space-y-1 overflow-y-auto h-[calc(100vh-5rem)]">
                <!-- Dashboard -->
                <a href="{{ route('travel_tours.dashboard') }}" 
                    class="flex items-center px-3 py-3 rounded-lg text-m font-semibold transition-all duration-300 ease-in-out text-white
                        {{ request()->routeIs('travel_tours.dashboard') 
                            ? 'active-nav-item' 
                            : 'nav-item-hover' }}">
                    <i class="fas fa-chart-pie mr-3 {{ request()->routeIs('travel_tours.dashboard') ? 'text-blue-300' : 'text-blue-200' }}"></i>
                    <span>Dashboard</span>
                    <i class="fas fa-chevron-right ml-auto text-xs opacity-70"></i>
                </a>
                
                <!-- Agency Profile -->
                <a href="{{ route('travel_tours.agency_prof.agency_profile') }}"
                    class="flex items-center px-3 py-3 rounded-lg text-m font-medium transition-all duration-300 ease-in-out text-white
                        {{ request()->routeIs('travel_tours.agency_prof.agency_profile') 
                            ? 'active-nav-item' 
                            : 'nav-item-hover' }}">
                    <i class="fas fa-building mr-3 {{ request()->routeIs('travel_tours.agency_prof.agency_profile') ? 'text-blue-300' : 'text-blue-200' }}"></i>
                    <span>Agency Profile</span>
                    <i class="fas fa-chevron-right ml-auto text-xs opacity-70"></i>
                </a>
                
                <!-- Tour Packages -->
                <a href="{{ route('travel_tours.tour_packages') }}" 
                    class="flex items-center px-3 py-3 rounded-lg text-m font-medium transition-all duration-300 ease-in-out text-white
                        {{ request()->routeIs('travel_tours.tour_packages') 
                            ? 'active-nav-item'
                            : 'nav-item-hover' }}">
                    <i class="fas fa-map-marked-alt mr-3 {{ request()->routeIs('travel_tours.tour_packages') ? 'text-blue-300' : 'text-blue-200' }}"></i>
                    <span>Tour Packages</span>
                    <i class="fas fa-chevron-right ml-auto text-xs opacity-70"></i>
                </a>
                
                <!-- Bookings -->
                <a href="{{ route('travel_tours.bookings.booking_request') }}" 
                    class="flex items-center px-3 py-3 rounded-lg text-m font-medium transition-all duration-300 ease-in-out text-white
                        {{ request()->routeIs('travel_tours.bookings') 
                            ? 'active-nav-item' 
                            : 'nav-item-hover' }}">
                    <i class="fas fa-calendar-check mr-3 {{ request()->routeIs('travel_tours.bookings') ? 'text-blue-300' : 'text-blue-200' }}"></i>
                    <span>Bookings</span>
                    <i class="fas fa-chevron-right ml-auto text-xs opacity-70"></i>
                </a>
                
                <!-- Customers -->
                <a href="{{ route('travel_tours.customers') }}" 
                    class="flex items-center px-3 py-3 rounded-lg text-m font-medium transition-all duration-300 ease-in-out text-white
                        {{ request()->routeIs('travel_tours.customers') 
                            ? 'active-nav-item' 
                            : 'nav-item-hover' }}">
                    <i class="fas fa-users mr-3 {{ request()->routeIs('travel_tours.customers') ? 'text-blue-300' : 'text-blue-200' }}"></i>
                    <span>Customers</span>
                    <i class="fas fa-chevron-right ml-auto text-xs opacity-70"></i>
                </a>
                
                <!-- Drivers -->
                <a href="{{ route('travel_tours.driver_info.drivers') }}" 
                    class="flex items-center px-3 py-3 rounded-lg text-m font-medium transition-all duration-300 ease-in-out text-white
                        {{ request()->routeIs('travel_tours.driver_info.drivers')
                            ? 'active-nav-item' 
                            : 'nav-item-hover' }}">
                    <i class="fas fa-user-tie mr-3 {{ request()->routeIs('travel_tours.driver_info.drivers') ? 'text-blue-300' : 'text-blue-200' }}"></i>
                    <span>Drivers</span>
                    <i class="fas fa-chevron-right ml-auto text-xs opacity-70"></i>
                </a>
                
                <!-- Reports -->
                <a href="{{ route('travel_tours.reports') }}"  
                    class="flex items-center px-3 py-3 rounded-lg text-m font-medium transition-all duration-300 ease-in-out text-white
                        {{ request()->routeIs('travel_tours.reports') 
                            ? 'active-nav-item' 
                            : 'nav-item-hover' }}">
                    <i class="fas fa-chart-bar mr-3 {{ request()->routeIs('travel_tours.reports') ? 'text-blue-300' : 'text-blue-200' }}"></i>
                    <span>Reports</span>
                    <i class="fas fa-chevron-right ml-auto text-xs opacity-70"></i>
                </a>

                <!-- Divider -->
                <div class="my-6 border-t border-blue-700"></div>

                <!-- Quick Actions -->
                <div class="px-3">
                    <h3 class="text-xs font-semibold text-blue-300 uppercase tracking-wider mb-3">Quick Actions</h3>
                    <div class="space-y-2">
                        <button class="group flex items-center w-full px-3 py-3 text-m text-blue-100 rounded-lg transition-all duration-300 hover:bg-blue-700">
                            <i class="fas fa-plus mr-3 text-blue-200 group-hover:text-green-300 transition-colors"></i>
                            <span>New Package</span>
                        </button>
                    </div>
                </div>
            </nav>
        </aside>
        
        <!-- Content Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 lg:ml-72" :class="{ 'ml-0': !sidebarOpen, 'ml-72': sidebarOpen }">
            
            <!-- Top Bar -->
            <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-6 sticky top-0 z-30 header-shadow">
                <div class="flex items-center">
                    <button class="lg:hidden mr-4 p-2 rounded-lg border border-gray-200 hover:bg-gray-100 transition-colors" 
                            @click="sidebarOpen = !sidebarOpen">
                        <i class="fa-solid fa-bars text-gray-600"></i>
                    </button>
                    <h1 class="text-xl font-bold text-gray-800 fade-in">@yield('page-title', 'Dashboard')</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <!-- Search -->
                    <div class="relative hidden md:block">
                        <input type="text" placeholder="Search..." 
                               class="pl-10 pr-4 py-2.5 w-64 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    </div>
                    
                    <!-- Notifications -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="relative p-2.5 rounded-lg hover:bg-gray-100 transition-colors">
                            <i class="fa-solid fa-bell text-gray-600"></i>
                            <span class="absolute top-1.5 right-1.5 w-2.5 h-2.5 bg-red-500 rounded-full notification-dot"></span>
                        </button>
                        
                        <!-- Notifications Dropdown -->
                        <div x-show="open" @click.away="open = false" x-transition
                            class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-xl z-50 overflow-hidden border border-gray-100">
                            <div class="p-4 border-b border-gray-100">
                                <h3 class="font-semibold text-gray-800">Notifications</h3>
                                <p class="text-xs text-gray-500 mt-1">You have 3 unread notifications</p>
                            </div>
                            <div class="p-2 border-t border-gray-100">
                                <a href="#" class="block text-center text-sm font-medium text-blue-600 hover:text-blue-800 py-2">
                                    View all notifications
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Profile -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center space-x-2 p-1.5 rounded-lg hover:bg-gray-100 transition-colors">
                            <div class="h-9 w-9 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center text-white font-medium">
                                TB
                            </div>
                            <div class="hidden md:block text-left">
                                <p class="text-sm font-medium text-gray-800">TravelBuddy Admin</p>
                                <p class="text-xs text-gray-500">Administrator</p>
                            </div>
                            <i class="fas fa-chevron-down text-gray-500 text-xs hidden md:block"></i>
                        </button>
                        
                        <!-- Profile Dropdown -->
                        <div x-show="open" @click.away="open = false" x-transition
                            class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl z-50 overflow-hidden border border-gray-100">
                            <div class="p-4 border-b border-gray-100">
                                <p class="text-sm font-medium text-gray-900">TravelBuddy Admin</p>
                                <p class="text-xs text-gray-500 mt-1">admin@travelbuddy.com</p>
                            </div>
                            <div class="py-1">
                                <a href="#" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                                    <i class="fas fa-user mr-3 text-gray-500"></i>
                                    <span>Profile Settings</span>
                                </a>
                                <a href="#" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                                    <i class="fas fa-cog mr-3 text-gray-500"></i>
                                    <span>Account Settings</span>
                                </a>
                            </div>
                            <div class="py-1 border-t border-gray-100">
                                <form method="POST" action="">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full px-4 py-2.5 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors">
                                        <i class="fas fa-arrow-right-from-bracket mr-3 text-gray-500"></i>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1 p-6 bg-gray-50">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="px-6 py-4 text-sm text-gray-500 border-t border-gray-200 bg-white  text-center">
                <div>
                    © {{ date('Y') }} TravelBuddy Admin. All rights reserved.
                </div>
            </footer>
        </div>
    </div>

    <script>
        // Close sidebar when clicking outside on mobile
        document.addEventListener('DOMContentLoaded', function() {
            document.addEventListener('click', function(event) {
                const sidebar = document.querySelector('aside');
                const sidebarToggle = document.querySelector('[x-on\\:click="sidebarOpen = !sidebarOpen"]');
                
                if (window.innerWidth < 1024 && 
                    !sidebar.contains(event.target) && 
                    !sidebarToggle.contains(event.target) && 
                    Alpine.$data(sidebar).sidebarOpen) {
                    Alpine.$data(sidebar).sidebarOpen = false;
                }
            });
        });
    </script>
</body>
</html>