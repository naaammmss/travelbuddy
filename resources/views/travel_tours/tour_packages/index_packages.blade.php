@extends('travel & tours.travel_layout')

@section('title', 'Travel & Tours Dashboard  | TravelBuddy')
@section('page-title', 'Packages')

@section('content')

    <div class="bg-gray-50 text-gray-900" x-data="tourPackages()">

                
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Tour Packages</h2>
                    <p class="text-gray-600">Manage your tour packages, attractions, and pricing.</p>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.attractions.create') }}" 
                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        <i class="fas fa-plus mr-2"></i>
                        Add New Package
                    </a>
                </div>
            </div>
            <!-- Success Message -->
            @if (session('status'))
                <div class="p-4 bg-green-50 border border-green-200 rounded-xl">
                    <div class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-0.5 mr-3"></i>
                        <div>
                            <h4 class="text-sm font-semibold text-green-800 mb-1">Success!</h4>
                            <p class="text-sm text-green-700">{{ session('status') }}</p>
                        </div>
                    </div>
                </div>
            @endif
            <!-- Search and Filter -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <input type="text" 
                            x-model="searchQuery"
                            @input="filterPackages()"
                            placeholder="Search packages..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <select x-model="selectedCategory" 
                                @change="filterPackages()"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">All Categories</option>
                            <option value="Adventure">Adventure</option>
                            <option value="Cultural">Cultural</option>
                            <option value="Nature">Nature</option>
                            <option value="Beach">Beach</option>
                            <option value="Historical">Historical</option>
                        </select>
                    </div>
                    <div>
                        <select x-model="selectedStatus" 
                                @change="filterPackages()"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                    <div>
                        <button @click="resetFilters()" class="w-full px-4 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            Reset Filters
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tour Packages Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <template x-for="package in filteredPackages" :key="package.id">
                <div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover">
                    <!-- Package Image -->
                    <div class="relative h-48 bg-gradient-to-br from-blue-100 to-purple-100">
                        <img :src="package.image" :alt="package.name" class="w-full h-full object-cover">
                        <div class="absolute top-4 right-4">
                            <span class="px-3 py-1 bg-white/90 backdrop-blur-sm rounded-full text-xs font-semibold"
                                  :class="package.status === 'active' ? 'text-green-600' : package.status === 'inactive' ? 'text-red-600' : 'text-yellow-600'"
                                  x-text="package.status.charAt(0).toUpperCase() + package.status.slice(1)"></span>
                        </div>
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 bg-white/90 backdrop-blur-sm rounded-full text-xs font-semibold text-gray-700"
                                  x-text="package.category"></span>
                        </div>
                    </div>

                    <!-- Package Content -->
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2" x-text="package.name"></h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2" x-text="package.description"></p>
                        
                        <!-- Package Details -->
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-clock mr-2"></i>
                                <span x-text="package.duration"></span>
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-users mr-2"></i>
                                <span x-text="package.max_participants + ' max participants'"></span>
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                <span x-text="package.location"></span>
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <span class="text-2xl font-bold text-blue-600" x-text="'₱' + package.price.toLocaleString()"></span>
                                <span class="text-sm text-gray-500">per person</span>
                            </div>
                            <div class="flex items-center">
                                <div class="flex text-yellow-400">
                                    <template x-for="i in 5" :key="i">
                                        <i class="fas fa-star text-xs"></i>
                                    </template>
                                </div>
                                <span class="text-sm text-gray-500 ml-1" x-text="package.rating"></span>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex space-x-2">
                            <button @click="editPackage(package)" class="flex-1 bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors text-sm">
                                <i class="fas fa-edit mr-1"></i>
                                Edit
                            </button>
                            <button @click="viewPackage(package)" class="flex-1 bg-gray-100 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-200 transition-colors text-sm">
                                <i class="fas fa-eye mr-1"></i>
                                View
                            </button>
                            <button @click="deletePackage(package.id)" class="bg-red-100 text-red-600 py-2 px-4 rounded-lg hover:bg-red-200 transition-colors text-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Empty State -->
        <div x-show="filteredPackages.length === 0" class="text-center py-12">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-map-marked-alt text-3xl text-gray-400"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">No packages found</h3>
            <p class="text-gray-600 mb-6">Start by adding your first tour package.</p>
            <button @click="showAddModal = true" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-plus mr-2"></i>
                Add Your First Package
            </button>
        </div>
    </div>
     <script>
        function tourPackages() {
            return {
                searchQuery: '',
                selectedCategory: '',
                selectedStatus: '',
                showAddModal: false,
                showEditModal: false,
                editingPackage: null,
                sidebarOpen: true,
                packageForm: {
                    name: '',
                    category: '',
                    description: '',
                    duration: '',
                    max_participants: '',
                    price: '',
                    location: '',
                    image: '',
                    itinerary: '',
                    inclusions: '',
                    exclusions: '',
                    status: 'active'
                },
                packages: [
                    {
                        id: 1,
                        name: 'Bohol Island Hopping Adventure',
                        category: 'Adventure',
                        description: 'Experience the best of Bohol with our comprehensive island hopping tour including dolphin watching, snorkeling, and beach hopping.',
                        duration: '1 day',
                        max_participants: 15,
                        price: 2500,
                        location: 'Panglao Island, Bohol',
                        image: '/images/AndaBeach.jpg',
                        itinerary: 'Day 1: Dolphin watching, Balicasag Island snorkeling, Virgin Island beach',
                        inclusions: '• Boat transfer\n• Snorkeling gear\n• Lunch\n• Guide services',
                        exclusions: '• Personal expenses\n• Optional activities',
                        status: 'active',
                        rating: 4.9
                    },
                    {
                        id: 2,
                        name: 'Chocolate Hills & Tarsier Tour',
                        category: 'Nature',
                        description: 'Visit the iconic Chocolate Hills and meet the world\'s smallest primates in their natural habitat.',
                        duration: 'Half day',
                        max_participants: 20,
                        price: 1800,
                        location: 'Carmen & Corella, Bohol',
                        image: '/images/Chocolate-Hills.jpg',
                        itinerary: 'Morning: Tarsier Sanctuary visit\nAfternoon: Chocolate Hills viewing',
                        inclusions: '• Transportation\n• Entrance fees\n• Guide services',
                        exclusions: '• Meals\n• Personal expenses',
                        status: 'active',
                        rating: 4.8
                    },
                    {
                        id: 3,
                        name: 'Cultural Heritage Tour',
                        category: 'Cultural',
                        description: 'Explore Bohol\'s rich cultural heritage through historic churches, museums, and traditional villages.',
                        duration: '1 day',
                        max_participants: 12,
                        price: 2200,
                        location: 'Baclayon, Loboc, Bohol',
                        image: '/images/baclayon_church.png',
                        itinerary: 'Morning: Baclayon Church, Blood Compact Monument\nAfternoon: Loboc River cruise, Cultural show',
                        inclusions: '• Transportation\n• Entrance fees\n• River cruise\n• Cultural show\n• Lunch',
                        exclusions: '• Personal expenses\n• Souvenirs',
                        status: 'active',
                        rating: 4.7
                    }
                ],
                filteredPackages: [],
                
                init() {
                    this.filteredPackages = [...this.packages];
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
                
                filterPackages() {
                    let filtered = [...this.packages];
                    
                    if (this.searchQuery) {
                        filtered = filtered.filter(pkg => 
                            pkg.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                            pkg.description.toLowerCase().includes(this.searchQuery.toLowerCase())
                        );
                    }
                    
                    if (this.selectedCategory) {
                        filtered = filtered.filter(pkg => pkg.category === this.selectedCategory);
                    }
                    
                    if (this.selectedStatus) {
                        filtered = filtered.filter(pkg => pkg.status === this.selectedStatus);
                    }
                    
                    this.filteredPackages = filtered;
                },
                
                resetFilters() {
                    this.searchQuery = '';
                    this.selectedCategory = '';
                    this.selectedStatus = '';
                    this.filteredPackages = [...this.packages];
                },
                
                editPackage(pkg) {
                    this.editingPackage = pkg;
                    this.packageForm = { ...pkg };
                    this.showEditModal = true;
                },
                
                viewPackage(pkg) {
                    // Implement view functionality
                    console.log('View package:', pkg);
                },
                
                deletePackage(id) {
                    if (confirm('Are you sure you want to delete this package?')) {
                        this.packages = this.packages.filter(pkg => pkg.id !== id);
                        this.filteredPackages = this.filteredPackages.filter(pkg => pkg.id !== id);
                    }
                },
                
                savePackage() {
                    if (this.showEditModal) {
                        // Update existing package
                        const index = this.packages.findIndex(pkg => pkg.id === this.editingPackage.id);
                        this.packages[index] = { ...this.packageForm, id: this.editingPackage.id };
                    } else {
                        // Add new package
                        const newPackage = {
                            ...this.packageForm,
                            id: Date.now(),
                            rating: 4.5
                        };
                        this.packages.push(newPackage);
                    }
                    
                    this.filteredPackages = [...this.packages];
                    this.closeModal();
                },
                
                closeModal() {
                    this.showAddModal = false;
                    this.showEditModal = false;
                    this.editingPackage = null;
                    this.packageForm = {
                        name: '',
                        category: '',
                        description: '',
                        duration: '',
                        max_participants: '',
                        price: '',
                        location: '',
                        image: '',
                        itinerary: '',
                        inclusions: '',
                        exclusions: '',
                        status: 'active'
                    };
                },
                
                handleImageUpload(event) {
                    const file = event.target.files[0];
                    if (file) {
                        if (file.size > 5 * 1024 * 1024) {
                            alert('File size must be less than 5MB');
                            event.target.value = '';
                            return;
                        }
                        
                        if (!file.type.startsWith('image/')) {
                            alert('Please select an image file');
                            event.target.value = '';
                            return;
                        }
                        
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.packageForm.image = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                }
            }
        }
    </script>
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
@endsection