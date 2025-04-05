/**
 * Main JavaScript functionality for Skyline Technology website
 * Includes: 
 * - Theme toggling (light/dark mode)
 * - Smooth scrolling 
 * - Form validation and submission
 * - Animations
 * - Modal functionality
 */

document.addEventListener('DOMContentLoaded', () => {
    // Theme toggle functionality
    setupThemeToggle();
    
    // Smooth scroll for navigation links
    setupSmoothScroll();
    
    // Initialize animations
    initAnimations();
    
    // Setup contact form
    setupContactForm();
    
    // Setup modals
    setupModals();
});

/**
 * Theme Toggle Functionality
 */
function setupThemeToggle() {
    const themeToggle = document.getElementById('theme-toggle');
    const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');
    
    // Set initial theme based on local storage or system preference
    const currentTheme = localStorage.getItem('theme');
    if (currentTheme) {
        document.body.classList.toggle('dark-theme', currentTheme === 'dark');
        document.body.classList.toggle('light-theme', currentTheme === 'light');
    } else {
        // If no theme in localStorage, use system preference
        document.body.classList.toggle('dark-theme', prefersDarkScheme.matches);
        document.body.classList.toggle('light-theme', !prefersDarkScheme.matches);
        localStorage.setItem('theme', prefersDarkScheme.matches ? 'dark' : 'light');
    }
    
    // Update toggle button text
    updateThemeToggleText();
    
    // Add event listener for theme toggle
    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            // Toggle theme classes
            document.body.classList.toggle('dark-theme');
            document.body.classList.toggle('light-theme');
            
            // Update localStorage
            const theme = document.body.classList.contains('dark-theme') ? 'dark' : 'light';
            localStorage.setItem('theme', theme);
            
            // Update toggle button text
            updateThemeToggleText();
        });
    }
}

/**
 * Update theme toggle button text based on current theme
 */
function updateThemeToggleText() {
    const themeToggle = document.getElementById('theme-toggle');
    if (!themeToggle) return;
    
    if (document.body.classList.contains('dark-theme')) {
        themeToggle.innerHTML = '<i class="fas fa-sun"></i> Light Mode';
    } else {
        themeToggle.innerHTML = '<i class="fas fa-moon"></i> Dark Mode';
    }
}

/**
 * Setup smooth scrolling for navigation links
 */
function setupSmoothScroll() {
    const navLinks = document.querySelectorAll('a[href^="#"]');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Only if the href is not just "#"
            if (this.getAttribute('href') !== '#') {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    // Add offset for fixed header
                    const headerOffset = 80;
                    const elementPosition = targetElement.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                    
                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                    
                    // Update URL hash without scrolling
                    history.pushState(null, null, targetId);
                }
            }
        });
    });
}

/**
 * Initialize animations for page elements
 */
function initAnimations() {
    // Simple reveal animation for elements with 'animate-on-scroll' class
    const animatedElements = document.querySelectorAll('.animate-on-scroll');
    
    if (animatedElements.length > 0) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate');
                    // Option: remove from observation once animated
                    // observer.unobserve(entry.target);
                } else {
                    // Option: remove animation when out of view
                    // entry.target.classList.remove('animate');
                }
            });
        }, {
            threshold: 0.1  // Trigger when 10% of the element is visible
        });
        
        animatedElements.forEach(element => {
            observer.observe(element);
        });
    }
}

/**
 * Setup contact form validation and AJAX submission
 */
function setupContactForm() {
    const contactForm = document.getElementById('contactForm');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form inputs
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const subject = document.getElementById('subject').value.trim();
            const message = document.getElementById('message').value.trim();
            
            // Basic validation
            if (!name || !email || !message) {
                showFormResponse('error', 'Please fill all required fields');
                return;
            }
            
            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                showFormResponse('error', 'Please enter a valid email address');
                return;
            }
            
            // Show loading state
            showFormResponse('loading', 'Sending message...');
            
            // Prepare form data
            const formData = new FormData();
            formData.append('name', name);
            formData.append('email', email);
            formData.append('subject', subject);
            formData.append('message', message);
            
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
}

/**
 * Display form response message with status
 */
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

/**
 * Setup modals functionality
 */
function setupModals() {
    // Get all modal triggers
    const modalTriggers = document.querySelectorAll('[data-modal-target]');
    const modalCloseButtons = document.querySelectorAll('[data-modal-close]');
    const modals = document.querySelectorAll('.modal');
    
    // Add click event to modal triggers
    modalTriggers.forEach(trigger => {
        trigger.addEventListener('click', () => {
            const modalId = trigger.getAttribute('data-modal-target');
            const modal = document.querySelector(modalId);
            if (modal) {
                openModal(modal);
            }
        });
    });
    
    // Add click event to close buttons
    modalCloseButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modal = button.closest('.modal');
            if (modal) {
                closeModal(modal);
            }
        });
    });
    
    // Close modal when clicking outside of modal content
    modals.forEach(modal => {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeModal(modal);
            }
        });
    });
    
    // Close modal with Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            modals.forEach(modal => {
                if (modal.classList.contains('active')) {
                    closeModal(modal);
                }
            });
        }
    });
}

function openModal(modal) {
    if (!modal) return;
    modal.classList.add('active');
    document.body.style.overflow = 'hidden'; // Prevent scrolling
}

function closeModal(modal) {
    if (!modal) return;
    modal.classList.remove('active');
    document.body.style.overflow = ''; // Re-enable scrolling
}

/**
 * Newsletter form submission
 */
function subscribeNewsletter(formId) {
    const form = document.getElementById(formId);
    
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = form.querySelector('input[type="email"]').value.trim();
            
            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address');
                return;
            }
            
            // Here you would normally send an AJAX request to handle the subscription
            // For now, just show a success message
            alert('Thanks for subscribing to our newsletter!');
            form.reset();
        });
    }
} 