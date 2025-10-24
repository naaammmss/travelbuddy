<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attraction;
use App\Models\User;
use App\Models\TourPackages;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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
            ['id' => 1,'customer_name' => 'Sarah Johnson','tour_name' => 'Bohol Island Hopping','date' => '2025-01-15','status' => 'confirmed','amount' => 2500],
            ['id' => 2,'customer_name' => 'Michael Chen','tour_name' => 'Chocolate Hills Adventure','date' => '2025-01-14','status' => 'pending','amount' => 1800],
            ['id' => 3,'customer_name' => 'Emily Rodriguez','tour_name' => 'Panglao Beach Tour','date' => '2025-01-13','status' => 'completed','amount' => 2200],
            ['id' => 4,'customer_name' => 'David Kim','tour_name' => 'Tarsier Sanctuary Visit','date' => '2025-01-12','status' => 'confirmed','amount' => 1500],
        ];

        $popular_tours = [
            ['name' => 'Bohol Island Hopping','bookings' => 45,'revenue' => 112500,'rating' => 4.9],
            ['name' => 'Chocolate Hills Adventure','bookings' => 38,'revenue' => 68400,'rating' => 4.8],
            ['name' => 'Panglao Beach Tour','bookings' => 32,'revenue' => 70400,'rating' => 4.7],
            ['name' => 'Tarsier Sanctuary Visit','bookings' => 28,'revenue' => 42000,'rating' => 4.6],
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
            'stats','recent_bookings','popular_tours','monthly_revenue','customer_demographics'
        ));
    }

    
    public function agencyProfile()
    {
        return view('travel_tours.agency_prof.agency_profile');
    }

   public function index()
    {
        // ok
        $packages = TourPackages::all();
        // dd($packages);
        return view('travel_tours.tour_packages.index_packages', compact('packages'));
    }

    public function create()
    {
        $categories = ['Nature', 'Historical', 'Adventure', 'Cultural', 'Other'];
        return view('travel_tours.tour_packages.create_packages', compact('categories'));
    }

    public function store(Request $request)
    {
        // Log entry for debugging 
        Log::debug('TourPackages.store called', ['keys' => array_keys($request->all())]);

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'description' => 'nullable|string',
            'duration' => 'nullable|string|max:100',
            'max_participants' => 'nullable|integer|min:1',
            'price' => 'required|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'itinerary' => 'nullable|string',
            'inclusions' => 'nullable|string',
            'exclusions' => 'nullable|string',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        try {
            $coverPhotoPath = null;

            // Accept either 'cover_photo' (current) or legacy 'image' input name
            if ($request->hasFile('cover_photo')) {
                $coverPhotoPath = $request->file('cover_photo')->store('tour_images', 'public');
            } elseif ($request->hasFile('image')) {
                $coverPhotoPath = $request->file('image')->store('tour_images', 'public');
            }

            $galleryPaths = [];
            if ($request->hasFile('gallery')) {
                foreach ($request->file('gallery') as $galleryImage) {
                    $galleryPaths[] = $galleryImage->store('tour_images/gallery', 'public');
                }
            }

            $price = $request->input('price');

            $package = TourPackages::create([
                'name' => $request->name,
                'category' => $request->category,
                'description' => $request->description,
                'duration' => $request->duration,
                'max_participants' => $request->max_participants,
                'price' => $price,
                'location' => $request->location,
                'itinerary' => $request->itinerary,
                'inclusions' => $request->inclusions,
                'exclusions' => $request->exclusions,
                'cover_photo' => $coverPhotoPath,
                'gallery' => $galleryPaths,
            ]);

            Log::debug('TourPackages.created', ['id' => $package->id, 'attributes' => $package->toArray()]);

            return redirect()
                ->route('travel_tours.tour_packages')
                ->with('status', 'Tour package created successfully!');
        } catch (\Exception $e) {
            Log::error('TourPackages.store failed', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->withInput()->withErrors(['error' => 'Failed to create tour package. Check logs for details.']);
        }
}
    public function show(TourPackages $package)
    {
        return view('travel_tours.tour_packages.show', compact('package'));
    }

    public function edit(TourPackages $package)
    {
        $categories = ['Adventure', 'Cultural', 'Nature', 'Beach', 'Historical'];
        return view('travel_tours.tour_packages.edit', compact('package', 'categories'));
    }

    public function update(Request $request, TourPackages $package)
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

        if ($request->hasFile('image')) {
            if ($package->image_path) {
                Storage::disk('public')->delete($package->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('packages', 'public');
        }

        $package->update($validated);

        return redirect()
            ->route('travel_tours.tour_packages')
            ->with('success', 'Tour Package updated successfully!');
    }

    public function destroy(TourPackages $package)
    {
        if ($package->image_path) {
            Storage::disk('public')->delete($package->image_path);
        }
        $package->delete();

        return redirect()
            ->route('travel_tours.tour_packages')
            ->with('success', 'Tour Package deleted successfully!');
    }

    public function customerPackages()
    {
        return view('customer.book_trip_package.trip_package');
    }

    public function reports()
    {
        return view('travel_tours.reports');
    }

    public function drivers()
    {
        return view('travel_tours.driver_info.drivers');
    }
}
