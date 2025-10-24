<!DOCTYPE html> 
<html lang="en"> 
    <head> 
        <meta charset="UTF-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Travel Agency Registration | Bohol TravelBuddy</title> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> 
        <script src="https://cdn.tailwindcss.com"></script> 
        <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script> 

        <style> 
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap'); 
            
            body { 
                font-family: 'Inter', sans-serif;
                background: linear-gradient(135deg, #1e3a8a, #2563eb, #9333ea); 
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
            .glass { 
                backdrop-filter: blur(14px); 
                background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2); 
            } 
        </style> 
    </head> 
    
    <body class="flex items-center justify-center min-h-screen relative"> 
        <div class="absolute top-0 left-0 w-72 h-72 bg-blue-600 opacity-30 blur-3xl rounded-full floating"></div> 
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-purple-700 opacity-30 blur-3xl rounded-full floating"></div>
        <div class="flex flex-col md:flex-row w-[90%] max-w-5xl rounded-3xl overflow-hidden shadow-2xl glass z-10">
    
            <!-- Left Side -->
            <div class="hidden md:flex flex-col justify-center items-center text-white p-10 w-1/2 bg-gradient-to-br from-blue-800 via-indigo-700 to-purple-700">
                <i class="fas fa-suitcase-rolling text-6xl mb-6 floating"></i>
                <h1 class="text-3xl font-bold mb-3">Partner with Bohol TravelBuddy</h1>
                <p class="text-blue-100 text-center leading-relaxed">
                    Register your travel agency to showcase tours and manage bookings across Bohol.
                </p>
                <a href="{{ route('agency_login.form') }}" 
                  class="mt-8 bg-white text-blue-700 px-6 py-3 rounded-xl font-semibold hover:bg-blue-50 shadow-md transition">
                    <i class="fas fa-right-to-bracket mr-2"></i> 
                        Go to Login
                </a>
            </div>

            <!-- Form Side -->
            <div class="w-full md:w-1/2 bg-white p-8 md:p-12"
                x-data="{
                    showPassword:false, showConfirmPassword:false,
                    passwordStrength:0, isLoading:false,
                    checkStrength(p){
                        let s=0;
                        if(p.length>=8)s++;
                        if(/[A-Z]/.test(p))s++;
                        if(/[a-z]/.test(p))s++;
                        if(/[0-9]/.test(p))s++;
                        if(/[^A-Za-z0-9]/.test(p))s++;
                        return s;
                    }
                }">

                <h2 class="text-2xl font-bold text-center mb-8 text-gray-800">
                    Travel Agency Registration
                </h2>

                <form action="{{ route('agency_register') }}" 
                  method="POST" 
                  class="space-y-6" 
                  @submit="isLoading=true">
                    @csrf

                    <div>
                        <label class="block font-semibold mb-1 text-gray-700">
                            Agency Name
                        </label>
                        <div class="relative">
                            <i class="fas fa-building absolute left-3 top-4 text-gray-400"></i>
                            <input type="text" 
                                name="agency_name" 
                                class="w-full pl-10 pr-4 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500" 
                                required 
                                placeholder="Enter your agency name"
                            >
                        </div>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1 text-gray-700">
                            Email Address
                        </label>
                        <div class="relative">
                            <i class="fas fa-envelope absolute left-3 top-4 text-gray-400"></i>
                            <input type="email" 
                                name="email" 
                                class="w-full pl-10 pr-4 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500" 
                                required 
                                placeholder="Enter your email"
                            >
                        </div>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1 text-gray-700">
                            Contact Number
                        </label>
                        <div class="relative">
                            <i class="fas fa-phone absolute left-3 top-4 text-gray-400"></i>
                            <input type="text" 
                                name="contact_number" 
                                class="w-full pl-10 pr-4 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500" 
                                required 
                                placeholder="e.g. +63 912 345 6789">
                        </div>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1 text-gray-700">
                            Password
                        </label>
                        <div class="relative">
                            <i class="fas fa-lock absolute left-3 top-4 text-gray-400"></i>
                            <input :type="showPassword?'text':'password'" 
                                name="password"
                                @input="passwordStrength=checkStrength($event.target.value)"
                                class="w-full pl-10 pr-12 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500"
                                required 
                                placeholder="Create password"
                            >
                            <button type="button"
                              @click="showPassword=!showPassword"
                                class="absolute right-3 top-3 text-gray-400 hover:text-blue-600">
                                <i :class="showPassword?'fa-eye-slash':'fa-eye'" class="fas"></i>
                            </button>
                        </div>

                        <div class="h-2 w-full bg-gray-200 rounded-full mt-2 overflow-hidden">
                            <div class="h-full rounded-full transition-all duration-300"
                                :class="{
                                    'bg-red-500 w-1/5':passwordStrength<=1,
                                    'bg-yellow-400 w-2/5':passwordStrength==2,
                                    'bg-orange-400 w-3/5':passwordStrength==3,
                                    'bg-blue-500 w-4/5':passwordStrength==4,
                                    'bg-green-500 w-full':passwordStrength>=5
                                }">
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1 text-gray-700">Confirm Password</label>
                        <div class="relative">
                            <i class="fas fa-lock absolute left-3 top-4 text-gray-400"></i>
                            <input :type="showConfirmPassword?'text':'password'" name="password_confirmation"
                                class="w-full pl-10 pr-12 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500"
                                required placeholder="Confirm password">
                            <button type="button" @click="showConfirmPassword=!showConfirmPassword"
                                class="absolute right-3 top-3 text-gray-400 hover:text-blue-600">
                                <i :class="showConfirmPassword?'fa-eye-slash':'fa-eye'" class="fas"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" :disabled="isLoading"
                        class="w-full py-4 rounded-xl text-white font-semibold 
                            bg-gradient-to-r from-blue-600 to-purple-600 
                            hover:from-blue-700 hover:to-purple-700 
                            transition-all duration-300 transform 
                            hover:scale-105 disabled:opacity-60">
                        <span x-show="!isLoading">
                            <i class="fas fa-user-plus mr-2"></i>
                            Register Travel Agency
                        </span>
                        <span x-show="isLoading">
                            <i class="fas fa-spinner fa-spin mr-2"></i>
                            Processing...
                        </span>
                    </button>
                </form>

                <p class="text-center text-gray-600 mt-8">
                    Already have an account?
                    <a href="{{ route('agency_login.form') }}" 
                      class="text-blue-600 font-semibold hover:underline">
                        Sign In
                    </a>
                </p>
            </div>
        </div>
    </body> 
</html>
