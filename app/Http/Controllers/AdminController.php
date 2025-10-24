<?php

namespace App\Http\Controllers;

use App\Models\User; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
   
    public function dashboard(Request $request)
    {
        // Sample metrics (replace with real queries later)
        $metrics = [
            'totalUsers' => 1280,
            'activeTrips' => 42,
            'bookingsToday' => 18,
            'supportTickets' => 3,
        ];

        return view('admin.dashboard', compact('metrics'));
    }

    public function customers(Request $request)
    {
        // Sample customer data (replace with real queries later)
        $customers = [
            [
                'id' => 1,
                'name' => 'Anna Lee',
                'email' => 'anna.lee@email.com',
                'phone' => '+63 912 345 6789',
                'bookings' => 8,
                'last_booking' => '2025-01-20',
                'total_spent' => '₱45,000',
                'status' => 'VIP',
                'status_color' => 'bg-purple-100 text-purple-700',
                'avatar' => 'AL'
            ],
            [
                'id' => 2,
                'name' => 'John Cruz',
                'email' => 'john.cruz@email.com',
                'phone' => '+63 917 123 4567',
                'bookings' => 5,
                'last_booking' => '2025-01-18',
                'total_spent' => '₱28,500',
                'status' => 'Returning',
                'status_color' => 'bg-green-100 text-green-700',
                'avatar' => 'JC'
            ],
            [
                'id' => 3,
                'name' => 'Sarah Martinez',
                'email' => 'sarah.martinez@email.com',
                'phone' => '+63 918 987 6543',
                'bookings' => 3,
                'last_booking' => '2025-01-15',
                'total_spent' => '₱18,200',
                'status' => 'Active',
                'status_color' => 'bg-blue-100 text-blue-700',
                'avatar' => 'SM'
            ],
            [
                'id' => 4,
                'name' => 'Mark Thompson',
                'email' => 'mark.thompson@email.com',
                'phone' => '+63 919 456 7890',
                'bookings' => 2,
                'last_booking' => '2025-01-12',
                'total_spent' => '₱12,800',
                'status' => 'New',
                'status_color' => 'bg-amber-100 text-amber-700',
                'avatar' => 'MT'
            ],
            [
                'id' => 5,
                'name' => 'Lisa Garcia',
                'email' => 'lisa.garcia@email.com',
                'phone' => '+63 920 111 2222',
                'bookings' => 6,
                'last_booking' => '2025-01-10',
                'total_spent' => '₱35,600',
                'status' => 'VIP',
                'status_color' => 'bg-purple-100 text-purple-700',
                'avatar' => 'LG'
            ],
            [
                'id' => 6,
                'name' => 'David Wilson',
                'email' => 'david.wilson@email.com',
                'phone' => '+63 921 333 4444',
                'bookings' => 1,
                'last_booking' => '2025-01-08',
                'total_spent' => '₱7,500',
                'status' => 'New',
                'status_color' => 'bg-amber-100 text-amber-700',
                'avatar' => 'DW'
            ]
        ];

        return view('admin.customers.index', compact('customers'));
    }

}


