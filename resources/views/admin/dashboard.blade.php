@extends('admin.layout')

@section('title', 'Admin Dashboard | TravelBuddy')
@section('page-title', 'Dashboard')

@section('content')
    <div class="space-y-6">
        <!-- Metrics -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-sm text-gray-500">Total Users</div>
                        <div class="text-3xl font-extrabold mt-1">{{ number_format($metrics['totalUsers']) }}</div>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl">👥</div>
                </div>
                <div class="mt-4 text-xs text-green-600 font-medium">▲ 4.2% vs last week</div>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-sm text-gray-500">Active Trips</div>
                        <div class="text-3xl font-extrabold mt-1">{{ number_format($metrics['activeTrips']) }}</div>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl">🧭</div>
                </div>
                <div class="mt-4 text-xs text-green-600 font-medium">▲ 1.1% vs last week</div>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-sm text-gray-500">Bookings Today</div>
                        <div class="text-3xl font-extrabold mt-1">{{ number_format($metrics['bookingsToday']) }}</div>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl">🛒</div>
                </div>
                <div class="mt-4 text-xs text-red-600 font-medium">▼ 0.6% vs yesterday</div>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-sm text-gray-500">Open Tickets</div>
                        <div class="text-3xl font-extrabold mt-1">{{ number_format($metrics['supportTickets']) }}</div>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-xl">🛟</div>
                </div>
                <div class="mt-4 text-xs text-gray-500 font-medium">SLA: 98% last 7d</div>
            </div>
        </div>

        <!-- Charts and table -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Bookings chart -->
            <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-semibold">Bookings (Last 7 days)</h3>
                    <div class="text-xs text-gray-500">Updated just now</div>
                </div>
                <div class="h-64 grid grid-cols-12 gap-2 items-end">
                    @php $bars = [14,18,12,22,27,20,24]; @endphp
                    @foreach($bars as $i => $h)
                        <div class="bg-blue-500/80 rounded-md" style="height: {{ $h * 6 }}px"></div>
                    @endforeach
                </div>
            </div>

            <!-- Top attractions -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <h3 class="font-semibold mb-4">Top Attractions</h3>
                <ul class="divide-y divide-gray-100">
                    @foreach([
                        ['Chocolate Hills', '4.9', '1,245 visits'],
                        ['Tarsier Sanctuary', '4.8', '1,010 visits'],
                        ['Loboc River Cruise', '4.7', '870 visits'],
                        ['Hinagdanan Cave', '4.6', '740 visits'],
                    ] as $row)
                        <li class="py-3 flex items-center justify-between">
                            <div>
                                <div class="font-medium">{{ $row[0] }}</div>
                                <div class="text-xs text-gray-500">{{ $row[2] }}</div>
                            </div>
                            <div class="text-sm text-yellow-600">★ {{ $row[1] }}</div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Recent bookings -->
        <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-semibold">Recent Bookings</h3>
                <a href="#" class="text-sm text-blue-600 hover:underline">View all</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left text-gray-500 border-b border-gray-200">
                            <th class="py-3 pr-6">Traveler</th>
                            <th class="py-3 pr-6">Package</th>
                            <th class="py-3 pr-6">Date</th>
                            <th class="py-3 pr-6">Status</th>
                            <th class="py-3 pr-6 text-right">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach([
                            ['Anna Lee', 'Bohol Highlights (3D2N)', '2025-09-22', 'Confirmed', '₱7,500'],
                            ['John Cruz', 'Adventure & Nature (4D3N)', '2025-09-22', 'Pending', '₱11,200'],
                            ['Sarah M.', 'Beach Escape (2D1N)', '2025-09-21', 'Refunded', '₱3,999'],
                            ['Mark T.', 'Cultural Heritage (1 Day)', '2025-09-20', 'Completed', '₱2,500'],
                        ] as $b)
                            <tr>
                                <td class="py-3 pr-6 font-medium text-gray-900">{{ $b[0] }}</td>
                                <td class="py-3 pr-6">{{ $b[1] }}</td>
                                <td class="py-3 pr-6">{{ $b[2] }}</td>
                                <td class="py-3 pr-6">
                                    @php $status = $b[3]; $map = [
                                        'Confirmed' => 'bg-green-100 text-green-700',
                                        'Pending' => 'bg-amber-100 text-amber-700',
                                        'Refunded' => 'bg-rose-100 text-rose-700',
                                        'Completed' => 'bg-blue-100 text-blue-700',
                                    ]; @endphp
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $map[$status] ?? 'bg-gray-100 text-gray-700' }}">{{ $status }}</span>
                                </td>
                                <td class="py-3 pr-6 text-right font-medium">{{ $b[4] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


