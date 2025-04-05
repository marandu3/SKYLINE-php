<?php
/**
 * Header template for Skyline Technology website
 * Used across multiple pages for consistency
 */

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Default values
$pageTitle = $title ?? 'Skyline Technology';
$metaDescription = $description ?? 'Innovative technology solutions for businesses and individuals';
$canonicalUrl = $canonicalUrl ?? getCurrentUrl();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="<?php echo htmlspecialchars($metaDescription); ?>">
    
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    
    <!-- Canonical URL -->
    <link rel="canonical" href="<?php echo htmlspecialchars($canonicalUrl); ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo getBaseUrl(); ?>/assets/images/favicon.png">
    
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo getBaseUrl(); ?>/styles.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <?php if (isset($extra['additionalHead'])): ?>
        <?php echo $extra['additionalHead']; ?>
    <?php endif; ?>
</head>
<body class="<?php echo isset($_COOKIE['theme']) && $_COOKIE['theme'] === 'dark' ? 'dark-theme' : 'light-theme'; ?>">
    <!-- Skip to main content link for accessibility -->
    <a href="#main-content" class="skip-link">Skip to main content</a>
    
    <!-- Header -->
    <header class="site-header">
        <div class="container">
            <div class="header-wrapper">
                <div class="logo">
                    <a href="<?php echo getBaseUrl(); ?>/">
                        <img src="<?php echo getBaseUrl(); ?>/assets/images/logo.png" alt="Skyline Technology Logo" class="logo-img">
                        <span class="logo-text">Skyline Technology</span>
                    </a>
                </div>
                
                <button class="mobile-menu-toggle" aria-label="Toggle Menu">
                    <span class="hamburger"></span>
                </button>
                
                <nav class="main-nav">
                    <ul class="nav-list">
                        <li class="nav-item <?php echo strContains($_SERVER['REQUEST_URI'], '/index') || $_SERVER['REQUEST_URI'] == '/' ? 'active' : ''; ?>">
                            <a href="<?php echo getBaseUrl(); ?>/">Home</a>
                        </li>
                        <li class="nav-item <?php echo strContains($_SERVER['REQUEST_URI'], '/about') ? 'active' : ''; ?>">
                            <a href="<?php echo getBaseUrl(); ?>/about.php">About</a>
                        </li>
                        <li class="nav-item <?php echo strContains($_SERVER['REQUEST_URI'], '/services') ? 'active' : ''; ?>">
                            <a href="<?php echo getBaseUrl(); ?>/services.php">Services</a>
                        </li>
                        <li class="nav-item <?php echo strContains($_SERVER['REQUEST_URI'], '/portfolio') ? 'active' : ''; ?>">
                            <a href="<?php echo getBaseUrl(); ?>/portfolio.php">Portfolio</a>
                        </li>
                        <li class="nav-item <?php echo strContains($_SERVER['REQUEST_URI'], '/team') ? 'active' : ''; ?>">
                            <a href="<?php echo getBaseUrl(); ?>/team.php">Our Team</a>
                        </li>
                        <li class="nav-item <?php echo strContains($_SERVER['REQUEST_URI'], '/contact') ? 'active' : ''; ?>">
                            <a href="<?php echo getBaseUrl(); ?>/contact.php">Contact</a>
                        </li>
                    </ul>
                    
                    <div class="nav-actions">
                        <button id="theme-toggle" class="theme-toggle" aria-label="Toggle Theme">
                            <?php if (isset($_COOKIE['theme']) && $_COOKIE['theme'] === 'dark'): ?>
                                <i class="fas fa-sun"></i> Light Mode
                            <?php else: ?>
                                <i class="fas fa-moon"></i> Dark Mode
                            <?php endif; ?>
                        </button>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    
    <!-- Main Content -->
    <main id="main-content" class="main-content"> 