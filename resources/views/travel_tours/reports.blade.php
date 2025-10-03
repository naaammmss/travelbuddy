<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reports & Analytics | Travel & Tours Dashboard</title>
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
</head>
<body class="bg-gray-50 text-gray-900" x-data="reportsAnalytics()">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-plane text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900">Travel & Tours Dashboard</h1>
                        <p class="text-sm text-gray-500">Reports & Analytics</p>
                    </div>
                </div>
                
                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('travel-tours.dashboard') }}" class="text-gray-600 hover:text-blue-600 transition-colors">Dashboard</a>
                    <a href="{{ route('travel-tours.agency-profile') }}" class="text-gray-600 hover:text-blue-600 transition-colors">Profile</a>
                    <a href="{{ route('travel-tours.tour-packages') }}" class="text-gray-600 hover:text-blue-600 transition-colors">Tour Packages</a>
                    <a href="{{ route('travel-tours.bookings') }}" class="text-gray-600 hover:text-blue-600 transition-colors">Bookings</a>
                    <a href="{{ route('travel-tours.customers') }}" class="text-gray-600 hover:text-blue-600 transition-colors">Customers</a>
                    <a href="{{ route('travel-tours.reports') }}" class="text-blue-600 font-medium border-b-2 border-blue-600 pb-1">Reports</a>
                </div>

                <!-- User Menu -->
                <div class="flex items-center space-x-4">
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                            <span class="hidden md:block">Admin User</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        <div x-show="open" @click.away="open = false" x-transition
                            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                            <hr class="my-2">
                            <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Reports & Analytics</h2>
                <p class="text-gray-600">Analyze your business performance and generate detailed reports.</p>
            </div>
            <div class="flex space-x-4">
                <button @click="exportReport()" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors flex items-center">
                    <i class="fas fa-download mr-2"></i>
                    Export Report
                </button>
                <button @click="generateReport()" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors flex items-center">
                    <i class="fas fa-chart-bar mr-2"></i>
                    Generate Report
                </button>
            </div>
        </div>

        <!-- Date Range Selector -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Report Period</h3>
                <div class="flex space-x-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">From Date</label>
                        <input type="date" 
                               x-model="dateFrom"
                               @change="updateCharts()"
                               class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">To Date</label>
                        <input type="date" 
                               x-model="dateTo"
                               @change="updateCharts()"
                               class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div class="flex items-end">
                        <button @click="setQuickRange('30d')" class="px-4 py-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition-colors mr-2">30 Days</button>
                        <button @click="setQuickRange('90d')" class="px-4 py-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition-colors mr-2">90 Days</button>
                        <button @click="setQuickRange('1y')" class="px-4 py-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition-colors">1 Year</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Key Metrics -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Revenue</p>
                        <p class="text-3xl font-bold text-green-600" x-text="'₱' + totalRevenue.toLocaleString()"></p>
                        <p class="text-sm text-green-600 flex items-center mt-1">
                            <i class="fas fa-arrow-up mr-1"></i>
                            +12% from last period
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-chart-line text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Bookings</p>
                        <p class="text-3xl font-bold text-blue-600" x-text="totalBookings"></p>
                        <p class="text-sm text-blue-600 flex items-center mt-1">
                            <i class="fas fa-arrow-up mr-1"></i>
                            +8% from last period
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-calendar-check text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Average Booking Value</p>
                        <p class="text-3xl font-bold text-purple-600" x-text="'₱' + averageBookingValue.toLocaleString()"></p>
                        <p class="text-sm text-purple-600 flex items-center mt-1">
                            <i class="fas fa-arrow-up mr-1"></i>
                            +5% from last period
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-calculator text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Customer Satisfaction</p>
                        <p class="text-3xl font-bold text-yellow-600" x-text="customerSatisfaction + '/5'"></p>
                        <p class="text-sm text-yellow-600 flex items-center mt-1">
                            <i class="fas fa-star mr-1"></i>
                            Excellent rating
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-star text-yellow-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Revenue Chart -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Revenue Trend</h3>
                    <div class="flex space-x-2">
                        <button @click="chartType = 'line'" :class="chartType === 'line' ? 'bg-blue-100 text-blue-600' : 'text-gray-600'" class="px-3 py-1 text-sm rounded-lg">Line</button>
                        <button @click="chartType = 'bar'" :class="chartType === 'bar' ? 'bg-blue-100 text-blue-600' : 'text-gray-600'" class="px-3 py-1 text-sm rounded-lg">Bar</button>
                    </div>
                </div>
                <div class="h-64">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

            <!-- Bookings Chart -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">Bookings by Package</h3>
                <div class="h-64">
                    <canvas id="bookingsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Package Performance -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Package Performance</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Package</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bookings</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Revenue</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Avg Rating</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Growth</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <template x-for="package in packagePerformance" :key="package.name">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900" x-text="package.name"></div>
                                    <div class="text-sm text-gray-500" x-text="package.category"></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" x-text="package.bookings"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" x-text="'₱' + package.revenue.toLocaleString()"></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex text-yellow-400">
                                            <template x-for="i in 5" :key="i">
                                                <i class="fas fa-star text-xs"></i>
                                            </template>
                                        </div>
                                        <span class="text-sm text-gray-500 ml-1" x-text="package.rating"></span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                          :class="package.growth > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
                                          x-text="(package.growth > 0 ? '+' : '') + package.growth + '%'"></span>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Customer Analytics -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
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
                        <span class="text-sm text-gray-600">Domestic (65%)</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                        <span class="text-sm text-gray-600">International (35%)</span>
                    </div>
                </div>
            </div>

            <!-- Monthly Comparison -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">Monthly Comparison</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">This Month</span>
                        <div class="flex items-center">
                            <div class="w-32 bg-gray-200 rounded-full h-2 mr-3">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: 85%"></div>
                            </div>
                            <span class="text-sm font-medium text-gray-900">₱85,000</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Last Month</span>
                        <div class="flex items-center">
                            <div class="w-32 bg-gray-200 rounded-full h-2 mr-3">
                                <div class="bg-green-600 h-2 rounded-full" style="width: 70%"></div>
                            </div>
                            <span class="text-sm font-medium text-gray-900">₱70,000</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Same Month Last Year</span>
                        <div class="flex items-center">
                            <div class="w-32 bg-gray-200 rounded-full h-2 mr-3">
                                <div class="bg-purple-600 h-2 rounded-full" style="width: 60%"></div>
                            </div>
                            <span class="text-sm font-medium text-gray-900">₱60,000</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function reportsAnalytics() {
            return {
                dateFrom: '2024-01-01',
                dateTo: '2024-12-31',
                chartType: 'line',
                totalRevenue: 285000,
                totalBookings: 156,
                averageBookingValue: 1827,
                customerSatisfaction: 4.8,
                packagePerformance: [
                    {
                        name: 'Bohol Island Hopping',
                        category: 'Adventure',
                        bookings: 45,
                        revenue: 112500,
                        rating: 4.9,
                        growth: 15
                    },
                    {
                        name: 'Chocolate Hills Tour',
                        category: 'Nature',
                        bookings: 38,
                        revenue: 68400,
                        rating: 4.8,
                        growth: 8
                    },
                    {
                        name: 'Cultural Heritage Tour',
                        category: 'Cultural',
                        bookings: 32,
                        revenue: 70400,
                        rating: 4.7,
                        growth: 12
                    },
                    {
                        name: 'Panglao Beach Tour',
                        category: 'Beach',
                        bookings: 28,
                        revenue: 61600,
                        rating: 4.6,
                        growth: -3
                    }
                ],
                
                init() {
                    this.initCharts();
                },
                
                initCharts() {
                    // Revenue Chart
                    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
                    new Chart(revenueCtx, {
                        type: 'line',
                        data: {
                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                            datasets: [{
                                label: 'Revenue (₱)',
                                data: [45000, 52000, 48000, 61000, 58000, 65000],
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

                    // Bookings Chart
                    const bookingsCtx = document.getElementById('bookingsChart').getContext('2d');
                    new Chart(bookingsCtx, {
                        type: 'doughnut',
                        data: {
                            labels: ['Adventure', 'Nature', 'Cultural', 'Beach'],
                            datasets: [{
                                data: [45, 38, 32, 28],
                                backgroundColor: ['rgb(59, 130, 246)', 'rgb(34, 197, 94)', 'rgb(168, 85, 247)', 'rgb(14, 165, 233)']
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom'
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
                                data: [65, 35],
                                backgroundColor: ['rgb(59, 130, 246)', 'rgb(34, 197, 94)']
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
                },
                
                updateCharts() {
                    // Update charts based on date range
                    console.log('Updating charts for:', this.dateFrom, 'to', this.dateTo);
                },
                
                setQuickRange(period) {
                    const today = new Date();
                    const from = new Date();
                    
                    switch(period) {
                        case '30d':
                            from.setDate(today.getDate() - 30);
                            break;
                        case '90d':
                            from.setDate(today.getDate() - 90);
                            break;
                        case '1y':
                            from.setFullYear(today.getFullYear() - 1);
                            break;
                    }
                    
                    this.dateFrom = from.toISOString().split('T')[0];
                    this.dateTo = today.toISOString().split('T')[0];
                    this.updateCharts();
                },
                
                exportReport() {
                    console.log('Exporting report...');
                },
                
                generateReport() {
                    console.log('Generating new report...');
                }
            }
        }
    </script>
</body>
</html>

