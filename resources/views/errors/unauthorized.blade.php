<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied | TravelBuddy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <style>
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-red-50 via-orange-50 to-yellow-50 flex items-center justify-center px-4 py-8">
    
    <!-- Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-red-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 floating-animation"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-orange-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 floating-animation" style="animation-delay: 2s;"></div>
    </div>

    <div class="max-w-2xl bg-white/90 backdrop-blur-sm rounded-3xl shadow-2xl p-12 text-center relative z-10">
        <!-- Icon -->
        <div class="w-24 h-24 bg-gradient-to-r from-red-500 to-orange-500 rounded-full flex items-center justify-center mx-auto mb-8">
            <i class="fas fa-shield-alt text-white text-3xl"></i>
        </div>

        <!-- Title -->
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Access Denied</h1>
        
        <!-- Description -->
        <p class="text-lg text-gray-600 mb-8 leading-relaxed">
            You don't have permission to access this area. Please make sure you're logged in with the correct account type.
        </p>

        <!-- User Info -->
        @auth
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-8">
            <div class="flex items-center justify-center gap-3 mb-4">
                <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center">
                    <span class="text-white font-bold text-lg">{{ substr(auth()->user()->name, 0, 1) }}</span>
                </div>
                <div class="text-left">
                    <div class="font-semibold text-gray-800">{{ auth()->user()->name }}</div>
                    <div class="text-sm text-gray-600">{{ auth()->user()->role_name }}</div>
                </div>
            </div>
            <p class="text-sm text-gray-600">
                You are currently logged in as a <strong>{{ auth()->user()->role_name }}</strong>. 
                Please contact an administrator if you believe this is an error.
            </p>
        </div>
        @endauth

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            @auth
                @if(auth()->user()->isCustomer())
                    <a href="{{ route('customer.dashboard') }}" 
                       class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-home mr-2"></i>
                        Go to Customer Dashboard
                    </a>
                @elseif(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" 
                       class="inline-flex items-center justify-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-cog mr-2"></i>
                        Go to Admin Dashboard
                    </a>
                @elseif(auth()->user()->isTravelAgency())
                    <a href="{{ route('travel.dashboard') }}" 
                       class="inline-flex items-center justify-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-briefcase mr-2"></i>
                        Go to Travel Agency Dashboard
                    </a>
                @endif
            @else
                <a href="{{ route('login.form') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Login
                </a>
            @endauth

            <a href="/" 
               class="inline-flex items-center justify-center px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105">
                <i class="fas fa-home mr-2"></i>
                Back to Home
            </a>
        </div>

        <!-- Help Text -->
        <div class="mt-8 p-4 bg-yellow-50 border border-yellow-200 rounded-xl">
            <div class="flex items-start gap-3">
                <i class="fas fa-info-circle text-yellow-600 mt-1"></i>
                <div class="text-left">
                    <p class="text-sm text-yellow-800 font-semibold mb-1">Need Help?</p>
                    <p class="text-sm text-yellow-700">
                        If you believe you should have access to this area, please contact the system administrator or try logging in with a different account type.
                    </p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

