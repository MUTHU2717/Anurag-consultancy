<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name       = htmlspecialchars($_POST['name']);
    $email      = htmlspecialchars($_POST['email']);
    $mobile     = htmlspecialchars($_POST['mobile']);
    $org        = htmlspecialchars($_POST['organization']);
    $message    = htmlspecialchars($_POST['message']);

    $to = "muthukumar418707@gmail.com";  // <-- Your email ID
    $subject = "New Consultation Request from Your Website";

    $body = "
    You have received a new message from your website contact form.

    ----------------------------------------------------
    Name: $name
    Email: $email
    Mobile No: $mobile
    Organization: $org
    Message:
    $message
    ----------------------------------------------------
    ";

    $headers = "From: Website Contact Form <no-reply@yourdomain.com>\r\n";
    $headers .= "Reply-To: $email\r\n";

    if (mail($to, $subject, $body, $headers)) {
        echo "<script>alert('Your message has been sent successfully!'); window.location.href='contact.html';</script>";
    } else {
        echo "<script>alert('Failed to send your message. Please try again later.'); window.location.href='contact.html';</script>";
    }

} else {
    echo "Invalid request!";
}
?>
