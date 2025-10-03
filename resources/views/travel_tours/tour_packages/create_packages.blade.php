@extends('travel & tours.travel_layout')

@section('title', 'Travel & Tours Dashboard  | TravelBuddy')
@section('page-title', 'Packages')

@section('content')

<!-- Add Package Modal -->
    <div x-show="showAddModal || showEditModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        
        <div class="bg-white rounded-xl shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-900" x-text="showEditModal ? 'Edit Package' : 'Add New Package'"></h3>
                    <button @click="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>

            <form @submit.prevent="savePackage()" class="p-6 space-y-6">
                <!-- Basic Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Package Name *</label>
                        <input type="text" 
                               x-model="packageForm.name"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Enter package name"
                               required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                        <select x-model="packageForm.category"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                            <option value="">Select category</option>
                            <option value="Adventure">Adventure</option>
                            <option value="Cultural">Cultural</option>
                            <option value="Nature">Nature</option>
                            <option value="Beach">Beach</option>
                            <option value="Historical">Historical</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                    <textarea x-model="packageForm.description"
                              rows="4"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                              placeholder="Describe your tour package..."
                              required></textarea>
                </div>

                <!-- Package Details -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Duration *</label>
                        <input type="text" 
                               x-model="packageForm.duration"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="e.g., 1 day, 2 days"
                               required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Max Participants *</label>
                        <input type="number" 
                               x-model="packageForm.max_participants"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Maximum participants"
                               required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Price (₱) *</label>
                        <input type="number" 
                               x-model="packageForm.price"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Price per person"
                               required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Location *</label>
                    <input type="text" 
                           x-model="packageForm.location"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Tour location"
                           required>
                </div>

                <!-- Package Image -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Package Image</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition-colors">
                        <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-4"></i>
                        <p class="text-sm text-gray-600 mb-2">Upload package image</p>
                        <p class="text-xs text-gray-500 mb-4">PNG, JPG up to 5MB</p>
                        <label for="package-image" class="cursor-pointer">
                            <span class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-upload mr-2"></i>
                                Choose File
                            </span>
                            <input id="package-image" type="file" accept="image/*" class="hidden" @change="handleImageUpload($event)">
                        </label>
                    </div>
                </div>

                <!-- Itinerary -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Itinerary</label>
                    <textarea x-model="packageForm.itinerary"
                              rows="6"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                              placeholder="Day 1: Arrival and welcome...
Day 2: Chocolate Hills tour...
Day 3: Beach activities..."></textarea>
                </div>

                <!-- Inclusions & Exclusions -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Inclusions</label>
                        <textarea x-model="packageForm.inclusions"
                                  rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                                  placeholder="• Transportation
• Meals
• Guide services
• Entrance fees"></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Exclusions</label>
                        <textarea x-model="packageForm.exclusions"
                                  rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                                  placeholder="• Personal expenses
• Optional activities
• Travel insurance"></textarea>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <button type="button" @click="closeModal()" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <span x-text="showEditModal ? 'Update Package' : 'Create Package'"></span>
                    </button>
                </div>
            </form>
                </div>
            </main>
        </div>
    </div>
