<?php
/**
 * About Page
 * Provides information about Skyline Technology, our mission, team, and values
 */

// Include functions
require_once 'includes/functions.php';

// Page-specific variables
$title = 'About Us - Skyline Technology';
$description = 'Learn about Skyline Technology - our mission, values, and the talented team behind our innovative technology solutions. Discover our journey and what makes us different.';

// Include header
include_once 'includes/header.php';
?>

<!-- Page Banner -->
<section class="page-banner">
    <div class="container">
        <div class="banner-content">
            <h1>About Us</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo getBaseUrl(); ?>/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">About</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="about-section section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="about-image">
                    <img src="<?php echo getBaseUrl(); ?>/assets/images/about/about-main.jpg" alt="About Skyline Technology" class="img-fluid rounded">
                    <div class="experience-badge">
                        <span class="years">15+</span>
                        <span class="text">Years of Experience</span>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="about-content">
                    <span class="subtitle">Our Story</span>
                    <h2>Innovative Solutions For a Digital World</h2>
                    <p>Founded in 2008, Skyline Technology has been at the forefront of technological innovation for over 15 years. What began as a small team of passionate tech enthusiasts has grown into a global company with a diverse portfolio of successful projects and satisfied clients.</p>
                    
                    <p>Our journey has been defined by a relentless pursuit of excellence and a commitment to leveraging technology to solve real-world problems. From web and mobile development to cloud solutions and AI integration, we have continuously evolved our services to meet the changing needs of businesses in the digital age.</p>
                    
                    <div class="about-features">
                        <div class="feature">
                            <div class="icon">
                                <i class="fas fa-code"></i>
                            </div>
                            <div class="content">
                                <h4>Custom Development</h4>
                                <p>Tailored solutions designed specifically for your unique business needs.</p>
                            </div>
                        </div>
                        
                        <div class="feature">
                            <div class="icon">
                                <i class="fas fa-cloud"></i>
                            </div>
                            <div class="content">
                                <h4>Cloud Expertise</h4>
                                <p>Seamless migration and optimization of cloud infrastructure for maximum efficiency.</p>
                            </div>
                        </div>
                    </div>
                    
                    <a href="<?php echo getBaseUrl(); ?>/contact.php" class="btn btn-primary">Get In Touch</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision Section -->
<section class="mission-vision-section section-padding bg-light">
    <div class="container">
        <div class="section-header text-center">
            <span class="subtitle">Who We Are</span>
            <h2>Our Mission & Vision</h2>
            <p>Guided by our core values, we are committed to making a positive impact through technology.</p>
        </div>
        
        <div class="row">
            <!-- Mission -->
            <div class="col-md-6 mb-4 mb-md-0">
                <div class="mission-card">
                    <div class="icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3>Our Mission</h3>
                    <p>To empower businesses and individuals with innovative technology solutions that drive growth, efficiency, and competitive advantage. We are committed to delivering high-quality, user-centric solutions that address real-world challenges and exceed client expectations.</p>
                </div>
            </div>
            
            <!-- Vision -->
            <div class="col-md-6">
                <div class="vision-card">
                    <div class="icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3>Our Vision</h3>
                    <p>To be a global leader in technology solutions, recognized for our innovation, excellence, and positive impact. We envision a future where our technology enhances human potential, contributes to sustainable development, and creates value for all stakeholders.</p>
                </div>
            </div>
        </div>
        
        <!-- Core Values -->
        <div class="core-values">
            <h3 class="text-center mt-5 mb-4">Our Core Values</h3>
            
            <div class="row">
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="value-card">
                        <div class="icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <h4>Excellence</h4>
                        <p>We strive for excellence in everything we do, from code quality to client communication.</p>
                    </div>
                </div>
                
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="value-card">
                        <div class="icon">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h4>Innovation</h4>
                        <p>We embrace creativity and continuously explore new technologies and approaches.</p>
                    </div>
                </div>
                
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="value-card">
                        <div class="icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h4>Integrity</h4>
                        <p>We maintain the highest standards of honesty, transparency, and ethical conduct.</p>
                    </div>
                </div>
                
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="value-card">
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4>Collaboration</h4>
                        <p>We believe in the power of teamwork and collaborative problem-solving.</p>
                    </div>
                </div>
                
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="value-card">
                        <div class="icon">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <h4>Adaptability</h4>
                        <p>We embrace change and continuously evolve to meet emerging challenges.</p>
                    </div>
                </div>
                
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="value-card">
                        <div class="icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h4>Client Focus</h4>
                        <p>We place our clients at the center of everything we do, ensuring their success.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="team-section section-padding">
    <div class="container">
        <div class="section-header text-center">
            <span class="subtitle">Meet Our Team</span>
            <h2>The Talented People Behind Skyline</h2>
            <p>Our success is driven by our team of dedicated professionals who bring diverse skills and perspectives to every project.</p>
        </div>
        
        <div class="row">
            <!-- Team Member 1 -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="team-card">
                    <div class="team-image">
                        <img src="<?php echo getBaseUrl(); ?>/assets/images/team/team1.jpg" alt="John Doe - CEO" class="img-fluid">
                        <div class="social-links">
                            <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                            <a href="#" aria-label="Email"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                    <div class="team-info">
                        <h4>John Doe</h4>
                        <span class="position">CEO & Founder</span>
                    </div>
                </div>
            </div>
            
            <!-- Team Member 2 -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="team-card">
                    <div class="team-image">
                        <img src="<?php echo getBaseUrl(); ?>/assets/images/team/team2.jpg" alt="Jane Smith - CTO" class="img-fluid">
                        <div class="social-links">
                            <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                            <a href="#" aria-label="Email"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                    <div class="team-info">
                        <h4>Jane Smith</h4>
                        <span class="position">CTO</span>
                    </div>
                </div>
            </div>
            
            <!-- Team Member 3 -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="team-card">
                    <div class="team-image">
                        <img src="<?php echo getBaseUrl(); ?>/assets/images/team/team3.jpg" alt="Michael Johnson - Lead Developer" class="img-fluid">
                        <div class="social-links">
                            <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                            <a href="#" aria-label="Email"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                    <div class="team-info">
                        <h4>Michael Johnson</h4>
                        <span class="position">Lead Developer</span>
                    </div>
                </div>
            </div>
            
            <!-- Team Member 4 -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="team-card">
                    <div class="team-image">
                        <img src="<?php echo getBaseUrl(); ?>/assets/images/team/team4.jpg" alt="Emily Williams - UX Designer" class="img-fluid">
                        <div class="social-links">
                            <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                            <a href="#" aria-label="Email"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                    <div class="team-info">
                        <h4>Emily Williams</h4>
                        <span class="position">UX Designer</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-4">
            <a href="<?php echo getBaseUrl(); ?>/team.php" class="btn btn-outline">View All Team Members</a>
        </div>
    </div>
</section>

<!-- Achievements Section -->
<section class="achievements-section section-padding bg-light">
    <div class="container">
        <div class="section-header text-center">
            <span class="subtitle">Our Achievements</span>
            <h2>Our Journey in Numbers</h2>
            <p>Over the years, we have achieved significant milestones and delivered exceptional results for our clients.</p>
        </div>
        
        <div class="row">
            <!-- Achievement 1 -->
            <div class="col-md-3 col-6 mb-4 mb-md-0">
                <div class="achievement-card text-center">
                    <div class="count" data-count="500">500+</div>
                    <h4>Projects Completed</h4>
                </div>
            </div>
            
            <!-- Achievement 2 -->
            <div class="col-md-3 col-6 mb-4 mb-md-0">
                <div class="achievement-card text-center">
                    <div class="count" data-count="150">150+</div>
                    <h4>Happy Clients</h4>
                </div>
            </div>
            
            <!-- Achievement 3 -->
            <div class="col-md-3 col-6">
                <div class="achievement-card text-center">
                    <div class="count" data-count="50">50+</div>
                    <h4>Team Members</h4>
                </div>
            </div>
            
            <!-- Achievement 4 -->
            <div class="col-md-3 col-6">
                <div class="achievement-card text-center">
                    <div class="count" data-count="25">25+</div>
                    <h4>Awards Won</h4>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Partners Section -->
<section class="partners-section section-padding">
    <div class="container">
        <div class="section-header text-center">
            <span class="subtitle">Our Partners</span>
            <h2>Trusted By Leading Companies</h2>
            <p>We collaborate with industry leaders to deliver cutting-edge solutions.</p>
        </div>
        
        <div class="partners-logos">
            <div class="partner-logo">
                <img src="<?php echo getBaseUrl(); ?>/assets/images/partners/partner1.png" alt="Partner 1">
            </div>
            <div class="partner-logo">
                <img src="<?php echo getBaseUrl(); ?>/assets/images/partners/partner2.png" alt="Partner 2">
            </div>
            <div class="partner-logo">
                <img src="<?php echo getBaseUrl(); ?>/assets/images/partners/partner3.png" alt="Partner 3">
            </div>
            <div class="partner-logo">
                <img src="<?php echo getBaseUrl(); ?>/assets/images/partners/partner4.png" alt="Partner 4">
            </div>
            <div class="partner-logo">
                <img src="<?php echo getBaseUrl(); ?>/assets/images/partners/partner5.png" alt="Partner 5">
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section section-padding">
    <div class="container">
        <div class="cta-content text-center">
            <h2>Ready to Transform Your Business?</h2>
            <p>Partner with us to accelerate your digital transformation journey and achieve your business goals.</p>
            <div class="cta-buttons">
                <a href="<?php echo getBaseUrl(); ?>/contact.php" class="btn btn-primary">Contact Us</a>
                <a href="<?php echo getBaseUrl(); ?>/services.php" class="btn btn-outline">Our Services</a>
            </div>
        </div>
    </div>
</section>

<?php
// Include footer
include_once 'includes/footer.php';
?> 