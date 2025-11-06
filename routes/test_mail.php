<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::get('/test-mail', function () {
    try {
        $data = ['message' => 'This is a test email'];
        
        Mail::raw('Test email from TravelBuddy at ' . now(), function($message) {
            $message->to('nams23259@gmail.com')
                   ->subject('Test Email');
        });
        
        return 'Test email sent! Check your inbox and spam folder.';
    } catch (\Exception $e) {
        return 'Error sending mail: ' . $e->getMessage();
    }
});