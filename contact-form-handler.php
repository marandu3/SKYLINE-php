<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Retrieve and sanitize form inputs
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // 2. Validate inputs
    if (empty($name) || empty($email) || empty($message)) {
        echo "Error: All fields are required.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Error: Invalid email address.";
        exit;
    }

    // 3. Compose email
    $to = "your-email@example.com"; // Replace with your email
    $email_subject = "Contact Form Submission: $subject";
    $email_body = "You have received a new message from $name.\n\n";
    $email_body .= "Email: $email\n\n";
    $email_body .= "Message:\n$message\n";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // 4. Send email
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "Success: Thank you, $name! Your message has been sent.";
    } else {
        echo "Error: Something went wrong. Please try again later.";
    }
} else {
    echo "Error: Invalid request.";
}
?>
