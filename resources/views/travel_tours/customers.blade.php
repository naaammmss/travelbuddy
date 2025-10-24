@extends('travel_tours.travel_layout')

@section('title', 'Travel & Tours Dashboard  | TravelBuddy')
@section('page-title', 'Customers')

@section('content')

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Customer Management</h2>
                <p class="text-gray-600">Manage your customer database and relationships.</p>
            </div>
            <button @click="showAddModal = true" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors flex items-center">
                <i class="fas fa-user-plus mr-2"></i>
                Add Customer
            </button>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Customers</p>
                        <p class="text-3xl font-bold text-gray-900" x-text="customers.length"></p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-users text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">New This Month</p>
                        <p class="text-3xl font-bold text-green-600" x-text="getNewCustomersThisMonth()"></p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-user-plus text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Repeat Customers</p>
                        <p class="text-3xl font-bold text-purple-600" x-text="getRepeatCustomers()"></p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-redo text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Bookings</p>
                        <p class="text-3xl font-bold text-orange-600" x-text="getTotalBookings()"></p>
                    </div>
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-calendar-check text-orange-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <input type="text" 
                           x-model="searchQuery"
                           @input="filterCustomers()"
                           placeholder="Search customers..."
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <select x-model="selectedType" 
                            @change="filterCustomers()"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">All Types</option>
                        <option value="individual">Individual</option>
                        <option value="group">Group</option>
                        <option value="corporate">Corporate</option>
                    </select>
                </div>
                <div>
                    <select x-model="selectedStatus" 
                            @change="filterCustomers()"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div>
                    <button @click="resetFilters()" class="w-full px-4 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Reset Filters
                    </button>
                </div>
            </div>
        </div>

        <!-- Customers Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <template x-for="customer in filteredCustomers" :key="customer.id">
                <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                    <div class="flex items-center mb-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-xl" x-text="customer.name.charAt(0)"></span>
                        </div>
                        <div class="ml-4 flex-1">
                            <h3 class="text-lg font-semibold text-gray-900" x-text="customer.name"></h3>
                            <p class="text-sm text-gray-500" x-text="customer.email"></p>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium mt-1"
                                  :class="{
                                      'bg-green-100 text-green-800': customer.status === 'active',
                                      'bg-gray-100 text-gray-800': customer.status === 'inactive',
                                      'bg-purple-100 text-purple-800': customer.status === 'vip'
                                  }"
                                  x-text="customer.status.charAt(0).toUpperCase() + customer.status.slice(1)"></span>
                        </div>
                    </div>
                    
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-phone mr-2"></i>
                            <span x-text="customer.phone"></span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span x-text="customer.location"></span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-calendar mr-2"></i>
                            <span x-text="'Joined: ' + customer.joined_date"></span>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="text-center">
                            <p class="text-2xl font-bold text-blue-600" x-text="customer.total_bookings"></p>
                            <p class="text-xs text-gray-500">Bookings</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-green-600" x-text="'₱' + customer.total_spent.toLocaleString()"></p>
                            <p class="text-xs text-gray-500">Total Spent</p>
                        </div>
                    </div>
                    
                    <div class="flex space-x-2">
                        <button @click="viewCustomer(customer)" class="flex-1 bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors text-sm">
                            <i class="fas fa-eye mr-1"></i>
                            View
                        </button>
                        <button @click="editCustomer(customer)" class="flex-1 bg-gray-100 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-200 transition-colors text-sm">
                            <i class="fas fa-edit mr-1"></i>
                            Edit
                        </button>
                        <button @click="contactCustomer(customer)" class="bg-green-100 text-green-600 py-2 px-4 rounded-lg hover:bg-green-200 transition-colors text-sm">
                            <i class="fas fa-envelope"></i>
                        </button>
                    </div>
                </div>
            </template>
        </div>

        <!-- Empty State -->
        <div x-show="filteredCustomers.length === 0" class="text-center py-12">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-users text-3xl text-gray-400"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">No customers found</h3>
            <p class="text-gray-600 mb-6">No customers match your current filters.</p>
            <button @click="resetFilters()" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                Clear Filters
            </button>
        </div>
    </div>

    <script>
        function customersManagement() {
            return {
                searchQuery: '',
                selectedType: '',
                selectedStatus: '',
                showAddModal: false,
                customers: [
                    {
                        id: 1,
                        name: 'Sarah Johnson',
                        email: 'sarah.johnson@email.com',
                        phone: '+1 234 567 8900',
                        location: 'New York, USA',
                        type: 'individual',
                        status: 'active',
                        joined_date: '2024-01-15',
                        total_bookings: 3,
                        total_spent: 15000
                    },
                    {
                        id: 2,
                        name: 'Michael Chen',
                        email: 'michael.chen@email.com',
                        phone: '+1 234 567 8901',
                        location: 'Los Angeles, USA',
                        type: 'individual',
                        status: 'vip',
                        joined_date: '2023-11-20',
                        total_bookings: 8,
                        total_spent: 45000
                    },
                    {
                        id: 3,
                        name: 'Emily Rodriguez',
                        email: 'emily.rodriguez@email.com',
                        phone: '+1 234 567 8902',
                        location: 'Miami, USA',
                        type: 'group',
                        status: 'active',
                        joined_date: '2024-02-10',
                        total_bookings: 2,
                        total_spent: 12000
                    },
                    {
                        id: 4,
                        name: 'David Kim',
                        email: 'david.kim@email.com',
                        phone: '+1 234 567 8903',
                        location: 'Seattle, USA',
                        type: 'corporate',
                        status: 'active',
                        joined_date: '2023-09-05',
                        total_bookings: 12,
                        total_spent: 85000
                    },
                    {
                        id: 5,
                        name: 'Lisa Wang',
                        email: 'lisa.wang@email.com',
                        phone: '+1 234 567 8904',
                        location: 'San Francisco, USA',
                        type: 'individual',
                        status: 'inactive',
                        joined_date: '2024-01-30',
                        total_bookings: 1,
                        total_spent: 5000
                    }
                ],
                filteredCustomers: [],
                
                init() {
                    this.filteredCustomers = [...this.customers];
                },
                
                filterCustomers() {
                    let filtered = [...this.customers];
                    
                    if (this.searchQuery) {
                        filtered = filtered.filter(customer => 
                            customer.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                            customer.email.toLowerCase().includes(this.searchQuery.toLowerCase())
                        );
                    }
                    
                    if (this.selectedType) {
                        filtered = filtered.filter(customer => customer.type === this.selectedType);
                    }
                    
                    if (this.selectedStatus) {
                        filtered = filtered.filter(customer => customer.status === this.selectedStatus);
                    }
                    
                    this.filteredCustomers = filtered;
                },
                
                resetFilters() {
                    this.searchQuery = '';
                    this.selectedType = '';
                    this.selectedStatus = '';
                    this.filteredCustomers = [...this.customers];
                },
                
                getNewCustomersThisMonth() {
                    const currentMonth = new Date().getMonth();
                    const currentYear = new Date().getFullYear();
                    return this.customers.filter(customer => {
                        const joinedDate = new Date(customer.joined_date);
                        return joinedDate.getMonth() === currentMonth && joinedDate.getFullYear() === currentYear;
                    }).length;
                },
                
                getRepeatCustomers() {
                    return this.customers.filter(customer => customer.total_bookings > 1).length;
                },
                
                getTotalBookings() {
                    return this.customers.reduce((total, customer) => total + customer.total_bookings, 0);
                },
                
                viewCustomer(customer) {
                    console.log('View customer:', customer);
                },
                
                editCustomer(customer) {
                    console.log('Edit customer:', customer);
                },
                
                contactCustomer(customer) {
                    console.log('Contact customer:', customer);
                }
            }
        }
    </script>
    <style>
        body { 
            font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; 
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
    </style>


