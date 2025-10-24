<!DOCTYPE html> 
<html lang="en"> 
    <head> 
        <meta charset="UTF-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Travel Agency Login | Bohol TravelBuddy</title> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> 
        <script src="https://cdn.tailwindcss.com"></script> 
        <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script> 
        
        <style> 
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap'); 
        
            body { 
                font-family: 'Inter', sans-serif; 
                background: linear-gradient(135deg, #06b6d4, #2563eb, #0ea5e9); 
                min-height: 100vh; overflow: hidden; 
            } 
            .floating { 
                animation: float 6s ease-in-out infinite; 
            } 
            @keyframes float { 
                0%,100% 
                { 
                    transform: translateY(0); 
                }  
                    50% 
                { 
                    transform: translateY(-10px); 
                } 
            } 
        </style> 
    </head> 
    
    <body class="flex items-center justify-center min-h-screen relative"> 
        <!-- Background Decorative Blurs --> 
        <div class="absolute top-0 left-0 w-72 h-72 bg-cyan-400 opacity-25 blur-3xl rounded-full floating"></div> 
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-600 opacity-30 blur-3xl rounded-full floating"></div>
        <div class="w-[90%] max-w-md bg-white rounded-3xl shadow-2xl p-8 md:p-10 relative z-10"
            x-data="{ showPassword:false, isLoading:false }">

            <!-- Header -->
            <div class="text-center mb-6">
                <i class="fas fa-umbrella-beach text-5xl text-cyan-600 mb-3"></i>
                <h2 class="text-2xl font-bold text-gray-800">
                    Travel Agency Login
                </h2>
                <p class="text-gray-500 text-sm">
                    Welcome back to Bohol TravelBuddy Partner Portal
                </p>
            </div>

            <!-- Login Form -->
            <form action="{{ route('agency_login') }}"
              method="POST" 
              class="space-y-6" 
              @submit="isLoading=true">
                @csrf

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold mb-1 text-gray-700">
                        Email
                    </label>
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-3 top-3 text-gray-400"></i>
                        <input type="email" 
                            name="email" 
                            class="w-full pl-10 pr-4 py-3 border rounded-xl focus:ring-2 focus:ring-cyan-500" 
                            required 
                            placeholder="Enter your agency email">
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-semibold mb-1 text-gray-700">
                        Password
                    </label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-3 top-3 text-gray-400"></i>
                        <input :type="showPassword ? 'text' : 'password'" 
                            name="password"
                            class="w-full pl-10 pr-12 py-3 border rounded-xl focus:ring-2 focus:ring-cyan-500" 
                            required 
                            placeholder="Enter your password">
                        <button type="button" 
                          @click="showPassword=!showPassword"
                            class="absolute right-3 top-3 text-gray-400 hover:text-cyan-600">
                            <i :class="showPassword ? 'fa-eye-slash' : 'fa-eye'" class="fas"></i>
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" :disabled="isLoading"
                    class="w-full py-4 bg-gradient-to-r from-cyan-600 to-blue-600 text-white font-semibold rounded-xl hover:from-cyan-700 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 disabled:opacity-60">
                    <span x-show="!isLoading">
                        <i class="fas fa-right-to-bracket mr-2"></i>
                        Login
                    </span>
                    <span x-show="isLoading">
                        <i class="fas fa-spinner fa-spin mr-2"></i>
                        Authenticating...
                    </span>
                </button>
            </form>

            <!-- Footer -->
            <p class="text-center text-gray-600 mt-8">
                Don’t have an account? 
                <a href="{{ route('agency_register') }}" class="text-cyan-600 font-semibold hover:underline">
                    Register your agency
                </a>
            </p>
        </div>
    </body> 
</html>
