<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | TravelBuddy</title>
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
        .password-strength {
            transition: all 0.3s ease;
        }
        .strength-weak { background-color: #ef4444; }
        .strength-medium { background-color: #f59e0b; }
        .strength-strong { background-color: #10b981; }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 flex items-center justify-center px-4 py-8" 
    x-data="{ isLoading: false, passwordStrength: 0, showPassword: false, showConfirmPassword: false }">

    <!-- Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 floating-animation"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-purple-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 floating-animation" 
            style="animation-delay: 2s;">
        </div>
        <div class="absolute top-40 left-1/2 w-80 h-80 bg-cyan-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 floating-animation" 
            style="animation-delay: 4s;">
        </div>
    </div>

    <div class="w-full max-w-6xl bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl overflow-hidden grid md:grid-cols-2 min-h-[700px] relative z-10">
        <!-- Left: Hero Panel -->
        <div class="hidden md:flex items-center justify-center bg-gradient-to-br from-blue-600 via-purple-600 to-indigo-700 p-12 text-white relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full blur-2xl"></div>
                <div class="absolute bottom-10 right-10 w-24 h-24 bg-white rounded-full blur-xl"></div>
                <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-white rounded-full blur-lg"></div>
            </div>
            
            <div class="max-w-md text-center space-y-6 relative z-10">
                <div class="space-y-4">
                    <h2 class="text-4xl font-bold leading-tight">Join the 
                        <span class="text-yellow-300">Adventure</span>
                    </h2>
                    <p class="text-lg text-blue-100 leading-relaxed">
                        Create your account and start exploring Bohol's hidden gems with our comprehensive travel platform.
                    </p>
                    <div class="space-y-3 text-left">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-green-300"></i>
                            <span class="text-blue-100">
                                Personalized itineraries
                            </span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-green-300"></i>
                            <span class="text-blue-100">
                                Interactive maps & guides
                            </span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-green-300"></i>
                            <span class="text-blue-100">
                                24/7 local support
                            </span>
                        </div>
                    </div>
                    <a href="{{ route('login.form') }}" 
                       class="inline-flex items-center px-6 py-3 bg-white/20 hover:bg-white/30 border border-white/30 rounded-xl font-semibold transition-all duration-300 hover:scale-105">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Already have an account?
                    </a>
                </div>
            </div>
        </div>

        <!-- Right: Forms -->
        <div class="p-8 md:p-12 h-full flex flex-col justify-center relative">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="TravelBuddy Logo" class="h-16 w-auto">
                </div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Create Your Account</h1>
                <p class="text-gray-500">Join thousands of travelers exploring Bohol</p>
            </div>

            <!-- Error Messages -->
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

            <!-- Register Form -->
            <form action="{{ route('register') }}" method="POST" 
                  class="space-y-6" 
                  @submit="isLoading = true"
                  x-data="{
                      checkPasswordStrength(password) {
                          let strength = 0;
                          if (password.length >= 8) strength++;
                          if (/[A-Z]/.test(password)) strength++;
                          if (/[a-z]/.test(password)) strength++;
                          if (/[0-9]/.test(password)) strength++;
                          if (/[^A-Za-z0-9]/.test(password)) strength++;
                          return strength;
                      }
                  }">
                @csrf

                <!-- Full Name -->
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-user mr-2 text-blue-500"></i>Full Name
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent form-focus transition-all duration-300" 
                           placeholder="Enter your full name"
                           required>
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-envelope mr-2 text-blue-500"></i>Email Address
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent form-focus transition-all duration-300" 
                           placeholder="Enter your email address"
                           required>
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-lock mr-2 text-blue-500"></i>Password
                    </label>
                    <div class="relative">
                        <input :type="showPassword ? 'text' : 'password'" 
                               name="password" id="password"
                               @input="passwordStrength = checkPasswordStrength($event.target.value)"
                               class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent form-focus transition-all duration-300" 
                               placeholder="Create a strong password"
                               required>
                        <button type="button" 
                                @click="showPassword = !showPassword"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700 transition-colors">
                            <i :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                        </button>
                    </div>
                    
                    <!-- Password Strength Indicator -->
                    <div x-show="passwordStrength > 0" class="space-y-2">
                        <div class="flex space-x-1">
                            <div class="h-2 flex-1 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full password-strength rounded-full transition-all duration-300"
                                     :class="{
                                         'strength-weak': passwordStrength <= 2,
                                         'strength-medium': passwordStrength === 3,
                                         'strength-strong': passwordStrength >= 4
                                     }"
                                     :style="`width: ${(passwordStrength / 5) * 100}%`"></div>
                            </div>
                        </div>
                        <p class="text-xs text-gray-600" 
                           x-text="passwordStrength <= 2 ? 'Weak password' : passwordStrength === 3 ? 'Medium strength' : 'Strong password'"></p>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="space-y-2">
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-lock mr-2 text-blue-500"></i>Confirm Password
                    </label>
                    <div class="relative">
                        <input :type="showConfirmPassword ? 'text' : 'password'" 
                               name="password_confirmation" id="password_confirmation"
                               class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent form-focus transition-all duration-300" 
                               placeholder="Confirm your password"
                               required>
                        <button type="button" 
                                @click="showConfirmPassword = !showConfirmPassword"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700 transition-colors">
                            <i :class="showConfirmPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                        </button>
                    </div>
                </div>

                <!-- Terms Agreement -->
                <div class="flex items-start space-x-3">
                    <input id="terms" type="checkbox" 
                           class="mt-1 w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" 
                           required>
                    <label for="terms" class="text-sm text-gray-600 leading-relaxed">
                        I agree to the <a href="#" class="text-blue-600 hover:underline font-semibold">Terms of Service</a> 
                        and <a href="#" class="text-blue-600 hover:underline font-semibold">Privacy Policy</a>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        :disabled="isLoading"
                        class="w-full py-4 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                    <span x-show="!isLoading" class="flex items-center justify-center">
                        <i class="fas fa-user-plus mr-2"></i>
                        Create Account
                    </span>
                    <span x-show="isLoading" class="flex items-center justify-center">
                        <i class="fas fa-spinner fa-spin mr-2"></i>
                        Creating Account...
                    </span>
                </button>
            </form>

        </div>
    </div>

</body>
</html>
