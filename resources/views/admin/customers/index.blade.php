@extends('admin.layout')

@section('title', 'Customers | TravelBuddy')
@section('page-title', 'Customers')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Customer Management</h2>
                <p class="text-gray-600">View and manage your customers</p>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Customer Type</label>
                    <select class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Types</option>
                        <option value="new">New Customers</option>
                        <option value="returning">Returning</option>
                        <option value="vip">VIP</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                    <input type="text" placeholder="Search customers..." class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex items-end">
                    <button class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                        <i class="fa-solid fa-search mr-2"></i>Search
                    </button>
                </div>
            </div>
        </div>

        <!-- Customers Table -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr class="text-left text-gray-500 border-b border-gray-200">
                            <th class="py-4 px-6 font-semibold">Customer</th>
                            <th class="py-4 px-6 font-semibold">Contact</th>
                            <th class="py-4 px-6 font-semibold">Total Bookings</th>
                            <th class="py-4 px-6 font-semibold">Last Booking</th>
                            <th class="py-4 px-6 font-semibold">Total Spent</th>
                            <th class="py-4 px-6 font-semibold">Status</th>
                            <th class="py-4 px-6 font-semibold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($customers as $customer)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-6">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                            {{ $customer['avatar'] }}
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900">{{ $customer['name'] }}</div>
                                            <div class="text-xs text-gray-500">Customer ID: #C{{ str_pad(rand(1000, 9999), 4, '0', STR_PAD_LEFT) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="text-sm text-gray-900">{{ $customer['email'] }}</div>
                                    <div class="text-xs text-gray-500">{{ $customer['phone'] }}</div>
                                </td>
                                <td class="py-4 px-6 text-gray-600">{{ $customer['bookings'] }}</td>
                                <td class="py-4 px-6 text-gray-600">{{ $customer['last_booking'] }}</td>
                                <td class="py-4 px-6 font-semibold text-gray-900">{{ $customer['total_spent'] }}</td>
                                <td class="py-4 px-6">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $customer['status_color'] }}">
                                        {{ $customer['status'] }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <button class="text-blue-600 hover:text-blue-800 p-1" title="View Profile">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                        <button class="text-green-600 hover:text-green-800 p-1" title="Edit">
                                            <i class="fa-solid fa-edit"></i>
                                        </button>
                                        <button class="text-purple-600 hover:text-purple-800 p-1" title="Message">
                                            <i class="fa-solid fa-message"></i>
                                        </button>
                                        <button class="text-amber-600 hover:text-amber-800 p-1" title="Booking History">
                                            <i class="fa-solid fa-history"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="bg-gray-50 px-6 py-4 flex items-center justify-between">
                <div class="text-sm text-gray-500">
                    Showing 1 to 6 of 156 customers
                </div>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 text-sm border border-gray-300 rounded-lg hover:bg-gray-100 disabled:opacity-50" disabled>
                        Previous
                    </button>
                    <button class="px-3 py-1 text-sm bg-blue-600 text-white rounded-lg">1</button>
                    <button class="px-3 py-1 text-sm border border-gray-300 rounded-lg hover:bg-gray-100">2</button>
                    <button class="px-3 py-1 text-sm border border-gray-300 rounded-lg hover:bg-gray-100">3</button>
                    <button class="px-3 py-1 text-sm border border-gray-300 rounded-lg hover:bg-gray-100">
                        Next
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
