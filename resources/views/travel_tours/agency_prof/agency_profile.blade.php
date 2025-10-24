@extends('travel_tours.travel_layout')

@section('title', 'Agency Profile')
@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10" x-data="{ editOpen: false }">
	<!-- Header -->
	<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
		<div class="flex items-center gap-6">
			<img src="{{ asset('images/logo.png') }}" alt="Agency Logo" class="w-28 h-28 rounded-lg object-cover">
			<div>
				<h1 class="text-2xl font-extrabold text-gray-800">TravelBuddy Agency</h1>
				<p class="text-sm text-gray-500 mt-1">Full-service travel agency specializing in curated Bohol tours, island hopping, and local experiences.</p>

				<div class="mt-4 flex items-center gap-4 text-sm text-gray-600">
					<div class="flex items-center gap-2"><i class="fa-solid fa-phone text-blue-600"></i> <span>(+63) 917-000-0000</span></div>
					<div class="flex items-center gap-2"><i class="fa-solid fa-envelope text-blue-600"></i> <span>info@travelbuddy.example</span></div>
				</div>
			</div>

			<div class="ml-auto">
				<button @click="editOpen = true" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">Edit Profile</button>
			</div>
		</div>
	</div>

	<!-- Main grid -->
	<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
		<!-- Left: About & Services -->
		<div class="lg:col-span-2 space-y-6">
			<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
				<h2 class="text-lg font-semibold text-gray-800">About the Agency</h2>
				<p class="mt-3 text-gray-700 leading-relaxed">TravelBuddy Agency has over 10 years of experience crafting unforgettable tours around Bohol and neighboring islands. We focus on sustainable travel, local guides, and tailored itineraries for families, couples, and adventure seekers.</p>
				<div class="mt-4 text-sm text-gray-600 flex gap-4">
					<div><strong>Established:</strong> 2015</div>
					<div><strong>Headquarters:</strong> Tagbilaran, Bohol</div>
				</div>
			</div>

			<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
				<div class="flex items-center justify-between">
					<h2 class="text-lg font-semibold text-gray-800">Services</h2>
					<a href="#" class="text-sm text-blue-600">Manage services</a>
				</div>

				<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
					@foreach(['Island Hopping','Chocolate Hills Tours','Tarsier Sanctuary','Airport Transfers','Custom Itineraries','Group Bookings'] as $service)
						<div class="p-4 bg-gray-50 rounded-lg text-sm text-gray-700 flex items-center gap-3">
							<i class="fa-solid fa-check text-green-500"></i>
							<span>{{ $service }}</span>
						</div>
					@endforeach
				</div>
			</div>

			<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
				<h2 class="text-lg font-semibold text-gray-800">Gallery</h2>
				<div class="grid grid-cols-2 sm:grid-cols-3 gap-3 mt-4">
					@foreach(['AndaBeach.jpg','loboc_river.jpg','Hinagdanan-Cave.jpg','chocolate_hills.jpg','tarsier_sanctuary.jpg'] as $img)
						<div class="h-36 overflow-hidden rounded-lg">
							<img src="{{ asset('images/' . $img) }}" alt="gallery" class="w-full h-full object-cover">
						</div>
					@endforeach
				</div>
			</div>
		</div>

		<!-- Right: Contact & Quick Stats -->
		<aside class="space-y-6">
			<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
				<h3 class="text-sm font-semibold text-gray-800">Contact</h3>
				<div class="mt-3 text-sm text-gray-600 space-y-2">
					<div class="flex items-center gap-2"><i class="fa-solid fa-phone text-blue-600"></i> (+63) 917-000-0000</div>
					<div class="flex items-center gap-2"><i class="fa-solid fa-envelope text-blue-600"></i> info@travelbuddy.example</div>
					<div class="flex items-center gap-2"><i class="fa-solid fa-location-dot text-blue-600"></i> Tagbilaran, Bohol</div>
				</div>
			</div>

			<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 text-center">
				<div class="text-sm text-gray-500">Monthly Bookings</div>
				<div class="text-3xl font-bold text-gray-800 mt-2">1,240</div>
				<div class="mt-2 text-sm text-green-600">+12% from last month</div>
			</div>

			<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
				<h3 class="text-sm font-semibold text-gray-800">Business Hours</h3>
				<div class="mt-2 text-sm text-gray-600">
					Mon - Sat: 8:00 AM - 6:00 PM<br>
					Sun: Closed
				</div>
			</div>
		</aside>
	</div>

	<!-- Edit Modal -->
	<div x-show="editOpen" x-cloak x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4" @click.self="editOpen = false">
		<div class="bg-white rounded-xl w-full max-w-2xl p-6">
			<div class="flex items-center justify-between">
				<h3 class="text-lg font-semibold">Edit Agency Profile</h3>
				<button @click="editOpen = false" class="text-gray-500 hover:text-gray-800">✕</button>
			</div>

			<form action="#" method="POST" class="mt-4 space-y-4">
				@csrf
				<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
					<input type="text" name="name" placeholder="Agency name" class="w-full border rounded-md p-2">
					<input type="text" name="phone" placeholder="Contact phone" class="w-full border rounded-md p-2">
				</div>
				<textarea name="description" rows="4" class="w-full border rounded-md p-2" placeholder="Short description"></textarea>
				<div class="flex items-center justify-end gap-2">
					<button type="button" @click="editOpen = false" class="px-4 py-2 bg-gray-100 rounded-md">Cancel</button>
					<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Save changes</button>
				</div>
			</form>
		</div>
	</div>

</div>

@endsection

