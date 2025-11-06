<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CustomerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // Show Register Page
    public function showRegister()
    {
        return view('auth.register');
    }

    public function __construct()
    {
        $this->middleware('web');
        $this->middleware('verified')->except(['register', 'login', 'showRegister', 'showLogin']);
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
            'contact_number' => 'required|string|max:20',
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
            'contact_number' => $request->contact_number,
            'email_verified_at' => null,
        ]);

        // Only create customer profile for customer role
        if ($role === 'customer') {
            CustomerProfile::create([
                'user_id' => $user->id,
                'address' => null,
                'phone' => $request->contact_number,
                'birthdate' => null,
            ]);
        }

        // Login the user
        Auth::login($user);

        // Generate and send verification code
        app(VerificationController::class)->sendCode($request);

        return redirect()->route('verification.notice')
            ->with('success', 'Registration successful! Please check your email for the verification code.');

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

        if (Auth::guard('web')->attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            $user = Auth::guard('web')->user();

            // Check if this is a customer login attempt
            if ($expectedRole === 'customer' && $user->role !== 'customer') {
                Auth::guard('web')->logout();
                return back()->withErrors(['email' => 'Invalid credentials for customer login.']);
            }

            // Check email verification
            if (!$user->hasVerifiedEmail()) {
                // Resend verification code
                app(VerificationController::class)->sendCode($request);
                return redirect()->route('verification.notice')
                    ->with('warning', 'Please verify your email address first.');
            }

            // Redirect based on role
            if ($user->role === 'customer') {
                return redirect()->route('customer.customer_dashboard')
                    ->with('success', 'Welcome back!');
            }
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
        'agency_name' => 'required|string|max:255',
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

    // Map the agency_name input to the users.name column
    $user = User::create([
        'name' => $request->agency_name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'travel_agency',
        'contact_number' => $request->contact_number ?? null,
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

    if (Auth::guard('travel_agency')->attempt($credentials, $request->remember)) {
    $request->session()->regenerate();
    $user = Auth::guard('travel_agency')->user();

    if ($user->role !== 'travel_agency') {
        Auth::guard('travel_agency')->logout();
        return redirect()->route('login.form')->with('error', 'Access denied!');
    }
    // ensure other guards (customer/web or admin) are logged out to avoid mixed sessions
    try {
        Auth::guard('web')->logout();
    } catch (\Exception $e) {
        // ignore if guard not active
    }
    try {
        Auth::guard('admin')->logout();
    } catch (\Exception $e) {
        // ignore if guard not active
    }

    return redirect()->route('travel_tours.dashboard')->with('success', 'Welcome back!');
}

    // Log guard states to help diagnose login failures
    Log::debug('Travel agency login failed', [
        'travel_agency' => Auth::guard('travel_agency')->check(),
        'admin' => Auth::guard('admin')->check(),
        'web' => Auth::guard('web')->check(),
    ]);

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records. (debug guards: agency=' . (Auth::guard('travel_agency')->check() ? '1' : '0') . ', admin=' . (Auth::guard('admin')->check() ? '1' : '0') . ', web=' . (Auth::guard('web')->check() ? '1' : '0') . ')',
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
    if (Auth::guard('admin')->check()) {
        Auth::guard('admin')->logout();
    } elseif (Auth::guard('travel_agency')->check()) {
        Auth::guard('travel_agency')->logout();
    } else {
        Auth::guard('web')->logout();
    }

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/')->with('success', 'You have been logged out successfully.');
}

}
