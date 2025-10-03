<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attraction;
use App\Models\User;

class TravelToursController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_bookings' => 1247,
            'active_tours' => 23,
            'total_customers' => 892,
            'monthly_revenue' => 45680,
            'pending_bookings' => 18,
            'completed_tours' => 156,
            'customer_satisfaction' => 4.8,
            'repeat_customers' => 67
        ];

        $recent_bookings = [
            [
                'id' => 1,
                'customer_name' => 'Sarah Johnson',
                'tour_name' => 'Bohol Island Hopping',
                'date' => '2025-01-15',
                'status' => 'confirmed',
                'amount' => 2500
            ],
            [
                'id' => 2,
                'customer_name' => 'Michael Chen',
                'tour_name' => 'Chocolate Hills Adventure',
                'date' => '2025-01-14',
                'status' => 'pending',
                'amount' => 1800
            ],
            [
                'id' => 3,
                'customer_name' => 'Emily Rodriguez',
                'tour_name' => 'Panglao Beach Tour',
                'date' => '2025-01-13',
                'status' => 'completed',
                'amount' => 2200
            ],
            [
                'id' => 4,
                'customer_name' => 'David Kim',
                'tour_name' => 'Tarsier Sanctuary Visit',
                'date' => '2025-01-12',
                'status' => 'confirmed',
                'amount' => 1500
            ]
        ];

        $popular_tours = [
            [
                'name' => 'Bohol Island Hopping',
                'bookings' => 45,
                'revenue' => 112500,
                'rating' => 4.9
            ],
            [
                'name' => 'Chocolate Hills Adventure',
                'bookings' => 38,
                'revenue' => 68400,
                'rating' => 4.8
            ],
            [
                'name' => 'Panglao Beach Tour',
                'bookings' => 32,
                'revenue' => 70400,
                'rating' => 4.7
            ],
            [
                'name' => 'Tarsier Sanctuary Visit',
                'bookings' => 28,
                'revenue' => 42000,
                'rating' => 4.6
            ]
        ];

        $monthly_revenue = [
            'January' => 45680,
            'February' => 52340,
            'March' => 48920,
            'April' => 61200,
            'May' => 57890,
            'June' => 65430
        ];

        $customer_demographics = [
            'domestic' => 65,
            'international' => 35
        ];

        return view('travel_tours.dashboard', compact(
            'stats', 
            'recent_bookings', 
            'popular_tours', 
            'monthly_revenue',
            'customer_demographics'
        ));
    }

    public function agencyProfile()
    {
        return view('travel_tours.agency-profile');
    }

    public function tourPackages()
    {
        return view('travel_tours.tour_packages.index_packages');
    }
     public function create()
    {
        $categories = ['Nature', 'Historical', 'Adventure', 'Cultural', 'Other'];
        return view('travel-tours.tour_packages.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'category'         => 'required|string|max:100',
            'description'      => 'required|string',
            'duration'         => 'required|string|max:100',
            'max_participants' => 'required|integer|min:1',
            'price'            => 'required|numeric|min:0',
            'location'         => 'required|string|max:255',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'itinerary'        => 'nullable|string',
            'inclusions'       => 'nullable|string',
            'exclusions'       => 'nullable|string',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('packages', 'public');
        }

        // Store in database
        $package = TourPackage::create($validated);

        return redirect()
            ->route('packages.index')
            ->with('success', 'Tour Package created successfully!');
    }

    public function edit(TourPackage $package)
    {
        $categories = ['Adventure', 'Cultural', 'Nature', 'Beach', 'Historical'];
        return view('travel_tours.packages.edit', compact('package', 'categories'));
    }

    public function update(Request $request, TourPackage $package)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'category'         => 'required|string|max:100',
            'description'      => 'required|string',
            'duration'         => 'required|string|max:100',
            'max_participants' => 'required|integer|min:1',
            'price'            => 'required|numeric|min:0',
            'location'         => 'required|string|max:255',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'itinerary'        => 'nullable|string',
            'inclusions'       => 'nullable|string',
            'exclusions'       => 'nullable|string',
        ]);

        // Replace image if new one is uploaded
        if ($request->hasFile('image')) {
            if ($package->image_path) {
                Storage::disk('public')->delete($package->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('packages', 'public');
        }

        $package->update($validated);

        return redirect()
            ->route('packages.index')
            ->with('success', 'Tour Package updated successfully!');
    }

    public function destroy(TourPackage $package)
    {
        if ($package->image_path) {
            Storage::disk('public')->delete($package->image_path);
        }
        $package->delete();

        return redirect()
            ->route('packages.index')
            ->with('success', 'Tour Package deleted successfully!');
    }

    public function bookings()
    {
        return view('travel_tours.bookings');
    }

    public function customers()
    {
        return view('travel_tours.customers');
    }

    public function reports()
    {
        return view('travel_tours.reports');
    }

    public function driversGuides()
    {
        return view('travel_tours.drivers-guides');
    }
}
