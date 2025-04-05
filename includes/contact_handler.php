<?php
/**
 * Contact Form Handler
 * 
 * This script processes contact form submissions and stores them in the database.
 * It also sends an email notification to the site administrator.
 */

// Include database configuration
require_once '../config/db_config.php';

// Set header for JSON response
header('Content-Type: application/json');

// Process only POST requests
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method.'
    ]);
    exit;
}

// Get form data
$formData = processFormData($_POST);

// Validate required fields
$requiredFields = ['name', 'email', 'subject', 'message'];
$missingFields = [];

foreach ($requiredFields as $field) {
    if (empty($formData[$field])) {
        $missingFields[] = $field;
    }
}

if (!empty($missingFields)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Please fill in all required fields.',
        'fields' => $missingFields
    ]);
    exit;
}

// Validate email format
if (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Please enter a valid email address.',
        'fields' => ['email']
    ]);
    exit;
}

// Connect to database
$conn = connectDB();

// Sanitize inputs to prevent SQL injection
$name = sanitizeInput($formData['name']);
$email = sanitizeInput($formData['email']);
$subject = sanitizeInput($formData['subject']);
$message = sanitizeInput($formData['message']);

// Prepare SQL and bind parameters
$sql = "INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    logError($conn->error, $sql);
    echo json_encode([
        'status' => 'error',
        'message' => 'Sorry, there was a problem processing your request. Please try again later.'
    ]);
    exit;
}

$stmt->bind_param("ssss", $name, $email, $subject, $message);

// Execute the statement
if ($stmt->execute()) {
    // Send email notification to admin
    $to = "admin@skylinetech.com"; // Change to your email
    $email_subject = "New Contact Form Submission: $subject";
    $email_body = "You have received a new message from $name.\n\n";
    $email_body .= "Email: $email\n\n";
    $email_body .= "Message:\n$message\n";
    
    $headers = "From: $email";
    
    // Try to send email
    $mailSent = @mail($to, $email_subject, $email_body, $headers);
    
    // Close the statement and connection
    $stmt->close();
    closeDB($conn);
    
    echo json_encode([
        'status' => 'success',
        'message' => 'Thank you for your message! We will get back to you soon.',
        'email_sent' => $mailSent
    ]);
} else {
    // Log the error
    logError($stmt->error, $sql);
    
    // Close the statement and connection
    $stmt->close();
    closeDB($conn);
    
    echo json_encode([
        'status' => 'error',
        'message' => 'Sorry, there was a problem submitting your message. Please try again later.'
    ]);
}
?> 