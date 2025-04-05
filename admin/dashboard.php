<?php
/**
 * Admin Dashboard
 * 
 * This page displays the admin dashboard with various management options.
 */

// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Include database config
require_once '../config/db_config.php';

// Connect to database
$conn = connectDB();

// Get user info
$userId = $_SESSION['user_id'];
$username = $_SESSION['username'];
$role = $_SESSION['role'];

// Get message count
$sql = "SELECT COUNT(*) as message_count FROM contact_messages";
$result = $conn->query($sql);
$messageCount = $result->fetch_assoc()['message_count'];

// Get messages (limited to 5 most recent)
$sql = "SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT 5";
$messagesResult = $conn->query($sql);

// Close connection
closeDB($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Skyline Technology</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles.css">
    <style>
        .admin-container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: var(--header-bg);
            color: var(--header-text);
            padding: 20px 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }
        
        .sidebar-header {
            display: flex;
            align-items: center;
            padding: 0 20px;
            margin-bottom: 30px;
        }
        
        .sidebar-logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            display: flex;
            align-items: center;
        }
        
        .sidebar-logo i {
            margin-right: 10px;
        }
        
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .sidebar-menu li {
            margin-bottom: 5px;
        }
        
        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: var(--header-text);
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .sidebar-menu a:hover, .sidebar-menu a.active {
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 4px solid var(--primary-color);
        }
        
        .sidebar-menu i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        .sidebar-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 15px 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        /* Main content */
        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 20px;
            background-color: var(--bg-color);
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            margin-bottom: 30px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }
        
        .user-info {
            display: flex;
            align-items: center;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-weight: bold;
        }
        
        /* Dashboard cards */
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .dashboard-card {
            background-color: var(--card-bg);
            border-radius: 10px;
            padding: 20px;
            box-shadow: var(--card-shadow);
            display: flex;
            align-items: center;
        }
        
        .card-icon {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            background-color: rgba(0, 119, 255, 0.1);
            color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-right: 15px;
        }
        
        .card-content h3 {
            margin: 0;
            font-size: 1.8rem;
        }
        
        .card-content p {
            margin: 5px 0 0;
            color: rgba(var(--text-color), 0.7);
        }
        
        /* Recent messages */
        .recent-messages {
            background-color: var(--card-bg);
            border-radius: 10px;
            padding: 20px;
            box-shadow: var(--card-shadow);
            margin-bottom: 30px;
        }
        
        .recent-messages h2 {
            margin-top: 0;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .view-all {
            font-size: 0.9rem;
            color: var(--primary-color);
        }
        
        .message-list {
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        
        .message-item {
            padding: 15px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
        }
        
        .message-item:last-child {
            border-bottom: none;
        }
        
        .message-item:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }
        
        .message-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        
        .message-sender {
            font-weight: 600;
        }
        
        .message-date {
            font-size: 0.85rem;
            color: rgba(var(--text-color), 0.6);
        }
        
        .message-subject {
            font-weight: 500;
            margin-bottom: 5px;
        }
        
        .message-preview {
            color: rgba(var(--text-color), 0.8);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .no-messages {
            padding: 20px;
            text-align: center;
            color: rgba(var(--text-color), 0.7);
        }
        
        /* Quick actions */
        .quick-actions {
            background-color: var(--card-bg);
            border-radius: 10px;
            padding: 20px;
            box-shadow: var(--card-shadow);
        }
        
        .quick-actions h2 {
            margin-top: 0;
            margin-bottom: 20px;
        }
        
        .action-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
        }
        
        .action-button {
            padding: 15px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: var(--text-color);
        }
        
        .action-button:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-color: var(--primary-color);
        }
        
        .action-icon {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 10px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
                z-index: 999;
            }
            
            .sidebar-logo span, .sidebar-menu span {
                display: none;
            }
            
            .sidebar-menu a {
                padding: 15px;
                justify-content: center;
            }
            
            .sidebar-menu i {
                margin: 0;
                font-size: 1.2rem;
            }
            
            .main-content {
                margin-left: 70px;
            }
            
            .sidebar-footer {
                display: none;
            }
        }
        
        @media (max-width: 576px) {
            .dashboard-cards {
                grid-template-columns: 1fr;
            }
            
            .action-buttons {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <i class="fas fa-layer-group"></i>
                    <span>Skyline Admin</span>
                </div>
            </div>
            <ul class="sidebar-menu">
                <li>
                    <a href="dashboard.php" class="active">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="messages.php">
                        <i class="fas fa-envelope"></i>
                        <span>Messages</span>
                    </a>
                </li>
                <li>
                    <a href="content.php">
                        <i class="fas fa-edit"></i>
                        <span>Edit Content</span>
                    </a>
                </li>
                <li>
                    <a href="users.php">
                        <i class="fas fa-users"></i>
                        <span>Manage Users</span>
                    </a>
                </li>
                <li>
                    <a href="settings.php">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="logout.php" style="color: var(--header-text); text-decoration: none;">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
        
        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1>Dashboard</h1>
                <div class="user-info">
                    <div class="user-avatar">
                        <?php echo strtoupper(substr($username, 0, 1)); ?>
                    </div>
                    <div>
                        <p style="margin: 0;"><?php echo htmlspecialchars($username); ?></p>
                        <small style="opacity: 0.7;"><?php echo ucfirst($role); ?></small>
                    </div>
                </div>
            </div>
            
            <!-- Dashboard Cards -->
            <div class="dashboard-cards">
                <div class="dashboard-card">
                    <div class="card-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="card-content">
                        <h3><?php echo $messageCount; ?></h3>
                        <p>Total Messages</p>
                    </div>
                </div>
                <div class="dashboard-card">
                    <div class="card-icon" style="background-color: rgba(41, 204, 151, 0.1); color: #29cc97;">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="card-content">
                        <h3>5</h3>
                        <p>Content Sections</p>
                    </div>
                </div>
                <div class="dashboard-card">
                    <div class="card-icon" style="background-color: rgba(254, 176, 25, 0.1); color: #feb019;">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-content">
                        <h3>1</h3>
                        <p>Admin Users</p>
                    </div>
                </div>
            </div>
            
            <!-- Recent Messages -->
            <div class="recent-messages">
                <h2>
                    Recent Messages
                    <a href="messages.php" class="view-all">View All</a>
                </h2>
                <div class="message-list">
                    <?php if ($messagesResult && $messagesResult->num_rows > 0): ?>
                        <?php while($message = $messagesResult->fetch_assoc()): ?>
                            <div class="message-item">
                                <div class="message-header">
                                    <div class="message-sender"><?php echo htmlspecialchars($message['name']); ?></div>
                                    <div class="message-date"><?php echo date('M d, Y', strtotime($message['created_at'])); ?></div>
                                </div>
                                <div class="message-subject"><?php echo htmlspecialchars($message['subject']); ?></div>
                                <div class="message-preview"><?php echo htmlspecialchars(substr($message['message'], 0, 100)); ?>...</div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="no-messages">No messages yet!</div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="quick-actions">
                <h2>Quick Actions</h2>
                <div class="action-buttons">
                    <a href="messages.php" class="action-button">
                        <div class="action-icon">
                            <i class="fas fa-envelope-open-text"></i>
                        </div>
                        <span>View Messages</span>
                    </a>
                    <a href="content.php" class="action-button">
                        <div class="action-icon">
                            <i class="fas fa-edit"></i>
                        </div>
                        <span>Edit Content</span>
                    </a>
                    <a href="../index.html" target="_blank" class="action-button">
                        <div class="action-icon">
                            <i class="fas fa-globe"></i>
                        </div>
                        <span>View Site</span>
                    </a>
                    <a href="logout.php" class="action-button">
                        <div class="action-icon">
                            <i class="fas fa-sign-out-alt"></i>
                        </div>
                        <span>Logout</span>
                    </a>
                </div>
            </div>
        </main>
    </div>
    
    <script>
        // Check if the document has a data-theme attribute
        const currentTheme = localStorage.getItem('theme') || 
                            (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        
        document.documentElement.setAttribute('data-theme', currentTheme);
    </script>
</body>
</html> 