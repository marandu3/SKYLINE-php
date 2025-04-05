</main>
    
    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-column footer-about">
                    <h3>About Skyline Technology</h3>
                    <p>Skyline Technology provides innovative technology solutions for businesses and individuals. Our mission is to deliver high-quality, cutting-edge technology services that empower our clients to achieve their goals.</p>
                    <div class="social-icons">
                        <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com" target="_blank" rel="noopener noreferrer" aria-label="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
                
                <div class="footer-column footer-links">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="<?php echo getBaseUrl(); ?>/">Home</a></li>
                        <li><a href="<?php echo getBaseUrl(); ?>/about.php">About Us</a></li>
                        <li><a href="<?php echo getBaseUrl(); ?>/services.php">Services</a></li>
                        <li><a href="<?php echo getBaseUrl(); ?>/portfolio.php">Portfolio</a></li>
                        <li><a href="<?php echo getBaseUrl(); ?>/team.php">Our Team</a></li>
                        <li><a href="<?php echo getBaseUrl(); ?>/contact.php">Contact</a></li>
                    </ul>
                </div>
                
                <div class="footer-column footer-services">
                    <h3>Our Services</h3>
                    <ul>
                        <li><a href="<?php echo getBaseUrl(); ?>/services.php#web-development">Web Development</a></li>
                        <li><a href="<?php echo getBaseUrl(); ?>/services.php#mobile-apps">Mobile Applications</a></li>
                        <li><a href="<?php echo getBaseUrl(); ?>/services.php#cloud-services">Cloud Services</a></li>
                        <li><a href="<?php echo getBaseUrl(); ?>/services.php#ui-design">UI/UX Design</a></li>
                        <li><a href="<?php echo getBaseUrl(); ?>/services.php#it-consulting">IT Consulting</a></li>
                        <li><a href="<?php echo getBaseUrl(); ?>/services.php#cybersecurity">Cybersecurity</a></li>
                    </ul>
                </div>
                
                <div class="footer-column footer-newsletter">
                    <h3>Stay Updated</h3>
                    <p>Subscribe to our newsletter for the latest updates and technology insights.</p>
                    <form id="newsletterForm" class="newsletter-form">
                        <input type="email" name="email" placeholder="Your email address" required>
                        <button type="submit" class="btn btn-primary">Subscribe</button>
                    </form>
                    <div class="form-response"></div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div class="copyright">
                    &copy; <?php echo date('Y'); ?> Skyline Technology. All Rights Reserved.
                </div>
                <div class="footer-bottom-links">
                    <a href="<?php echo getBaseUrl(); ?>/privacy-policy.php">Privacy Policy</a>
                    <a href="<?php echo getBaseUrl(); ?>/terms-of-service.php">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Scroll to Top Button -->
    <button id="scroll-top" class="scroll-top" aria-label="Scroll to Top">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- JavaScript -->
    <script src="<?php echo getBaseUrl(); ?>/assets/js/main.js"></script>
    
    <?php if (isset($extra['additionalScripts'])): ?>
        <?php echo $extra['additionalScripts']; ?>
    <?php endif; ?>
    
    <script>
        // Newsletter form submission
        document.addEventListener('DOMContentLoaded', function() {
            const newsletterForm = document.getElementById('newsletterForm');
            if (newsletterForm) {
                newsletterForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const email = this.querySelector('input[type="email"]').value.trim();
                    
                    // Basic validation
                    if (!email) {
                        alert('Please enter your email address');
                        return;
                    }
                    
                    // Here you would normally submit the form via AJAX
                    // For now, just show a success message
                    const responseEl = this.nextElementSibling;
                    responseEl.classList.add('success');
                    responseEl.style.display = 'block';
                    responseEl.textContent = 'Thank you for subscribing!';
                    
                    this.reset();
                    
                    // Hide the message after 5 seconds
                    setTimeout(() => {
                        responseEl.style.display = 'none';
                    }, 5000);
                });
            }
            
            // Initialize scroll to top button
            const scrollTopBtn = document.getElementById('scroll-top');
            if (scrollTopBtn) {
                window.addEventListener('scroll', function() {
                    if (window.pageYOffset > 300) {
                        scrollTopBtn.classList.add('show');
                    } else {
                        scrollTopBtn.classList.remove('show');
                    }
                });
                
                scrollTopBtn.addEventListener('click', function() {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }
            
            // Mobile menu toggle
            const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
            const mainNav = document.querySelector('.main-nav');
            
            if (mobileMenuToggle && mainNav) {
                mobileMenuToggle.addEventListener('click', function() {
                    this.classList.toggle('active');
                    mainNav.classList.toggle('active');
                    document.body.classList.toggle('menu-open');
                });
            }
        });
    </script>
</body>
</html> 