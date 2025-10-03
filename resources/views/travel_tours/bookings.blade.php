@extends('travel & tours.travel_layout')

@section('title', 'Travel & Tours Dashboard  | TravelBuddy')
@section('page-title', 'Bookings')

@section('content')
    <!-- <style>
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
    </style> -->
    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Bookings Management</h2>
                    <p class="text-gray-600">Manage customer bookings and tour requests.</p>
                </div>
            </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Bookings</p>
                        <p class="text-3xl font-bold text-gray-900" x-text="bookings.length"></p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-calendar-check text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Pending</p>
                        <p class="text-3xl font-bold text-yellow-600" x-text="getBookingsByStatus('pending').length"></p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-clock text-yellow-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Confirmed</p>
                        <p class="text-3xl font-bold text-green-600" x-text="getBookingsByStatus('confirmed').length"></p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Revenue</p>
                        <p class="text-3xl font-bold text-purple-600" x-text="'₱' + getTotalRevenue().toLocaleString()"></p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-chart-line text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div>
                    <input type="text" 
                           x-model="searchQuery"
                           @input="filterBookings()"
                           placeholder="Search bookings..."
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <select x-model="selectedStatus" 
                            @change="filterBookings()"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
                <div>
                    <select x-model="selectedPackage" 
                            @change="filterBookings()"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">All Packages</option>
                        <option value="Bohol Island Hopping">Bohol Island Hopping</option>
                        <option value="Chocolate Hills Tour">Chocolate Hills Tour</option>
                        <option value="Cultural Heritage Tour">Cultural Heritage Tour</option>
                    </select>
                </div>
                <div>
                    <input type="date" 
                           x-model="selectedDate"
                           @change="filterBookings()"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <button @click="resetFilters()" class="w-full px-4 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Reset Filters
                    </button>
                </div>
            </div>
        </div>

        <!-- Bookings Table -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Booking ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Package</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Participants</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <template x-for="booking in filteredBookings" :key="booking.id">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900" x-text="'#' + booking.id"></div>
                                    <div class="text-sm text-gray-500" x-text="booking.created_at"></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-user text-blue-600"></i>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900" x-text="booking.customer_name"></div>
                                            <div class="text-sm text-gray-500" x-text="booking.customer_email"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900" x-text="booking.package_name"></div>
                                    <div class="text-sm text-gray-500" x-text="booking.package_category"></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900" x-text="booking.tour_date"></div>
                                    <div class="text-sm text-gray-500" x-text="booking.tour_time"></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900" x-text="booking.participants + ' people'"></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900" x-text="'₱' + booking.total_amount.toLocaleString()"></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                          :class="{
                                              'bg-yellow-100 text-yellow-800': booking.status === 'pending',
                                              'bg-green-100 text-green-800': booking.status === 'confirmed',
                                              'bg-red-100 text-red-800': booking.status === 'cancelled',
                                              'bg-blue-100 text-blue-800': booking.status === 'completed'
                                          }"
                                          x-text="booking.status.charAt(0).toUpperCase() + booking.status.slice(1)"></span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <template x-if="booking.status === 'pending'">
                                            <div class="flex space-x-1">
                                                <button @click="updateBookingStatus(booking.id, 'confirmed')" 
                                                        class="text-green-600 hover:text-green-900">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                                <button @click="updateBookingStatus(booking.id, 'cancelled')" 
                                                        class="text-red-600 hover:text-red-900">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </template>
                                        <template x-if="booking.status === 'confirmed'">
                                            <button @click="updateBookingStatus(booking.id, 'completed')" 
                                                    class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-flag-checkered"></i>
                                            </button>
                                        </template>
                                        <button @click="viewBooking(booking)" class="text-gray-600 hover:text-gray-900">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button @click="editBooking(booking)" class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Empty State -->
        <div x-show="filteredBookings.length === 0" class="text-center py-12">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-calendar-times text-3xl text-gray-400"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">No bookings found</h3>
            <p class="text-gray-600 mb-6">No bookings match your current filters.</p>
            <button @click="resetFilters()" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                Clear Filters
            </button>
        </div>
    </div>

    <!-- Booking Details Modal -->
    <div x-show="showDetailsModal" 
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
                    <h3 class="text-xl font-bold text-gray-900">Booking Details</h3>
                    <button @click="showDetailsModal = false" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>

            <div class="p-6" x-show="selectedBooking">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-2">Customer Information</h4>
                        <div class="space-y-2 text-sm">
                            <p><span class="font-medium">Name:</span> <span x-text="selectedBooking?.customer_name"></span></p>
                            <p><span class="font-medium">Email:</span> <span x-text="selectedBooking?.customer_email"></span></p>
                            <p><span class="font-medium">Phone:</span> <span x-text="selectedBooking?.customer_phone"></span></p>
                        </div>
                    </div>
                    
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-2">Booking Information</h4>
                        <div class="space-y-2 text-sm">
                            <p><span class="font-medium">Booking ID:</span> #<span x-text="selectedBooking?.id"></span></p>
                            <p><span class="font-medium">Date:</span> <span x-text="selectedBooking?.tour_date"></span></p>
                            <p><span class="font-medium">Time:</span> <span x-text="selectedBooking?.tour_time"></span></p>
                            <p><span class="font-medium">Participants:</span> <span x-text="selectedBooking?.participants"></span></p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6">
                    <h4 class="font-semibold text-gray-900 mb-2">Package Details</h4>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="font-medium" x-text="selectedBooking?.package_name"></p>
                        <p class="text-sm text-gray-600" x-text="selectedBooking?.package_category"></p>
                    </div>
                </div>
                
                <div class="mt-6">
                    <h4 class="font-semibold text-gray-900 mb-2">Payment Information</h4>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <p><span class="font-medium">Base Price:</span> ₱<span x-text="selectedBooking?.base_price?.toLocaleString()"></span></p>
                        <p><span class="font-medium">Total Amount:</span> ₱<span x-text="selectedBooking?.total_amount?.toLocaleString()"></span></p>
                        <p><span class="font-medium">Payment Status:</span> <span x-text="selectedBooking?.payment_status"></span></p>
                        <p><span class="font-medium">Payment Method:</span> <span x-text="selectedBooking?.payment_method"></span></p>
                    </div>
                </div>
                
                <div class="mt-6">
                    <h4 class="font-semibold text-gray-900 mb-2">Special Requests</h4>
                    <p class="text-sm text-gray-600" x-text="selectedBooking?.special_requests || 'No special requests'"></p>
                </div>
            </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        function bookingsManagement() {
            return {
                searchQuery: '',
                selectedStatus: '',
                selectedPackage: '',
                selectedDate: '',
                showDetailsModal: false,
                selectedBooking: null,
                sidebarOpen: true,
                bookings: [
                    {
                        id: 'BK001',
                        customer_name: 'Sarah Johnson',
                        customer_email: 'sarah.johnson@email.com',
                        customer_phone: '+1 234 567 8900',
                        package_name: 'Bohol Island Hopping Adventure',
                        package_category: 'Adventure',
                        tour_date: '2025-02-15',
                        tour_time: '08:00 AM',
                        participants: 4,
                        base_price: 2500,
                        total_amount: 10000,
                        status: 'pending',
                        payment_status: 'Pending',
                        payment_method: 'Credit Card',
                        special_requests: 'Vegetarian meals for 2 participants',
                        created_at: '2025-01-10'
                    },
                    {
                        id: 'BK002',
                        customer_name: 'Michael Chen',
                        customer_email: 'michael.chen@email.com',
                        customer_phone: '+1 234 567 8901',
                        package_name: 'Chocolate Hills & Tarsier Tour',
                        package_category: 'Nature',
                        tour_date: '2025-02-12',
                        tour_time: '09:00 AM',
                        participants: 2,
                        base_price: 1800,
                        total_amount: 3600,
                        status: 'confirmed',
                        payment_status: 'Paid',
                        payment_method: 'PayPal',
                        special_requests: 'Pickup from hotel',
                        created_at: '2025-01-08'
                    },
                    {
                        id: 'BK003',
                        customer_name: 'Emily Rodriguez',
                        customer_email: 'emily.rodriguez@email.com',
                        customer_phone: '+1 234 567 8902',
                        package_name: 'Cultural Heritage Tour',
                        package_category: 'Cultural',
                        tour_date: '2025-02-08',
                        tour_time: '10:00 AM',
                        participants: 6,
                        base_price: 2200,
                        total_amount: 13200,
                        status: 'completed',
                        payment_status: 'Paid',
                        payment_method: 'Bank Transfer',
                        special_requests: 'Spanish speaking guide',
                        created_at: '2025-01-05'
                    },
                    {
                        id: 'BK004',
                        customer_name: 'David Kim',
                        customer_email: 'david.kim@email.com',
                        customer_phone: '+1 234 567 8903',
                        package_name: 'Bohol Island Hopping Adventure',
                        package_category: 'Adventure',
                        tour_date: '2025-02-20',
                        tour_time: '07:30 AM',
                        participants: 8,
                        base_price: 2500,
                        total_amount: 20000,
                        status: 'pending',
                        payment_status: 'Pending',
                        payment_method: 'Credit Card',
                        special_requests: 'Private boat',
                        created_at: '2025-01-12'
                    }
                ],
                filteredBookings: [],
                
                init() {
                    this.filteredBookings = [...this.bookings];
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
                
                filterBookings() {
                    let filtered = [...this.bookings];
                    
                    if (this.searchQuery) {
                        filtered = filtered.filter(booking => 
                            booking.customer_name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                            booking.package_name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                            booking.id.toLowerCase().includes(this.searchQuery.toLowerCase())
                        );
                    }
                    
                    if (this.selectedStatus) {
                        filtered = filtered.filter(booking => booking.status === this.selectedStatus);
                    }
                    
                    if (this.selectedPackage) {
                        filtered = filtered.filter(booking => booking.package_name === this.selectedPackage);
                    }
                    
                    if (this.selectedDate) {
                        filtered = filtered.filter(booking => booking.tour_date === this.selectedDate);
                    }
                    
                    this.filteredBookings = filtered;
                },
                
                resetFilters() {
                    this.searchQuery = '';
                    this.selectedStatus = '';
                    this.selectedPackage = '';
                    this.selectedDate = '';
                    this.filteredBookings = [...this.bookings];
                },
                
                getBookingsByStatus(status) {
                    return this.bookings.filter(booking => booking.status === status);
                },
                
                getTotalRevenue() {
                    return this.bookings
                        .filter(booking => booking.status === 'confirmed' || booking.status === 'completed')
                        .reduce((total, booking) => total + booking.total_amount, 0);
                },
                
                updateBookingStatus(id, status) {
                    const booking = this.bookings.find(b => b.id === id);
                    if (booking) {
                        booking.status = status;
                        if (status === 'confirmed' || status === 'completed') {
                            booking.payment_status = 'Paid';
                        }
                        this.filteredBookings = [...this.bookings];
                    }
                },
                
                viewBooking(booking) {
                    this.selectedBooking = booking;
                    this.showDetailsModal = true;
                },
                
                editBooking(booking) {
                    // Implement edit functionality
                    console.log('Edit booking:', booking);
                },
                
                exportBookings() {
                    // Implement export functionality
                    console.log('Export bookings');
                }
            }
        }
    </script>
