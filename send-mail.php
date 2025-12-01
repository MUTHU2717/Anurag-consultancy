<?php

// Owner email
$owner_email = "muthukumar418707@gmail.com";

// Collect form values
$name   = $_POST['name'];
$email  = $_POST['email'];
$mobile = $_POST['mobile'];
$org    = $_POST['organization'];
$msg    = $_POST['message'];

// Email to YOU (the business owner)
$subject = "New Consultation Request From Website";

$message_to_owner  = "You have a new consultation request:\n\n";
$message_to_owner .= "Name: $name\n";
$message_to_owner .= "Email: $email\n";
$message_to_owner .= "Mobile: $mobile\n";
$message_to_owner .= "Organization: $org\n\n";
$message_to_owner .= "Message:\n$msg\n";

$headers_owner = "From: $email";

// Send email to owner
mail($owner_email, $subject, $message_to_owner, $headers_owner);


// Auto-reply to the USER
$reply_subject = "Thanks for contacting us!";
$reply_message = "Hello $name,\n\n";
$reply_message .= "Thank you for reaching out. We will get back to you soon.\n";
$reply_message .= "In the meantime, visit our website for more information.\n\n";
$reply_message .= "Regards,\nAnurag Consultancy";

$headers_reply = "From: $owner_email";

// Send auto-reply
mail($email, $reply_subject, $reply_message, $headers_reply);


// Redirect user to a thank-you page
header("Location: thank-you.html");
exit();

?>

