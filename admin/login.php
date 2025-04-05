<?php
/**
 * Admin Login Page
 */

// Start session
session_start();

// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

// Include database config
require_once '../config/db_config.php';

$error = '';

// Process login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize login data
    $username = sanitizeInput($_POST['username']);
    $password = $_POST['password']; // Don't sanitize password
    
    // Connect to database
    $conn = connectDB();
    
    // Prepare SQL statement
    $sql = "SELECT id, username, password, role FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        $error = "An error occurred. Please try again later.";
    } else {
        // Bind parameters
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            
            // Verify password
            if (password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                
                // Redirect to dashboard
                header("Location: dashboard.php");
                exit;
            } else {
                $error = "Invalid username or password";
            }
        } else {
            $error = "Invalid username or password";
        }
        
        $stmt->close();
    }
    
    closeDB($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Skyline Technology</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles.css">
    <style>
        .login-container {
            max-width: 400px;
            margin: 80px auto;
            padding: 30px;
            background-color: var(--card-bg);
            border-radius: 10px;
            box-shadow: var(--card-shadow);
        }
        
        .login-logo {
            text-align: center;
            margin-bottom: 25px;
        }
        
        .login-logo i {
            font-size: 3rem;
            color: var(--primary-color);
        }
        
        .login-title {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .error-message {
            color: #e74c3c;
            background-color: rgba(231, 76, 60, 0.1);
            border-left: 3px solid #e74c3c;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 3px;
        }
        
        .login-form .form-group {
            margin-bottom: 20px;
        }
        
        .login-form .form-group label {
            margin-bottom: 8px;
        }
        
        .login-form .form-control {
            background-color: var(--input-bg);
            color: var(--text-color);
            padding: 12px 15px;
        }
        
        .login-form .btn {
            width: 100%;
            padding: 12px;
        }
        
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-logo">
            <i class="fas fa-layer-group"></i>
        </div>
        <div class="login-title">
            <h2>Admin Login</h2>
            <p>Enter your credentials to access the admin dashboard</p>
        </div>
        
        <?php if ($error): ?>
        <div class="error-message">
            <?php echo $error; ?>
        </div>
        <?php endif; ?>
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="login-form">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        
        <div class="back-link">
            <a href="../index.html"><i class="fas fa-arrow-left"></i> Back to Website</a>
        </div>
    </div>
    
    <script>
        // Check if the document has a data-theme attribute
        const currentTheme = localStorage.getItem('theme') || 
                            (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        
        document.documentElement.setAttribute('data-theme', currentTheme);
    </script>
</body>
</html> 