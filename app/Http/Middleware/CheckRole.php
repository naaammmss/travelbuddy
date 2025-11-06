<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = $request->user();
        if (! $user) {
            // check common guards
            $guardsToCheck = ['admin', 'travel_agency', 'web', 'customer'];
            foreach ($guardsToCheck as $g) {
                if (Auth::guard($g)->check()) {
                    $user = Auth::guard($g)->user();
                    break;
                }
            }
        }

        if (! $user || $user->role !== $role) {
            return redirect('/');
        }

        return $next($request);
    }
}