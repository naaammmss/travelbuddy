<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendVerificationCode extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $code;
    public $verificationUrl;

    public function __construct(User $user, string $code)
    {
        $this->user = $user;
        $this->code = $code;
        $this->verificationUrl = route('verification.verify');
    }

    public function build()
    {
        return $this->markdown('emails.verify-code')
                    ->subject('Verify Your Email Address - ' . config('app.name'));
    }
}