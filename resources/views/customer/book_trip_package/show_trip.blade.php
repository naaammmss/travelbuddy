@extends('customer.customer_panel')

@section('page-title', $package->name)

@section('content')
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
            .modal-backdrop {
                backdrop-filter: blur(8px);
                background: rgba(0, 0, 0, 0.8);
            }
        </style>
    @endpush

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
        <!-- Background Elements -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 floating-animation"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-purple-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 floating-animation" style="animation-delay: 2s;"></div>
            <div class="absolute top-40 left-1/2 w-80 h-80 bg-cyan-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 floating-animation" style="animation-delay: 4s;"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 relative z-10">
            <!-- BACK LINK -->
            <a href="{{ route('customer.book_trip_package.trip_package') }}" 
               class="inline-flex items-center gap-3 text-blue-600 hover:text-blue-700 font-semibold mb-8 transition-all duration-300 transform hover:scale-105">
                <div class="w-10 h-10 rounded-full bg-white/80 backdrop-blur-sm flex items-center justify-center shadow-lg">
                    <i class="fa-solid fa-arrow-left"></i>
                </div>
                Back to Packages
            </a>

            <!-- PACKAGE DETAILS CARD -->
            <div class="glass-effect rounded-3xl shadow-2xl overflow-hidden transition-all duration-300 card-hover">
                <div class="grid lg:grid-cols-3 gap-0 relative">
                    <!-- MAIN IMAGE -->
                    <div class="lg:col-span-2 relative group cursor-pointer" onclick="openGallery(0)">
                        <img src="{{ asset('storage/' . $package->cover_photo) }}" 
                             alt="{{ $package->name }}" 
                             class="w-full h-96 lg:h-[500px] object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>
                        
                        <!-- Click to View Overlay -->
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 bg-black/20">
                            <div class="bg-white/90 backdrop-blur-sm text-gray-700 px-6 py-3 rounded-xl shadow-lg flex items-center gap-3">
                                <i class="fa-solid fa-expand text-lg"></i>
                                <span class="font-semibold">Click to View Gallery</span>
                            </div>
                        </div>
                        
                        <!-- Favorite Button -->
                        <button class="absolute top-4 right-4 w-12 h-12 bg-white/90 backdrop-blur-sm hover:bg-white p-3 rounded-full shadow-lg transition-all duration-300 transform hover:scale-110 z-10">
                            <i class="fa-regular fa-heart text-gray-600 hover:text-red-500 text-lg"></i>
                        </button>
                    </div>

                    <!-- SIDE GALLERY -->
                    @if(isset($package->gallery) && count($package->gallery) > 0)
                    <div class="flex flex-col gap-3 p-4 bg-white backdrop-blur-sm">
                        @foreach(array_slice($package->gallery, 0, 3) as $index => $image)
                            <img src="{{ asset('storage/' . $image) }}" 
                                 alt="Gallery Image" 
                                 class="w-full h-24 object-cover rounded-xl shadow-lg hover:scale-105 transition-all duration-300 cursor-pointer"
                                 onclick="openGallery({{ $index + 1 }})">
                        @endforeach
                        
                        @if(count($package->gallery) > 3)
                        <div class="relative">
                            <div class="w-full h-24 bg-gradient-to-br from-gray-200 to-gray-300 rounded-xl flex items-center justify-center">
                                <span class="text-gray-600 font-semibold">+{{ count($package->gallery) - 3 }} more</span>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif
                </div>

                <!-- Package Info Section -->
                <div class="p-8 bg-white/80 backdrop-blur-sm">
                    <div class="flex flex-col lg:flex-row justify-between items-start gap-6">
                        <div class="flex-1">
                            <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $package->name }}</h1>
                            <div class="flex items-center gap-4 mb-6">
                                <div class="flex items-center text-yellow-500">
                                    <i class="fas fa-star text-lg mr-1"></i>
                                    <span class="font-semibold">4.8</span>
                                    <span class="text-gray-500 ml-1">(127 reviews)</span>
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>Duration: 2-3 days</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-right">
                            <p class="text-gray-500 text-sm mb-1">Starting from</p>
                            <p class="text-4xl font-bold bg-gradient-to-r from-teal-600 to-blue-600 bg-clip-text text-transparent">₱{{ number_format($package->price, 2) }}</p>
                            <p class="text-gray-500 text-sm">per person</p>
                            <a href="#booking-form" 
                               class="mt-4 inline-block bg-gradient-to-r from-teal-600 to-blue-600 hover:from-teal-700 hover:to-blue-700 
                                      text-white font-semibold rounded-xl py-3 px-8 shadow-lg transition-all duration-300 transform hover:scale-105">
                                <i class="fa-solid fa-calendar-check mr-2"></i>
                                Book Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description Section -->
            @if($package->description)
            <div class="mt-8 glass-effect rounded-2xl p-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center">
                        <i class="fa-solid fa-circle-info text-white"></i>
                    </div>
                    About This Package
                </h3>
                <div class="text-gray-700 leading-relaxed text-lg whitespace-pre-line">
                    {!! nl2br(e($package->description)) !!}
                </div>
            </div>
            @endif

            <!-- Itinerary Section -->
            @if($package->itinerary)
            <div class="mt-8 glass-effect rounded-2xl p-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-green-500 to-teal-500 flex items-center justify-center">
                        <i class="fa-solid fa-route text-white"></i>
                    </div>
                    Itinerary
                </h3>
                <div class="text-gray-700 leading-relaxed text-lg whitespace-pre-line">
                    {!! nl2br(e($package->itinerary)) !!}
                </div>
            </div>
            @endif

            <!-- Inclusions & Exclusions + Booking Form -->
            <div class="grid lg:grid-cols-2 gap-8 mt-8">
                <!-- LEFT SIDE: Inclusions & Exclusions -->
                <div class="space-y-6">
                    @php
                        $inclusions = is_array($package->inclusions) ? $package->inclusions : explode("\n", $package->inclusions ?? '');
                        $exclusions = is_array($package->exclusions) ? $package->exclusions : explode("\n", $package->exclusions ?? '');
                    @endphp

                    <!-- Inclusions -->
                    @if(!empty(array_filter($inclusions)))
                    <div class="glass-effect rounded-2xl p-6 border-l-4 border-green-500">
                        <h4 class="text-xl font-bold text-green-700 mb-4 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center">
                                <i class="fa-solid fa-check text-white text-sm"></i>
                            </div>
                            What's Included
                        </h4>
                        <ul class="space-y-2">
                            @foreach($inclusions as $item)
                                @if(!empty(trim($item)))
                                    <li class="flex items-start gap-3 text-gray-700">
                                        <i class="fa-solid fa-check-circle text-green-500 mt-1 text-sm"></i>
                                        <span>{{ trim($item) }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Exclusions -->
                    @if(!empty(array_filter($exclusions)))
                    <div class="glass-effect rounded-2xl p-6 border-l-4 border-red-500">
                        <h4 class="text-xl font-bold text-red-700 mb-4 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-red-500 flex items-center justify-center">
                                <i class="fa-solid fa-times text-white text-sm"></i>
                            </div>
                            What's Not Included
                        </h4>
                        <ul class="space-y-2">
                            @foreach($exclusions as $item)
                                @if(!empty(trim($item)))
                                    <li class="flex items-start gap-3 text-gray-700">
                                        <i class="fa-solid fa-times-circle text-red-500 mt-1 text-sm"></i>
                                        <span>{{ trim($item) }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>

                <!-- RIGHT SIDE: Booking Form -->
                <div id="booking-form" class="glass-effect rounded-2xl shadow-xl p-8 h-fit self-start">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center">
                            <i class="fa-solid fa-calendar-check text-white"></i>
                        </div>
                        Book Your Trip
                    </h3>
                    @include('customer.book_trip_package.booking_form', ['package' => $package])
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Gallery Modal -->
    @if(isset($package->gallery) && count($package->gallery) > 0)
    <div id="galleryModal" class="fixed inset-0 z-50 hidden">
        <!-- Blurred Background Overlay -->
        <div class="absolute inset-0 bg-black/60 backdrop-blur-md transition-all duration-300" onclick="closeGallery()"></div>
        
        <!-- Modal Content Container -->
        <div class="relative w-full h-full flex items-center justify-center p-4">
            <!-- Main Image Container -->
            <div class="relative max-w-7xl w-full max-h-[90vh] flex items-center justify-center">
                <img id="galleryImage" 
                  src="" 
                    class="max-w-full max-h-full object-contain rounded-2xl shadow-2xl transition-all duration-300 transform scale-95 opacity-0" 
                      style="filter: drop-shadow(0 25px 50px rgba(0,0,0,0.3));">
                
                <!-- Close Button -->
                <button class="absolute top-4 right-4 w-14 h-14 bg-white/90 backdrop-blur-sm text-gray-700 rounded-full 
                    hover:bg-white hover:scale-110 transition-all duration-300 flex items-center justify-center group shadow-lg" 
                      onclick="closeGallery()">
                        <i class="fa-solid fa-times text-2xl group-hover:rotate-90 transition-transform duration-300"></i>
                </button>

                <!-- Navigation Buttons -->
                <button class="absolute left-4 top-1/2 -translate-y-1/2 w-14 h-14 bg-white/90 backdrop-blur-sm text-gray-700 
                    rounded-full hover:bg-white hover:scale-110 transition-all duration-300 flex items-center justify-center group shadow-lg" 
                      onclick="prevImage()">
                    <i class="fa-solid fa-chevron-left text-xl group-hover:-translate-x-1 transition-transform duration-300"></i>
                </button>
                <button class="absolute right-4 top-1/2 -translate-y-1/2 w-14 h-14 bg-white/90 backdrop-blur-sm text-gray-700 rounded-full hover:bg-white hover:scale-110 transition-all duration-300 flex items-center justify-center group shadow-lg" onclick="nextImage()">
                    <i class="fa-solid fa-chevron-right text-xl group-hover:translate-x-1 transition-transform duration-300"></i>
                </button>
            </div>
        </div>

        <!-- Bottom Controls -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 w-full max-w-4xl px-8">
            <!-- Gallery Counter -->
            <div class="flex justify-center mb-4">
                <div id="galleryCounter" 
                  class="bg-white/90 backdrop-blur-sm text-gray-700 text-sm font-semibold px-6 py-2 rounded-full shadow-lg">
                </div>
            </div>
            
            <!-- Thumbnail Strip -->
            <div class="flex justify-center">
                <div class="flex gap-3 max-w-4xl overflow-x-auto pb-2 px-4">
                    @foreach(array_merge([$package->cover_photo], $package->gallery) as $index => $image)
                        <img src="{{ asset('storage/' . $image) }}" 
                             alt="Thumbnail {{ $index + 1 }}"
                             class="w-20 h-20 object-cover rounded-xl cursor-pointer opacity-60 hover:opacity-100 transition-all duration-300 border-3 border-transparent hover:border-white hover:scale-110 shadow-lg"
                             onclick="openGallery({{ $index }})"
                             id="thumb-{{ $index }}">
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Keyboard Shortcuts Info -->
        <div class="absolute top-8 left-8 bg-white/90 backdrop-blur-sm text-gray-700 text-sm px-4 py-3 rounded-xl shadow-lg opacity-0 hover:opacity-100 transition-opacity duration-300">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-keyboard text-lg"></i>
                <div>
                    <div class="font-semibold">Navigation</div>
                    <div class="text-xs text-gray-600">Arrow keys • Swipe • Click outside</div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const images = @json(array_merge([$package->cover_photo], $package->gallery ?? []));
            let currentIndex = 0;

            // Make functions globally accessible
            window.openGallery = function(index) {
                currentIndex = index;
                const modal = document.getElementById('galleryModal');
                const galleryImage = document.getElementById('galleryImage');
                
                if (modal && galleryImage && images[index]) {
                    // Set image source first
                    galleryImage.src = '/storage/' + images[index];
                    
                    // Show modal with animation
                    modal.classList.remove('hidden');
                    
                    // Trigger image animation after a short delay
                    setTimeout(() => {
                        galleryImage.style.transform = 'scale(1)';
                        galleryImage.style.opacity = '1';
                    }, 50);
                    
                    updateCounter();
                    updateThumbnails();
                    
                    // Prevent body scroll when modal is open
                    document.body.style.overflow = 'hidden';
                }
            };

            window.closeGallery = function() {
                const modal = document.getElementById('galleryModal');
                const galleryImage = document.getElementById('galleryImage');
                
                if (modal && galleryImage) {
                    // Animate image out
                    galleryImage.style.transform = 'scale(0.95)';
                    galleryImage.style.opacity = '0';
                    
                    // Hide modal after animation
                    setTimeout(() => {
                        modal.classList.add('hidden');
                        // Restore body scroll
                        document.body.style.overflow = 'auto';
                    }, 300);
                }
            };

            window.nextImage = function() {
                currentIndex = (currentIndex + 1) % images.length;
                updateGallery();
            };

            window.prevImage = function() {
                currentIndex = (currentIndex - 1 + images.length) % images.length;
                updateGallery();
            };

            function updateGallery() {
                const galleryImage = document.getElementById('galleryImage');
                if (galleryImage && images[currentIndex]) {
                    // Fade out current image
                    galleryImage.style.opacity = '0';
                    galleryImage.style.transform = 'scale(0.95)';
                    
                    // Change image source and fade in
                    setTimeout(() => {
                        galleryImage.src = '/storage/' + images[currentIndex];
                        galleryImage.style.opacity = '1';
                        galleryImage.style.transform = 'scale(1)';
                    }, 150);
                    
                    updateCounter();
                    updateThumbnails();
                }
            }

            function updateCounter() {
                const counter = document.getElementById('galleryCounter');
                if (counter) {
                    counter.innerText = `${currentIndex + 1} / ${images.length}`;
                }
            }

            function updateThumbnails() {
                // Remove active class from all thumbnails
                document.querySelectorAll('[id^="thumb-"]').forEach(thumb => {
                    thumb.classList.remove('border-white', 'opacity-100', 'scale-110');
                    thumb.classList.add('border-transparent', 'opacity-60');
                });
                
                // Add active class to current thumbnail
                const currentThumb = document.getElementById(`thumb-${currentIndex}`);
                if (currentThumb) {
                    currentThumb.classList.remove('border-transparent', 'opacity-60');
                    currentThumb.classList.add('border-white', 'opacity-100', 'scale-110');
                }
            }

            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                const modal = document.getElementById('galleryModal');
                if (!modal || modal.classList.contains('hidden')) return;
                
                switch(e.key) {
                    case 'Escape':
                        closeGallery();
                        break;
                    case 'ArrowRight':
                        e.preventDefault();
                        nextImage();
                        break;
                    case 'ArrowLeft':
                        e.preventDefault();
                        prevImage();
                        break;
                }
            });

            // Touch/swipe support for mobile
            let touchStartX = 0;
            let touchEndX = 0;

            const modal = document.getElementById('galleryModal');
            if (modal) {
                modal.addEventListener('touchstart', (e) => {
                    touchStartX = e.changedTouches[0].screenX;
                });

                modal.addEventListener('touchend', (e) => {
                    touchEndX = e.changedTouches[0].screenX;
                    handleSwipe();
                });
            }

            function handleSwipe() {
                const swipeThreshold = 50;
                const diff = touchStartX - touchEndX;
                
                if (Math.abs(diff) > swipeThreshold) {
                    if (diff > 0) {
                        nextImage(); // next image
                    } else {
                        prevImage(); // previous image
                    }
                }
            }

            // Close modal when clicking outside the image
            if (modal) {
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        closeGallery();
                    }
                });
            }
        });
    </script>
@endsection
