<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\{Mail, Log, DB};
use App\Mail\SendVerificationCode;
use Carbon\Carbon;

class VerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['verify']);
    }

    public function show()
    {
        $user = auth()->user();
        
        if ($user->hasVerifiedEmail()) {
            return redirect()->route('customer.customer_dashboard')
                ->with('info', 'Email already verified.');
        }
        
        return view('auth.verify-code');
    }

    public function sendCode(Request $request)
    {
        try {
            // Prefer the request user, but fall back to the currently authenticated user.
            $user = $request->user() ?? auth()->user();
            if (!$user) {
                Log::warning('VerificationController::sendCode called but no user was available on the request or auth().');
                return back()->withErrors(['error' => 'No authenticated user found to send verification code.']);
            }
            
            if ($user->hasVerifiedEmail()) {
                return redirect()->route('customer.customer_dashboard');
            }
            
            // Generate a random 6-digit code
            $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            
            // Invalidate old codes
            VerificationCode::where('user_id', $user->id)
                ->where('used', false)
                ->update(['used' => true]);

            // Create new code
            VerificationCode::create([
                'user_id' => $user->id,
                'code' => $code,
                'expires_at' => now()->addMinutes(15),
            ]);

            try {
                // Send email with verification code
                Mail::to($user->email)->send(new SendVerificationCode($user, $code));
                return back()->with('success', 'A new verification code has been sent to your email.');
            } catch (\Exception $e) {
                Log::error('Mail sending failed: ' . $e->getMessage());
                return back()->with('error', 'Failed to send verification code: ' . $e->getMessage());
            }
            
        } catch (\Exception $e) {
            Log::error('Error sending verification code: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Could not send verification code. Please try again.']);
        }
    }

    public function verify(Request $request)
    {
        try {
            $request->validate([
                'code' => 'required|string|size:6',
            ]);

            $user = auth()->user();
            
            if ($user->hasVerifiedEmail()) {
                return redirect()->route('customer.customer_dashboard')
                    ->with('info', 'Email already verified.');
            }

            $verificationCode = VerificationCode::where('user_id', $user->id)
                ->where('code', $request->code)
                ->where('used', false)
                ->where('expires_at', '>', now())
                ->first();

            if (!$verificationCode) {
                return back()->withErrors(['code' => 'Invalid or expired verification code.'])
                    ->with('error', 'Please try again or request a new code.');
            }

            DB::transaction(function () use ($user, $verificationCode) {
                $verificationCode->update(['used' => true]);
                $user->update(['email_verified_at' => now()]);
            });

            return redirect()->route('customer.customer_dashboard')
                ->with('success', 'Email verified successfully! Welcome to TravelBuddy.');
                
        } catch (\Exception $e) {
            Log::error('Verification error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'An error occurred during verification. Please try again.']);
        }
    }

    public function resend(Request $request)
    {
        try {
            $user = $request->user();

            if ($user->hasVerifiedEmail()) {
                return redirect()->route('customer.customer_dashboard');
            }

            // Check for recent resend attempts
            $recentCode = VerificationCode::where('user_id', $user->id)
                ->where('created_at', '>', now()->subMinutes(2))
                ->exists();

            if ($recentCode) {
                return back()->withErrors(['error' => 'Please wait a few minutes before requesting another code.']);
            }

            return $this->sendCode($request);
            
        } catch (\Exception $e) {
            Log::error('Error resending code: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Could not resend verification code. Please try again.']);
        }
    }
}