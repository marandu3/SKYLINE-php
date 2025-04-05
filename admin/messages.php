<?php
/**
 * Admin Messages Page
 * 
 * This page displays all contact messages and allows the admin to manage them.
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

// Handle message deletion
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $messageId = $_GET['delete'];
    $sql = "DELETE FROM contact_messages WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $messageId);
    $stmt->execute();
    $stmt->close();
    
    // Redirect to remove the delete parameter
    header("Location: messages.php");
    exit;
}

// Handle message read status
if (isset($_GET['read']) && is_numeric($_GET['read'])) {
    $messageId = $_GET['read'];
    $sql = "UPDATE contact_messages SET is_read = 1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $messageId);
    $stmt->execute();
    $stmt->close();
    
    // Redirect to remove the read parameter
    header("Location: messages.php");
    exit;
}

// Pagination settings
$limit = 10; // Messages per page
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $limit;

// Get total message count
$sql = "SELECT COUNT(*) as total FROM contact_messages";
$result = $conn->query($sql);
$totalMessages = $result->fetch_assoc()['total'];
$totalPages = ceil($totalMessages / $limit);

// Get messages for current page
$sql = "SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$messagesResult = $stmt->get_result();
$stmt->close();

// Close connection
closeDB($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages - Skyline Technology Admin</title>
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
        
        /* Messages table */
        .messages-container {
            background-color: var(--card-bg);
            border-radius: 10px;
            padding: 20px;
            box-shadow: var(--card-shadow);
            margin-bottom: 30px;
        }
        
        .messages-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .messages-table th, .messages-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }
        
        .messages-table th {
            font-weight: 600;
            color: var(--primary-color);
            background-color: rgba(0, 119, 255, 0.05);
        }
        
        .messages-table tbody tr {
            transition: background-color 0.3s;
        }
        
        .messages-table tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }
        
        .table-actions {
            display: flex;
            gap: 10px;
        }
        
        .table-actions a {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            color: white;
            transition: opacity 0.3s;
        }
        
        .table-actions a:hover {
            opacity: 0.8;
        }
        
        .action-view {
            background-color: var(--primary-color);
        }
        
        .action-delete {
            background-color: #e74c3c;
        }
        
        .no-messages {
            padding: 30px;
            text-align: center;
            color: rgba(var(--text-color), 0.7);
        }
        
        /* Message modal */
        .message-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            overflow: auto;
        }
        
        .modal-content {
            background-color: var(--card-bg);
            margin: 10% auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: var(--card-shadow);
            width: 60%;
            max-width: 700px;
            animation: slideIn 0.3s ease;
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }
        
        .modal-close {
            font-size: 1.5rem;
            cursor: pointer;
            transition: color 0.3s;
        }
        
        .modal-close:hover {
            color: var(--primary-color);
        }
        
        .message-details {
            margin-bottom: 20px;
        }
        
        .message-details .info-item {
            margin-bottom: 15px;
        }
        
        .message-details .label {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 5px;
        }
        
        .message-content {
            padding: 15px;
            background-color: rgba(0, 0, 0, 0.02);
            border-radius: 5px;
            white-space: pre-line;
        }
        
        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 5px;
            margin-top: 20px;
        }
        
        .pagination a, .pagination span {
            display: inline-block;
            padding: 5px 10px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            text-decoration: none;
            color: var(--text-color);
            transition: all 0.3s;
        }
        
        .pagination a:hover {
            background-color: rgba(0, 119, 255, 0.1);
            border-color: var(--primary-color);
        }
        
        .pagination .active {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }
        
        .pagination .disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        
        /* Animations */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
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
            
            .modal-content {
                width: 90%;
            }
            
            .messages-table .mobile-hide {
                display: none;
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
                    <a href="dashboard.php">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="messages.php" class="active">
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
                <h1>Contact Messages</h1>
            </div>
            
            <!-- Messages Container -->
            <div class="messages-container">
                <?php if ($messagesResult && $messagesResult->num_rows > 0): ?>
                    <table class="messages-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th class="mobile-hide">Subject</th>
                                <th class="mobile-hide">Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($message = $messagesResult->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($message['name']); ?></td>
                                    <td><?php echo htmlspecialchars($message['email']); ?></td>
                                    <td class="mobile-hide"><?php echo htmlspecialchars($message['subject']); ?></td>
                                    <td class="mobile-hide"><?php echo date('M d, Y', strtotime($message['created_at'])); ?></td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="#" class="action-view" onclick="viewMessage(<?php echo $message['id']; ?>, '<?php echo htmlspecialchars(addslashes($message['name'])); ?>', '<?php echo htmlspecialchars(addslashes($message['email'])); ?>', '<?php echo htmlspecialchars(addslashes($message['subject'])); ?>', '<?php echo htmlspecialchars(addslashes($message['message'])); ?>', '<?php echo date('M d, Y H:i', strtotime($message['created_at'])); ?>')">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="messages.php?delete=<?php echo $message['id']; ?>" class="action-delete" onclick="return confirm('Are you sure you want to delete this message?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    
                    <!-- Pagination -->
                    <?php if ($totalPages > 1): ?>
                        <div class="pagination">
                            <?php if ($page > 1): ?>
                                <a href="?page=<?php echo $page - 1; ?>"><i class="fas fa-chevron-left"></i></a>
                            <?php else: ?>
                                <span class="disabled"><i class="fas fa-chevron-left"></i></span>
                            <?php endif; ?>
                            
                            <?php
                            $startPage = max(1, $page - 2);
                            $endPage = min($totalPages, $startPage + 4);
                            
                            if ($startPage > 1) {
                                echo '<a href="?page=1">1</a>';
                                if ($startPage > 2) {
                                    echo '<span>...</span>';
                                }
                            }
                            
                            for ($i = $startPage; $i <= $endPage; $i++) {
                                echo $i == $page 
                                    ? '<span class="active">' . $i . '</span>' 
                                    : '<a href="?page=' . $i . '">' . $i . '</a>';
                            }
                            
                            if ($endPage < $totalPages) {
                                if ($endPage < $totalPages - 1) {
                                    echo '<span>...</span>';
                                }
                                echo '<a href="?page=' . $totalPages . '">' . $totalPages . '</a>';
                            }
                            ?>
                            
                            <?php if ($page < $totalPages): ?>
                                <a href="?page=<?php echo $page + 1; ?>"><i class="fas fa-chevron-right"></i></a>
                            <?php else: ?>
                                <span class="disabled"><i class="fas fa-chevron-right"></i></span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    
                <?php else: ?>
                    <div class="no-messages">
                        <i class="fas fa-inbox" style="font-size: 3rem; color: var(--primary-color); margin-bottom: 15px;"></i>
                        <h3>No Messages Yet</h3>
                        <p>When visitors submit contact forms, their messages will appear here.</p>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
    
    <!-- Message Modal -->
    <div id="messageModal" class="message-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalSubject">Message Subject</h2>
                <span class="modal-close" onclick="closeModal()">&times;</span>
            </div>
            <div class="message-details">
                <div class="info-item">
                    <div class="label">From</div>
                    <div id="modalFrom">Sender Name</div>
                </div>
                <div class="info-item">
                    <div class="label">Email</div>
                    <div id="modalEmail">sender@example.com</div>
                </div>
                <div class="info-item">
                    <div class="label">Date</div>
                    <div id="modalDate">Jan 1, 2023</div>
                </div>
                <div class="info-item">
                    <div class="label">Message</div>
                    <div id="modalMessage" class="message-content">Message content goes here...</div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Check if the document has a data-theme attribute
        const currentTheme = localStorage.getItem('theme') || 
                            (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        
        document.documentElement.setAttribute('data-theme', currentTheme);
        
        // Modal functions
        const modal = document.getElementById("messageModal");
        
        function viewMessage(id, name, email, subject, message, date) {
            document.getElementById("modalSubject").textContent = subject;
            document.getElementById("modalFrom").textContent = name;
            document.getElementById("modalEmail").textContent = email;
            document.getElementById("modalDate").textContent = date;
            document.getElementById("modalMessage").textContent = message;
            
            modal.style.display = "block";
            
            // Mark as read if not already
            fetch(`messages.php?read=${id}`, { method: 'GET' })
                .then(response => {
                    // No need to do anything with the response
                })
                .catch(error => {
                    console.error('Error marking message as read:', error);
                });
            
            return false;
        }
        
        function closeModal() {
            modal.style.display = "none";
        }
        
        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</body>
</html> 