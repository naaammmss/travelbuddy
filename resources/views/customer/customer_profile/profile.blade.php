@extends('customer.customer_panel')

@section('title', 'Bohol TravelBuddy')
@section('page-title', 'Profile')

@section('content')
<div class="max-w-4xl mx-auto bg-gradient-to-br from-blue-50 to-teal-50 shadow-xl rounded-2xl p-10 mt-10 border border-gray-100 relative overflow-hidden">
    
    <!-- Decorative Background Waves -->
    <div class="absolute -top-10 -right-10 opacity-10">
        <img src="{{ asset('images/travel_wave.svg') }}" alt="wave" class="w-64 rotate-12">
    </div>

    <h2 class="text-4xl font-extrabold text-center mb-10 text-teal-700 tracking-wide">My Profile</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-800 px-4 py-3 rounded-lg mb-6 text-center shadow-sm">
            <i class="fa-solid fa-circle-check mr-2"></i>{{ session('success') }}
        </div>
    @endif

    <!-- Profile Form -->
    <form method="POST" action="{{ route('customer.customer_profile.update') }}" enctype="multipart/form-data" class="relative z-10">
        @csrf

        <!-- Profile Photo -->
        <div class="flex flex-col items-center mb-10">
            <div class="relative w-36 h-36">
                <img id="profile-preview"
                    src="{{ $profile && $profile->profile_picture ? asset('storage/' . $profile->profile_picture) : asset('images/default-avatar.png') }}"
                    alt="Profile Photo"
                    class="w-32 h-32 rounded-full object-cover border-4 border-teal-500 shadow-md mx-auto">
                <label for="profile_picture"
                       class="absolute bottom-2 right-2 bg-teal-600 hover:bg-teal-700 text-white text-sm p-2 rounded-full cursor-pointer shadow-lg transition-all">
                    <i class="fa-solid fa-camera"></i>
                </label>
                <input id="profile_picture" name="profile_picture" type="file" accept="image/*" class="hidden" onchange="previewProfilePhoto(event)">
            </div>
            <p class="text-gray-600 text-sm mt-3 italic">Click the camera icon to change your photo</p>
        </div>

        <!-- User Info Fields -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <label class="block text-gray-800 font-semibold mb-2">Full Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                       class="w-full border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-teal-500 focus:outline-none shadow-sm">
            </div>

            <div>
                <label class="block text-gray-800 font-semibold mb-2">Email Address</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                       class="w-full border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-teal-500 focus:outline-none shadow-sm">
            </div>

            <div>
                <label class="block text-gray-800 font-semibold mb-2">Address</label>
                <input type="text" name="address" value="{{ old('address', $profile->address ?? '') }}"
                       class="w-full border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-teal-500 focus:outline-none shadow-sm">
            </div>

            <div>
                <label class="block text-gray-800 font-semibold mb-2">Phone Number</label>
                <input type="text" name="phone" value="{{ old('phone', $profile->phone ?? '') }}"
                       class="w-full border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-teal-500 focus:outline-none shadow-sm">
            </div>

            <div class="md:col-span-2">
                <label class="block text-gray-800 font-semibold mb-2">Birthdate</label>
                <input type="date" name="birthdate" value="{{ old('birthdate', $profile->birthdate ?? '') }}"
                       class="w-full border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-teal-500 focus:outline-none shadow-sm">
            </div>
        </div>

        <!-- Save Button -->
        <div class="mt-10 text-center">
            <button type="submit"
                    class="bg-gradient-to-r from-teal-500 to-blue-600 text-white font-bold py-3 px-10 rounded-xl shadow-lg hover:scale-105 hover:shadow-xl transition-all duration-300">
                <i class="fa-solid fa-floppy-disk mr-2"></i> Save Changes
            </button>
        </div>
    </form>
</div>

{{-- JavaScript for Image Preview --}}
<script>
function previewProfilePhoto(event) {
    const reader = new FileReader();
    reader.onload = function() {
        document.getElementById('profile-preview').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection
