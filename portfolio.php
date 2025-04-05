<?php
/**
 * Portfolio Page
 * Displays the company's projects and work
 */

// Include functions
require_once 'includes/functions.php';

// Page-specific variables
$title = 'Portfolio - Skyline Technology';
$description = 'Explore our portfolio of successful projects and innovative solutions at Skyline Technology. We showcase our best work in web development, mobile apps, cloud services, and more.';

// Include header
include_once 'includes/header.php';
?>

<!-- Page Banner -->
<section class="page-banner">
    <div class="container">
        <div class="banner-content">
            <h1>Our Portfolio</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo getBaseUrl(); ?>/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Portfolio</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<!-- Portfolio Section -->
<section class="portfolio-section section-padding">
    <div class="container">
        <div class="section-header text-center">
            <span class="subtitle">Our Recent Projects</span>
            <h2>Transforming Ideas Into Digital Reality</h2>
            <p>Explore our diverse portfolio of successful projects that showcase our expertise and commitment to excellence.</p>
        </div>
        
        <!-- Portfolio Filters -->
        <div class="portfolio-filters">
            <ul class="filters-list">
                <li class="filter active" data-filter="all">All Projects</li>
                <li class="filter" data-filter="web">Web Development</li>
                <li class="filter" data-filter="mobile">Mobile Apps</li>
                <li class="filter" data-filter="ui">UI/UX Design</li>
                <li class="filter" data-filter="cloud">Cloud Solutions</li>
            </ul>
        </div>
        
        <!-- Portfolio Grid -->
        <div class="portfolio-grid">
            <!-- Project 1 -->
            <div class="portfolio-item" data-category="web cloud">
                <div class="portfolio-card">
                    <div class="portfolio-img">
                        <img src="<?php echo getBaseUrl(); ?>/assets/images/portfolio/project1.jpg" alt="E-commerce Platform">
                    </div>
                    <div class="portfolio-content">
                        <span class="category">Web Development</span>
                        <h3 class="title">E-commerce Platform</h3>
                        <p class="description">A comprehensive e-commerce solution with integrated payment gateways and inventory management.</p>
                        <a href="<?php echo getBaseUrl(); ?>/project-details.php?id=1" class="btn btn-outline">View Details</a>
                    </div>
                </div>
            </div>
            
            <!-- Project 2 -->
            <div class="portfolio-item" data-category="mobile ui">
                <div class="portfolio-card">
                    <div class="portfolio-img">
                        <img src="<?php echo getBaseUrl(); ?>/assets/images/portfolio/project2.jpg" alt="Fitness Tracking App">
                    </div>
                    <div class="portfolio-content">
                        <span class="category">Mobile App</span>
                        <h3 class="title">Fitness Tracking App</h3>
                        <p class="description">A mobile application for tracking workouts, nutrition, and health metrics with social features.</p>
                        <a href="<?php echo getBaseUrl(); ?>/project-details.php?id=2" class="btn btn-outline">View Details</a>
                    </div>
                </div>
            </div>
            
            <!-- Project 3 -->
            <div class="portfolio-item" data-category="web ui">
                <div class="portfolio-card">
                    <div class="portfolio-img">
                        <img src="<?php echo getBaseUrl(); ?>/assets/images/portfolio/project3.jpg" alt="Corporate Website Redesign">
                    </div>
                    <div class="portfolio-content">
                        <span class="category">UI/UX Design</span>
                        <h3 class="title">Corporate Website Redesign</h3>
                        <p class="description">A complete redesign of a corporate website focusing on user experience and conversion optimization.</p>
                        <a href="<?php echo getBaseUrl(); ?>/project-details.php?id=3" class="btn btn-outline">View Details</a>
                    </div>
                </div>
            </div>
            
            <!-- Project 4 -->
            <div class="portfolio-item" data-category="cloud">
                <div class="portfolio-card">
                    <div class="portfolio-img">
                        <img src="<?php echo getBaseUrl(); ?>/assets/images/portfolio/project4.jpg" alt="Cloud Migration Services">
                    </div>
                    <div class="portfolio-content">
                        <span class="category">Cloud Solutions</span>
                        <h3 class="title">Cloud Migration Services</h3>
                        <p class="description">Seamless migration of legacy systems to cloud infrastructure with minimal downtime.</p>
                        <a href="<?php echo getBaseUrl(); ?>/project-details.php?id=4" class="btn btn-outline">View Details</a>
                    </div>
                </div>
            </div>
            
            <!-- Project 5 -->
            <div class="portfolio-item" data-category="mobile">
                <div class="portfolio-card">
                    <div class="portfolio-img">
                        <img src="<?php echo getBaseUrl(); ?>/assets/images/portfolio/project5.jpg" alt="Food Delivery App">
                    </div>
                    <div class="portfolio-content">
                        <span class="category">Mobile App</span>
                        <h3 class="title">Food Delivery App</h3>
                        <p class="description">A comprehensive food delivery application with real-time tracking and secure payments.</p>
                        <a href="<?php echo getBaseUrl(); ?>/project-details.php?id=5" class="btn btn-outline">View Details</a>
                    </div>
                </div>
            </div>
            
            <!-- Project 6 -->
            <div class="portfolio-item" data-category="web">
                <div class="portfolio-card">
                    <div class="portfolio-img">
                        <img src="<?php echo getBaseUrl(); ?>/assets/images/portfolio/project6.jpg" alt="Learning Management System">
                    </div>
                    <div class="portfolio-content">
                        <span class="category">Web Development</span>
                        <h3 class="title">Learning Management System</h3>
                        <p class="description">A feature-rich LMS for educational institutions with course management and analytics.</p>
                        <a href="<?php echo getBaseUrl(); ?>/project-details.php?id=6" class="btn btn-outline">View Details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section section-padding bg-light">
    <div class="container">
        <div class="section-header text-center">
            <span class="subtitle">Client Feedback</span>
            <h2>What Our Clients Say</h2>
            <p>Hear from our satisfied clients about their experience working with Skyline Technology.</p>
        </div>
        
        <div class="testimonials-slider">
            <!-- Testimonial 1 -->
            <div class="testimonial-item">
                <div class="testimonial-content">
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="quote">"Skyline Technology has been instrumental in transforming our digital presence. Their expertise in web development and commitment to quality is unmatched in the industry."</p>
                    <div class="client-info">
                        <div class="client-img">
                            <img src="<?php echo getBaseUrl(); ?>/assets/images/testimonials/client1.jpg" alt="John Smith">
                        </div>
                        <div class="client-details">
                            <h4>John Smith</h4>
                            <span>CEO, TechCorp Inc.</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Testimonial 2 -->
            <div class="testimonial-item">
                <div class="testimonial-content">
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="quote">"We approached Skyline Technology for a complex mobile app project, and they delivered beyond our expectations. Their technical skills and attention to detail are impressive."</p>
                    <div class="client-info">
                        <div class="client-img">
                            <img src="<?php echo getBaseUrl(); ?>/assets/images/testimonials/client2.jpg" alt="Sarah Johnson">
                        </div>
                        <div class="client-details">
                            <h4>Sarah Johnson</h4>
                            <span>Product Manager, FitLife</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Testimonial 3 -->
            <div class="testimonial-item">
                <div class="testimonial-content">
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="quote">"The cloud migration services provided by Skyline Technology have significantly improved our operational efficiency. Their team was professional and responsive throughout the project."</p>
                    <div class="client-info">
                        <div class="client-img">
                            <img src="<?php echo getBaseUrl(); ?>/assets/images/testimonials/client3.jpg" alt="Michael Chen">
                        </div>
                        <div class="client-details">
                            <h4>Michael Chen</h4>
                            <span>CTO, Global Solutions</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section section-padding">
    <div class="container">
        <div class="cta-content text-center">
            <h2>Ready to Start Your Project?</h2>
            <p>Let's transform your ideas into reality. Contact us today to discuss your project requirements.</p>
            <div class="cta-buttons">
                <a href="<?php echo getBaseUrl(); ?>/contact.php" class="btn btn-primary">Contact Us</a>
                <a href="<?php echo getBaseUrl(); ?>/services.php" class="btn btn-outline">Our Services</a>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Portfolio Filter Functionality
        const filterButtons = document.querySelectorAll('.filter');
        const portfolioItems = document.querySelectorAll('.portfolio-item');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                filterButtons.forEach(btn => btn.classList.remove('active'));
                
                // Add active class to clicked button
                this.classList.add('active');
                
                const filterValue = this.getAttribute('data-filter');
                
                portfolioItems.forEach(item => {
                    const categories = item.getAttribute('data-category').split(' ');
                    
                    if (filterValue === 'all' || categories.includes(filterValue)) {
                        item.style.display = 'block';
                        setTimeout(() => {
                            item.style.opacity = '1';
                            item.style.transform = 'scale(1)';
                        }, 100);
                    } else {
                        item.style.opacity = '0';
                        item.style.transform = 'scale(0.8)';
                        setTimeout(() => {
                            item.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });
        
        // Simple Testimonial Slider
        const testimonials = document.querySelectorAll('.testimonial-item');
        let currentIndex = 0;
        
        function showTestimonial(index) {
            testimonials.forEach((testimonial, i) => {
                if (i === index) {
                    testimonial.style.display = 'block';
                    setTimeout(() => {
                        testimonial.style.opacity = '1';
                    }, 50);
                } else {
                    testimonial.style.opacity = '0';
                    setTimeout(() => {
                        testimonial.style.display = 'none';
                    }, 300);
                }
            });
        }
        
        // Initial display
        showTestimonial(currentIndex);
        
        // Auto-rotate testimonials
        setInterval(() => {
            currentIndex = (currentIndex + 1) % testimonials.length;
            showTestimonial(currentIndex);
        }, 5000); // Change every 5 seconds
    });
</script>

<?php
// Include footer
include_once 'includes/footer.php';
?> 