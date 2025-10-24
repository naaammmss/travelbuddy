<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | TravelBuddy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
    <style>
        body { 
            font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; 
        }
        .gradient-text {
            background: linear-gradient(135deg, #0EA5E9, #3B82F6, #1D4ED8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .form-focus {
            transition: all 0.3s ease;
        }
        .form-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.1), 0 10px 10px -5px rgba(59, 130, 246, 0.04);
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 flex items-center justify-center px-4 py-8" x-data="{ isLoading: false, showPassword: false }">

    <!-- Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 floating-animation"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-purple-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 floating-animation" style="animation-delay: 2s;"></div>
        <div class="absolute top-40 left-1/2 w-80 h-80 bg-cyan-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 floating-animation" style="animation-delay: 4s;"></div>
    </div>

    <div class="w-full max-w-6xl bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl overflow-hidden grid md:grid-cols-2 min-h-[700px] relative z-10">
        <!-- Left: Login Form -->
        <div class="p-8 md:p-12 h-full flex flex-col justify-center relative">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl text-white">🏝️</span>
                </div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">@if(isset($expected_role) && $expected_role === 'admin') Admin Login @elseif(isset($expected_role) && $expected_role === 'agency') Agency Login @else Welcome Back! @endif</h1>
                <p class="text-gray-500">@if(isset($expected_role) && $expected_role === 'admin') Sign in to access the Admin Dashboard @elseif(isset($expected_role) && $expected_role === 'agency') Sign in to access the Agency Dashboard @else Sign in to continue your Bohol adventure @endif</p>
            </div>

            <!-- Success/Error Messages -->
            @if (session('status'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl">
                    <div class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-0.5 mr-3"></i>
                        <div>
                            <h4 class="text-sm font-semibold text-green-800 mb-1">Success!</h4>
                            <p class="text-sm text-green-700">{{ session('status') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-circle text-red-500 mt-0.5 mr-3"></i>
                        <div>
                            <h4 class="text-sm font-semibold text-red-800 mb-2">Please fix the following errors:</h4>
                            <ul class="text-sm text-red-700 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>• {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Login Form -->
        <form method="POST" action="{{ isset($expected_role) && $expected_role === 'admin' ? route('admin.login') : (isset($expected_role) && $expected_role === 'agency' ? route('agency.login') : route('login')) }}" 
                  class="space-y-6" 
                  @submit="isLoading = true">
                @csrf
                {{-- expected_role is not sent from the form; server determines role based on the route --}}
                
                <!-- Email -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-envelope mr-2 text-blue-500"></i>Email Address
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent form-focus transition-all duration-300" 
                           placeholder="Enter your email address"
                           required>
                </div>
                
                <!-- Password -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-lock mr-2 text-blue-500"></i>Password
                    </label>
                    <div class="relative">
                        <input :type="showPassword ? 'text' : 'password'" 
                               name="password" 
                               class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent form-focus transition-all duration-300" 
                               placeholder="Enter your password"
                               required>
                        <button type="button" 
                                @click="showPassword = !showPassword"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700 transition-colors">
                            <i :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label class="inline-flex items-center text-sm text-gray-600">
                        <input type="checkbox" name="remember" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 mr-2">
                        Remember me
                    </label>
                    <a href="#" class="text-sm text-blue-600 hover:underline font-semibold">Forgot password?</a>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" 
                        :disabled="isLoading"
                        class="w-full py-4 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                    <span x-show="!isLoading" class="flex items-center justify-center">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Sign In
                    </span>
                    <span x-show="isLoading" class="flex items-center justify-center">
                        <i class="fas fa-spinner fa-spin mr-2"></i>
                        Signing In...
                    </span>
                </button>
            </form>

            @php
                $registerRoute = '/register';
                if (Str::contains(request()->path(), 'admin/login')) {
                    $registerRoute = '/admin/register';
                } elseif (Str::contains(request()->path(), 'agency/login')) {
                    $registerRoute = '/agency/register';
                }
            @endphp

            <!-- Sign Up Link -->
            <div class="mt-6 text-center">
                <span class="text-gray-600">Don't have an account?</span>
                <a href="{{ url($registerRoute) }}" class="text-blue-600 hover:underline font-semibold">Register</a>
            </div>
        </div>

        <!-- Right: Hero Panel -->
        <div class="hidden md:flex items-center justify-center bg-gradient-to-br from-blue-600 via-purple-600 to-indigo-700 p-12 text-white relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full blur-2xl"></div>
                <div class="absolute bottom-10 right-10 w-24 h-24 bg-white rounded-full blur-xl"></div>
                <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-white rounded-full blur-lg"></div>
            </div>
            
            <div class="max-w-md text-center space-y-6 relative z-10">
                <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <span class="text-4xl">🏝️</span>
                </div>
                
                <h2 class="text-4xl font-bold leading-tight">Welcome <span class="text-yellow-300">Back!</span></h2>
                <p class="text-lg text-blue-100 leading-relaxed">Sign in to continue your Bohol adventure and access your saved itineraries.</p>
                
                <div class="space-y-3 text-left">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-star text-yellow-300"></i>
                        <span class="text-blue-100">Access your saved trips</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-map-marked-alt text-yellow-300"></i>
                        <span class="text-blue-100">Continue exploring</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-heart text-yellow-300"></i>
                        <span class="text-blue-100">Your favorite spots</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-clock text-yellow-300"></i>
                        <span class="text-blue-100">Quick access to history</span>
                    </div>
                </div>
                
                @php
                    $registerRoute = '/register';
                    if (Str::contains(request()->path(), 'admin/login')) {
                        $registerRoute = '/admin/register';
                    } elseif (Str::contains(request()->path(), 'agency/login')) {
                        $registerRoute = '/agency/register';
                    }
                @endphp
                <a href="{{ url($registerRoute) }}" 
                   class="inline-flex items-center px-6 py-3 bg-white/20 hover:bg-white/30 border border-white/30 rounded-xl font-semibold transition-all duration-300 hover:scale-105">
                    <i class="fas fa-user-plus mr-2"></i>
                    New to TravelBuddy?
                </a>
            </div>
        </div>
    </div>

</body>
</html>


