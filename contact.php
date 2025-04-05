<?php
/**
 * Contact Page
 * Provides contact information and a form for users to send messages
 */

// Include functions
require_once 'includes/functions.php';

// Page-specific variables
$title = 'Contact Us - Skyline Technology';
$description = 'Get in touch with Skyline Technology. Contact us for inquiries, support, or to discuss your project needs. Our team is ready to help you bring your ideas to life.';

// Include header
include_once 'includes/header.php';
?>

<!-- Page Banner -->
<section class="page-banner">
    <div class="container">
        <div class="banner-content">
            <h1>Contact Us</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo getBaseUrl(); ?>/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<!-- Contact Information -->
<section class="contact-info-section section-padding">
    <div class="container">
        <div class="section-header text-center">
            <span class="subtitle">Get In Touch</span>
            <h2>We're Here to Help</h2>
            <p>Have questions about our services or want to discuss your project? Reach out to us through any of the following channels or use the form below.</p>
        </div>
        
        <div class="contact-info-container">
            <div class="row">
                <!-- Contact Card - Address -->
                <div class="col-md-4">
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3>Our Location</h3>
                        <p>123 Tech Street, Suite 100<br>Silicon Valley, CA 94043<br>United States</p>
                    </div>
                </div>
                
                <!-- Contact Card - Email -->
                <div class="col-md-4">
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3>Email Us</h3>
                        <p>info@skylinetechnology.com<br>support@skylinetechnology.com<br>careers@skylinetechnology.com</p>
                    </div>
                </div>
                
                <!-- Contact Card - Phone -->
                <div class="col-md-4">
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <h3>Call Us</h3>
                        <p>+1 (555) 123-4567<br>+1 (555) 987-6543<br>Toll-free: 1-800-SKY-TECH</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form and Map -->
<section class="contact-form-section section-padding bg-light">
    <div class="container">
        <div class="row">
            <!-- Contact Form -->
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="contact-form-container">
                    <h2>Send Us a Message</h2>
                    <p>Fill out the form below, and we'll get back to you as soon as possible.</p>
                    
                    <div class="form-response"></div>
                    
                    <form id="contactForm" class="contact-form">
                        <!-- CSRF Protection -->
                        <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Your Name <span class="required">*</span></label>
                                    <input type="text" id="name" name="name" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email Address <span class="required">*</span></label>
                                    <input type="email" id="email" name="email" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" id="subject" name="subject" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Your Message <span class="required">*</span></label>
                            <textarea id="message" name="message" rows="5" class="form-control" required></textarea>
                        </div>
                        
                        <div class="form-group form-check">
                            <input type="checkbox" id="privacy" name="privacy" class="form-check-input" required>
                            <label for="privacy" class="form-check-label">I agree to the <a href="<?php echo getBaseUrl(); ?>/privacy-policy.php">Privacy Policy</a> <span class="required">*</span></label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
            
            <!-- Map -->
            <div class="col-lg-6">
                <div class="contact-map">
                    <h2>Find Us</h2>
                    <div class="map-container">
                        <!-- Replace with your Google Maps embed code -->
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d101268.17004973494!2d-122.10250453453123!3d37.41383200000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fb7495bec0189%3A0x7c17d44a466baf9b!2sMountain%20View%2C%20CA!5e0!3m2!1sen!2sus!4v1680532426385!5m2!1sen!2sus" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Business Hours -->
<section class="business-hours-section section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="business-hours-content">
                    <span class="subtitle">When We're Available</span>
                    <h2>Our Business Hours</h2>
                    <p>Our team is available to assist you during the following hours. For urgent matters outside of business hours, please email us at support@skylinetechnology.com.</p>
                    
                    <div class="hours-list">
                        <div class="hours-item">
                            <span class="day">Monday - Friday:</span>
                            <span class="time">9:00 AM - 6:00 PM (PST)</span>
                        </div>
                        <div class="hours-item">
                            <span class="day">Saturday:</span>
                            <span class="time">10:00 AM - 4:00 PM (PST)</span>
                        </div>
                        <div class="hours-item">
                            <span class="day">Sunday:</span>
                            <span class="time">Closed</span>
                        </div>
                    </div>
                    
                    <p class="mt-4">Technical support is available 24/7 for our enterprise clients.</p>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="faq-container">
                    <h3>Frequently Asked Questions</h3>
                    
                    <div class="accordion" id="contactFAQ">
                        <!-- FAQ Item 1 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    How quickly can I expect a response?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#contactFAQ">
                                <div class="accordion-body">
                                    We typically respond to inquiries within 24 business hours. For urgent matters, we recommend calling our support line directly.
                                </div>
                            </div>
                        </div>
                        
                        <!-- FAQ Item 2 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Do you offer consultations for new projects?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#contactFAQ">
                                <div class="accordion-body">
                                    Yes, we offer free initial consultations to discuss your project requirements and provide recommendations. Please contact us to schedule a consultation.
                                </div>
                            </div>
                        </div>
                        
                        <!-- FAQ Item 3 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    How can I join your team?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#contactFAQ">
                                <div class="accordion-body">
                                    We're always looking for talented individuals to join our team. Please visit our Careers page to see current openings or send your resume to careers@skylinetechnology.com.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Additional Scripts for Contact Page -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Bootstrap components
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
        
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));
        
        // Contact form submission
        const contactForm = document.getElementById('contactForm');
        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Get form data
                const formData = new FormData(this);
                
                // Show loading state
                showFormResponse('loading', 'Sending your message...');
                
                // Send AJAX request
                fetch('includes/contact_handler.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showFormResponse('success', data.message);
                        contactForm.reset();
                    } else {
                        showFormResponse('error', data.message || 'An error occurred. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showFormResponse('error', 'Failed to send message. Please try again later.');
                });
            });
        }
        
        // Display form response
        function showFormResponse(status, message) {
            const responseElement = document.querySelector('.form-response');
            
            if (responseElement) {
                // Remove previous classes
                responseElement.classList.remove('loading', 'success', 'error');
                
                // Add status class
                responseElement.classList.add(status);
                
                // Set message
                if (status === 'loading') {
                    responseElement.innerHTML = '<div class="spinner"></div>' + message;
                } else {
                    responseElement.textContent = message;
                }
                
                // Show the element
                responseElement.style.display = 'block';
                
                // Auto-hide success and error messages after 5 seconds
                if (status !== 'loading') {
                    setTimeout(() => {
                        responseElement.style.display = 'none';
                    }, 5000);
                }
            }
        }
    });
</script>

<?php
// Include footer
include_once 'includes/footer.php';
?> 