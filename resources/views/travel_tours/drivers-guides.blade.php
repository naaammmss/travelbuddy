<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Drivers & Tour Guides | Travel & Tours Dashboard</title>
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
<body class="bg-gray-50 text-gray-900" x-data="driversGuidesManagement()">
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
                    <a href="{{ route('travel-tours.agency-profile') }}" class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-300 hover:bg-blue-50 hover:text-blue-600">
                        <i class="fas fa-building mr-3 text-gray-400 group-hover:text-blue-500 transition-colors"></i>
                        <span>Agency Profile</span>
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
                    <a href="{{ route('travel-tours.drivers-guides') }}" class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-300 bg-blue-50 text-blue-600 border-r-2 border-blue-600">
                        <i class="fas fa-user-tie mr-3 text-blue-500"></i>
                        <span>Drivers & Guides</span>
                        <span class="ml-auto w-2 h-2 bg-blue-500 rounded-full pulse-animation"></span>
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
                        <h1 class="text-2xl font-bold text-gray-900">Drivers & Tour Guides</h1>
                        <p class="text-sm text-gray-500 hidden sm:block">Manage your team of drivers and tour guides</p>
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
                                        <p class="text-sm text-gray-900">New team member added</p>
                                        <p class="text-xs text-gray-500">1 hour ago</p>
                                    </div>
                                    <div class="px-4 py-3 hover:bg-gray-50 border-b border-gray-100">
                                        <p class="text-sm text-gray-900">Driver availability updated</p>
                                        <p class="text-xs text-gray-500">2 hours ago</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Search -->
                        <div class="hidden md:block">
                            <div class="relative">
                                <input type="text" placeholder="Search team members..." 
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
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Drivers & Tour Guides</h2>
                <p class="text-gray-600">Manage your team of drivers and tour guides.</p>
            </div>
            <button @click="showAddModal = true" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors flex items-center">
                <i class="fas fa-user-plus mr-2"></i>
                Add Team Member
            </button>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Team</p>
                        <p class="text-3xl font-bold text-gray-900" x-text="teamMembers.length"></p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-users text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Drivers</p>
                        <p class="text-3xl font-bold text-green-600" x-text="getTeamByType('driver').length"></p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-car text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Tour Guides</p>
                        <p class="text-3xl font-bold text-purple-600" x-text="getTeamByType('guide').length"></p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-map-marked-alt text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Available Today</p>
                        <p class="text-3xl font-bold text-orange-600" x-text="getAvailableToday().length"></p>
                    </div>
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-check-circle text-orange-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <input type="text" 
                           x-model="searchQuery"
                           @input="filterTeam()"
                           placeholder="Search team members..."
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <select x-model="selectedType" 
                            @change="filterTeam()"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">All Types</option>
                        <option value="driver">Drivers</option>
                        <option value="guide">Tour Guides</option>
                        <option value="both">Both</option>
                    </select>
                </div>
                <div>
                    <select x-model="selectedStatus" 
                            @change="filterTeam()"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">All Status</option>
                        <option value="available">Available</option>
                        <option value="busy">Busy</option>
                        <option value="off">Off Duty</option>
                    </select>
                </div>
                <div>
                    <button @click="resetFilters()" class="w-full px-4 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Reset Filters
                    </button>
                </div>
            </div>
        </div>

        <!-- Team Members Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <template x-for="member in filteredTeam" :key="member.id">
                <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                    <div class="flex items-center mb-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-xl" x-text="member.name.charAt(0)"></span>
                        </div>
                        <div class="ml-4 flex-1">
                            <h3 class="text-lg font-semibold text-gray-900" x-text="member.name"></h3>
                            <p class="text-sm text-gray-500" x-text="member.type.charAt(0).toUpperCase() + member.type.slice(1)"></p>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium mt-1"
                                  :class="{
                                      'bg-green-100 text-green-800': member.status === 'available',
                                      'bg-yellow-100 text-yellow-800': member.status === 'busy',
                                      'bg-gray-100 text-gray-800': member.status === 'off'
                                  }"
                                  x-text="member.status.charAt(0).toUpperCase() + member.status.slice(1)"></span>
                        </div>
                    </div>
                    
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-phone mr-2"></i>
                            <span x-text="member.phone"></span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-id-card mr-2"></i>
                            <span x-text="'License: ' + member.license_number"></span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-calendar mr-2"></i>
                            <span x-text="'Joined: ' + member.joined_date"></span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-star mr-2"></i>
                            <span x-text="member.rating + '/5 (' + member.reviews + ' reviews)'"></span>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="text-center">
                            <p class="text-2xl font-bold text-blue-600" x-text="member.tours_completed"></p>
                            <p class="text-xs text-gray-500">Tours Completed</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-green-600" x-text="'₱' + member.earnings.toLocaleString()"></p>
                            <p class="text-xs text-gray-500">Total Earnings</p>
                        </div>
                    </div>
                    
                    <div class="flex space-x-2">
                        <button @click="viewMember(member)" class="flex-1 bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors text-sm">
                            <i class="fas fa-eye mr-1"></i>
                            View
                        </button>
                        <button @click="editMember(member)" class="flex-1 bg-gray-100 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-200 transition-colors text-sm">
                            <i class="fas fa-edit mr-1"></i>
                            Edit
                        </button>
                        <button @click="assignTour(member)" class="bg-green-100 text-green-600 py-2 px-4 rounded-lg hover:bg-green-200 transition-colors text-sm">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </template>
        </div>

        <!-- Empty State -->
        <div x-show="filteredTeam.length === 0" class="text-center py-12">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-users text-3xl text-gray-400"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">No team members found</h3>
            <p class="text-gray-600 mb-6">No team members match your current filters.</p>
            <button @click="resetFilters()" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                Clear Filters
            </button>
        </div>
    </div>

    <!-- Add/Edit Member Modal -->
    <div x-show="showAddModal || showEditModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        
        <div class="bg-white rounded-xl shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-900" x-text="showEditModal ? 'Edit Team Member' : 'Add Team Member'"></h3>
                    <button @click="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>

            <form @submit.prevent="saveMember()" class="p-6 space-y-6">
                <!-- Basic Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                        <input type="text" 
                               x-model="memberForm.name"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Enter full name"
                               required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number *</label>
                        <input type="tel" 
                               x-model="memberForm.phone"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="+63 912 345 6789"
                               required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Type *</label>
                        <select x-model="memberForm.type"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                            <option value="">Select type</option>
                            <option value="driver">Driver</option>
                            <option value="guide">Tour Guide</option>
                            <option value="both">Both</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">License Number *</label>
                        <input type="text" 
                               x-model="memberForm.license_number"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Enter license number"
                               required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input type="email" 
                               x-model="memberForm.email"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="member@example.com">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select x-model="memberForm.status"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="available">Available</option>
                            <option value="busy">Busy</option>
                            <option value="off">Off Duty</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                    <textarea x-model="memberForm.address"
                              rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                              placeholder="Enter address"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Specializations</label>
                    <textarea x-model="memberForm.specializations"
                              rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                              placeholder="e.g., Historical tours, Adventure activities, Multi-language support"></textarea>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <button type="button" @click="closeModal()" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <span x-text="showEditModal ? 'Update Member' : 'Add Member'"></span>
                    </button>
                </div>
            </form>
                </div>
            </main>
        </div>
    </div>

    <script>
        function driversGuidesManagement() {
            return {
                searchQuery: '',
                selectedType: '',
                selectedStatus: '',
                showAddModal: false,
                showEditModal: false,
                editingMember: null,
                sidebarOpen: true,
                memberForm: {
                    name: '',
                    phone: '',
                    type: '',
                    license_number: '',
                    email: '',
                    status: 'available',
                    address: '',
                    specializations: ''
                },
                teamMembers: [
                    {
                        id: 1,
                        name: 'Juan Dela Cruz',
                        phone: '+63 912 345 6789',
                        email: 'juan.delacruz@email.com',
                        type: 'both',
                        license_number: 'DL-2024-001',
                        status: 'available',
                        address: 'Tagbilaran City, Bohol',
                        specializations: 'Historical tours, Multi-language support',
                        joined_date: '2023-01-15',
                        rating: 4.9,
                        reviews: 156,
                        tours_completed: 89,
                        earnings: 125000
                    },
                    {
                        id: 2,
                        name: 'Maria Santos',
                        phone: '+63 912 345 6790',
                        email: 'maria.santos@email.com',
                        type: 'guide',
                        license_number: 'TG-2024-002',
                        status: 'busy',
                        address: 'Panglao Island, Bohol',
                        specializations: 'Adventure activities, Wildlife tours',
                        joined_date: '2023-03-20',
                        rating: 4.8,
                        reviews: 134,
                        tours_completed: 76,
                        earnings: 98000
                    },
                    {
                        id: 3,
                        name: 'Pedro Rodriguez',
                        phone: '+63 912 345 6791',
                        email: 'pedro.rodriguez@email.com',
                        type: 'driver',
                        license_number: 'DL-2024-003',
                        status: 'available',
                        address: 'Carmen, Bohol',
                        specializations: 'Long-distance driving, Vehicle maintenance',
                        joined_date: '2023-05-10',
                        rating: 4.7,
                        reviews: 98,
                        tours_completed: 45,
                        earnings: 67000
                    },
                    {
                        id: 4,
                        name: 'Ana Garcia',
                        phone: '+63 912 345 6792',
                        email: 'ana.garcia@email.com',
                        type: 'guide',
                        license_number: 'TG-2024-004',
                        status: 'off',
                        address: 'Loboc, Bohol',
                        specializations: 'Cultural heritage, Food tours',
                        joined_date: '2023-07-15',
                        rating: 4.9,
                        reviews: 112,
                        tours_completed: 67,
                        earnings: 89000
                    }
                ],
                filteredTeam: [],
                
                init() {
                    this.filteredTeam = [...this.teamMembers];
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
                
                filterTeam() {
                    let filtered = [...this.teamMembers];
                    
                    if (this.searchQuery) {
                        filtered = filtered.filter(member => 
                            member.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                            member.license_number.toLowerCase().includes(this.searchQuery.toLowerCase())
                        );
                    }
                    
                    if (this.selectedType) {
                        filtered = filtered.filter(member => member.type === this.selectedType);
                    }
                    
                    if (this.selectedStatus) {
                        filtered = filtered.filter(member => member.status === this.selectedStatus);
                    }
                    
                    this.filteredTeam = filtered;
                },
                
                resetFilters() {
                    this.searchQuery = '';
                    this.selectedType = '';
                    this.selectedStatus = '';
                    this.filteredTeam = [...this.teamMembers];
                },
                
                getTeamByType(type) {
                    return this.teamMembers.filter(member => member.type === type || member.type === 'both');
                },
                
                getAvailableToday() {
                    return this.teamMembers.filter(member => member.status === 'available');
                },
                
                viewMember(member) {
                    console.log('View member:', member);
                },
                
                editMember(member) {
                    this.editingMember = member;
                    this.memberForm = { ...member };
                    this.showEditModal = true;
                },
                
                assignTour(member) {
                    console.log('Assign tour to:', member);
                },
                
                saveMember() {
                    if (this.showEditModal) {
                        // Update existing member
                        const index = this.teamMembers.findIndex(member => member.id === this.editingMember.id);
                        this.teamMembers[index] = { ...this.memberForm, id: this.editingMember.id };
                    } else {
                        // Add new member
                        const newMember = {
                            ...this.memberForm,
                            id: Date.now(),
                            joined_date: new Date().toISOString().split('T')[0],
                            rating: 5.0,
                            reviews: 0,
                            tours_completed: 0,
                            earnings: 0
                        };
                        this.teamMembers.push(newMember);
                    }
                    
                    this.filteredTeam = [...this.teamMembers];
                    this.closeModal();
                },
                
                closeModal() {
                    this.showAddModal = false;
                    this.showEditModal = false;
                    this.editingMember = null;
                    this.memberForm = {
                        name: '',
                        phone: '',
                        type: '',
                        license_number: '',
                        email: '',
                        status: 'available',
                        address: '',
                        specializations: ''
                    };
                }
            }
        }
    </script>
</body>
</html>
