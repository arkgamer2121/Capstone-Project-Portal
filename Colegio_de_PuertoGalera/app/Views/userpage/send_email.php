<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['msg'];

    // Validate form data (you can add more validation as needed)
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        error_log("All fields are required");
        exit;
    }

    // Set up email parameters
    $to = "dextherbdelmonte@gmail.com";
    $headers = "From: $name <$email>" . "\r\n";
    $headers .= "Reply-To: $email" . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";

    // Send email
    if (mail($to, $subject, $message, $headers)) {
        echo "Your message has been sent successfully.";
    } else {
        error_log("Failed to send email");
        echo "Failed to send your message. Please try again later.";
    }
} else {
    // Redirect if accessed directly
    header("Location: /");
    exit;
}
?>
