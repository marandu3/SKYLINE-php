<?php
/**
 * Skyline Technology - Main Index Page
 * 
 * This is the main entry point for the website. It loads content from the database
 * and displays it with a modern, responsive layout.
 */

// Include database config
require_once 'config/db_config.php';

// Get content from database if available
$pageContent = [
    'hero' => ['title' => 'Welcome to Skyline Technology', 'content' => 'Your trusted partner in IT solutions'],
    'about' => ['title' => 'About Us', 'content' => 'Skyline Technology specializes in IT services including Web design, Software development, Networking, and IT maintenance. We are committed to delivering innovative solutions to drive your success.'],
    'services' => ['title' => 'Our Services', 'content' => 'We provide top-notch services tailored to your business needs.'],
    'team' => ['title' => 'Meet Our Team', 'content' => 'A dedicated team of IT experts ready to serve you.'],
    'contact' => ['title' => 'Contact Us', 'content' => 'Get in touch with us today. We\'d love to hear from you!']
];

try {
    // Connect to database
    $conn = connectDB();
    
    // Get all website content
    $sql = "SELECT * FROM website_content";
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $section = $row['section'];
            if (isset($pageContent[$section])) {
                $pageContent[$section]['title'] = $row['title'];
                $pageContent[$section]['content'] = $row['content'];
            }
        }
    }
    
    // Close connection
    closeDB($conn);
} catch (Exception $e) {
    // If database not set up, use default content
    // No need to display error to users
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skyline Technology - IT Solutions</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="header">
        <div class="container header-content">
            <div class="logo">
                <i class="fas fa-layer-group"></i>
                <span>Skyline Technology</span>
            </div>
            <nav>
                <button class="mobile-menu-btn" id="mobile-menu-btn">
                    <i class="fas fa-bars"></i>
                </button>
                <ul class="nav-links">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#team">Team</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="portfolio.php">Portfolio</a></li>
                </ul>
            </nav>
            <button class="theme-toggle" id="theme-toggle">
                <i class="fas fa-moon"></i>
            </button>
        </div>
    </header>

    <section id="home" class="hero">
        <div class="container hero-content">
            <h1 class="animate-on-scroll"><?php echo htmlspecialchars($pageContent['hero']['title']); ?></h1>
            <p class="animate-on-scroll"><?php echo htmlspecialchars($pageContent['hero']['content']); ?></p>
            <div class="hero-buttons animate-on-scroll">
                <a href="#services" class="btn btn-outline">Our Services</a>
                <a href="#contact" class="btn">Get Started</a>
            </div>
        </div>
    </section>

    <section id="about" class="about">
        <div class="container">
            <div class="section-title">
                <h2><?php echo htmlspecialchars($pageContent['about']['title']); ?></h2>
            </div>
            <p class="animate-on-scroll"><?php echo htmlspecialchars($pageContent['about']['content']); ?></p>
            
            <div class="about-features animate-on-scroll">
                <div class="feature">
                    <div class="feature-icon">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <h3>Fast & Efficient</h3>
                    <p>We deliver projects quickly without compromising quality.</p>
                </div>
                <div class="feature">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Secure Solutions</h3>
                    <p>Security is at the core of everything we build.</p>
                </div>
                <div class="feature">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3>24/7 Support</h3>
                    <p>Our team is always available to assist you.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="services" class="services">
        <div class="container">
            <div class="section-title">
                <h2><?php echo htmlspecialchars($pageContent['services']['title']); ?></h2>
                <p><?php echo htmlspecialchars($pageContent['services']['content']); ?></p>
            </div>
            
            <div class="services-grid">
                <div class="service-card animate-on-scroll">
                    <div class="service-icon">
                        <i class="fas fa-code"></i>
                    </div>
                    <h3>Web Development</h3>
                    <p>Custom website solutions tailored to your business needs, from simple landing pages to complex web applications.</p>
                </div>
                
                <div class="service-card animate-on-scroll">
                    <div class="service-icon">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <h3>IT Maintenance</h3>
                    <p>Regular system maintenance, hardware troubleshooting, and software updates to keep your IT infrastructure running smoothly.</p>
                </div>
                
                <div class="service-card animate-on-scroll">
                    <div class="service-icon">
                        <i class="fas fa-network-wired"></i>
                    </div>
                    <h3>Networking Solutions</h3>
                    <p>Comprehensive networking services including design, implementation, and maintenance of secure and reliable networks.</p>
                </div>
                
                <div class="service-card animate-on-scroll">
                    <div class="service-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3>Mobile App Development</h3>
                    <p>Native and cross-platform mobile applications designed to provide a seamless user experience on all devices.</p>
                </div>
                
                <div class="service-card animate-on-scroll">
                    <div class="service-icon">
                        <i class="fas fa-cloud"></i>
                    </div>
                    <h3>Cloud Solutions</h3>
                    <p>Cloud migration, hosting, and management services to leverage the full potential of cloud computing for your business.</p>
                </div>
                
                <div class="service-card animate-on-scroll">
                    <div class="service-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h3>Cybersecurity</h3>
                    <p>Comprehensive security assessments, implementation of security measures, and ongoing monitoring to protect your digital assets.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="team" class="team">
        <div class="container">
            <div class="section-title">
                <h2><?php echo htmlspecialchars($pageContent['team']['title']); ?></h2>
                <p><?php echo htmlspecialchars($pageContent['team']['content']); ?></p>
            </div>
            
            <div class="team-grid">
                <div class="team-member animate-on-scroll">
                    <img src="assets/images/team1.jpg" alt="Elton Mallya" class="member-img">
                    <div class="member-info">
                        <h3>Elton Mallya</h3>
                        <p>CEO & Founder</p>
                        <div class="member-social">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="team-member animate-on-scroll">
                    <img src="assets/images/team2.jpg" alt="John Marandu" class="member-img">
                    <div class="member-info">
                        <h3>John Marandu</h3>
                        <p>Lead Developer</p>
                        <div class="member-social">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="team-member animate-on-scroll">
                    <img src="assets/images/team3.jpg" alt="Mike Johnson" class="member-img">
                    <div class="member-info">
                        <h3>Mike Johnson</h3>
                        <p>Network Specialist</p>
                        <div class="member-social">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="team-member animate-on-scroll">
                    <img src="assets/images/team4.jpg" alt="Sarah Williams" class="member-img">
                    <div class="member-info">
                        <h3>Sarah Williams</h3>
                        <p>UI/UX Designer</p>
                        <div class="member-social">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="contact">
        <div class="container">
            <div class="section-title">
                <h2><?php echo htmlspecialchars($pageContent['contact']['title']); ?></h2>
                <p><?php echo htmlspecialchars($pageContent['contact']['content']); ?></p>
            </div>
            
            <div class="contact-form-container">
                <div class="contact-info">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h3>Our Address</h3>
                            <p>123 Skyline Avenue, Tanzania</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h3>Email Us</h3>
                            <p>info@skylinetech.com</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div>
                            <h3>Call Us</h3>
                            <p>+255 613 980 136</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <h3>Working Hours</h3>
                            <p>Monday - Friday: 9AM - 5PM</p>
                        </div>
                    </div>
                </div>
                
                <form action="includes/contact_handler.php" method="POST" class="contact-form" id="contactForm">
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Your Email</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" class="form-control" rows="5" required></textarea>
                    </div>
                    
                    <div id="form-response" class="form-response"></div>
                    
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Send Message
                    </button>
                </form>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>Skyline Technology</h3>
                    <p>Shaping the future through innovation, technology, and creativity.</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#team">Our Team</a></li>
                        <li><a href="#contact">Contact Us</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>Services</h3>
                    <ul class="footer-links">
                        <li><a href="#services">Web Development</a></li>
                        <li><a href="#services">IT Maintenance</a></li>
                        <li><a href="#services">Networking Solutions</a></li>
                        <li><a href="#services">Mobile App Development</a></li>
                        <li><a href="#services">Cloud Solutions</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>Newsletter</h3>
                    <p>Subscribe to our newsletter to receive updates about new services and offers.</p>
                    <form class="newsletter-form">
                        <input type="email" placeholder="Your Email" required>
                        <button type="submit"><i class="fas fa-paper-plane"></i></button>
                    </form>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> Skyline Technology. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
    <script>
        // Contact form AJAX submission
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const responseDiv = document.getElementById('form-response');
            
            // Show loading message
            responseDiv.innerHTML = '<div class="loading">Sending message...</div>';
            responseDiv.style.display = 'block';
            
            fetch('includes/contact_handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    responseDiv.innerHTML = `<div class="success">${data.message}</div>`;
                    // Reset form on success
                    document.getElementById('contactForm').reset();
                } else {
                    responseDiv.innerHTML = `<div class="error">${data.message}</div>`;
                }
            })
            .catch(error => {
                responseDiv.innerHTML = '<div class="error">An error occurred. Please try again later.</div>';
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html> 