<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CustomerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show Register Page
    public function showRegister()
    {
        return view('auth.register');
    }

    // Handle Registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/[A-Z]/',     // must contain uppercase
                'regex:/[a-z]/',     // must contain lowercase
                'regex:/[0-9]/',     // must contain number
                'regex:/[@$!%*#?&]/' // must contain special char
            ],
        ], [
            'password.regex' => 'Password must contain uppercase, lowercase, number, and special character.',
        ]);

        $routeName = $request->route() ? $request->route()->getName() : null;
        if ($routeName && strpos($routeName, 'admin.') === 0) {
            $role = 'admin';
        } elseif ($routeName && strpos($routeName, 'agency.') === 0) {
            $role = 'agency';
        } else {
            $role = 'customer';
        }

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

        // Create associated customer profile
        CustomerProfile::create([
            'user_id' => $user->id,
            'address' => null,
            'phone' => null,
            'birthdate' => null,
        ]);

        return redirect()->route('login.form')->with('success', 'Registration successful!');

    }

    // Show Login Page
    public function showLogin()
    {
        return view('auth.login');
    }

    // Handle Login
  public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Determine expected role from the route name (do not accept from the form)
        $routeName = $request->route() ? $request->route()->getName() : null;
        if ($routeName && strpos($routeName, 'admin.') === 0) {
            $expectedRole = 'admin';
        } elseif ($routeName && strpos($routeName, 'agency.') === 0) {
            $expectedRole = 'agency';
        } else {
            // Public login should be customer-only
            $expectedRole = 'customer';
        }

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            // Redirect to role-specific dashboard
            $user = Auth::user();

            // If expected role is set on the form but the user doesn't match, logout and show error
            if ($expectedRole && $user->role !== $expectedRole) {
                Auth::logout();
                return back()->withErrors(['email' => 'No account with that role found for these credentials.'])->onlyInput('email');
            }
            return redirect()->intended($this->getDashboardUrl($user))->with('success', 'Welcome back!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showAdminRegister()
    {
        return view('auth.admin_register', ['expected_role' => 'admin']);
    }

    public function registerAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        AdminProfile::create(['user_id' => $user->id]);

        return redirect()->route('admin_login.form')
        ->with('success', 'Admin account created successfully!');
    }

// Show Travel Agency Register Page
public function showTravelAgencyRegister()
{
    return view('auth.agency_register', ['expected_role' => 'agency']);
}

// Handle Travel Agency Registration
public function registerTravelAgency(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => [
            'required',
            'confirmed',
            'min:8',
            'regex:/[A-Z]/',
            'regex:/[a-z]/',
            'regex:/[0-9]/',
            'regex:/[@$!%*#?&]/'
        ],
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'travel_agency',
    ]);

    return redirect()->route('agency_login.form')
        ->with('success', 'Registration successful! Please log in as a Travel Agency.');
}

// Show Travel Agency Login Page
public function showTravelAgencyLogin()
{
    return view('auth.agency_login');
}

// Handle Travel Agency Login
public function loginTravelAgency(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials, $request->remember)) {
        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role !== 'travel_agency') {
            Auth::logout();
            return redirect()->route('login.form')
                ->with('error', 'Access denied! You are not a Travel Agency.');
        }

        return redirect()->route('travel_tours.dashboard')
            ->with('success', 'Welcome back, Travel Partner!');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
}

 protected function getDashboardUrl($user)
    {
        if ($user->isAdmin()) {
            // Admin dashboard is at /admin and named route 'admin.dashboard'
            return route('admin.dashboard');
        }

        if ($user->isAgency()) {
            // Agency/travel_tours dashboard
            return route('travel_tours.dashboard');
        }

        // Default customer dashboard
        return route('customer.customer_dashboard');
    }

      /**
     * ✅ Logout user and destroy session
     */
    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Redirect based on user role
    return redirect('/customer/login')->with('success', 'You have been logged out successfully.');
}


}
