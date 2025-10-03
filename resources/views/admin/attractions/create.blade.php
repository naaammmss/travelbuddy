@extends('admin.layout')

@section('title', 'Add Attraction | Admin')
@section('page-title', 'Add Attraction')

@section('content')

    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Add New Attraction</h1>
                    <p class="text-gray-600 mt-2">Create a new tourist spot for your travel platform</p>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.attractions.index') }}" 
                        class="inline-flex items-center px-4 py-2 
                            border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white 
                            hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i> Back to Attractions
                    </a>
                </div>
            </div>
        </div>
        
        <form action="{{ route('admin.attractions.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8" x-data="attractionForm()">
            @csrf

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                <!-- Main Form Content -->
                <div class="xl:col-span-2 space-y-8">
                    <!-- Information Card -->
                    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                Basic Information
                            </h3>
                        </div>
                        <div class="p-6 space-y-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Attraction Name <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    name="name" 
                                    value="{{ old('name') }}" 
                                    required 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors @error('name') border-red-300 focus:ring-red-500 @enderror"
                                    placeholder="Enter attraction name (e.g., Chocolate Hills)"
                                >
                                @error('name')
                                    <div class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                                <textarea 
                                    name="description" 
                                    rows="6" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors resize-none @error('description') border-red-300 focus:ring-red-500 @enderror"
                                    placeholder="Describe the attraction, what makes it special, activities available, best time to visit, etc."
                                >{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Category</label>
                                <select 
                                    name="category" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors @error('category') border-red-300 focus:ring-red-500 @enderror"
                                >
                                    <option value="">Select a category</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat }}" @selected(old('category') == $cat)>{{ $cat }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <div class="mt-2 text-sm text-red-600 flex items-center">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Location Information -->
                    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-map-marker-alt mr-2 text-green-600"></i>
                                Location Details
                            </h3>
                        </div>
                        <div class="p-6 space-y-6">
                           <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Address/Location Name
                                </label>
                                <input type="text" 
                                       name="address" 
                                       value="{{ old('address') }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                                       placeholder="e.g., Carmen, Bohol, Philippines">
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-info-circle mr-2 text-purple-600"></i>
                                Additional Information
                            </h3>
                        </div>
                        <div class="p-6 space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Best Time to Visit
                                    </label>
                                    <select name="best_time_to_visit" 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                                        <option value="">Select best time</option>
                                        <option value="Early Morning" @selected(old('best_time_to_visit') == 'Early Morning')>Early Morning (6-9 AM)</option>
                                        <option value="Morning" @selected(old('best_time_to_visit') == 'Morning')>Morning (9-12 PM)</option>
                                        <option value="Afternoon" @selected(old('best_time_to_visit') == 'Afternoon')>Afternoon (12-5 PM)</option>
                                        <option value="Evening" @selected(old('best_time_to_visit') == 'Evening')>Evening (5-8 PM)</option>
                                        <option value="Anytime" @selected(old('best_time_to_visit') == 'Anytime')>Anytime</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Estimated Visit Duration
                                    </label>
                                    <select name="visit_duration" 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                                        <option value="">Select duration</option>
                                        <option value="30 minutes" @selected(old('visit_duration') == '30 minutes')>30 minutes</option>
                                        <option value="1 hour" @selected(old('visit_duration') == '1 hour')>1 hour</option>
                                        <option value="2-3 hours" @selected(old('visit_duration') == '2-3 hours')>2-3 hours</option>
                                        <option value="Half day" @selected(old('visit_duration') == 'Half day')>Half day (4-6 hours)</option>
                                        <option value="Full day" @selected(old('visit_duration') == 'Full day')>Full day (6+ hours)</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Entry Fee (Optional)
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">₱</span>
                                    </div>
                                    <input type="number" 
                                           name="entry_fee" 
                                           value="{{ old('entry_fee') }}" 
                                           min="0"
                                           step="0.01"
                                           class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                                           placeholder="0.00">
                                </div>
                                <p class="mt-1 text-sm text-gray-500">Leave empty if free entry</p>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Special Notes
                                </label>
                                <textarea name="special_notes" 
                                          rows="3" 
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors resize-none"
                                          placeholder="Any special requirements, restrictions, or important information visitors should know...">{{ old('special_notes') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-8">
                    <!-- Image Upload Card -->
                    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Cover Photo
                            </h3>
                        </div>
                        <div class="p-6">
                            <!-- Image Preview -->
                            <div x-show="!imagePreview" class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-gray-400 transition-colors">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="mt-4">
                                    <label for="image-upload" class="cursor-pointer">
                                        <span class="mt-2 block text-sm font-medium text-gray-900">Upload a photo</span>
                                        <span class="mt-1 block text-sm text-gray-500">PNG, JPG up to 4MB</span>
                                    </label>
                                    <input id="image-upload" type="file" name="image" accept="image/*" class="sr-only" @change="handleImageUpload($event)">
                                </div>
                            </div>

                            <div x-show="imagePreview" class="space-y-4">
                                <div class="relative">
                                    <img :src="imagePreview" alt="Preview" class="w-full h-48 object-cover rounded-lg border border-gray-200">
                                    <button type="button" @click="removeImage()" class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="text-center">
                                    <button type="button" class="cursor-pointer text-sm text-blue-600 hover:text-blue-700 font-medium"
                                            @click="document.getElementById('image-upload').click()">
                                        Change Photo
                                    </button>
                                </div>
                            </div>

                            @error('image')
                                <div class="mt-4 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                        <div class="p-6 space-y-4">
                            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold py-3 px-6 rounded-lg hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105">
                                Create Attraction
                            </button>
                            <a href="{{ route('admin.attractions.index') }}" class="w-full bg-gray-100 text-gray-700 font-semibold py-3 px-6 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors text-center block">
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function attractionForm() {
            return {
                imagePreview: null,
                
                handleImageUpload(event) {
                    const file = event.target.files[0];
                    if (file) {
                        // Validate file size (4MB)
                        if (file.size > 4 * 1024 * 1024) {
                            alert('File size must be less than 4MB');
                            event.target.value = '';
                            return;
                        }
                        
                        // file type
                        if (!file.type.startsWith('image/')) {
                            alert('Please select an image file');
                            event.target.value = '';
                            return;
                        }
                        
                        // Create preview
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.imagePreview = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                },
                
                removeImage() {
                    this.imagePreview = null;
                    document.getElementById('image-upload').value = '';
                    document.getElementById('image-upload-change').value = '';
                }
            }
        }
    </script>
@endsection


