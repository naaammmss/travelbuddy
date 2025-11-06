<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestEmail extends Command
{
    protected $signature = 'mail:test';
    protected $description = 'Test email configuration';

    public function handle()
    {
        $this->info('Testing email configuration...');
        
        try {
            $this->info('Current mail settings:');
            $this->info('MAIL_MAILER: ' . config('mail.default'));
            $this->info('MAIL_HOST: ' . config('mail.mailers.smtp.host'));
            $this->info('MAIL_PORT: ' . config('mail.mailers.smtp.port'));
            $this->info('MAIL_USERNAME: ' . config('mail.mailers.smtp.username'));
            $this->info('MAIL_ENCRYPTION: ' . config('mail.mailers.smtp.encryption'));
            
            Mail::raw('Test email from TravelBuddy at ' . now(), function($message) {
                $message->to('nams23259@gmail.com')
                       ->subject('Test Email from Artisan Command');
            });
            
            $this->info('Test email sent successfully!');
        } catch (\Exception $e) {
            $this->error('Error sending mail: ' . $e->getMessage());
            $this->error('Stack trace:');
            $this->error($e->getTraceAsString());
        }
    }
}