@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 flex items-center justify-center px-4 py-8">
    <div class="w-full max-w-md bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl p-8">
        <div class="text-center mb-8">
            <div class="w-16 h-16 flex items-center justify-center mx-auto mb-4">
                <img src="{{ asset('images/logo.png') }}" alt="TravelBuddy Logo" class="h-16 w-auto">
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Verify Your Email</h1>
            <p class="text-gray-500">Please enter the verification code sent to your email</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                <div class="flex items-start">
                    <i class="fas fa-exclamation-circle text-red-500 mt-0.5 mr-3"></i>
                    <div>
                        <ul class="text-sm text-red-700 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl">
                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mt-0.5 mr-3"></i>
                    <div class="text-sm text-green-700">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('verification.verify') }}" class="space-y-6">
            @csrf
            
            <div class="space-y-2">
                <label for="code" class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-key mr-2 text-blue-500"></i>Verification Code
                </label>
                <input type="text" 
                       name="code" 
                       id="code" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                       placeholder="Enter 6-digit code"
                       required
                       autofocus>
            </div>

            <button type="submit" 
                    class="w-full py-4 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                <i class="fas fa-check-circle mr-2"></i>
                Verify Code
            </button>
        </form>

        <div class="mt-6 text-center">
            <form action="{{ route('verification.send') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-blue-600 hover:underline text-sm">
                    <i class="fas fa-redo mr-1"></i>
                    Resend verification code
                </button>
            </form>
        </div>
    </div>
</div>
@endsection