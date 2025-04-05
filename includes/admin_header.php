<?php
/**
 * Admin Header Template
 * Used across admin pages for consistent header
 */

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in, redirect if not
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Get current page
$currentPage = basename($_SERVER['PHP_SELF']);

// Default values
$pageTitle = $title ?? 'Admin Dashboard - Skyline Technology';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../assets/images/favicon.png">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Admin Styles -->
    <style>
        :root {
            --primary-color: #4a6cf7;
            --secondary-color: #6b7a99;
            --success-color: #13ce66;
            --danger-color: #f44336;
            --warning-color: #ffa500;
            --info-color: #50b5ff;
            --dark-color: #1e293b;
            --light-color: #f8f9fa;
            --body-bg: #f5f5f7;
            --sidebar-bg: #fff;
            --card-bg: #fff;
            --text-color: #334155;
            --border-color: #e2e8f0;
            --header-height: 60px;
            --sidebar-width: 250px;
        }
        
        /* Dark Mode */
        .dark-mode {
            --primary-color: #4e7df9;
            --secondary-color: #8896ab;
            --body-bg: #121a29;
            --sidebar-bg: #1a2337;
            --card-bg: #1a2337;
            --text-color: #e2e8f0;
            --border-color: #334155;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', sans-serif;
            background-color: var(--body-bg);
            color: var(--text-color);
            transition: background-color 0.3s ease, color 0.3s ease;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        /* Header Styles */
        .admin-header {
            height: var(--header-height);
            background-color: var(--card-bg);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            position: fixed;
            top: 0;
            right: 0;
            left: var(--sidebar-width);
            z-index: 100;
            transition: left 0.3s ease;
        }
        
        .admin-header .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }
        
        .admin-header .page-title {
            font-size: 1.2rem;
            font-weight: 500;
            margin: 0;
        }
        
        .admin-header .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .admin-header .btn-theme-toggle {
            background: none;
            border: none;
            color: var(--text-color);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem;
            border-radius: 50%;
            transition: background-color 0.3s ease;
        }
        
        .admin-header .btn-theme-toggle:hover {
            background-color: var(--border-color);
        }
        
        .admin-header .user-dropdown {
            position: relative;
            cursor: pointer;
        }
        
        .admin-header .user-dropdown .user-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 0.75rem;
            border-radius: 0.5rem;
            transition: background-color 0.3s ease;
        }
        
        .admin-header .user-dropdown .user-info:hover {
            background-color: var(--border-color);
        }
        
        .admin-header .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
        }
        
        .admin-header .user-name {
            font-weight: 500;
        }
        
        .admin-header .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 0.5rem;
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 0;
            min-width: 200px;
            z-index: 101;
            display: none;
        }
        
        .admin-header .user-dropdown.active .dropdown-menu {
            display: block;
        }
        
        .admin-header .dropdown-item {
            padding: 0.5rem 1rem;
            color: var(--text-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: background-color 0.3s ease;
        }
        
        .admin-header .dropdown-item:hover {
            background-color: var(--border-color);
        }
        
        .admin-header .dropdown-item i {
            width: 20px;
        }
        
        /* Sidebar Styles */
        .admin-sidebar {
            width: var(--sidebar-width);
            background-color: var(--sidebar-bg);
            border-right: 1px solid var(--border-color);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 101;
            transition: transform 0.3s ease, width 0.3s ease;
            overflow-y: auto;
        }
        
        .admin-sidebar .sidebar-header {
            height: var(--header-height);
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            border-bottom: 1px solid var(--border-color);
        }
        
        .admin-sidebar .logo {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .admin-sidebar .sidebar-nav {
            padding: 1.5rem 0;
        }
        
        .admin-sidebar .nav-item {
            margin-bottom: 0.25rem;
        }
        
        .admin-sidebar .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1.5rem;
            color: var(--secondary-color);
            text-decoration: none;
            transition: background-color 0.3s ease, color 0.3s ease;
            border-left: 3px solid transparent;
        }
        
        .admin-sidebar .nav-link:hover {
            background-color: var(--border-color);
            color: var(--primary-color);
        }
        
        .admin-sidebar .nav-link.active {
            background-color: rgba(74, 108, 247, 0.1);
            color: var(--primary-color);
            border-left-color: var(--primary-color);
        }
        
        .admin-sidebar .nav-link i {
            width: 20px;
            text-align: center;
        }
        
        /* Main Content */
        .admin-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--header-height);
            padding: 2rem;
            flex: 1;
            transition: margin-left 0.3s ease;
        }
        
        /* Responsive */
        .sidebar-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--text-color);
            cursor: pointer;
            font-size: 1.25rem;
            padding: 0;
            margin-right: 1rem;
        }
        
        @media (max-width: 768px) {
            .sidebar-toggle {
                display: block;
            }
            
            .admin-sidebar {
                transform: translateX(-100%);
            }
            
            .admin-sidebar.active {
                transform: translateX(0);
            }
            
            .admin-header {
                left: 0;
            }
            
            .admin-content {
                margin-left: 0;
            }
        }
        
        /* Card Styles */
        .card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            overflow: hidden;
            transition: box-shadow 0.3s ease;
        }
        
        .card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .card-header, .card-footer {
            background-color: var(--card-bg);
            border-color: var(--border-color);
            padding: 1rem 1.5rem;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        /* Stats Card */
        .stats-card {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.5rem;
        }
        
        .stats-card .stats-icon {
            width: 48px;
            height: 48px;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        
        .stats-card .stats-info {
            flex: 1;
        }
        
        .stats-card .stats-label {
            font-size: 0.875rem;
            color: var(--secondary-color);
            margin-bottom: 0.25rem;
        }
        
        .stats-card .stats-value {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
        }
        
        /* Form Styles */
        .form-control, .form-select {
            background-color: var(--card-bg);
            border-color: var(--border-color);
            color: var(--text-color);
        }
        
        .form-control:focus, .form-select:focus {
            background-color: var(--card-bg);
            border-color: var(--primary-color);
            color: var(--text-color);
            box-shadow: 0 0 0 0.25rem rgba(74, 108, 247, 0.25);
        }
        
        /* Table Styles */
        .table {
            color: var(--text-color);
        }
        
        .table th {
            font-weight: 500;
            border-bottom-width: 1px;
            border-color: var(--border-color);
            white-space: nowrap;
        }
        
        .table td {
            border-color: var(--border-color);
        }
        
        /* Button Styles */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: #3b5ce5;
            border-color: #3b5ce5;
        }
        
        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        /* Modal Styles */
        .modal-content {
            background-color: var(--card-bg);
            color: var(--text-color);
        }
        
        .modal-header, .modal-footer {
            border-color: var(--border-color);
        }
        
        /* Utility Classes */
        .text-primary { color: var(--primary-color) !important; }
        .text-success { color: var(--success-color) !important; }
        .text-danger { color: var(--danger-color) !important; }
        .text-warning { color: var(--warning-color) !important; }
        .text-info { color: var(--info-color) !important; }
        
        .bg-primary { background-color: var(--primary-color) !important; }
        .bg-success { background-color: var(--success-color) !important; }
        .bg-danger { background-color: var(--danger-color) !important; }
        .bg-warning { background-color: var(--warning-color) !important; }
        .bg-info { background-color: var(--info-color) !important; }
        
        /* Alert Styles */
        .alert {
            border-radius: 0.5rem;
            border: none;
        }
        
        .alert-primary {
            background-color: rgba(74, 108, 247, 0.1);
            color: var(--primary-color);
        }
        
        .alert-success {
            background-color: rgba(19, 206, 102, 0.1);
            color: var(--success-color);
        }
        
        .alert-danger {
            background-color: rgba(244, 67, 54, 0.1);
            color: var(--danger-color);
        }
        
        .alert-warning {
            background-color: rgba(255, 165, 0, 0.1);
            color: var(--warning-color);
        }
    </style>
    
    <?php if (isset($extraStyles)): ?>
        <style><?php echo $extraStyles; ?></style>
    <?php endif; ?>
</head>
<body class="<?php echo isset($_COOKIE['admin_theme']) && $_COOKIE['admin_theme'] === 'dark' ? 'dark-mode' : ''; ?>">
    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="sidebar-header">
            <a href="dashboard.php" class="logo">
                <i class="fas fa-layer-group"></i>
                <span>Skyline Admin</span>
            </a>
        </div>
        
        <nav class="sidebar-nav">
            <div class="nav-item">
                <a href="dashboard.php" class="nav-link <?php echo $currentPage === 'dashboard.php' ? 'active' : ''; ?>">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </div>
            
            <div class="nav-item">
                <a href="messages.php" class="nav-link <?php echo $currentPage === 'messages.php' ? 'active' : ''; ?>">
                    <i class="fas fa-envelope"></i>
                    <span>Messages</span>
                </a>
            </div>
            
            <div class="nav-item">
                <a href="content.php" class="nav-link <?php echo $currentPage === 'content.php' ? 'active' : ''; ?>">
                    <i class="fas fa-file-alt"></i>
                    <span>Content</span>
                </a>
            </div>
            
            <div class="nav-item">
                <a href="portfolio.php" class="nav-link <?php echo $currentPage === 'portfolio.php' ? 'active' : ''; ?>">
                    <i class="fas fa-briefcase"></i>
                    <span>Portfolio</span>
                </a>
            </div>
            
            <div class="nav-item">
                <a href="team.php" class="nav-link <?php echo $currentPage === 'team.php' ? 'active' : ''; ?>">
                    <i class="fas fa-users"></i>
                    <span>Team</span>
                </a>
            </div>
            
            <div class="nav-item">
                <a href="services.php" class="nav-link <?php echo $currentPage === 'services.php' ? 'active' : ''; ?>">
                    <i class="fas fa-cogs"></i>
                    <span>Services</span>
                </a>
            </div>
            
            <div class="nav-item">
                <a href="settings.php" class="nav-link <?php echo $currentPage === 'settings.php' ? 'active' : ''; ?>">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </div>
        </nav>
    </aside>
    
    <!-- Header -->
    <header class="admin-header">
        <button class="sidebar-toggle" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        
        <div class="header-content">
            <h1 class="page-title">
                <?php
                switch ($currentPage) {
                    case 'dashboard.php':
                        echo 'Dashboard';
                        break;
                    case 'messages.php':
                        echo 'Messages';
                        break;
                    case 'content.php':
                        echo 'Content Management';
                        break;
                    case 'portfolio.php':
                        echo 'Portfolio Management';
                        break;
                    case 'team.php':
                        echo 'Team Management';
                        break;
                    case 'services.php':
                        echo 'Services Management';
                        break;
                    case 'settings.php':
                        echo 'Settings';
                        break;
                    default:
                        echo 'Admin Panel';
                }
                ?>
            </h1>
            
            <div class="header-actions">
                <button id="themeToggle" class="btn-theme-toggle" aria-label="Toggle Theme">
                    <i class="fas <?php echo isset($_COOKIE['admin_theme']) && $_COOKIE['admin_theme'] === 'dark' ? 'fa-sun' : 'fa-moon'; ?>"></i>
                </button>
                
                <div class="user-dropdown" id="userDropdown">
                    <div class="user-info">
                        <div class="user-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <span class="user-name"><?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Admin'; ?></span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    
                    <div class="dropdown-menu">
                        <a href="profile.php" class="dropdown-item">
                            <i class="fas fa-user-circle"></i>
                            <span>Profile</span>
                        </a>
                        <a href="settings.php" class="dropdown-item">
                            <i class="fas fa-cog"></i>
                            <span>Settings</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="logout.php" class="dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Main Content -->
    <main class="admin-content"> 