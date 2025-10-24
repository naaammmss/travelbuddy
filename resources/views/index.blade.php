<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bohol TravelBuddy - Your Ultimate Travel Companion</title>
    <meta name="description" content="Discover Bohol's hidden gems with TravelBuddy.">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        body { 
            font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; 
        }
        .hero-bg {
            background: linear-gradient(135deg, rgba(6, 182, 212, 0.7) 0%, rgba(14, 165, 233, 0.30) 50%, rgba(59, 130, 246, 0.7) 100%),
                        url('/images/AndaBeach.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .gradient-text {
            background: linear-gradient(135deg, #0EA5E9, #3B82F6, #1D4ED8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .animate-pulse-slow {
            animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
</head>
<body class="bg-white text-gray-900">
    <!-- Navigation -->
    <nav class="bg-white/95 backdrop-blur-sm shadow-sm sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="h-20 flex items-center px-6 border-b border-gray-200">
                    <img src="{{ asset('images/logo.png') }}" alt="TravelBuddy Logo" class="h-16 w-auto">
                    <div class="ml-3">
                        <div class="text-lg font-extrabold tracking-tight">TravelBuddy</div>
                        <div class="text-xs text-gray-500">Your Ultimate Travel Companion</div>
                    </div>
                </div>
                
                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">Home</a>
                    <a href="#features" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">Features</a>
                    <a href="#attractions" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">Attractions</a>
                    <a href="#testimonials" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">Reviews</a>
                    <a href="#faq" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">FAQ</a>
                    <a href="#contact" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">Contact</a>
                </div>
            
                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('register.form') }}" 
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                        Register
                    </a>

                    <a href="{{ route('login.form') }}"
                        class="border border-blue-600 text-blue-600 px-6 py-2 rounded-lg font-medium hover:bg-blue-50 transition-colors">
                        Login
                    </a>
                </div>
                
                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 text-2xl">
                    ☰
                </button>
            </div>
            
            <!-- Mobile Menu -->
            <div x-show="mobileMenuOpen" x-transition class="md:hidden py-4 border-t border-gray-200">
                <div class="flex flex-col space-y-4">
                    <a href="#home" class="text-gray-700 hover:text-blue-600 transition-colors">Home</a>
                    <a href="#features" class="text-gray-700 hover:text-blue-600 transition-colors">Features</a>
                    <a href="#attractions" class="text-gray-700 hover:text-blue-600 transition-colors">Attractions</a>
                    <a href="#testimonials" class="text-gray-700 hover:text-blue-600 transition-colors">Reviews</a>
                    <a href="#faq" class="text-gray-700 hover:text-blue-600 transition-colors">FAQ</a>
                    <a href="#contact" class="text-gray-700 hover:text-blue-600 transition-colors">Contact</a>
                    <div class="flex flex-col space-y-2 pt-4">
                        <button class="bg-blue-600 text-white px-6 py-2 rounded-lg font-medium">Register</button>
                        <button class="border border-blue-600 text-blue-600 px-6 py-2 rounded-lg font-medium">Login</button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="relative hero-bg min-h-screen flex items-center">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                
                <div class="text-white">
                    <div class="animate-float">
                        <h1 class="text-5xl md:text-7xl font-bold mb-8 leading-tight">
                            Discover<br>
                            <span class="text-yellow-300">Bohol's</span><br>
                            Hidden Gems
                        </h1>
                    </div>
                    <p class="text-xl md:text-2xl mb-8 leading-relaxed text-blue-100">
                        Your comprehensive travel companion for exploring the beautiful island of Bohol. Plan, discover, and experience the best of this tropical paradise.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button class="bg-yellow-400 text-gray-900 px-8 py-4 rounded-xl font-bold text-lg hover:bg-yellow-300 transition-all transform hover:scale-105 shadow-lg">
                            Start Your Journey
                        </button>
                        <button class="bg-white/20 backdrop-blur-sm text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-white/30 transition-all border border-white/30">
                            Learn More
                        </button>
                    </div>
                </div>
                
                <!-- Right Content - Stats Cards -->
                <div class="grid grid-cols-2 gap-6">
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 text-center border border-white/20">
                        <div class="text-3xl font-bold text-yellow-300 mb-2">50+</div>
                        <div class="text-white/90">Attractions</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 text-center border border-white/20">
                        <div class="text-3xl font-bold text-yellow-300 mb-2">1000+</div>
                        <div class="text-white/90">Happy Travelers</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 text-center border border-white/20">
                        <div class="text-3xl font-bold text-yellow-300 mb-2">24/7</div>
                        <div class="text-white/90">Support</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 text-center border border-white/20">
                        <div class="text-3xl font-bold text-yellow-300 mb-2">4.9★</div>
                        <div class="text-white/90">Rating</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    Why Choose <span class="gradient-text">TravelBuddy</span>?
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Experience Bohol like never before with our comprehensive travel platform designed specifically for the island's unique attractions and culture.
                </p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg card-hover">
                    <div class=" flex items-center justify-center mb-6">
                        <img src="/images/map.png" alt="Interactive Map" class="w-16 h-16 md:w-20 md:h-20 object-contain" />
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center justify-center">Interactive Maps</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Navigate Bohol with confidence using our detailed interactive maps featuring all major attractions, restaurants, and hidden gems.
                    </p>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg card-hover">
                    <div class=" flex items-center justify-center mb-6">
                        <img src="/images/itinerary.png" alt="Smart Itinerary" class="w-16 h-16 md:w-20 md:h-20 object-cover rounded-xl" />
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center justify-center">Smart Itinerary</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Get personalized travel recommendations based on your interests, budget, and time constraints for the perfect Bohol experience.
                    </p>
                </div>
                
                <!-- Feature 3 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg card-hover">
                    <div class=" flex items-center justify-center mb-6">
                        <img src="/images/twentyfour-seven.png" alt="24/7 Support" class="w-16 h-16 md:w-20 md:h-20 object-contain" />
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center justify-center">24/7 Support</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Get help anytime with our round-the-clock customer support team, available in English language.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Attractions Section -->
    <section id="attractions" class="py-20 bg-gradient-to-br from-gray-50 via-blue-50 to-cyan-50 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-20 left-10 w-32 h-32 bg-blue-400 rounded-full blur-3xl"></div>
            <div class="absolute top-40 right-20 w-24 h-24 bg-cyan-400 rounded-full blur-2xl"></div>
            <div class="absolute bottom-20 left-1/4 w-40 h-40 bg-indigo-400 rounded-full blur-3xl"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center mb-16">
                <div class="inline-block mb-4">
                    <span class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-semibold">🏝️ Explore Bohol</span>
                </div>
                <h2 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">
                    Must-Visit <span class="gradient-text">Attractions</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-4xl mx-auto mb-8 leading-relaxed">
                    Discover Bohol's most iconic destinations and hidden treasures with our curated collection of attractions. From natural wonders to cultural heritage sites.
                </p>
            </div>
            
            <!-- Attractions Carousel -->
            <div class="relative" x-data="attractionsCarousel()" 
                 @mouseenter="stopAutoPlay()" 
                 @mouseleave="restartAutoPlay()">
                <!-- Carousel Container -->
                <div class="overflow-hidden rounded-3xl shadow-2xl">
                    <!-- Ensure consistent slide height -->
                    <style>
                        /* Inline to keep this view self-contained; adjust if needed */
                        .attractions-fixed-height { min-height: 720px; }
                    </style>
                    <div class="flex transition-transform duration-700 ease-in-out" 
                         :style="`transform: translateX(-${currentSlide * 100}%)`">
                         
                         <!-- Slide 1: Natural Wonders/Chocolate Hills -->
                         <div class="w-full flex-shrink-0">
                             <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 p-8 bg-white/90 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 attractions-fixed-height">
                                 <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-xl overflow-hidden card-hover border border-gray-100 group" x-data="{ isLiked: false }">
                                     <div class="relative h-80 bg-gradient-to-br from-amber-100 to-orange-200 overflow-hidden">
                                         <img src="/images/Chocolate-Hills.jpg" alt="Chocolate Hills" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" 
                                              onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                         <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                         
                                         <!-- Rating Badge -->
                                         <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm rounded-full px-3 py-1">
                                             <div class="flex items-center space-x-1">
                                                 <span class="text-yellow-400">★</span>
                                                 <span class="text-sm font-bold">4.8</span>
                                             </div>
                                         </div>
                                         
                                         <!-- Category Badge -->
                                         <div class="absolute bottom-4 left-4">
                                             <span class="bg-amber-500 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">Natural Wonder</span>
                                         </div>
                                     </div>
                                     <div class="p-6">
                                         <div class="flex items-start justify-between mb-3">
                                             <h3 class="text-2xl font-bold text-gray-800">Chocolate Hills</h3>
                                         </div>
                                         <p class="text-gray-600 mb-4 leading-relaxed">Iconic dome-shaped hills that turn chocolate brown during dry season, creating a unique landscape that's one of the Philippines' most famous landmarks.</p>
                                         
                                         <div class="flex items-center justify-between mb-4">
                                             <div class="flex items-center space-x-2">
                                                 <span class="text-sm text-gray-500">📍 Carmen, Bohol</span>
                                             </div>
                                         </div>
                                         
                                         <div class="flex space-x-2">
                                             <button class="flex-1 bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition-all duration-300 hover:scale-105 shadow-lg">
                                                 View Details
                                             </button>
                                         </div>
                                     </div>
                                 </div>
                                 
                                 <!-- Tarsier Sanctuary -->
                                 <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-xl overflow-hidden card-hover border border-gray-100 group" x-data="{ isLiked: false }">
                                     <div class="relative h-80 bg-gradient-to-br from-green-100 to-emerald-200 overflow-hidden">
                                         <img src="/images/tarsier_sanctuary.jpg" alt="Tarsier Sanctuary" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                              onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                         <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                         
                                         <!-- Rating Badge -->
                                         <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm rounded-full px-3 py-1">
                                             <div class="flex items-center space-x-1">
                                                 <span class="text-yellow-400">★</span>
                                                 <span class="text-sm font-bold">4.7</span>
                                             </div>
                                         </div>
                                    
                                         <div class="absolute bottom-4 left-4">
                                             <span class="bg-green-500 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">Wildlife</span>
                                         </div>
                                     </div>
                                     <div class="p-6">
                                         <div class="flex items-start justify-between mb-3">
                                             <h3 class="text-2xl font-bold text-gray-800">Tarsier Sanctuary</h3>
                                         </div>
                                         <p class="text-gray-600 mb-4 leading-relaxed">Meet the world's smallest primates in their natural habitat with guided tours and learn about conservation efforts.</p>
                                         
                                         <div class="flex items-center justify-between mb-4">
                                             <div class="flex items-center space-x-2">
                                                 <span class="text-sm text-gray-500">📍 Corella, Bohol</span>
                                             </div>
                                         </div>
                                         
                                         <div class="flex space-x-2">
                                             <button class="flex-1 bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition-all duration-300 hover:scale-105 shadow-lg">
                                                 View Details
                                             </button>
                                         </div>
                                     </div>
                                 </div>
                                 
                                 <!-- Panglao Beach -->
                                 <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-xl overflow-hidden card-hover border border-gray-100 group" x-data="{ isLiked: false }">
                                     <div class="relative h-80 bg-gradient-to-br from-cyan-100 to-blue-200 overflow-hidden">
                                         <img src="/images/AndaBeach.jpg" alt="Panglao Beach" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                              onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                         <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                         
                                         <!-- Rating Badge -->
                                         <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm rounded-full px-3 py-1">
                                             <div class="flex items-center space-x-1">
                                                 <span class="text-yellow-400">★</span>
                                                 <span class="text-sm font-bold">4.9</span>
                                             </div>
                                         </div>
                                         
                                         <div class="absolute bottom-4 left-4">
                                             <span class="bg-cyan-500 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">Beach</span>
                                         </div>
                                     </div>
                                     <div class="p-6">
                                         <div class="flex items-start justify-between mb-3">
                                             <h3 class="text-2xl font-bold text-gray-800">Panglao Beach</h3>
                                         </div>
                                         <p class="text-gray-600 mb-4 leading-relaxed">Pristine white sand beaches perfect for swimming, snorkeling, and diving with crystal clear waters.</p>
                                         
                                         <div class="flex items-center justify-between mb-4">
                                             <div class="flex items-center space-x-2">
                                                 <span class="text-sm text-gray-500">📍 Panglao Island</span>
                                             </div>
                                         </div>
                                         
                                         <div class="flex space-x-2">
                                             <button class="flex-1 bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition-all duration-300 hover:scale-105 shadow-lg">
                                                 View Details
                                             </button>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         
                         <!-- Slide 2: Adventure & Nature -->
                         <div class="w-full flex-shrink-0">
                             <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 p-8 bg-white/90 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 attractions-fixed-height">
                                 <!-- Loboc River -->
                                 <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-xl overflow-hidden card-hover border border-gray-100 group" x-data="{ isLiked: false }">
                                     <div class="relative h-80 bg-gradient-to-br from-cyan-100 to-blue-200 overflow-hidden">
                                         <img src="/images/loboc_river.jpg" alt="Loboc River" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                              onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                         <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                         <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm rounded-full px-3 py-1">
                                             <div class="flex items-center space-x-1">
                                                 <span class="text-yellow-400">★</span>
                                                 <span class="text-sm font-semibold">4.6</span>
                                             </div>
                                         </div>
                                         <div class="absolute bottom-4 left-4 text-white">
                                             <span class="bg-teal-500 text-white px-3 py-1 rounded-full text-sm font-medium">River Cruise</span>
                                         </div>
                                     </div>
                                     <div class="p-6">
                                         <h3 class="text-2xl font-bold text-gray-800 mb-3">Loboc River</h3>
                                         <p class="text-gray-600 mb-4 leading-relaxed">Scenic river cruise with buffet lunch and live music entertainment.</p>
                                         <div class="flex items-center justify-between mb-4">
                                             <div class="flex items-center space-x-2">
                                                 <span class="text-sm text-gray-500">📍 Loboc, Bohol</span>
                                             </div>
                                         </div>
                                         <button class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition-colors">
                                             View Details
                                         </button>
                                     </div>
                                 </div>
                                 
                                 <!-- Hinagdanan Cave -->
                                 <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-xl overflow-hidden card-hover border border-gray-100 group" x-data="{ isLiked: false }">
                                     <div class="relative h-80 bg-gradient-to-br from-cyan-100 to-blue-200 overflow-hidden">
                                         <img src="/images/hinagdanan-cave.jpg" alt="Hinagdanan Cave" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                              onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                         <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                         <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm rounded-full px-3 py-1">
                                             <div class="flex items-center space-x-1">
                                                 <span class="text-yellow-400">★</span>
                                                 <span class="text-sm font-semibold">4.5</span>
                                             </div>
                                         </div>
                                         <div class="absolute bottom-4 left-4 text-white">
                                             <span class="bg-purple-500 text-white px-3 py-1 rounded-full text-sm font-medium">Adventure</span>
                                         </div>
                                     </div>
                                     <div class="p-6">
                                         <h3 class="text-2xl font-bold text-gray-800 mb-3">Hinagdanan Cave</h3>
                                         <p class="text-gray-600 mb-4 leading-relaxed">Natural limestone cave with crystal clear underground pool for swimming.</p>
                                         <div class="flex items-center justify-between mb-4">
                                             <div class="flex items-center space-x-2">
                                                 <span class="text-sm text-gray-500">📍 Dauis, Bohol</span>
                                             </div>
                                         </div>
                                         <button class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition-colors">
                                             View Details
                                         </button>
                                     </div>
                                 </div>
                                 
                                 <!-- Bilar Man-Made Forest -->
                                 <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-xl overflow-hidden card-hover border border-gray-100 group" x-data="{ isLiked: false }">
                                     <div class="relative h-80 bg-gradient-to-br from-cyan-100 to-blue-200 overflow-hidden">
                                         <img src="/images/Bilar_manmade_forest.jpg" alt="Bilar Forest" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                              onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                         <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                         <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm rounded-full px-3 py-1">
                                             <div class="flex items-center space-x-1">
                                                 <span class="text-yellow-400">★</span>
                                                 <span class="text-sm font-semibold">4.4</span>
                                             </div>
                                         </div>
                                         <div class="absolute bottom-4 left-4 text-white">
                                             <span class="bg-emerald-500 text-white px-3 py-1 rounded-full text-sm font-medium">Nature</span>
                                         </div>
                                     </div>
                                     <div class="p-6">
                                         <h3 class="text-2xl font-bold text-gray-800 mb-3">Bilar Forest</h3>
                                         <p class="text-gray-600 mb-4 leading-relaxed">Dense mahogany forest perfect for nature walks and photography.</p>
                                         <div class="flex items-center justify-between mb-4">
                                             <div class="flex items-center space-x-2">
                                                 <span class="text-sm text-gray-500">📍 Bilar, Bohol</span>
                                             </div>
                                         </div>
                                         <button class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition-colors">
                                             View Details
                                         </button>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         
                         <!-- Slide 3: Cultural & Historical -->
                         <div class="w-full flex-shrink-0">
                             <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 p-8 bg-white/90 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 attractions-fixed-height">
                                 <!-- Baclayon Church -->
                                 <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-xl overflow-hidden card-hover border border-gray-100 group" x-data="{ isLiked: false }">
                                     <div class="relative h-80 bg-gradient-to-br from-cyan-100 to-blue-200 overflow-hidden">
                                         <img src="/images/baclayon_church.png" alt="Bilar Forest" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                              onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                         <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                         <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm rounded-full px-3 py-1">
                                             <div class="flex items-center space-x-1">
                                                 <span class="text-yellow-400">★</span>
                                                 <span class="text-sm font-semibold">4.3</span>
                                             </div>
                                         </div>
                                         <div class="absolute bottom-4 left-4 text-white">
                                             <span class="bg-amber-500 text-white px-3 py-1 rounded-full text-sm font-medium">Culture</span>
                                         </div>
                                     </div>
                                     <div class="p-6">
                                         <h3 class="text-2xl font-bold text-gray-800 mb-3">Baclayon Church</h3>
                                         <p class="text-gray-600 mb-4 leading-relaxed">One of the oldest stone churches in the Philippines, built in 1595.</p>
                                         <div class="flex items-center justify-between mb-4">
                                             <div class="flex items-center space-x-2">
                                                 <span class="text-sm text-gray-500">📍 Baclayon, Bohol</span>
                                             </div>
                                         </div>
                                         <button class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition-colors">
                                             View Details
                                         </button>
                                     </div>
                                 </div>
                                 
                                 <!-- Blood Compact Monument -->
                                 <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-xl overflow-hidden card-hover border border-gray-100 group" x-data="{ isLiked: false }">
                                     <div class="relative h-80 bg-gradient-to-br from-cyan-100 to-blue-200 overflow-hidden">
                                         <img src="/images/blood_compact.jpg" alt="Bilar Forest" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                              onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                         <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                         <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm rounded-full px-3 py-1">
                                             <div class="flex items-center space-x-1">
                                                 <span class="text-yellow-400">★</span>
                                                 <span class="text-sm font-semibold">4.2</span>
                                             </div>
                                         </div>
                                         <div class="absolute bottom-4 left-4 text-white">
                                             <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium">History</span>
                                         </div>
                                     </div>
                                     <div class="p-6">
                                         <h3 class="text-2xl font-bold text-gray-800 mb-3">Blood Compact Monument</h3>
                                         <p class="text-gray-600 mb-4 leading-relaxed">Historic site commemorating the first international treaty of friendship.</p>
                                         <div class="flex items-center justify-between mb-4">
                                             <div class="flex items-center space-x-2">
                                                 <span class="text-sm text-gray-500">📍 Tagbilaran City</span>
                                             </div>
                                         </div>
                                         <button class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition-colors">
                                             View Details
                                         </button>
                                     </div>
                                 </div>
                                 
                                 <!-- Anda Beach -->
                                 <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-xl overflow-hidden card-hover border border-gray-100 group" x-data="{ isLiked: false }">
                                     <div class="relative h-80 bg-gradient-to-br from-cyan-100 to-blue-200 overflow-hidden">
                                         <img src="/images/AndaBeach.jpg" alt="Anda Beach" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                              onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                         <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                         <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm rounded-full px-3 py-1">
                                             <div class="flex items-center space-x-1">
                                                 <span class="text-yellow-400">★</span>
                                                 <span class="text-sm font-semibold">4.8</span>
                                             </div>
                                         </div>
                                         <div class="absolute bottom-4 left-4 text-white">
                                             <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-medium">Beach</span>
                                         </div>
                                     </div>
                                     <div class="p-6">
                                         <h3 class="text-2xl font-bold text-gray-800 mb-3">Anda Beach</h3>
                                         <p class="text-gray-600 mb-4 leading-relaxed">Secluded white sand beach with crystal clear waters, perfect for relaxation.</p>
                                         <div class="flex items-center justify-between mb-4">
                                             <div class="flex items-center space-x-2">
                                                 <span class="text-sm text-gray-500">📍 Anda, Bohol</span>
                                             </div>
                                         </div>
                                         <button class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition-colors">
                                             View Details
                                         </button>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 
                 <!-- Navigation Buttons -->
                 <button @click="previousSlide(); restartAutoPlay();" 
                         class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/95 hover:bg-white shadow-xl rounded-full p-4 transition-all duration-300 hover:scale-110 z-10 border border-gray-200">
                     <span class="text-2xl text-gray-700">‹</span>
                 </button>
                 
                 <button @click="nextSlide(); restartAutoPlay();" 
                         class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/95 hover:bg-white shadow-xl rounded-full p-4 transition-all duration-300 hover:scale-110 z-10 border border-gray-200">
                     <span class="text-2xl text-gray-700">›</span>
                 </button>
                
             </div>
         </div>
     </section>

     <!-- Testimonials Section -->
     <section id="testimonials" class="py-20 bg-gray-50">
         <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
             <div class="text-center mb-16">
                 <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                     What Travelers <span class="gradient-text">Say</span>
                 </h2>
                 <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                     Hear from fellow travelers who have experienced Bohol with TravelBuddy.
                 </p>
             </div>
             
             <div class="grid md:grid-cols-3 gap-8">
                 <!-- Testimonial 1 -->
                 <div class="bg-white rounded-2xl p-8 shadow-lg">
                     <div class="flex items-center mb-4">
                         <div class="flex text-yellow-400">
                             <span>★★★★★</span>
                         </div>
                     </div>
                     <p class="text-gray-600 mb-6 italic">
                         "TravelBuddy made our Bohol trip absolutely perfect! The itinerary suggestions were spot-on and we discovered places we never would have found on our own."
                     </p>
                     <div class="flex items-center">
                         <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold">
                             SM
                         </div>
                         <div class="ml-4">
                             <div class="font-semibold text-gray-900">Sarah Martinez</div>
                         </div>
                     </div>
                 </div>
                 
                 <!-- Testimonial 2 -->
                 <div class="bg-white rounded-2xl p-8 shadow-lg">
                     <div class="flex items-center mb-4">
                         <div class="flex text-yellow-400">
                             <span>★★★★★</span>
                         </div>
                     </div>
                     <p class="text-gray-600 mb-6 italic">
                         "The interactive maps and local insights were incredibly helpful. We felt like we had a local guide with us throughout our entire trip!"
                     </p>
                     <div class="flex items-center">
                         <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold">
                             JD
                         </div>
                         <div class="ml-4">
                             <div class="font-semibold text-gray-900">John Dela Cruz</div>
                         </div>
                     </div>
                 </div>
                 
                 <!-- Testimonial 3 -->
                 <div class="bg-white rounded-2xl p-8 shadow-lg">
                     <div class="flex items-center mb-4">
                         <div class="flex text-yellow-400">
                             <span>★★★★★</span>
                         </div>
                     </div>
                     <p class="text-gray-600 mb-6 italic">
                         "As a first-time visitor to Bohol, TravelBuddy was a lifesaver. The platform helped us plan the perfect 5-day itinerary that covered all the must-see spots."
                     </p>
                     <div class="flex items-center">
                         <div class="w-12 h-12 bg-gradient-to-br from-pink-500 to-rose-600 rounded-full flex items-center justify-center text-white font-bold">
                             AL
                         </div>
                         <div class="ml-4">
                             <div class="font-semibold text-gray-900">Anna Lee</div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    Frequently Asked <span class="gradient-text">Questions</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Find answers to common questions about using TravelBuddy for your Bohol adventure.
                </p>
            </div>
            
            <div class="space-y-4" x-data="{ openFaq: null }">
                <!-- FAQ Item 1 -->
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                    <button @click="openFaq = openFaq === 1 ? null : 1" 
                            class="w-full px-8 py-6 text-left flex justify-between items-center focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-inset rounded-2xl">
                        <h3 class="text-lg font-semibold text-gray-900">How do I create a personalized itinerary?</h3>
                        <div class="flex-shrink-0 ml-4">
                            <i class="fas fa-chevron-down transition-transform duration-200" 
                               :class="{ 'rotate-180': openFaq === 1 }"></i>
                        </div>
                    </button>
                    <div x-show="openFaq === 1" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-95"
                         class="px-8 pb-6">
                        <p class="text-gray-600 leading-relaxed">
                            Simply register for an account and answer a few questions about your travel preferences, budget, and interests. 
                            Our system will generate a customized itinerary that includes the best attractions, and activities based on 
                            your specific needs and the duration of your stay in Bohol.
                        </p>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                    <button @click="openFaq = openFaq === 2 ? null : 2" 
                            class="w-full px-8 py-6 text-left flex justify-between items-center focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-inset rounded-2xl">
                        <h3 class="text-lg font-semibold text-gray-900">Is TravelBuddy free to use?</h3>
                        <div class="flex-shrink-0 ml-4">
                            <i class="fas fa-chevron-down transition-transform duration-200" 
                               :class="{ 'rotate-180': openFaq === 2 }"></i>
                        </div>
                    </button>
                    <div x-show="openFaq === 2" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-95"
                         class="px-8 pb-6">
                        <p class="text-gray-600 leading-relaxed">
                            Yes! TravelBuddy offers a free basic plan that includes access to our interactive maps, 
                            attraction information, and basic itinerary suggestions.
                        </p>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                    <button @click="openFaq = openFaq === 3 ? null : 3" 
                            class="w-full px-8 py-6 text-left flex justify-between items-center focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-inset rounded-2xl">
                        <h3 class="text-lg font-semibold text-gray-900">Can I use TravelBuddy offline?</h3>
                        <div class="flex-shrink-0 ml-4">
                            <i class="fas fa-chevron-down transition-transform duration-200" 
                               :class="{ 'rotate-180': openFaq === 3 }"></i>
                        </div>
                    </button>
                    <div x-show="openFaq === 3" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-95"
                         class="px-8 pb-6">
                        <p class="text-gray-600 leading-relaxed">
                            Yes! You can download maps and itinerary details for offline use. This is especially useful 
                            when exploring remote areas of Bohol where internet connectivity might be limited. 
                            Simply download your planned routes and attraction information before heading out.
                        </p>
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                    <button @click="openFaq = openFaq === 4 ? null : 4" 
                            class="w-full px-8 py-6 text-left flex justify-between items-center focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-inset rounded-2xl">
                        <h3 class="text-lg font-semibold text-gray-900">How accurate are the attraction ratings and reviews?</h3>
                        <div class="flex-shrink-0 ml-4">
                            <i class="fas fa-chevron-down transition-transform duration-200" 
                               :class="{ 'rotate-180': openFaq === 4 }"></i>
                        </div>
                    </button>
                    <div x-show="openFaq === 4" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-95"
                         class="px-8 pb-6">
                        <p class="text-gray-600 leading-relaxed">
                            All ratings and reviews are from verified travelers who have actually visited the attractions. 
                            We regularly update our database and moderate reviews to ensure accuracy. Our team also 
                            personally visits attractions to verify information and provide up-to-date details.
                        </p>
                    </div>
                </div>

                <!-- FAQ Item 5 -->
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                    <button @click="openFaq = openFaq === 5 ? null : 5" 
                            class="w-full px-8 py-6 text-left flex justify-between items-center focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-inset rounded-2xl">
                        <h3 class="text-lg font-semibold text-gray-900">Can I book accommodations through TravelBuddy?</h3>
                        <div class="flex-shrink-0 ml-4">
                            <i class="fas fa-chevron-down transition-transform duration-200" 
                               :class="{ 'rotate-180': openFaq === 5 }"></i>
                        </div>
                    </button>
                    <div x-show="openFaq === 5" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-95"
                         class="px-8 pb-6">
                        <p class="text-gray-600 leading-relaxed">
                            Currently, TravelBuddy focuses on providing comprehensive travel information and itinerary planning. 
                            We partner with local accommodations and can provide recommendations, but direct booking 
                            will be available in future updates. For now, we'll direct you to trusted booking platforms.
                        </p>
                    </div>
                </div>

                <!-- FAQ Item 6 -->
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                    <button @click="openFaq = openFaq === 7 ? null : 7" 
                            class="w-full px-8 py-6 text-left flex justify-between items-center focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-inset rounded-2xl">
                        <h3 class="text-lg font-semibold text-gray-900">Is TravelBuddy available in other languages?</h3>
                        <div class="flex-shrink-0 ml-4">
                            <i class="fas fa-chevron-down transition-transform duration-200" 
                               :class="{ 'rotate-180': openFaq === 7 }"></i>
                        </div>
                    </button>
                    <div x-show="openFaq === 7" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-95"
                         class="px-8 pb-6">
                        <p class="text-gray-600 leading-relaxed">
                            Currently, TravelBuddy is only available in English. We're working on adding 
                            support for other major languages including Japanese, Korean, and Chinese to better serve 
                            our international visitors to Bohol.
                        </p>
                    </div>
                </div>

                <!-- FAQ Item 8 -->
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                    <button @click="openFaq = openFaq === 8 ? null : 8" 
                            class="w-full px-8 py-6 text-left flex justify-between items-center focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-inset rounded-2xl">
                        <h3 class="text-lg font-semibold text-gray-900">How often is the information updated?</h3>
                        <div class="flex-shrink-0 ml-4">
                            <i class="fas fa-chevron-down transition-transform duration-200" 
                               :class="{ 'rotate-180': openFaq === 8 }"></i>
                        </div>
                    </button>
                    <div x-show="openFaq === 8" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-95"
                         class="px-8 pb-6">
                        <p class="text-gray-600 leading-relaxed">
                            We update our database weekly with new attractions, updated operating hours, pricing information, 
                            and user reviews. Our local team regularly visits attractions to ensure all information is 
                            current and accurate. Users can also report outdated information through our feedback system.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
     <section class="py-20 bg-gradient-to-r from-blue-600 to-cyan-600">
         <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
             <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                 Ready to Explore <span class="text-yellow-300">Bohol</span>?
             </h2>
             <p class="text-xl text-blue-100 mb-8">
                 Join thousands of travelers who have discovered the magic of Bohol with TravelBuddy.
             </p>
             <div class="flex flex-col sm:flex-row gap-4 justify-center">
                 <button class="bg-yellow-400 text-gray-900 px-8 py-4 rounded-xl font-bold text-lg hover:bg-yellow-300 transition-all transform hover:scale-105 shadow-lg">
                     Start Your Journey Now
                 </button>
             </div>
         </div>
     </section>

     <!-- Footer -->
     <footer id="contact" class="bg-gray-900 text-white py-16">
         <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
             <div class="grid md:grid-cols-4 gap-8">
                 <!-- Brand -->
                <div class="md:col-span-2">
                     <div class="flex items-center space-x-4 mb-6">
                         <div class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center">
                             <span class="text-2xl text-white">🏝️</span>
                         </div>
                         <div>
                             <h3 class="text-2xl font-bold">Bohol TravelBuddy</h3>
                             <p class="text-gray-400">Your Ultimate Travel Companion</p>
                         </div>
                     </div>
                     <p class="text-gray-400 leading-relaxed mb-6">
                         Discover the beauty of Bohol with our comprehensive travel platform. From planning to exploring, we're here to make your journey unforgettable.
                     </p>
                </div>
                 
                <div>
                     <h4 class="text-lg font-semibold mb-6">Quick Links</h4>
                     <ul class="space-y-3">
                         <li><a href="#home" class="text-gray-400 hover:text-white transition-colors">Home</a></li>
                         <li><a href="#features" class="text-gray-400 hover:text-white transition-colors">Features</a></li>
                         <li><a href="#attractions" class="text-gray-400 hover:text-white transition-colors">Attractions</a></li>
                        <li><a href="#testimonials" class="text-gray-400 hover:text-white transition-colors">Reviews</a></li>
                        <li><a href="#faq" class="text-gray-400 hover:text-white transition-colors">FAQ</a></li>
                        <li><a href="#contact" class="text-gray-400 hover:text-white transition-colors">Contact</a></li>
                     </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-6">Contact Info</h4>
                    <ul class="space-y-3">
                        <li class="flex items-center space-x-3">
                             <i class="fa-solid fa-location-dot"></i>
                             <span class="text-gray-400">Bohol, Philippines</span>
                         </li>
                         <li class="flex items-center space-x-3">
                             <i class="fa-solid fa-phone"></i>
                             <span class="text-gray-400">+63 912 345 6789</span>
                         </li>
                    </ul>
                </div>
             </div>
       
             <div class="border-t border-white mt-12 pt-8 text-center">
                 <p class="text-gray-400">© 2025 Bohol TravelBuddy. All Rights Reserved.</p>
             </div>
         </div>
     </footer>

     <script>
         // Attractions Carousel Function
         function attractionsCarousel() {
             return {
                 currentSlide: 0,
                 totalSlides: 3,
                 autoPlayInterval: null,
                 
                 init() {
                     this.startAutoPlay();
                 },
                 
                 nextSlide() {
                     this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
                 },
                 
                 previousSlide() {
                     this.currentSlide = this.currentSlide === 0 ? this.totalSlides - 1 : this.currentSlide - 1;
                 },
                 
                 startAutoPlay() {
                     this.autoPlayInterval = setInterval(() => {
                         this.nextSlide();
                     }, 5000); // Auto-advance every 5 seconds
                 },
                 
                 stopAutoPlay() {
                     if (this.autoPlayInterval) {
                         clearInterval(this.autoPlayInterval);
                         this.autoPlayInterval = null;
                     }
                 },
                 
                 restartAutoPlay() {
                     this.stopAutoPlay();
                     this.startAutoPlay();
                 }
             }
         }

         // Smooth scrolling for navigation links
         document.querySelectorAll('a[href^="#"]').forEach(anchor => {
             anchor.addEventListener('click', function (e) {
                 e.preventDefault();
                 const target = document.querySelector(this.getAttribute('href'));
                 if (target) {
                     target.scrollIntoView({
                         behavior: 'smooth',
                         block: 'start'
                     });
                 }
             });
         });

         // Add scroll effect to navigation
         window.addEventListener('scroll', function() {
             const nav = document.querySelector('nav');
             if (window.scrollY > 100) {
                 nav.classList.add('bg-white/98');
             } else {
                 nav.classList.remove('bg-white/98');
             }
         });
     </script>
 </body>
 </html>