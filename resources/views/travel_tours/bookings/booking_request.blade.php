@extends('travel_tours.travel_layout')

@section('title', 'Travel & Tours Dashboard  | TravelBuddy')
@section('page-title', 'booking_request')

@section('content')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Bookings Management</h2>
                <p class="text-gray-600">Manage customer bookings and tour requests.</p>
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
    
@endsection