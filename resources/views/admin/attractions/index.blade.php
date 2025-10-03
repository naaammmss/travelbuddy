@extends('admin.layout')

@section('title', 'Attractions | Admin')
@section('page-title', 'Attractions')

@section('content')
<div class="space-y-6" x-data="attractionsManager()">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Manage Attractions</h1>
            <p class="text-gray-600 mt-1">Manage tourist spots and attractions for your travel platform</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.attractions.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                <i class="fas fa-plus mr-2"></i>
                Add New Attraction
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

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Search -->
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" 
                       x-model="searchQuery"
                       @input="filterAttractions()"
                       placeholder="Search attractions..."
                       class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
            </div>

            <!-- Category Filter -->
            <div>
                <select x-model="selectedCategory" 
                        @change="filterAttractions()"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                    <option value="">All Categories</option>
                    <option value="Nature">Natural Wonder</option>
                    <option value="Beach">Beach</option>
                    <option value="Cultural">Cultural</option>
                    <option value="Adventure">Adventure</option>
                    <option value="Wildlife">Wildlife</option>
                    <option value="Historical">Historical</option>
                </select>
            </div>

            <!-- Sort -->
            <div>
                <select x-model="sortBy" 
                        @change="filterAttractions()"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                    <option value="name">Sort by Name</option>
                    <option value="created_at">Sort by Date Added</option>
                    <option value="category">Sort by Category</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Image Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" x-show="filteredAttractions.length > 0">
        <template x-for="attraction in filteredAttractions" :key="attraction.id">
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:scale-105 group">
                <!-- Image -->
                <div class="relative h-56 bg-gradient-to-br from-blue-100 to-purple-100 overflow-hidden">
                    <template x-if="attraction.image_path">
                        <img :src="'/storage/' + attraction.image_path" 
                            :alt="attraction.name" 
                            class="w-full h-full object-cover">
                    </template>
                    <!-- Category Badge -->
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-white/90 backdrop-blur-sm rounded-full text-xs font-semibold text-gray-700"
                              x-text="attraction.category || 'Uncategorized'"></span>
                    </div>

                    <!-- Actions Menu -->
                    <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" 
                                    class="p-2 bg-white/90 backdrop-blur-sm rounded-full hover:bg-white transition-colors">
                                <i class="fas fa-ellipsis-v text-gray-600"></i>
                            </button>
                            
                            <div x-show="open" 
                                 @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 transform scale-95"
                                 x-transition:enter-end="opacity-100 transform scale-100"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 transform scale-100"
                                 x-transition:leave-end="opacity-0 transform scale-95"
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-200 py-2 z-10">
                                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    <i class="fas fa-edit mr-3 text-blue-500"></i>
                                    Edit Attraction
                                </a>
                                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    <i class="fas fa-eye mr-3 text-green-500"></i>
                                    View Details
                                </a>
                                <button @click="deleteAttraction(attraction.id)" 
                                        class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    <i class="fas fa-trash mr-3"></i>
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2" x-text="attraction.name"></h3>
                    
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2" x-text="attraction.description || 'No description available'"></p>
                    
                    <!-- Location -->
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <i class="fas fa-map-marker-alt mr-2 text-red-500"></i>
                        <span x-text="attraction.address ? attraction.address : 'Location not set'"></span>
                    </div>

                    <!-- Stats -->
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <div class="flex items-center">
                            <i class="fas fa-calendar mr-1"></i>
                            <span x-text="new Date(attraction.created_at).toLocaleDateString()"></span>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <!-- Empty State -->
    <div x-show="filteredAttractions.length === 0" class="text-center py-12">
        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-map-marked-alt text-3xl text-gray-400"></i>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">No attractions found</h3>
        <p class="text-gray-600 mb-6">Start by adding your first attraction to the platform.</p>
        <a href="{{ route('admin.attractions.create') }}" 
           class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition-colors">
            <i class="fas fa-plus mr-2"></i>
            Add Your First Attraction
        </a>
    </div>

    <!-- Pagination -->
    <!--<div class="flex justify-center" x-show="filteredAttractions.length > 0">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-4">
            {{ $attractions->links() }}
        </div>
    </div>-->
</div>

<script>
function attractionsManager() {
    return {
        searchQuery: '',
        selectedCategory: '',
        sortBy: 'name',
        attractions: @json($attractions->items()),
        filteredAttractions: @json($attractions->items()),
        
        init() {
            this.filteredAttractions = [...this.attractions];
        },
        
        filterAttractions() {
            let filtered = [...this.attractions];
            
            // Search filter
            if (this.searchQuery) {
                filtered = filtered.filter(attraction => 
                    attraction.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    (attraction.description && attraction.description.toLowerCase().includes(this.searchQuery.toLowerCase()))
                );
            }
            
            // Category filter
            if (this.selectedCategory) {
                filtered = filtered.filter(attraction => attraction.category === this.selectedCategory);
            }
            
            // Sort
            filtered.sort((a, b) => {
                if (this.sortBy === 'name') {
                    return a.name.localeCompare(b.name);
                } else if (this.sortBy === 'created_at') {
                    return new Date(b.created_at) - new Date(a.created_at);
                } else if (this.sortBy === 'category') {
                    return (a.category || '').localeCompare(b.category || '');
                }
                return 0;
            });
            
            this.filteredAttractions = filtered;
        },
        
        deleteAttraction(id) {
            if (confirm('Are you sure you want to delete this attraction?')) {
                // Implement delete functionality
                console.log('Delete attraction:', id);
            }
        }
    }
}
</script>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection