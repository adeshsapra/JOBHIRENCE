@extends('front.layouts.app')


@section('main')
    <!-- Contact Section -->
    <section class="contact-section">
        <div class="contact-container">
            <div class="contact-info-column">
                <div class="contact-info-header">
                    <h2>Get In Touch</h2>
                    <p>Have questions or need assistance? We're here to help you with any inquiries about JobHierance.</p>
                </div>
                
                <div class="contact-methods">
                    <div class="contact-method">
                        <i class="fas fa-map-marker-alt"></i>
                        <div class="contact-method-details">
                            <h4>Our Location</h4>
                            <p>123 Business Avenue, Tech City, CA 90210</p>
                        </div>
                    </div>
                    
                    <div class="contact-method">
                        <i class="fas fa-phone-alt"></i>
                        <div class="contact-method-details">
                            <h4>Call Us</h4>
                            <p>(800) 123-4567</p>
                        </div>
                    </div>
                    
                    <div class="contact-method">
                        <i class="fas fa-envelope"></i>
                        <div class="contact-method-details">
                            <h4>Email Us</h4>
                            <a href="mailto:support@jobhierance.com">support@jobhierance.com</a>
                        </div>
                    </div>
                </div>
                
                <div class="contact-social-media">
                    <h4>Follow Us</h4>
                    <div class="contact-social-icons">
                        <a href="#" class="contact-social-icon"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="contact-social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="contact-social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="contact-social-icon"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="contact-form-column">
                <div class="contact-form-header">
                    <h2>Send us a message</h2>
                    <p>We'll get back to you as soon as possible</p>
                </div>
                
                <form class="contact-form">
                    <div class="contact-form-group">
                        <input type="text" class="contact-form-control" id="first-name" placeholder=" ">
                        <label for="first-name" class="contact-form-label">First Name</label>
                    </div>
                    
                    <div class="contact-form-group">
                        <input type="text" class="contact-form-control" id="last-name" placeholder=" ">
                        <label for="last-name" class="contact-form-label">Last Name</label>
                    </div>
                    
                    <div class="contact-form-group">
                        <input type="email" class="contact-form-control" id="email" placeholder=" ">
                        <label for="email" class="contact-form-label">Email Address</label>
                    </div>
                    
                    <div class="contact-form-group">
                        <input type="tel" class="contact-form-control" id="phone" placeholder=" ">
                        <label for="phone" class="contact-form-label">Phone Number</label>
                    </div>
                    
                    <div class="contact-form-group full-width">
                        <textarea class="contact-form-control" id="message" placeholder=" "></textarea>
                        <label for="message" class="contact-form-label">Your Message</label>
                    </div>
                    
                    <button type="submit" class="contact-submit-btn">Send Message <i class="fas fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </section>
    
    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="faq-container">
            <div class="faq-header">
                <h2>Frequently Asked Questions</h2>
                <p>Find answers to the most common questions about our platform</p>
            </div>
            
            <div class="faq-categories">
                <div class="faq-category active" data-category="all">All Questions</div>
                <div class="faq-category" data-category="job-seekers">Job Seekers</div>
                <div class="faq-category" data-category="employers">Employers</div>
                <div class="faq-category" data-category="account">Account</div>
            </div>
            
            <div class="faq-accordion">
                <details class="faq-item" data-category="job-seekers">
                    <summary class="faq-question">How do I create an account?</summary>
                    <div class="faq-answer">
                        <p>Creating an account on JobHierance is simple and free. Follow these steps:</p>
                        <ul>
                            <li>Click on the "Sign Up" button in the top-right corner of the homepage</li>
                            <li>Choose whether you're a job seeker or employer</li>
                            <li>Fill in your details (name, email, password)</li>
                            <li>Verify your email address</li>
                            <li>Complete your profile with relevant information</li>
                        </ul>
                        <p>Once your account is created, you can immediately start browsing jobs or posting opportunities.</p>
                    </div>
                </details>
                
                <details class="faq-item" data-category="job-seekers">
                    <summary class="faq-question">How do I apply for a job?</summary>
                    <div class="faq-answer">
                        <p>To apply for a job on JobHierance:</p>
                        <ul>
                            <li>Search for jobs using the search bar or filters</li>
                            <li>Click on a job listing that interests you</li>
                            <li>Review the job details and requirements</li>
                            <li>Click the "Apply Now" button</li>
                            <li>Follow the application instructions (some may require uploading your resume or answering screening questions)</li>
                        </ul>
                        <p>You can track all your job applications in the "Jobs Applied" section of your account dashboard.</p>
                    </div>
                </details>
                
                <details class="faq-item" data-category="employers">
                    <summary class="faq-question">How do I post a job as an employer?</summary>
                    <div class="faq-answer">
                        <p>To post a job on JobHierance as an employer:</p>
                        <ul>
                            <li>Sign in to your employer account</li>
                            <li>Go to "Post a Job" in your dashboard</li>
                            <li>Fill in all the job details (title, description, requirements, location, salary, etc.)</li>
                            <li>Select any screening questions if desired</li>
                            <li>Review your job posting</li>
                            <li>Submit it for publication</li>
                        </ul>
                        <p>Your job will be reviewed and typically published within 24 hours. You can manage all your job postings from the "My Jobs" section.</p>
                    </div>
                </details>
                
                <details class="faq-item" data-category="account">
                    <summary class="faq-question">How do I reset my password?</summary>
                    <div class="faq-answer">
                        <p>If you've forgotten your password:</p>
                        <ul>
                            <li>Click "Login" in the top menu</li>
                            <li>Select "Forgot Password" below the login form</li>
                            <li>Enter the email address associated with your account</li>
                            <li>Check your email for a password reset link</li>
                            <li>Follow the link and create a new password</li>
                        </ul>
                        <p>For security reasons, password reset links expire after 24 hours. If you don't receive the email, check your spam folder or contact our support team.</p>
                    </div>
                </details>
                
                <details class="faq-item" data-category="account">
                    <summary class="faq-question">Is it free to use JobHierance?</summary>
                    <div class="faq-answer">
                        <p>JobHierance offers both free and premium services:</p>
                        <ul>
                            <li>For job seekers: Creating an account, browsing jobs, and applying to most positions is completely free.</li>
                            <li>For employers: We offer different subscription tiers based on your hiring needs. Basic job posting may include a fee, while premium features like candidate sorting, featured listings, and analytics require a subscription.</li>
                        </ul>
                        <p>Visit our Pricing page for detailed information about our plans and features.</p>
                    </div>
                </details>
            </div>
            
            <div class="faq-cta">
                <p>Didn't find the answer you were looking for?</p>
                <a href="#contact" class="faq-cta-btn">Contact Us</a>
            </div>
        </div>
    </section>
@endsection