<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     * If the user is authenticated, redirect them to the proper dashboard based on role.
     * This supports multiple guards as Laravel's default middleware does.
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();

                if ($user && isset($user->role)) {
                    $role = strtolower($user->role);

                    if ($role === 'admin') {
                        return redirect()->route('admin.dashboard');
                    }

                    if ($role === 'agency' || $role === 'travel_agency') {
                        return redirect()->route('travel_tours.dashboard');
                    }

                    if ($role === 'customer') {
                        return redirect()->route('customer.customer_dashboard');
                    }
                }

                // Fallback
                return redirect('/');
            }
        }

        return $next($request);
    }
}
