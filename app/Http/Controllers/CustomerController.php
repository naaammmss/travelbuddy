<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attraction;
use App\Models\TourPackages;
use App\Models\CustomerProfile;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    // Display available packages
    public function customerPackages()
    {
        $packages = TourPackages::all();
        return view('customer.book_trip_package.trip_package', compact('packages'));
    }

    // Customer Dashboard
    public function customerDashboard()
    {
        $attractions = Attraction::latest()->get();
        $bookings = []; // Placeholder for user bookings
        return view('customer.customer_dashboard', compact('attractions', 'bookings'));
    }

    //  Show Profile Page
    public function showProfile()
    {
        $user = auth()->user();
        
        $profile = $user->customerProfile; // Relationship from User model
        return view('customer.customer_profile.profile', compact('user', 'profile'));
    }

    // Update Profile Information
    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $profile = $user->customerProfile ?? new CustomerProfile(['user_id' => $user->id]);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'birthdate' => 'nullable|date',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update main user table
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Ensure profile record exists
        if (!$profile) {
            $profile = new CustomerProfile();
            $profile->user_id = $user->id;
        }

        // Update profile data
        $profile->address = $request->address;
        $profile->phone = $request->phone;
        $profile->birthdate = $request->birthdate;

        // Handle picture upload
        if ($request->hasFile('profile_picture')) {
        $path = $request->file('profile_picture')->store('profile_pictures', 'public');
        $profile->profile_picture = $path;
    }

    $profile->save();

        return back()->with('success', 'Profile updated successfully!');
    }

    // 🧾 Store booking data
    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:tour_packages,id',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'participants' => 'required|integer|min:1',
            'travel_date' => 'required|date',
            'special_requests' => 'nullable|string'
        ]);

        Booking::create($request->all());

        return redirect()->back()->with('status', 'Your booking request has been submitted successfully!');
    }

    // 📦 Show individual trip package
    public function storeBooking($id)
    {
        $package = TourPackages::findOrFail($id);
        return view('customer.book_trip_package.show_trip', compact('package'));
    }
}
