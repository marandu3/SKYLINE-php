<?php
/**
 * Utility Functions for Skyline Technology Website
 * This file contains common functions used across multiple pages
 */

/**
 * Sanitize user input to prevent XSS attacks
 * 
 * @param string $data The input data to sanitize
 * @return string Sanitized data
 */
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

/**
 * Format date in a human-readable format
 * 
 * @param string $date The date string to format
 * @param string $format The desired format (defaults to 'M d, Y h:i A')
 * @return string Formatted date
 */
function formatDate($date, $format = 'M d, Y h:i A') {
    $timestamp = strtotime($date);
    return date($format, $timestamp);
}

/**
 * Generate a CSRF token for form security
 * 
 * @return string Generated CSRF token
 */
function generateCSRFToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Verify CSRF token from form submission
 * 
 * @param string $token The submitted token to verify
 * @return bool True if token is valid, false otherwise
 */
function verifyCSRFToken($token) {
    if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
        return false;
    }
    return true;
}

/**
 * Truncate text to a specified length
 * 
 * @param string $text The text to truncate
 * @param int $length Maximum length before truncation
 * @param string $append Text to append if truncated (default: '...')
 * @return string Truncated text
 */
function truncateText($text, $length = 100, $append = '...') {
    if (strlen($text) <= $length) {
        return $text;
    }
    
    $text = substr($text, 0, $length);
    $text = substr($text, 0, strrpos($text, ' '));
    
    return $text . $append;
}

/**
 * Check if user is logged in
 * 
 * @return bool True if user is logged in, false otherwise
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

/**
 * Redirect to a specified URL
 * 
 * @param string $url The URL to redirect to
 * @param int $statusCode HTTP status code (default: 302)
 * @return void
 */
function redirect($url, $statusCode = 302) {
    header('Location: ' . $url, true, $statusCode);
    exit;
}

/**
 * Log activity to database
 * 
 * @param PDO $pdo Database connection
 * @param int $userId User ID (0 for system)
 * @param string $action Action performed
 * @param string $description Description of the action
 * @return bool True on success, false on failure
 */
function logActivity($pdo, $userId, $action, $description) {
    try {
        $stmt = $pdo->prepare("INSERT INTO activity_log (user_id, action, description, ip_address, created_at) 
                               VALUES (:user_id, :action, :description, :ip_address, NOW())");
        
        $ipAddress = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
        
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':action', $action, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':ip_address', $ipAddress, PDO::PARAM_STR);
        
        return $stmt->execute();
    } catch (PDOException $e) {
        // Log error silently
        error_log('Error logging activity: ' . $e->getMessage());
        return false;
    }
}

/**
 * Generate a random string
 * 
 * @param int $length Length of the random string
 * @param string $keyspace Characters to use (default: alphanumeric)
 * @return string Random string
 */
function generateRandomString($length = 10, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
    $str = '';
    $max = mb_strlen($keyspace, '8bit') - 1;
    
    for ($i = 0; $i < $length; ++$i) {
        $str .= $keyspace[random_int(0, $max)];
    }
    
    return $str;
}

/**
 * Create a slug from a string
 * 
 * @param string $string The string to convert to a slug
 * @return string URL-friendly slug
 */
function createSlug($string) {
    // Replace non-alphanumeric characters with hyphens
    $string = preg_replace('/[^a-z0-9]+/i', '-', $string);
    // Remove hyphens from beginning and end
    $string = trim($string, '-');
    // Convert to lowercase
    $string = strtolower($string);
    
    return $string;
}

/**
 * Get base URL of the website
 * 
 * @param bool $includeProtocol Whether to include http/https protocol
 * @return string Base URL
 */
function getBaseUrl($includeProtocol = true) {
    $protocol = ($includeProtocol) ? (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' : '';
    $host = $_SERVER['HTTP_HOST'] ?? '';
    $scriptDir = dirname($_SERVER['SCRIPT_NAME']);
    $baseUrl = $protocol . $host . rtrim($scriptDir, '/\\');
    
    return $baseUrl;
}

/**
 * Get current page URL
 * 
 * @return string Current page URL
 */
function getCurrentUrl() {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? '';
    $uri = $_SERVER['REQUEST_URI'] ?? '';
    
    return $protocol . '://' . $host . $uri;
}

/**
 * Check if string contains a specific substring
 * 
 * @param string $haystack The string to search in
 * @param string|array $needle The substring(s) to search for
 * @return bool True if substring is found, false otherwise
 */
function strContains($haystack, $needle) {
    if (is_array($needle)) {
        foreach ($needle as $n) {
            if (strpos($haystack, $n) !== false) {
                return true;
            }
        }
        return false;
    }
    
    return strpos($haystack, $needle) !== false;
}

/**
 * Include header template
 * 
 * @param string $title Page title
 * @param string $description Meta description
 * @param array $extra Additional parameters
 * @return void
 */
function includeHeader($title = 'Skyline Technology', $description = '', $extra = []) {
    include_once 'includes/header.php';
}

/**
 * Include footer template
 * 
 * @param array $extra Additional parameters
 * @return void
 */
function includeFooter($extra = []) {
    include_once 'includes/footer.php';
} 