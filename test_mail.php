<?php
$to = "nams23259@gmail.com";
$subject = "Test Email";
$message = "This is a test email sent at " . date('Y-m-d H:i:s');
$headers = "From: TravelBuddy <nams23259@gmail.com>";

if(mail($to, $subject, $message, $headers)) {
    echo "Mail sent successfully";
} else {
    echo "Mail sending failed";
}
?>