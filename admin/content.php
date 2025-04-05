<?php
/**
 * Admin Content Management Page
 * 
 * This page allows admins to edit website content.
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

// Process form submissions
$successMessage = '';
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_content'])) {
    $section = sanitizeInput($_POST['section']);
    $title = sanitizeInput($_POST['title']);
    $content = sanitizeInput($_POST['content']);
    
    // Update content in database
    $sql = "UPDATE website_content SET title = ?, content = ? WHERE section = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("sss", $title, $content, $section);
        
        if ($stmt->execute()) {
            $successMessage = "Content for '$section' section has been updated successfully.";
        } else {
            $errorMessage = "Error updating content: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        $errorMessage = "Error preparing statement: " . $conn->error;
    }
}

// Get website content
$sql = "SELECT * FROM website_content ORDER BY section";
$contentResult = $conn->query($sql);

// Close connection
closeDB($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content Management - Skyline Technology Admin</title>
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
        
        /* Alerts */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        
        .alert-success {
            background-color: rgba(39, 174, 96, 0.1);
            border-left: 4px solid #27ae60;
            color: #27ae60;
        }
        
        .alert-danger {
            background-color: rgba(231, 76, 60, 0.1);
            border-left: 4px solid #e74c3c;
            color: #e74c3c;
        }
        
        /* Content sections */
        .content-sections {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        
        .content-section {
            background-color: var(--card-bg);
            border-radius: 10px;
            padding: 20px;
            box-shadow: var(--card-shadow);
            margin-bottom: 20px;
            width: 100%;
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }
        
        .section-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary-color);
            display: flex;
            align-items: center;
        }
        
        .section-title i {
            margin-right: 8px;
        }
        
        .content-form .form-group {
            margin-bottom: 15px;
        }
        
        .content-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }
        
        .content-form input[type="text"],
        .content-form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            font-family: inherit;
            font-size: 1rem;
            background-color: var(--input-bg);
            color: var(--text-color);
        }
        
        .content-form textarea {
            min-height: 150px;
            resize: vertical;
        }
        
        .content-form input[type="text"]:focus,
        .content-form textarea:focus {
            border-color: var(--primary-color);
            outline: none;
        }
        
        .content-form button {
            padding: 10px 20px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .content-form button:hover {
            background-color: var(--primary-dark);
        }
        
        .preview-button {
            background-color: transparent;
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .preview-button:hover {
            background-color: var(--primary-color);
            color: white;
        }
        
        /* Content Preview Modal */
        .preview-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }
        
        .preview-modal-content {
            background-color: var(--card-bg);
            margin: 10% auto;
            padding: 30px;
            border-radius: 10px;
            width: 70%;
            box-shadow: var(--card-shadow);
            animation: slideIn 0.3s ease;
        }
        
        .preview-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }
        
        .preview-modal-close {
            font-size: 1.5rem;
            cursor: pointer;
            transition: color 0.3s;
        }
        
        .preview-modal-close:hover {
            color: var(--primary-color);
        }
        
        .preview-content {
            white-space: pre-line;
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
            
            .preview-modal-content {
                width: 90%;
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
                    <a href="messages.php">
                        <i class="fas fa-envelope"></i>
                        <span>Messages</span>
                    </a>
                </li>
                <li>
                    <a href="content.php" class="active">
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
                <h1>Content Management</h1>
            </div>
            
            <?php if ($successMessage): ?>
                <div class="alert alert-success">
                    <?php echo $successMessage; ?>
                </div>
            <?php endif; ?>
            
            <?php if ($errorMessage): ?>
                <div class="alert alert-danger">
                    <?php echo $errorMessage; ?>
                </div>
            <?php endif; ?>
            
            <div class="content-sections">
                <?php if ($contentResult && $contentResult->num_rows > 0): ?>
                    <?php while ($content = $contentResult->fetch_assoc()): ?>
                        <div class="content-section">
                            <div class="section-header">
                                <div class="section-title">
                                    <i class="fas fa-file-alt"></i> 
                                    <?php echo ucfirst(htmlspecialchars($content['section'])); ?> Section
                                </div>
                                <button class="preview-button" onclick="previewContent('<?php echo htmlspecialchars($content['title']); ?>', '<?php echo htmlspecialchars(addslashes($content['content'])); ?>')">
                                    <i class="fas fa-eye"></i> Preview
                                </button>
                            </div>
                            
                            <form class="content-form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <input type="hidden" name="section" value="<?php echo htmlspecialchars($content['section']); ?>">
                                
                                <div class="form-group">
                                    <label for="title-<?php echo htmlspecialchars($content['section']); ?>">Title</label>
                                    <input type="text" id="title-<?php echo htmlspecialchars($content['section']); ?>" name="title" value="<?php echo htmlspecialchars($content['title']); ?>" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="content-<?php echo htmlspecialchars($content['section']); ?>">Content</label>
                                    <textarea id="content-<?php echo htmlspecialchars($content['section']); ?>" name="content" required><?php echo htmlspecialchars($content['content']); ?></textarea>
                                </div>
                                
                                <button type="submit" name="update_content">
                                    <i class="fas fa-save"></i> Save Changes
                                </button>
                            </form>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="content-section">
                        <p>No content sections found. Please run the database setup script to create default content.</p>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
    
    <!-- Content Preview Modal -->
    <div id="previewModal" class="preview-modal">
        <div class="preview-modal-content">
            <div class="preview-modal-header">
                <h2 id="previewTitle">Content Preview</h2>
                <span class="preview-modal-close" onclick="closePreviewModal()">&times;</span>
            </div>
            <div id="previewContent" class="preview-content">
                Preview content will appear here...
            </div>
        </div>
    </div>
    
    <script>
        // Check if the document has a data-theme attribute
        const currentTheme = localStorage.getItem('theme') || 
                            (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        
        document.documentElement.setAttribute('data-theme', currentTheme);
        
        // Preview modal functions
        const previewModal = document.getElementById("previewModal");
        
        function previewContent(title, content) {
            document.getElementById("previewTitle").textContent = title;
            document.getElementById("previewContent").textContent = content;
            previewModal.style.display = "block";
        }
        
        function closePreviewModal() {
            previewModal.style.display = "none";
        }
        
        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target == previewModal) {
                closePreviewModal();
            }
        }
        
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.display = 'none';
            });
        }, 5000);
    </script>
</body>
</html> 