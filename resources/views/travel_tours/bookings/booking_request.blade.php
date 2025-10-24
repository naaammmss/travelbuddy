@extends('travel_tours.travel_layout')

@section('title', 'Travel & Tours Dashboard | TravelBuddy')
@section('page-title', 'Booking Requests')

@section('content')
<div x-data="bookingManager()" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900 flex items-center gap-3">
                Booking Management
            </h2>
            <p class="text-gray-600 mt-1">Monitor, confirm, or cancel customer bookings efficiently.</p>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white shadow-md rounded-2xl p-6 border border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <!-- Search -->
            <div class="relative md:col-span-2">
                <i class="fas fa-search absolute left-3 top-3.5 text-gray-400"></i>
                <input type="text" placeholder="Search by name, package, or email..." 
                    x-model="searchQuery"
                    class="pl-10 pr-4 py-3 w-full border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>

            <!-- Status -->
            <select x-model="selectedStatus"
                class="px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                <option value="">All Status</option>
                <option value="Pending">Pending</option>
                <option value="Confirmed">Confirmed</option>
                <option value="Cancelled">Cancelled</option>
                <option value="Completed">Completed</option>
            </select>

            <!-- Date -->
            <input type="date" x-model="selectedDate"
                class="px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">

            <!-- Reset -->
            <button @click="resetFilters"
                class="bg-gray-100 px-4 py-3 rounded-xl hover:bg-gray-200 text-gray-700 font-medium transition">
                <i class="fas fa-undo mr-2"></i> Reset
            </button>
        </div>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 text-gray-600 text-sm font-semibold uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left">Booking ID</th>
                        <th class="px-6 py-3 text-left">Customer</th>
                        <th class="px-6 py-3 text-left">Package</th>
                        <th class="px-6 py-3 text-left">Date</th>
                        <th class="px-6 py-3 text-left">People</th>
                        <th class="px-6 py-3 text-left">Total</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($bookings as $booking)
                        <tr class="hover:bg-blue-50 transition duration-150 ease-in-out">
                            <td class="px-6 py-4 font-semibold text-gray-800">#{{ $booking->id }}</td>

                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-900">{{ $booking->full_name }}</div>
                                <div class="text-gray-500 text-sm">{{ $booking->email }}</div>
                            </td>

                            <td class="px-6 py-4 text-gray-700">{{ $booking->package->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $booking->travel_date }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $booking->participants }}</td>

                            <td class="px-6 py-4 font-bold text-blue-600">
                                ₱{{ number_format($booking->total_price, 2) }}
                            </td>

                            <td class="px-6 py-4">
                                <span class="px-3 py-1.5 text-xs rounded-full font-semibold 
                                    @if($booking->status=='Pending') bg-yellow-100 text-yellow-800
                                    @elseif($booking->status=='Confirmed') bg-green-100 text-green-800
                                    @elseif($booking->status=='Cancelled') bg-red-100 text-red-800
                                    @elseif($booking->status=='Completed') bg-blue-100 text-blue-800
                                    @else bg-gray-100 text-gray-600 @endif">
                                    {{ $booking->status }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center space-x-3">
                                    <button @click="updateStatus({{ $booking->id }}, 'Confirmed')" 
                                        class="p-2 rounded-lg bg-green-50 text-green-600 hover:bg-green-100 transition" 
                                        title="Confirm">
                                        <i class="fas fa-check"></i>
                                    </button>

                                    <button @click="updateStatus({{ $booking->id }}, 'Cancelled')" 
                                        class="p-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition" 
                                        title="Cancel">
                                        <i class="fas fa-times"></i>
                                    </button>

                                    <button @click="updateStatus({{ $booking->id }}, 'Completed')" 
                                        class="p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition" 
                                        title="Mark as Completed">
                                        <i class="fas fa-flag-checkered"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-10 text-gray-500 text-sm">
                                <i class="fas fa-folder-open text-3xl text-gray-400 mb-3"></i><br>
                                No bookings found at the moment.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Alpine.js Booking Manager -->
<script>
function bookingManager() {
    return {
        searchQuery: '',
        selectedStatus: '',
        selectedDate: '',

        resetFilters() {
            this.searchQuery = '';
            this.selectedStatus = '';
            this.selectedDate = '';
        },

        updateStatus(id, status) {
            if (!confirm(`Are you sure you want to mark this booking as "${status}"?`)) return;

            fetch(`/travel_tours/bookings/update-status/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ status: status })
            }).then(() => location.reload());
        }
    }
}
</script>
@endsection
