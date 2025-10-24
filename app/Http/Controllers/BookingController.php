<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\TourPackages;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        // Validate input with enhanced rules
        $validated = $request->validate([
            'package_id'   => 'required|exists:tour_packages,id',
            'full_name'    => 'required|string|max:255|regex:/^[A-Za-z\s]{2,}$/',
            'email'        => 'required|email|max:255',
            'phone'        => 'required|string|regex:/^[\+]?[0-9\s\-\(\)]{10,15}$/',
            'participants' => 'required|integer|min:1|max:100',
            'travel_date'  => 'required|string', 
        ], [
            'full_name.regex' => 'Full name must contain only letters and spaces (minimum 2 characters).',
            'phone.regex' => 'Please enter a valid phone number (10-15 digits).',
            'participants.min' => 'Number of participants must be at least 1.',
            'participants.max' => 'Maximum 100 participants allowed.',
        ]);

        // Get package
        $package = TourPackages::findOrFail($validated['package_id']);
        $totalPrice = $package->price * $validated['participants'];

        // Parse start and end dates from range
        $dates = explode(' to ', $validated['travel_date']);
        if (count($dates) !== 2) {
            return back()->withErrors(['travel_date' => 'Please select a valid date range.']);
        }

        try {
            $startDate = Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d');
            $endDate   = Carbon::createFromFormat('d/m/Y', trim($dates[1]))->format('Y-m-d');
        } catch (\Exception $e) {
            return back()->withErrors(['travel_date' => 'Invalid date format selected.']);
        }

        // Save booking
        Booking::create([
            'package_id'   => $validated['package_id'],
            'full_name'    => $validated['full_name'],
            'email'        => $validated['email'],
            'phone'        => $validated['phone'],
            'participants' => $validated['participants'],
            'start_date'   => $startDate,
            'end_date'     => $endDate,
            'total_price'  => $totalPrice,
            'status'       => 'Pending',
        ]);

        // Success message
        return redirect()->back()->with('success', 'Your booking has been submitted successfully! We will contact you soon.');
    }

    public function index()
    {
        $bookings = Booking::with('package')->latest()->get();
        return view('travel_tours.bookings.booking_request', compact('bookings'));
    }
}
