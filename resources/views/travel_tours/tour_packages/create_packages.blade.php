@extends('travel_tours.travel_layout')

@section('title', 'Travel & Tours Dashboard | TravelBuddy')
@section('page-title', 'Add Tour Package')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Enhanced Header Section -->
    <div class="mb-8">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div class="flex-1">
                <div class="flex items-center mb-2">
                    <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center mr-3 shadow-lg">
                        <i class="fas fa-map-marked-alt text-white text-lg"></i>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Create New Tour Package</h1>
                </div>
                <p class="text-gray-600 dark:text-gray-400 ml-13">Design an unforgettable travel experience. All fields marked with <span class="text-red-500">*</span> are required.</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('travel_tours.tour_packages') }}" 
                   class="inline-flex items-center px-5 py-3 border border-gray-300 dark:border-gray-600 rounded-xl text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-blue-400 transition-all duration-200 shadow-sm hover:shadow-md group">
                    <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i> 
                    Back to Packages
                </a>
            </div>
        </div>
    </div>

    <!-- Enhanced Form -->
    <form action="{{ route('travel_tours.tour_packages.store') }}" method="POST" enctype="multipart/form-data">
    
        @csrf

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            <!-- Main Form Content -->
            <div class="xl:col-span-2 space-y-8">
                <!-- Enhanced Basic Information Card -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden border border-gray-100 dark:border-gray-700 transition-all duration-300 hover:shadow-xl">
                    <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-lg bg-blue-500 flex items-center justify-center mr-3 shadow-md">
                                <i class="fas fa-info-circle text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Basic Information</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Core details about your tour package</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                                Package Name <span class="text-red-500 ml-1">*</span>
                            </label>
                            <div class="relative">
                                <input id="name" name="name" value="{{ old('name') }}" required
                                       x-model="form.name"
                                       class="w-full px-4 py-3.5 pl-11 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-transparent transition-all duration-200 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 shadow-sm"
                                       placeholder="e.g., Bohol Countryside Adventure Tour">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-heading text-gray-400"></i>
                                </div>
                            </div>
                            @error('name')
                                <p class="text-red-600 dark:text-red-400 text-sm mt-2 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="category" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Category</label>
                                <div class="relative">
                                    <select id="category" name="category" required
                                            x-model="form.category"
                                            class="w-full px-4 py-3.5 pl-11 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-transparent transition-all duration-200 bg-white dark:bg-gray-700 text-gray-900 dark:text-white appearance-none shadow-sm">
                                        <option value="">Select a category</option>
                                        <option value="Adventure">Adventure</option>
                                        <option value="Cultural">Cultural</option>
                                        <option value="Nature">Nature</option>
                                        <option value="Beach">Beach</option>
                                        <option value="Historical">Historical</option>
                                    </select>
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-tag text-gray-400"></i>
                                    </div>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <i class="fas fa-chevron-down text-gray-400"></i>
                                    </div>
                                </div>
                                @error('category')
                                    <p class="text-red-600 dark:text-red-400 text-sm mt-2 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label for="location" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Location</label>
                                <div class="relative">
                                    <input id="location" name="location" value="{{ old('location') }}" 
                                           x-model="form.location"
                                           placeholder="e.g., Bohol, Philippines"
                                           class="w-full px-4 py-3.5 pl-11 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-transparent transition-all duration-200 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-map-marker-alt text-gray-400"></i>
                                    </div>
                                </div>
                                @error('location')
                                    <p class="text-red-600 dark:text-red-400 text-sm mt-2 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Description</label>
                            <div class="relative">
                                <textarea id="description" name="description" rows="5"
                                          x-model="form.description"
                                          class="w-full px-4 py-3.5 pl-11 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-transparent transition-all duration-200 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 resize-vertical shadow-sm"
                                          placeholder="Provide an engaging overview of the tour, highlighting key attractions and unique experiences..."></textarea>
                                <div class="absolute top-3 left-3 pl-3 flex items-start pointer-events-none">
                                    <i class="fas fa-align-left text-gray-400 mt-1"></i>
                                </div>
                            </div>
                            <div class="flex justify-between items-center mt-2">
                                <span class="text-xs text-gray-500">Describe what makes this tour special</span>
                                <span class="text-xs text-gray-500" x-text="form.description.length + '/500'"></span>
                            </div>
                            @error('description')
                                <p class="text-red-600 dark:text-red-400 text-sm mt-2 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Enhanced Package Details Card -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden border border-gray-100 dark:border-gray-700 transition-all duration-300 hover:shadow-xl">
                    <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-lg bg-green-500 flex items-center justify-center mr-3 shadow-md">
                                <i class="fas fa-cogs text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Package Details</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Duration, pricing, and capacity</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="duration" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Duration</label>
                                <div class="relative">
                                    <input id="duration" name="duration" value="{{ old('duration') }}" 
                                           x-model="form.duration"
                                           placeholder="e.g., 3 Days, 2 Nights"
                                           class="w-full px-4 py-3.5 pl-11 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-transparent transition-all duration-200 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-clock text-gray-400"></i>
                                    </div>
                                </div>
                                @error('duration')
                                    <p class="text-red-600 dark:text-red-400 text-sm mt-2 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label for="max_participants" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Max Participants</label>
                                <div class="relative">
                                    <input type="number" id="max_participants" name="max_participants" min="1" value="{{ old('max_participants') }}"
                                           x-model="form.max_participants"
                                           class="w-full px-4 py-3.5 pl-11 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-transparent transition-all duration-200 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-users text-gray-400"></i>
                                    </div>
                                </div>
                                @error('max_participants')
                                    <p class="text-red-600 dark:text-red-400 text-sm mt-2 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Price (PHP)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-500 dark:text-gray-400">
                                    <i class="fas fa-peso-sign"></i>
                                </span>
                                <input type="number" step="0.01" id="price" name="price" value="{{ old('price') }}" 
                                       x-model="form.price"
                                       class="w-full pl-10 px-4 py-3.5 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-transparent transition-all duration-200 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm"
                                       placeholder="0.00">
                            </div>
                            @error('price')
                                <p class="text-red-600 dark:text-red-400 text-sm mt-2 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Enhanced Itinerary Card -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden border border-gray-100 dark:border-gray-700 transition-all duration-300 hover:shadow-xl">
                    <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-purple-50 to-violet-50 dark:from-purple-900/20 dark:to-violet-900/20">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-lg bg-purple-500 flex items-center justify-center mr-3 shadow-md">
                                <i class="fas fa-map-signs text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Itinerary</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Outline the daily schedule and activities</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="relative">
                            <textarea id="itinerary" name="itinerary" rows="6"
                                      x-model="form.itinerary"
                                      class="w-full px-4 py-3.5 pl-11 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-transparent transition-all duration-200 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 resize-vertical shadow-sm"
                                      placeholder="Outline your itinerary day by day:&#10;&#10;Day 1: Arrival and welcome dinner...&#10;Day 2: Explore local landmarks...&#10;Day 3: Departure with souvenirs..."></textarea>
                            <div class="absolute top-3 left-3 pl-3 flex items-start pointer-events-none">
                                <i class="fas fa-route text-gray-400 mt-1"></i>
                            </div>
                        </div>
                        <div class="flex justify-between items-center mt-2">
                            <span class="text-xs text-gray-500">Use bullet points or numbered lists for clarity</span>
                            <span class="text-xs text-gray-500" x-text="form.itinerary.length + '/2000'"></span>
                        </div>
                        @error('itinerary')
                            <p class="text-red-600 dark:text-red-400 text-sm mt-2 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Enhanced Inclusions & Exclusions Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden border border-gray-100 dark:border-gray-700 transition-all duration-300 hover:shadow-xl">
                        <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-lg bg-green-500 flex items-center justify-center mr-3 shadow-md">
                                    <i class="fas fa-check-circle text-white"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Inclusions</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">What's included in the package</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="relative">
                                <textarea id="inclusions" name="inclusions" rows="5"
                                          x-model="form.inclusions"
                                          class="w-full px-4 py-3.5 pl-11 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-transparent transition-all duration-200 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 resize-vertical shadow-sm"
                                          placeholder="List what's included:&#10;- Accommodation&#10;- Transportation&#10;- Tour guide&#10;- Meals (as specified)"></textarea>
                                <div class="absolute top-3 left-3 pl-3 flex items-start pointer-events-none">
                                    <i class="fas fa-check text-gray-400 mt-1"></i>
                                </div>
                            </div>
                            @error('inclusions')
                                <p class="text-red-600 dark:text-red-400 text-sm mt-2 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden border border-gray-100 dark:border-gray-700 transition-all duration-300 hover:shadow-xl">
                        <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-red-50 to-pink-50 dark:from-red-900/20 dark:to-pink-900/20">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-lg bg-red-500 flex items-center justify-center mr-3 shadow-md">
                                    <i class="fas fa-times-circle text-white"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Exclusions</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">What's not included in the package</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="relative">
                                <textarea id="exclusions" name="exclusions" rows="5"
                                          x-model="form.exclusions"
                                          class="w-full px-4 py-3.5 pl-11 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-transparent transition-all duration-200 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 resize-vertical shadow-sm"
                                          placeholder="List what's not included:&#10;- Personal expenses&#10;- Airfare&#10;- Travel insurance&#10;- Tips for guides"></textarea>
                                <div class="absolute top-3 left-3 pl-3 flex items-start pointer-events-none">
                                    <i class="fas fa-times text-gray-400 mt-1"></i>
                                </div>
                            </div>
                            @error('exclusions')
                                <p class="text-red-600 dark:text-red-400 text-sm mt-2 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Sidebar -->
            <div class="space-y-8">
                <!-- Enhanced Cover Photo Card -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden border border-gray-100 dark:border-gray-700 transition-all duration-300 hover:shadow-xl">
                    <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-purple-50 to-violet-50 dark:from-purple-900/20 dark:to-violet-900/20">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-lg bg-purple-500 flex items-center justify-center mr-3 shadow-md">
                                <i class="fas fa-camera text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Cover Photo</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Main image for your package</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6" x-data="coverUpload()">
                        <!-- Upload Box -->
                        <div x-show="!imagePreview" 
                             class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-6 text-center hover:border-blue-400 dark:hover:border-blue-500 transition-all duration-300 cursor-pointer bg-gray-50 dark:bg-gray-700/50 group"
                             @click="document.getElementById('cover-upload').click()">
                            <div class="h-16 w-16 mx-auto rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                <i class="fas fa-cloud-upload-alt text-blue-500 text-xl"></i>
                            </div>
                            <p class="text-sm font-medium text-gray-900 dark:text-white mb-1">Upload a cover photo</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG up to 5MB</p>
                            <input id="cover-upload" type="file" name="cover_photo" accept="image/*" class="hidden" @change="handleImageUpload($event)">
                        </div>

                        <!-- Preview -->
                        <div x-show="imagePreview" class="relative">
                            <img :src="imagePreview" alt="Preview"
                                class="w-full h-48 object-cover rounded-xl border border-gray-200 dark:border-gray-600 shadow-sm">
                            <button type="button" @click="removeImage()"
                                    class="absolute top-3 right-3 bg-red-500 text-white rounded-full p-2 hover:bg-red-600 transition-colors shadow-lg">
                                <i class="fas fa-trash text-xs"></i>
                            </button>
                            <div class="text-center mt-3">
                                <button type="button" class="text-sm text-blue-600 hover:text-blue-700 font-medium inline-flex items-center"
                                        @click="document.getElementById('cover-upload').click()">
                                    <i class="fas fa-sync-alt mr-1"></i> Change Photo
                                </button>
                            </div>
                        </div>

                        @error('cover_photo')
                        <div class="mt-3 text-sm text-red-600 dark:text-red-400 flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <!-- Enhanced Gallery Upload -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden border border-gray-100 dark:border-gray-700 transition-all duration-300 hover:shadow-xl">
                    <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-purple-50 to-violet-50 dark:from-purple-900/20 dark:to-violet-900/20">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-lg bg-purple-500 flex items-center justify-center mr-3 shadow-md">
                                <i class="fas fa-images text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Gallery</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Additional images</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6" x-data="galleryUpload()">
                        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-4 text-center hover:border-blue-400 dark:hover:border-blue-500 transition-all duration-300 cursor-pointer bg-gray-50 dark:bg-gray-700/50 group"
                            @click="document.getElementById('gallery-upload').click()">
                            <i class="fas fa-layer-group text-gray-400 text-xl mb-2 group-hover:text-blue-500 transition-colors"></i>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Upload gallery images</p>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">PNG, JPG up to 5MB each</p>
                            <input id="gallery-upload" type="file" name="gallery[]" accept="image/*" multiple class="hidden" @change="handleFiles($event)">
                        </div>

                        <template x-if="previews.length">
                            <div class="mt-4">
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Selected images (<span x-text="previews.length"></span>)</p>
                                <div class="grid grid-cols-3 gap-3">
                                    <template x-for="(src, idx) in previews" :key="idx">
                                        <div class="relative h-20 overflow-hidden rounded-lg border border-gray-200 dark:border-gray-600">
                                            <img :src="src" class="w-full h-full object-cover">
                                            <button type="button" @click="removeImage(idx)" class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition-colors">
                                                <i class="fas fa-times text-xs"></i>
                                            </button>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </template>

                        <div class="mt-4 text-right">
                            <button type="button" @click="clear()" class="text-sm text-red-600 hover:text-red-700 font-medium inline-flex items-center">
                                <i class="fas fa-trash mr-1"></i> Clear All
                            </button>
                        </div>

                        @error('gallery')
                        <div class="mt-3 text-sm text-red-600 dark:text-red-400 flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <!-- Enhanced Action Buttons -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden border border-gray-100 dark:border-gray-700 transition-all duration-300 hover:shadow-xl">
                    <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-lg bg-blue-500 flex items-center justify-center mr-3 shadow-md">
                                <i class="fas fa-rocket text-white"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Publish Package</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <button type="submit"
                                    class="w-full px-6 py-3.5 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg transition-all duration-300 transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 flex items-center justify-center group">
                                <i class="fas fa-plus-circle mr-2 group-hover:scale-110 transition-transform"></i>
                                Create Package
                            </button>

                            <a href="{{ route('travel_tours.tour_packages') }}"
                               class="w-full px-6 py-3.5 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-xl shadow transition-all duration-300 hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 flex items-center justify-center group">
                                <i class="fas fa-times mr-2 group-hover:rotate-90 transition-transform"></i>
                                Cancel
                            </a>
                        </div>
                        
                        <div class="mt-6 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-100 dark:border-blue-800">
                            <div class="flex items-start">
                                <i class="fas fa-lightbulb text-blue-500 mt-0.5 mr-2"></i>
                                <div>
                                    <p class="text-sm font-medium text-blue-800 dark:text-blue-300">Pro Tip</p>
                                    <p class="text-xs text-blue-600 dark:text-blue-400 mt-1">Add high-quality images and detailed descriptions to attract more customers.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
function coverUpload() {
    return {
        imagePreview: null,
        handleImageUpload(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => this.imagePreview = e.target.result;
                reader.readAsDataURL(file);
            }
        },
        removeImage() {
            this.imagePreview = null;
            document.getElementById('cover-upload').value = '';
        }
    }
}

function galleryUpload() {
    return {
        previews: [],
        handleFiles(e) {
            const files = Array.from(e.target.files || []);
            files.forEach(file => {
                const reader = new FileReader();
                reader.onload = ev => this.previews.push(ev.target.result);
                reader.readAsDataURL(file);
            });
        },
        removeImage(index) {
            this.previews.splice(index, 1);
        },
        clear() {
            this.previews = [];
            document.getElementById('gallery-upload').value = '';
        }
    }
}
</script>

@endsection