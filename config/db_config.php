<?php
/**
 * Database Configuration File
 * 
 * This file contains database connection parameters and utility functions
 */

// Database connection parameters
define('DB_HOST', 'localhost');
define('DB_USER', 'skyline_user');     // Change to your database username
define('DB_PASS', 'your_password');    // Change to your database password
define('DB_NAME', 'skyline_db');

// Create database connection
function connectDB() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    return $conn;
}

// Sanitize input data to prevent SQL injection
function sanitizeInput($data) {
    $conn = connectDB();
    return $conn->real_escape_string($data);
}

// Close database connection
function closeDB($conn) {
    $conn->close();
}

// Process form data
function processFormData($data) {
    $processedData = array();
    
    foreach ($data as $key => $value) {
        $processedData[$key] = htmlspecialchars(trim($value));
    }
    
    return $processedData;
}

// Log database errors
function logError($error, $query = '') {
    $errorLogFile = $_SERVER['DOCUMENT_ROOT'] . '/logs/db_errors.log';
    $timestamp = date('Y-m-d H:i:s');
    $logMessage = "[{$timestamp}] Error: {$error}" . ($query ? " | Query: {$query}" : "") . PHP_EOL;
    
    // Create directory if it doesn't exist
    if (!file_exists(dirname($errorLogFile))) {
        mkdir(dirname($errorLogFile), 0755, true);
    }
    
    error_log($logMessage, 3, $errorLogFile);
}
?> 