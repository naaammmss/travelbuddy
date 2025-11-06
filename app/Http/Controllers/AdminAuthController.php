<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
     public function showRegisterForm() 
    {
         return view('auth.admin_register'); 
    } 
    
    public function register(Request $request) 
    {
        $request->validate([ 
            'name' => ['required', 'string', 'max:255'], 
            'email' => ['required', 'email', 'unique:users,email'], 
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]); 
        
        $admin = User::create([ 
            'name' => $request->name, 
            'email' => $request->email, 
            'password' => Hash::make($request->password), 
            'role' => 'admin', 
        ]); 
        
    // Log in the new admin using the admin guard
    Auth::guard('admin')->login($admin);
    // regenerate session to avoid session fixation
    request()->session()->regenerate();

    return redirect()->route('admin.dashboard')->with('success', 'Admin registered successfully!'); 
    }
    
    /** * Show admin login page */ 
    public function showLoginForm() 
    { 
        return view('auth.admin_login'); 
    } 
    /** * Handle admin login */ 
    public function login(Request $request) 
    {
        $credentials = $request->validate([ 
            'email' => ['required', 'email'], 
            'password' => ['required', 'string'], 
        ]); 

        // Attempt to authenticate using the admin guard directly
        if (Auth::guard('admin')->attempt($credentials)) {
            // Regenerate session to avoid fixation
            $request->session()->regenerate();

            // Redirect to admin dashboard
            return redirect()->route('admin.dashboard')->with('success', 'Welcome Admin!');
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])
            ->withInput();
        // if (Auth::attempt($credentials)) {
        //     $user = Auth::user(); 
        //         if ($user->role === 'admin') {
        //              return redirect()->route('admin.dashboard')->with('success', 'Welcome back, Admin!'); 
        //         } else { 
        //             Auth::logout(); 
                    
        //             return back()->withErrors(['email' => 'Access denied. Admins only.']); 
        //         } 
        //     } return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
    } 
    
    /** * Handle admin logout */ 
    public function logout(Request $request) 
    { 

        Auth::logout(); 

        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 
        
        return redirect()->route('admin.login')
            ->with('success', 'Logged out successfully.'); 
    }
}
