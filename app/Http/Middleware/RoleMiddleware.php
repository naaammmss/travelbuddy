<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * Expecting middleware parameter: role (e.g., admin, agency, customer)
     */
    public function handle(Request $request, Closure $next, $role = null)
    {
        $user = Auth::user();

        if (! $user) {
            return redirect()->route('login.form');
        }

        if ($role) {
            // case-insensitive compare and support multiple allowed roles (comma or pipe-separated)
            $expected = array_map('trim', preg_split('/[|,]/', strtolower($role)));
            $actual = strtolower($user->role ?? '');

            if (! in_array($actual, $expected, true)) {
                // Redirect user to the dashboard that matches their actual role
                if ($actual === 'admin') {
                    return redirect()->route('admin.dashboard')->withErrors(['access' => 'You do not have access to that area.']);
                }

                // accept both 'agency' and 'travel_agency' role strings
                if ($actual === 'agency' || $actual === 'travel_agency') {
                    return redirect()->route('travel_tours.dashboard')->withErrors(['access' => 'You do not have access to that area.']);
                }

                if ($actual === 'customer') {
                    return redirect()->route('customer.customer_dashboard')->withErrors(['access' => 'You do not have access to that area.']);
                }

                // Fallback: redirect to home page
                return redirect('/')->withErrors(['access' => 'You do not have access to that area.']);
            }
        }

        return $next($request);
    }
}
