@extends('travel_tours.travel_layout')

@section('title', 'Edit Tour Package | TravelBuddy')
@section('page-title', 'Edit Tour Package')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 transition-colors duration-300 dark:bg-gray-900">
    <!-- HEADER -->
    <div class="mb-8 flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <div class="p-2 bg-teal-100 dark:bg-teal-800 rounded-full">
                <i class="fa-solid fa-suitcase text-teal-600 dark:text-teal-300"></i>
            </div>
            <h1 class="text-3xl font-extrabold text-gray-800 dark:text-gray-100">
                Edit Package: <span class="text-sky-600 dark:text-sky-400">{{ $package->name }}</span>
            </h1>
        </div>
        <a href="{{ route('travel_tours.tour_packages') }}"
           class="px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-100 text-gray-700 font-medium transition-all duration-200 shadow-sm">
            <i class="fa-solid fa-arrow-left mr-2"></i> Back to List
        </a>
    </div>

    <!-- FORM START -->
    <form action="{{ route('travel_tours.tour_packages.update', $package->id) }}" 
        method="POST" enctype="multipart/form-data" class="space-y-10">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- LEFT SIDE -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- PACKAGE DETAILS -->
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-6 border border-gray-100 dark:border-gray-700 transition-all">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4 flex items-center">
                        <i class="fa-solid fa-info-circle text-sky-500 dark:text-sky-400 mr-2"></i> Basic Information
                    </h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Package Name</label>
                            <input type="text" name="name" value="{{ old('name', $package->name) }}" required
                                class="mt-2 w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 p-3 focus:ring-sky-500 focus:border-sky-500 transition">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                                <select name="category"
                                    class="mt-2 w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 p-3 focus:ring-sky-500 focus:border-sky-500 transition">
                                    <option value="">Select a category</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat }}" {{ old('category', $package->category) == $cat ? 'selected' : '' }}>
                                            {{ $cat }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location</label>
                                <input type="text" name="location" value="{{ old('location', $package->location) }}"
                                    class="mt-2 w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 p-3 focus:ring-sky-500 focus:border-sky-500 transition">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                            <textarea name="description" rows="4"
                                class="mt-2 w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 p-3 focus:ring-sky-500 focus:border-sky-500 transition">{{ old('description', $package->description) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- PACKAGE SETTINGS -->
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-6 border border-gray-100 dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4 flex items-center">
                        <i class="fa-solid fa-clock text-sky-500 dark:text-sky-400 mr-2"></i> Package Details
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Duration</label>
                            <input type="text" name="duration" value="{{ old('duration', $package->duration) }}"
                                class="mt-2 w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 p-3 focus:ring-sky-500 focus:border-sky-500 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Max Participants</label>
                            <input type="number" name="max_participants" min="1"
                                value="{{ old('max_participants', $package->max_participants) }}"
                                class="mt-2 w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 p-3 focus:ring-sky-500 focus:border-sky-500 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price (PHP)</label>
                            <input type="number" step="0.01" name="price" value="{{ old('price', $package->price) }}"
                                class="mt-2 w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 p-3 focus:ring-sky-500 focus:border-sky-500 transition">
                        </div>
                    </div>
                </div>

                <!-- ITINERARY -->
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-6 border border-gray-100 dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4 flex items-center">
                        <i class="fa-solid fa-map text-sky-500 dark:text-sky-400 mr-2"></i> Itinerary
                    </h2>
                    <textarea name="itinerary" rows="6"
                        class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 p-3 focus:ring-sky-500 focus:border-sky-500 transition">{{ old('itinerary', $package->itinerary) }}</textarea>
                </div>

                <!-- INCLUSIONS / EXCLUSIONS -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-6 border border-gray-100 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4 flex items-center">
                            <i class="fa-solid fa-plus-circle text-teal-600 dark:text-teal-400 mr-2"></i> Inclusions
                        </h2>
                        <textarea name="inclusions" rows="4"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 p-3 focus:ring-sky-500 focus:border-sky-500 transition">{{ old('inclusions', $package->inclusions) }}</textarea>
                    </div>
                    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-6 border border-gray-100 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4 flex items-center">
                            <i class="fa-solid fa-minus-circle text-red-500 dark:text-red-400 mr-2"></i> Exclusions
                        </h2>
                        <textarea name="exclusions" rows="4"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 p-3 focus:ring-sky-500 focus:border-sky-500 transition">{{ old('exclusions', $package->exclusions) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- RIGHT SIDE -->
            <div class="space-y-8">
                <!-- COVER PHOTO -->
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-6 border border-gray-100 dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4 flex items-center">
                        <i class="fa-solid fa-image text-sky-500 dark:text-sky-400 mr-2"></i> Cover Photo
                    </h2>
                    @if($package->cover_photo)
                        <img src="{{ asset('storage/' . $package->cover_photo) }}" alt="cover"
                             class="w-full h-48 object-cover rounded-lg mb-3 border dark:border-gray-600">
                    @endif
                    <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-700 dark:text-gray-300">
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Upload a new image to replace the current one (optional)</p>
                </div>

                <!-- GALLERY -->
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-6 border border-gray-100 dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4 flex items-center">
                        <i class="fa-solid fa-images text-sky-500 dark:text-sky-400 mr-2"></i> Gallery
                    </h2>
                    @if(is_array($package->gallery) && count($package->gallery))
                        <div class="grid grid-cols-3 gap-2 mb-3">
                            @foreach($package->gallery as $g)
                                <img src="{{ asset('storage/' . $g) }}" class="w-full h-24 object-cover rounded border dark:border-gray-600" alt="gallery">
                            @endforeach
                        </div>
                    @endif
                    <input type="file" name="gallery[]" accept="image/*" multiple class="w-full text-sm text-gray-700 dark:text-gray-300">
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Add more gallery images (these will be appended)</p>
                </div>

                <!-- ACTION BUTTONS -->
                <div class="flex space-x-3">
                    <button type="submit"
                        class="flex-1 bg-sky-600 hover:bg-sky-700 text-white py-2.5 rounded-lg font-semibold shadow-md transition-all duration-200">
                        <i class="fa-solid fa-floppy-disk mr-2"></i> Save Changes
                    </button>
                    <a href="{{ route('travel_tours.tour_packages') }}"
                        class="flex-1 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-100 py-2.5 rounded-lg font-semibold transition-all duration-200">
                        <i class="fa-solid fa-xmark mr-1"></i> Cancel
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
