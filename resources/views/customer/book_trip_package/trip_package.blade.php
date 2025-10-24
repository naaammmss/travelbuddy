@extends('customer.customer_panel')

@section('title', 'Bohol TravelBuddy')
@section('page-title', 'Trip Packages')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-8">
	<h2 class="text-2xl font-bold mb-4">Available Trip Packages</h2>

	<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
		@forelse($packages as $package)
			<a href="{{ route('customer.book_trip_package.show_trip', $package->id) }}" 
			   class="block bg-white rounded-2xl shadow overflow-hidden hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300">
				@if($package->cover_photo)
					<img src="{{ asset('storage/' . $package->cover_photo) }}" alt="{{ $package->name }}" class="w-full h-48 object-cover">
				@else
					<div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400">No image</div>
				@endif

				<div class="p-4">
					<h3 class="text-lg font-semibold text-gray-900">{{ $package->name }}</h3>
					<div class="text-sm text-gray-500">{{ $package->category }} · {{ $package->location }}</div>
					<p class="mt-2 text-gray-700 text-sm">{{ \Illuminate\Support\Str::limit($package->description ?? '', 140) }}</p>

					<div class="mt-4 flex items-center justify-between">
						<div class="text-lg font-bold text-indigo-700">₱{{ number_format($package->price, 2) }}</div>
					</div>
				</div>
			</a>
		@empty
			<div class="col-span-1 sm:col-span-2 lg:col-span-3 bg-white rounded-2xl shadow p-6 text-center text-gray-600">
				No tour packages available at the moment.
			</div>
		@endforelse
	</div>
</div>

@endsection
