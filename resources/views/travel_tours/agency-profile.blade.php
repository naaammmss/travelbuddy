<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agency Profile | Travel & Tours Dashboard</title>
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        body { 
            font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; 
        }
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .pulse-animation {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        .slide-in {
            animation: slideIn 0.6s ease-out;
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .form-input {
            transition: all 0.3s ease;
        }
        .form-input:focus {
            transform: translateY(-1px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.15);
        }
        .progress-bar {
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
            height: 4px;
            border-radius: 2px;
            transition: width 0.3s ease;
        }
        .status-indicator {
            position: relative;
            overflow: hidden;
        }
        .status-indicator::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            transition: left 0.5s;
        }
        .status-indicator:hover::before {
            left: 100%;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900" x-data="agencyProfile()">
    <!-- Enhanced Sidebar Layout -->
    <div class="flex h-screen bg-gray-50" x-data="{ sidebarOpen: true, mobileMenuOpen: false }">
        <!-- Sidebar -->
        <div class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-xl transform transition-transform duration-300 ease-in-out"
             :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0">
            
            <!-- Sidebar Header -->
            <div class="flex items-center justify-between h-20 px-6 border-b border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="relative group">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl blur opacity-75 group-hover:opacity-100 transition duration-300"></div>
                        <div class="relative w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-105 transition-transform duration-300">
                            <i class="fas fa-plane text-white floating-animation"></i>
                        </div>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold bg-gradient-to-r from-gray-900 to-gray-600 bg-clip-text text-transparent">TravelBuddy</h1>
                        <p class="text-xs text-gray-500">Dashboard</p>
                    </div>
                </div>
                <button @click="sidebarOpen = false" class="lg:hidden p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Navigation Menu -->
            <nav class="mt-6 px-3">
                <div class="space-y-1">
                    <!-- Dashboard -->
                    <a href="{{ route('travel-tours.dashboard') }}" class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-300 hover:bg-blue-50 hover:text-blue-600">
                        <i class="fas fa-chart-pie mr-3 text-gray-400 group-hover:text-blue-500 transition-colors"></i>
                        <span>Dashboard</span>
                    </a>

                    <!-- Agency Profile -->
                    <a href="{{ route('travel-tours.agency-profile') }}" class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-300 bg-blue-50 text-blue-600 border-r-2 border-blue-600">
                        <i class="fas fa-building mr-3 text-blue-500"></i>
                        <span>Agency Profile</span>
                        <span class="ml-auto w-2 h-2 bg-blue-500 rounded-full pulse-animation"></span>
                    </a>

                    <!-- Tour Packages -->
                    <a href="{{ route('travel-tours.tour-packages') }}" class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-300 hover:bg-blue-50 hover:text-blue-600">
                        <i class="fas fa-map-marked-alt mr-3 text-gray-400 group-hover:text-blue-500 transition-colors"></i>
                        <span>Tour Packages</span>
                    </a>

                    <!-- Bookings -->
                    <a href="{{ route('travel-tours.bookings') }}" class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-300 hover:bg-blue-50 hover:text-blue-600">
                        <i class="fas fa-calendar-check mr-3 text-gray-400 group-hover:text-blue-500 transition-colors"></i>
                        <span>Bookings</span>
                        <span class="ml-auto px-2 py-1 text-xs bg-red-100 text-red-600 rounded-full">3</span>
                    </a>

                    <!-- Customers -->
                    <a href="{{ route('travel-tours.customers') }}" class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-300 hover:bg-blue-50 hover:text-blue-600">
                        <i class="fas fa-users mr-3 text-gray-400 group-hover:text-blue-500 transition-colors"></i>
                        <span>Customers</span>
                    </a>

                    <!-- Drivers & Tour Guides -->
                    <a href="{{ route('travel-tours.drivers-guides') }}" class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-300 hover:bg-blue-50 hover:text-blue-600">
                        <i class="fas fa-user-tie mr-3 text-gray-400 group-hover:text-blue-500 transition-colors"></i>
                        <span>Drivers & Guides</span>
                    </a>

                    <!-- Reports -->
                    <a href="{{ route('travel-tours.reports') }}" class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-300 hover:bg-blue-50 hover:text-blue-600">
                        <i class="fas fa-chart-bar mr-3 text-gray-400 group-hover:text-blue-500 transition-colors"></i>
                        <span>Reports</span>
                    </a>
                </div>

                <!-- Divider -->
                <div class="my-6 border-t border-gray-200"></div>

                <!-- Quick Actions -->
                <div class="px-3">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Quick Actions</h3>
                    <div class="space-y-1">
                        <button class="group flex items-center w-full px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 transition-colors">
                            <i class="fas fa-plus mr-3 text-gray-400 group-hover:text-green-500 transition-colors"></i>
                            <span>New Package</span>
                        </button>
                        <button class="group flex items-center w-full px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 transition-colors">
                            <i class="fas fa-user-plus mr-3 text-gray-400 group-hover:text-blue-500 transition-colors"></i>
                            <span>Add Customer</span>
                        </button>
                        <button class="group flex items-center w-full px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 transition-colors">
                            <i class="fas fa-download mr-3 text-gray-400 group-hover:text-purple-500 transition-colors"></i>
                            <span>Export Data</span>
                        </button>
                    </div>
                </div>
            </nav>

            <!-- Sidebar Footer -->
            <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="relative">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white text-sm"></i>
                        </div>
                        <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">Admin User</p>
                        <p class="text-xs text-gray-500">admin@travelbuddy.com</p>
                    </div>
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="p-1 text-gray-400 hover:text-gray-600 transition-colors">
                            <i class="fas fa-ellipsis-v text-sm"></i>
                        </button>
                        <div x-show="open" @click.away="open = false" x-transition
                            class="absolute bottom-0 right-0 mb-8 w-48 bg-white rounded-xl shadow-xl border border-gray-200 py-2 z-50">
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-user mr-3 text-blue-500"></i>Profile
                            </a>
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-cog mr-3 text-gray-500"></i>Settings
                            </a>
                            <hr class="my-2">
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                <i class="fas fa-sign-out-alt mr-3"></i>Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile sidebar overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" 
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-40 bg-gray-600 bg-opacity-75 lg:hidden"></div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col lg:ml-64">
            <!-- Top Navigation Bar -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                    <!-- Mobile menu button -->
                    <button @click="sidebarOpen = true" class="lg:hidden p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                        <i class="fas fa-bars"></i>
                    </button>

                    <!-- Page Title -->
                    <div class="flex-1 lg:flex-none">
                        <h1 class="text-2xl font-bold text-gray-900">Agency Profile</h1>
                        <p class="text-sm text-gray-500 hidden sm:block">Manage your agency information and branding</p>
                    </div>

                    <!-- Top Right Actions -->
                    <div class="flex items-center space-x-4">
                        <!-- Notifications -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="relative p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-all duration-300">
                                <i class="fas fa-bell text-lg"></i>
                                <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full pulse-animation"></span>
                            </button>
                            <div x-show="open" @click.away="open = false" x-transition
                                class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-xl border border-gray-200 py-2 z-50">
                                <div class="px-4 py-2 border-b border-gray-100">
                                    <h3 class="font-semibold text-gray-900">Notifications</h3>
                                </div>
                                <div class="max-h-64 overflow-y-auto">
                                    <div class="px-4 py-3 hover:bg-gray-50 border-b border-gray-100">
                                        <p class="text-sm text-gray-900">New booking received</p>
                                        <p class="text-xs text-gray-500">2 minutes ago</p>
                                    </div>
                                    <div class="px-4 py-3 hover:bg-gray-50 border-b border-gray-100">
                                        <p class="text-sm text-gray-900">Profile updated successfully</p>
                                        <p class="text-xs text-gray-500">1 hour ago</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Search -->
                        <div class="hidden md:block">
                            <div class="relative">
                                <input type="text" placeholder="Search..." 
                                       class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Help -->
                        <button class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                            <i class="fas fa-question-circle text-lg"></i>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto">
                <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Enhanced Header -->
        <div class="mb-8 slide-in">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-4xl font-bold bg-gradient-to-r from-gray-900 to-gray-600 bg-clip-text text-transparent mb-2">Agency Profile</h2>
                    <p class="text-gray-600 text-lg">Manage your agency information, branding, and contact details</p>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm text-gray-500">Profile Completion</p>
                        <p class="text-2xl font-bold text-blue-600" x-text="profileCompletion + '%'"></p>
                    </div>
                    <div class="w-16 h-16 relative">
                        <svg class="w-16 h-16 transform -rotate-90" viewBox="0 0 36 36">
                            <path class="text-gray-200" stroke="currentColor" stroke-width="3" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"></path>
                            <path class="text-blue-600" stroke="currentColor" stroke-width="3" fill="none" stroke-dasharray="90, 100" :stroke-dasharray="profileCompletion + ', 100'" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"></path>
                        </svg>
                    </div>
                </div>
            </div>
            
            <!-- Progress Bar -->
            <div class="mt-6">
                <div class="flex items-center justify-between text-sm text-gray-600 mb-2">
                    <span>Profile Setup Progress</span>
                    <span x-text="profileCompletion + '% Complete'"></span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="progress-bar rounded-full h-2" :style="'width: ' + profileCompletion + '%'"></div>
                </div>
            </div>
        </div>

        <form class="space-y-8" x-data="profileForm()">
            <!-- Agency Information Card -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 card-hover slide-in">
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-building text-white text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Agency Information</h3>
                            <p class="text-sm text-gray-500">Basic details about your travel agency</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                        <span class="text-sm text-gray-500">Required</span>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700 flex items-center">
                            <i class="fas fa-building mr-2 text-blue-500"></i>
                            Agency Name *
                        </label>
                        <input type="text" 
                               x-model="form.agency_name"
                               @input="updateProgress()"
                               class="form-input w-full px-4 py-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 focus:bg-white transition-all duration-300"
                               placeholder="Enter your agency name"
                               required>
                    </div>
                    
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700 flex items-center">
                            <i class="fas fa-certificate mr-2 text-purple-500"></i>
                            License Number
                        </label>
                        <input type="text" 
                               x-model="form.license_number"
                               @input="updateProgress()"
                               class="form-input w-full px-4 py-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 focus:bg-white transition-all duration-300"
                               placeholder="DOT-2024-001">
                    </div>
                    
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700 flex items-center">
                            <i class="fas fa-envelope mr-2 text-green-500"></i>
                            Email Address *
                        </label>
                        <input type="email" 
                               x-model="form.email"
                               @input="updateProgress()"
                               class="form-input w-full px-4 py-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 focus:bg-white transition-all duration-300"
                               placeholder="agency@example.com"
                               required>
                    </div>
                    
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700 flex items-center">
                            <i class="fas fa-phone mr-2 text-orange-500"></i>
                            Phone Number *
                        </label>
                        <input type="tel" 
                               x-model="form.phone"
                               @input="updateProgress()"
                               class="form-input w-full px-4 py-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 focus:bg-white transition-all duration-300"
                               placeholder="+63 912 345 6789"
                               required>
                    </div>
                </div>
                
                <div class="mt-6 space-y-2">
                    <label class="block text-sm font-semibold text-gray-700 flex items-center">
                        <i class="fas fa-map-marker-alt mr-2 text-red-500"></i>
                        Address *
                    </label>
                    <textarea x-model="form.address"
                              @input="updateProgress()"
                              rows="3"
                              class="form-input w-full px-4 py-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 focus:bg-white transition-all duration-300 resize-none"
                              placeholder="Enter complete business address"
                              required></textarea>
                </div>
            </div>

            <!-- Enhanced Logo Upload Card -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 card-hover slide-in">
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-image text-white text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Agency Logo</h3>
                            <p class="text-sm text-gray-500">Upload your professional logo for branding</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="w-3 h-3 bg-yellow-500 rounded-full"></span>
                        <span class="text-sm text-gray-500">Optional</span>
                    </div>
                </div>
            </div>

            <!-- Description Card -->
            <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                <div class="flex items-center mb-6">
                    <i class="fas fa-align-left text-blue-600 mr-3"></i>
                    <h3 class="text-lg font-semibold text-gray-900">Agency Description</h3>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">About Your Agency</label>
                    <textarea x-model="form.description"
                              rows="6"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                              placeholder="Tell customers about your agency, services, and what makes you special..."></textarea>
                    <p class="text-sm text-gray-500 mt-2">This description will be shown to customers when they view your agency profile.</p>
                </div>
            </div>

            <!-- Social Media & Website Card -->
            <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                <div class="flex items-center mb-6">
                    <i class="fas fa-share-alt text-blue-600 mr-3"></i>
                    <h3 class="text-lg font-semibold text-gray-900">Social Media & Website</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Website URL</label>
                        <input type="url" 
                               x-model="form.website"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="https://www.youragency.com">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Facebook Page</label>
                        <input type="url" 
                               x-model="form.facebook"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="https://facebook.com/youragency">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Instagram</label>
                        <input type="url" 
                               x-model="form.instagram"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="https://instagram.com/youragency">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Twitter</label>
                        <input type="url" 
                               x-model="form.twitter"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="https://twitter.com/youragency">
                    </div>
                </div>
            </div>

            <!-- Business Hours Card -->
            <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                <div class="flex items-center mb-6">
                    <i class="fas fa-clock text-blue-600 mr-3"></i>
                    <h3 class="text-lg font-semibold text-gray-900">Business Hours</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Opening Time</label>
                        <input type="time" 
                               x-model="form.opening_time"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Closing Time</label>
                        <input type="time" 
                               x-model="form.closing_time"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>
                
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Working Days</label>
                    <div class="flex flex-wrap gap-2">
                        <template x-for="day in ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']" :key="day">
                            <label class="flex items-center">
                                <input type="checkbox" 
                                       :value="day"
                                       x-model="form.working_days"
                                       class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700" x-text="day"></span>
                            </label>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Enhanced Action Buttons -->
            <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0 sm:space-x-4 bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-green-500 rounded-full pulse-animation"></div>
                        <span class="text-sm text-gray-600">Auto-save enabled</span>
                    </div>
                    <div class="text-sm text-gray-500">
                        Last saved: <span x-text="lastSaved"></span>
                    </div>
                </div>
                
                <div class="flex space-x-3">
                    <button type="button" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-all duration-300 flex items-center">
                        <i class="fas fa-times mr-2"></i>
                        Cancel
                    </button>
                    <button type="submit" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center">
                        <i class="fas fa-save mr-2"></i>
                        Save Changes
                    </button>
                </div>
            </div>
                </form>
                </div>
            </main>
        </div>
    </div>

    <script>
        function agencyProfile() {
            return {
                profileCompletion: 75,
                lastSaved: 'Never',
                sidebarOpen: true,
                form: {
                    agency_name: 'Bohol Paradise Tours',
                    license_number: 'DOT-2024-001',
                    email: 'info@boholparadise.com',
                    phone: '+63 912 345 6789',
                    address: '123 Tagbilaran City, Bohol, Philippines',
                    description: 'Your premier travel partner in Bohol, offering unforgettable island experiences with professional guides and top-notch service.',
                    website: 'https://www.boholparadise.com',
                    facebook: 'https://facebook.com/boholparadise',
                    instagram: 'https://instagram.com/boholparadise',
                    twitter: 'https://twitter.com/boholparadise',
                    opening_time: '08:00',
                    closing_time: '18:00',
                    working_days: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']
                },
                logoPreview: null,
                
                init() {
                    this.updateProgress();
                    this.autoSave();
                    this.handleResize();
                },
                
                handleResize() {
                    // Handle sidebar on window resize
                    window.addEventListener('resize', () => {
                        if (window.innerWidth >= 1024) {
                            this.sidebarOpen = true;
                        } else {
                            this.sidebarOpen = false;
                        }
                    });
                },
                
                updateProgress() {
                    let completed = 0;
                    let total = 0;
                    
                    // Check required fields
                    const requiredFields = ['agency_name', 'email', 'phone', 'address'];
                    requiredFields.forEach(field => {
                        total++;
                        if (this.form[field] && this.form[field].trim() !== '') {
                            completed++;
                        }
                    });
                    
                    // Check optional fields
                    const optionalFields = ['license_number', 'description', 'website'];
                    optionalFields.forEach(field => {
                        total++;
                        if (this.form[field] && this.form[field].trim() !== '') {
                            completed++;
                        }
                    });
                    
                    // Check logo
                    total++;
                    if (this.logoPreview) {
                        completed++;
                    }
                    
                    this.profileCompletion = Math.round((completed / total) * 100);
                },
                
                autoSave() {
                    setInterval(() => {
                        // Simulate auto-save
                        this.lastSaved = new Date().toLocaleTimeString();
                    }, 30000); // Auto-save every 30 seconds
                },
                
                handleLogoUpload(event) {
                    const file = event.target.files[0];
                    if (file) {
                        if (file.size > 2 * 1024 * 1024) {
                            this.showNotification('File size must be less than 2MB', 'error');
                            event.target.value = '';
                            return;
                        }
                        
                        if (!file.type.startsWith('image/')) {
                            this.showNotification('Please select an image file', 'error');
                            event.target.value = '';
                            return;
                        }
                        
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.logoPreview = e.target.result;
                            this.updateProgress();
                            this.showNotification('Logo uploaded successfully!', 'success');
                        };
                        reader.readAsDataURL(file);
                    }
                },
                
                removeLogo() {
                    this.logoPreview = null;
                    document.getElementById('logo-upload').value = '';
                    this.updateProgress();
                    this.showNotification('Logo removed', 'info');
                },
                
                showNotification(message, type = 'info') {
                    // Create notification element
                    const notification = document.createElement('div');
                    notification.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-xl shadow-lg transition-all duration-300 transform translate-x-full ${
                        type === 'success' ? 'bg-green-500 text-white' :
                        type === 'error' ? 'bg-red-500 text-white' :
                        'bg-blue-500 text-white'
                    }`;
                    notification.innerHTML = `
                        <div class="flex items-center">
                            <i class="fas fa-${type === 'success' ? 'check' : type === 'error' ? 'times' : 'info'} mr-2"></i>
                            ${message}
                        </div>
                    `;
                    
                    document.body.appendChild(notification);
                    
                    // Animate in
                    setTimeout(() => {
                        notification.classList.remove('translate-x-full');
                    }, 100);
                    
                    // Remove after 3 seconds
                    setTimeout(() => {
                        notification.classList.add('translate-x-full');
                        setTimeout(() => {
                            document.body.removeChild(notification);
                        }, 300);
                    }, 3000);
                }
            }
        }
    </script>
</body>
</html>
