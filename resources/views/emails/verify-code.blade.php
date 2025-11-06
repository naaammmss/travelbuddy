<x-mail::message>
<div style="text-align: center; margin-bottom: 30px;">
    <img src="{{ asset('images/logo.png') }}" alt="TravelBuddy" style="max-width: 200px; margin: 0 auto;">
    <h1 style="color: #4F46E5; font-size: 28px; margin-top: 20px;">Welcome to TravelBuddy</h1>
</div>

# Verify Your Email Address

Hi {{ $user->name }},

Thank you for joining TravelBuddy! To ensure the security of your account, please verify your email address using the code below:

<x-mail::panel>
<div style="background: #F3F4F6; padding: 20px; border-radius: 10px;">
    <h1 style="font-size: 36px; text-align: center; letter-spacing: 8px; color: #4F46E5; margin: 0;">{{ $code }}</h1>
    <p style="text-align: center; color: #6B7280; margin-top: 10px; font-size: 14px;">This code will expire in 15 minutes</p>
</div>
</x-mail::panel>

<div style="background: #FEF3C7; padding: 15px; border-radius: 8px; margin: 20px 0;">
    <p style="color: #92400E; margin: 0; font-size: 14px;">🔒 For security reasons, please do not share this code with anyone.</p>
</div>

<x-mail::button :url="$verificationUrl" color="indigo">
Verify Email Address
</x-mail::button>

<p style="color: #6B7280; font-size: 14px; margin-top: 20px;">If you did not create an account on TravelBuddy, please ignore this email.</p>

Safe travels!<br>
The {{ config('app.name') }} Team
</x-mail::message>