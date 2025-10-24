@extends('customer.customer_panel')

@section('title', 'TravelBuddy')
@section('page-title', 'Dashboard')

@section('content')
    @push('scripts')
        {{-- Ensure Alpine.js is loaded --}}
        <script src="//unpkg.com/alpinejs" defer></script>
    @endpush

    @push('styles')
        <style>
            .gradient-bg {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }
            .card-hover {
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .card-hover:hover {
                transform: translateY(-4px);
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }
            .glass-effect {
                background: rgba(255, 255, 255, 0.25);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.18);
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
            @keyframes pulse {
                0%, 100% { opacity: 1; }
                50% { opacity: .5; }
            }
            .modal-backdrop {
                backdrop-filter: blur(8px);
                background: rgba(0, 0, 0, 0.6);
            }
            .attraction-card {
                background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
                border: 1px solid rgba(226, 232, 240, 0.8);
            }
            .attraction-card:hover {
                border-color: rgba(59, 130, 246, 0.3);
                background: linear-gradient(145deg, #ffffff 0%, #eff6ff 100%);
            }
        </style>
    @endpush

    @php
        $sessionBookings = session('bookings', []);
        $allBookings = array_merge($bookings ?? [], $sessionBookings);
    @endphp

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
        <!-- Background Elements -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 floating-animation"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-purple-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 floating-animation" style="animation-delay: 2s;"></div>
            <div class="absolute top-40 left-1/2 w-80 h-80 bg-cyan-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 floating-animation" style="animation-delay: 4s;"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 relative z-10" x-data="{ openModal: false, selected: {} }">
            <!-- Welcome Section -->
            <div class="mb-12">
                <div class="glass-effect rounded-2xl p-8 text-center relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-600/10 via-purple-600/10 to-indigo-600/10"></div>
                    <div class="relative z-10">
                        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                            Welcome Back, <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Explorer</span>! 👋
                        </h1>
                        <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                            Ready for your next adventure? Here's your personalized dashboard with all your travel highlights.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                @foreach([
                    ['label' => 'Active Plans', 'value' => 2, 'icon' => '🌍', 'color' => 'from-blue-500 to-cyan-500'],
                    ['label' => 'Past Journeys', 'value' => 7, 'icon' => '🧳', 'color' => 'from-purple-500 to-pink-500'],
                    ['label' => 'Rewards Balance', 'value' => '1,240 pts', 'icon' => '⭐', 'color' => 'from-yellow-500 to-orange-500']
                ] as $card)
                    <div class="attraction-card p-6 rounded-2xl shadow-lg card-hover relative overflow-hidden group">
                        <div class="absolute inset-0 bg-gradient-to-br {{ $card['color'] }} opacity-0 group-hover:opacity-5 transition-opacity duration-300"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-4">
                                <div class="text-4xl">{{ $card['icon'] }}</div>
                                <div class="w-12 h-12 rounded-full bg-gradient-to-r {{ $card['color'] }} flex items-center justify-center">
                                    <div class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-sm"></div>
                                </div>
                            </div>
                            <div class="text-sm font-medium text-gray-500 mb-2">{{ $card['label'] }}</div>
                            <div class="text-3xl font-bold text-gray-800">{{ $card['value'] }}</div>
                        </div>
                </div>
            @endforeach
        </div>

        <!-- Recent Reservations -->
            <div class="mb-16">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center">
                            <span class="text-white text-lg">📋</span>
                        </div>
                        Recent Reservations
                    </h2>
                    <button class="px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-lg hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                        View All
                    </button>
                </div>
                
                <div class="glass-effect rounded-2xl overflow-hidden shadow-xl">
                    <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                        <tr>
                            @foreach(['Reservation ID', 'Itinerary', 'When', 'Status', 'Cost'] as $header)
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">{{ $header }}</th>
                            @endforeach
                        </tr>
                    </thead>
                            <tbody class="bg-white/80 backdrop-blur-sm divide-y divide-gray-200">
                        @forelse($allBookings as $b)
                                    <tr class="hover:bg-blue-50/50 transition-all duration-200 group">
                                        <td class="px-6 py-4 text-sm font-medium text-gray-800 group-hover:text-blue-600 transition-colors">{{ $b['id'] ?? '—' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $b['package'] ?? $b['destination'] ?? 'Package' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ isset($b['date']) ? \Carbon\Carbon::parse($b['date'])->format('M d, Y') : '—' }}</td>
                                <td class="px-6 py-4 text-sm">
                                    @php
                                        $status = $b['status'] ?? 'Unknown';
                                        $badge = match($status) {
                                                    'Confirmed' => 'bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 border border-green-200',
                                                    'Pending' => 'bg-gradient-to-r from-yellow-100 to-amber-100 text-yellow-800 border border-yellow-200',
                                                    default => 'bg-gradient-to-r from-gray-100 to-slate-100 text-gray-800 border border-gray-200',
                                        };
                                    @endphp
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $badge }}">{{ $status }}</span>
                                </td>
                                        <td class="px-6 py-4 text-sm font-semibold text-gray-800">{{ $b['amount'] ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr>
                                        <td class="px-6 py-12 text-center text-gray-500" colspan="5">
                                            <div class="flex flex-col items-center gap-4">
                                                <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center">
                                                    <span class="text-2xl">📝</span>
                                                </div>
                                                <div>
                                                    <p class="text-lg font-medium">No reservations yet</p>
                                                    <p class="text-sm">Start planning your next adventure!</p>
                                                </div>
                                            </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                    </div>
            </div>
        </div>

        <!-- Tourist Attractions -->
            <div class="mb-16">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center">
                            <span class="text-white text-xl">🏛️</span>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-800">
                            Tourist <span class="bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">Attractions</span>
                </h2>
                    </div>
                    <button class="px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-xl hover:shadow-lg transition-all duration-300 transform hover:scale-105 font-semibold">
                        View All Attractions →
                    </button>
            </div>

            @if(isset($attractions) && $attractions->count())
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($attractions as $attr)
                        <div 
                                class="group attraction-card rounded-2xl overflow-hidden shadow-lg card-hover relative cursor-pointer"
                            @click='selected = {
                                name: @json($attr->name),
                                category: @json($attr->category),
                                description: @json($attr->description),
                                address: @json($attr->address),
                                fee: @json($attr->entry_fee ? "₱" . number_format($attr->entry_fee, 2) : "Free"),
                                notes: @json($attr->special_notes ?? "None"),
                                image: @json($attr->image_path ? asset("storage/" . $attr->image_path) : asset("images/no-image.png")),
                                map: @json($attr->map_embed_url ?? null) 
                            }; openModal = true'
                        >
                            <!-- Image -->
                                <div class="relative h-64 overflow-hidden">
                                <img 
                                    src="{{ $attr->image_path ? asset('storage/' . $attr->image_path) : asset('images/no-image.png') }}" 
                                    alt="{{ $attr->name }}" 
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out"
                                >
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>

                                    <!-- Category Badge -->
                                    <div class="absolute top-4 left-4">
                                        <span class="px-3 py-1 bg-gradient-to-r from-blue-500 to-purple-500 text-white text-xs font-bold rounded-full shadow-lg backdrop-blur-sm">
                                            {{ $attr->category }}
                                        </span>
                                    </div>

                                    <!-- Hover Overlay -->
                                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                                        <button class="px-6 py-3 bg-white/90 backdrop-blur-sm text-blue-600 font-semibold rounded-xl shadow-lg hover:bg-white transition-all duration-300 transform hover:scale-105">
                                            <i class="fas fa-eye mr-2"></i>
                                            View Details
                                        </button>
                                    </div>
                            </div>

                            <!-- Info -->
                                <div class="p-6">
                                    <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-blue-600 transition-colors duration-300">
                                        {{ $attr->name }}
                                    </h3>
                                    <p class="text-sm text-gray-600 mb-4 line-clamp-2 leading-relaxed">
                                        {{ Str::limit($attr->description, 100) }}
                                    </p>

                                    <div class="flex items-center text-sm text-gray-700 mb-3">
                                        <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>
                                        <span class="truncate">{{ $attr->address }}</span>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-semibold text-gray-800">
                                            <i class="fas fa-ticket-alt text-green-500 mr-1"></i>
                                            {{ $attr->entry_fee ? "₱" . number_format($attr->entry_fee, 2) : "Free" }}
                                        </span>
                                        <div class="flex items-center text-yellow-500">
                                            <i class="fas fa-star text-sm"></i>
                                            <span class="ml-1 text-xs text-gray-600">4.8</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="glass-effect p-12 rounded-2xl text-center">
                        <div class="flex flex-col items-center gap-6">
                            <div class="w-20 h-20 rounded-full bg-gradient-to-r from-purple-100 to-pink-100 flex items-center justify-center">
                                <span class="text-4xl">🏛️</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-800 mb-2">No attractions found</h3>
                                <p class="text-gray-600">We're working on adding more amazing places for you to explore!</p>
                            </div>
                        </div>
                </div>
            @endif

                <!-- Enhanced Modal -->
                <div 
                    x-show="openModal"
                    x-transition.opacity.duration.300ms
                    x-cloak
                    class="fixed inset-0 z-50 flex items-center justify-center modal-backdrop p-4"
                    @click.self="openModal = false"
                    @keydown.escape.window="openModal = false"
                >
                    <div 
                        class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-hidden transform transition-all"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                        x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                    >
                        <!-- Header with Image -->
                        <div class="relative">
                            <img :src="selected.image" alt="" class="w-full h-80 object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                            
                            <!-- Close Button -->
                            <button 
                                @click="openModal = false" 
                                class="absolute top-4 right-4 w-10 h-10 bg-white/20 backdrop-blur-sm text-white rounded-full hover:bg-white/30 transition-all duration-300 flex items-center justify-center group"
                            >
                                <i class="fas fa-times text-lg group-hover:scale-110 transition-transform"></i>
                            </button>

                            <!-- Content Overlay -->
                            <div class="absolute bottom-6 left-6 right-6 text-white">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="px-3 py-1 bg-gradient-to-r from-blue-500 to-purple-500 text-white text-sm font-bold rounded-full backdrop-blur-sm" x-text="selected.category"></span>
                                    <div class="flex items-center text-yellow-400">
                                        <i class="fas fa-star text-sm mr-1"></i>
                                        <span class="text-sm font-medium">4.8</span>
                                    </div>
                                </div>
                                <h2 class="text-3xl font-bold mb-1" x-text="selected.name"></h2>
                                <p class="text-blue-200 text-sm flex items-center">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span x-text="selected.address"></span>
                                </p>
                            </div>
                        </div>

                        <!-- Scrollable Body -->
                        <div class="max-h-96 overflow-y-auto">
                            <div class="p-6">
                                <!-- Description -->
                                <div class="mb-6">
                                    <h3 class="text-lg font-bold text-gray-800 mb-3 flex items-center gap-2">
                                        <i class="fas fa-info-circle text-blue-500"></i>
                                        About This Place
                                    </h3>
                                    <p class="text-gray-700 leading-relaxed" x-text="selected.description"></p>
                                </div>

                                <!-- Details Grid -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-4 rounded-xl border border-green-100">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-500 rounded-full flex items-center justify-center">
                                                <i class="fas fa-ticket-alt text-white text-sm"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm text-gray-600 font-medium">Entrance Fee</p>
                                                <p class="text-lg font-bold text-green-600" x-text="selected.fee"></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 p-4 rounded-xl border border-purple-100">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center">
                                                <i class="fas fa-map-marked-alt text-white text-sm"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm text-gray-600 font-medium">Location</p>
                                                <p class="text-sm font-semibold text-purple-600" x-text="selected.address"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Special Notes -->
                                <div class="mb-6">
                                    <h3 class="text-lg font-bold text-gray-800 mb-3 flex items-center gap-2">
                                        <i class="fas fa-sticky-note text-yellow-500"></i>
                                        Special Notes
                                    </h3>
                                    <div class="bg-gradient-to-r from-yellow-50 to-orange-50 p-4 rounded-xl border border-yellow-200">
                                        <p class="text-gray-700" x-text="selected.notes"></p>
                                    </div>
                                </div>

                                <!-- Map Section -->
                                <div class="mb-6">
                                    <h3 class="text-lg font-bold text-gray-800 mb-3 flex items-center gap-2">
                                        <i class="fas fa-map text-red-500"></i>
                                        Location Map
                                    </h3>
                                    <div class="rounded-xl overflow-hidden border border-gray-200 shadow-sm">
                                        <template x-if="selected.map">
                                            <div class="w-full h-64">
                                                <div x-html="selected.map"></div>
                                            </div>
                                        </template>
                                        <template x-if="!selected.map">
                                            <div class="w-full h-64 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                                <div class="text-center text-gray-500">
                                                    <i class="fas fa-map-marked-alt text-3xl mb-2"></i>
                                                    <p>Map not available</p>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <script>
    function attractionModal() {
        return {
            openModal: false,
            selected: {},
            openAttraction(data) {
                this.selected = data;
                this.openModal = true;
            }
        }
    }
    </script>
@endsection
