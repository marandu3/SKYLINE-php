<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate inputs
    if (!empty($name) && !empty($email) && !empty($message)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Email content
            $to = "your-email@example.com"; // Replace with your email
            $email_subject = "New Contact Form Submission: $subject";
            $email_body = "Name: $name\n";
            $email_body .= "Email: $email\n\n";
            $email_body .= "Message:\n$message\n";

            $headers = "From: $email";

            // Send the email
            if (mail($to, $email_subject, $email_body, $headers)) {
                echo "Thank you, $name! Your message has been sent.";
            } else {
                echo "Sorry, something went wrong. Please try again later.";
            }
        } else {
            echo "Invalid email format.";
        }
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request.";
}
?>
