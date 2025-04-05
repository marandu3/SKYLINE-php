<?php
/**
 * Database Setup Script
 * 
 * This script creates the database and tables required for the Skyline Technology website
 */

// Connection parameters for root/admin user
$host = 'localhost';
$user = 'root';  // Replace with your MySQL admin username
$pass = '';      // Replace with your MySQL admin password

// Create connection to MySQL server (without selecting a database)
$conn = new mysqli($host, $user, $pass);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Database name and user settings
$dbName = 'skyline_db';
$dbUser = 'skyline_user';
$dbPass = 'your_password';  // Change this to a secure password

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS $dbName";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
    die();
}

// Create user and grant privileges
$sql = "CREATE USER IF NOT EXISTS '$dbUser'@'localhost' IDENTIFIED BY '$dbPass'";
if ($conn->query($sql) === TRUE) {
    echo "User created successfully<br>";
} else {
    echo "Error creating user: " . $conn->error . "<br>";
}

$sql = "GRANT ALL PRIVILEGES ON $dbName.* TO '$dbUser'@'localhost'";
if ($conn->query($sql) === TRUE) {
    echo "Privileges granted successfully<br>";
} else {
    echo "Error granting privileges: " . $conn->error . "<br>";
}

$conn->query("FLUSH PRIVILEGES");

// Select the database
$conn->select_db($dbName);

// Create contact_messages table
$sql = "CREATE TABLE IF NOT EXISTS contact_messages (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'contact_messages' created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Create users table for admin login
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    role ENUM('admin', 'editor') NOT NULL DEFAULT 'editor',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'users' created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Insert default admin user
$defaultUsername = 'admin';
$defaultPassword = password_hash('admin123', PASSWORD_DEFAULT); // Change this password in production
$defaultEmail = 'admin@skylinetech.com';

$sql = "INSERT INTO users (username, password, email, role) 
        SELECT '$defaultUsername', '$defaultPassword', '$defaultEmail', 'admin' 
        FROM dual 
        WHERE NOT EXISTS (SELECT 1 FROM users WHERE username = '$defaultUsername')";

if ($conn->query($sql) === TRUE) {
    echo "Default admin user created successfully<br>";
} else {
    echo "Error creating default user: " . $conn->error . "<br>";
}

// Create website_content table for editable content
$sql = "CREATE TABLE IF NOT EXISTS website_content (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    section VARCHAR(50) NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'website_content' created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Insert default content
$defaultContent = [
    ['hero', 'Welcome to Skyline Technology', 'Your trusted partner in IT solutions'],
    ['about', 'About Us', 'Skyline Technology specializes in IT services including Web design, Software development, Networking, and IT maintenance. We are committed to delivering innovative solutions to drive your success.'],
    ['services', 'Our Services', 'We provide top-notch services tailored to your business needs.'],
    ['team', 'Meet Our Team', 'A dedicated team of IT experts ready to serve you.'],
    ['contact', 'Contact Us', 'Get in touch with us today. We\'d love to hear from you!']
];

foreach ($defaultContent as $content) {
    $section = $content[0];
    $title = $content[1];
    $contentText = $content[2];
    
    $sql = "INSERT INTO website_content (section, title, content) 
            SELECT '$section', '$title', '$contentText' 
            FROM dual 
            WHERE NOT EXISTS (SELECT 1 FROM website_content WHERE section = '$section')";
    
    $conn->query($sql);
}

echo "Default content added successfully<br>";

// Close connection
$conn->close();

echo "<br>Database setup complete. Remember to update the database credentials in config/db_config.php";
?> 