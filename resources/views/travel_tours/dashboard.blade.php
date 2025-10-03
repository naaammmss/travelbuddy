@extends('travel & tours.travel_layout')

@section('title', 'Travel & Tours Dashboard  | TravelBuddy')
@section('page-title', 'Dashboard')

@section('content')

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Welcome Section -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Welcome back, Admin!</h2>
            <p class="text-gray-600">Here's what's happening with your travel business today.</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Bookings -->
            <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Bookings</p>
                        <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['total_bookings']) }}</p>
                        <p class="text-sm text-green-600 flex items-center mt-1">
                            <i class="fas fa-arrow-up mr-1"></i>
                            +12% from last month
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-calendar-check text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Active Tours -->
            <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Active Tours</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $stats['active_tours'] }}</p>
                        <p class="text-sm text-blue-600 flex items-center mt-1">
                            <i class="fas fa-map-marked-alt mr-1"></i>
                            Currently running
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-route text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Customers -->
            <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Customers</p>
                        <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['total_customers']) }}</p>
                        <p class="text-sm text-purple-600 flex items-center mt-1">
                            <i class="fas fa-users mr-1"></i>
                            {{ $stats['repeat_customers'] }}% repeat customers
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-user-friends text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Monthly Revenue -->
            <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Monthly Revenue</p>
                        <p class="text-3xl font-bold text-gray-900">₱{{ number_format($stats['monthly_revenue']) }}</p>
                        <p class="text-sm text-green-600 flex items-center mt-1">
                            <i class="fas fa-arrow-up mr-1"></i>
                            +8% from last month
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-chart-line text-yellow-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts and Analytics Row -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Revenue Chart -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Monthly Revenue</h3>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 text-sm bg-blue-100 text-blue-600 rounded-lg">6M</button>
                        <button class="px-3 py-1 text-sm text-gray-600 hover:bg-gray-100 rounded-lg">1Y</button>
                    </div>
                </div>
                <div class="h-64">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

            <!-- Customer Demographics -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">Customer Demographics</h3>
                <div class="h-64 flex items-center justify-center">
                    <div class="relative w-48 h-48">
                        <canvas id="demographicsChart"></canvas>
                    </div>
                </div>
                <div class="flex justify-center space-x-6 mt-4">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div>
                        <span class="text-sm text-gray-600">Domestic ({{ $customer_demographics['domestic'] }}%)</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                        <span class="text-sm text-gray-600">International ({{ $customer_demographics['international'] }}%)</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Bookings and Popular Tours -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Bookings -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Bookings</h3>
                    <a href="#" class="text-blue-600 hover:text-blue-700 text-sm font-medium">View All</a>
                </div>
                <div class="space-y-4">
                    @foreach($recent_bookings as $booking)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-user text-blue-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">{{ $booking['customer_name'] }}</p>
                                <p class="text-sm text-gray-600">{{ $booking['tour_name'] }}</p>
                                <p class="text-xs text-gray-500">{{ $booking['date'] }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($booking['status'] == 'confirmed') bg-green-100 text-green-800
                                @elseif($booking['status'] == 'pending') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst($booking['status']) }}
                            </span>
                            <p class="text-sm font-medium text-gray-900 mt-1">₱{{ number_format($booking['amount']) }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Popular Tours -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Popular Tours</h3>
                    <a href="#" class="text-blue-600 hover:text-blue-700 text-sm font-medium">View All</a>
                </div>
                <div class="space-y-4">
                    @foreach($popular_tours as $tour)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-map-marked-alt text-green-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">{{ $tour['name'] }}</p>
                                <p class="text-sm text-gray-600">{{ $tour['bookings'] }} bookings</p>
                                <div class="flex items-center">
                                    <div class="flex text-yellow-400">
                                        @for($i = 0; $i < 5; $i++)
                                            <i class="fas fa-star text-xs"></i>
                                        @endfor
                                    </div>
                                    <span class="text-xs text-gray-500 ml-1">{{ $tour['rating'] }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-900">₱{{ number_format($tour['revenue']) }}</p>
                            <p class="text-xs text-gray-500">Revenue</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        function dashboard() {
            return {
                init() {
                    this.initCharts();
                },
                
                initCharts() {
                    // Revenue Chart
                    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
                    new Chart(revenueCtx, {
                        type: 'line',
                        data: {
                            labels: Object.keys(@json($monthly_revenue)),
                            datasets: [{
                                label: 'Revenue (₱)',
                                data: Object.values(@json($monthly_revenue)),
                                borderColor: 'rgb(59, 130, 246)',
                                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                borderWidth: 3,
                                fill: true,
                                tension: 0.4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value) {
                                            return '₱' + value.toLocaleString();
                                        }
                                    }
                                }
                            }
                        }
                    });

                    // Demographics Chart
                    const demographicsCtx = document.getElementById('demographicsChart').getContext('2d');
                    new Chart(demographicsCtx, {
                        type: 'doughnut',
                        data: {
                            labels: ['Domestic', 'International'],
                            datasets: [{
                                data: [{{ $customer_demographics['domestic'] }}, {{ $customer_demographics['international'] }}],
                                backgroundColor: ['rgb(59, 130, 246)', 'rgb(34, 197, 94)'],
                                borderWidth: 0
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            }
                        }
                    });
                }
            }
        }
    </script>

    <style>
        body { 
            font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; 
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        .stat-card {
            background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1);
        }
    </style>
@endsection
