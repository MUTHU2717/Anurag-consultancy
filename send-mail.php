<?php
// send-mail.php - improved with method check & basic validation

// Only allow POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("HTTP/1.1 405 Method Not Allowed");
    echo "405 Method Not Allowed. Use POST.";
    exit;
}

// Simple helper to fetch & sanitize
function get_post($key){
    return isset($_POST[$key]) ? trim(strip_tags($_POST[$key])) : '';
}

$owner_email = "muthukumar418707@gmail.com";

$name   = get_post('name');
$email  = get_post('email');
$mobile = get_post('mobile');
$org    = get_post('organization');
$msg    = get_post('message');

// Basic validation
$errors = [];
if (!$name)  $errors[] = "Name is required.";
if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required.";
if (!$mobile) $errors[] = "Mobile is required.";

if (!empty($errors)) {
    // Return to form with error (simple)
    header("HTTP/1.1 400 Bad Request");
    echo "Please fix the following errors:\n" . implode("\n", $errors);
    exit;
}

// Email to owner
$subject = "New Consultation Request From Website";
$message_to_owner  = "You have a new consultation request:\n\n";
$message_to_owner .= "Name: $name\n";
$message_to_owner .= "Email: $email\n";
$message_to_owner .= "Mobile: $mobile\n";
$message_to_owner .= "Organization: $org\n\n";
$message_to_owner .= "Message:\n$msg\n";
$headers_owner = "From: $email\r\nReply-To: $email\r\n";

// Send email (note: mail() must be enabled)
$mail_ok = mail($owner_email, $subject, $message_to_owner, $headers_owner);

// Auto reply to user
$reply_subject = "Thanks for contacting us!";
$reply_message = "Hello $name,\n\nThank you for reaching out. We will get back to you soon.\nIn the meantime, visit our website for more information.\n\nRegards,\nAnurag Consultancy";
$headers_reply = "From: $owner_email\r\n";

$reply_ok = mail($email, $reply_subject, $reply_message, $headers_reply);

if ($mail_ok) {
    header("Location: thank-you.html");
    exit;
} else {
    // mail failed - inform admin (but don't reveal details to user)
    header("HTTP/1.1 500 Internal Server Error");
    echo "There was an error sending your message. Please try again later.";
    exit;
}
?>

