<?php
/**
 * Template Name: Contact Page
 */

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_submitted'])) {
    $response = process_contact_form();
}

function process_contact_form() {
    // Verify nonce
    if (!isset($_POST['contact_nonce']) || !wp_verify_nonce($_POST['contact_nonce'], 'submit_contact_form')) {
        return ['success' => false, 'message' => 'Security verification failed.'];
    }

    // Validate required fields
    $required_fields = ['fullName', 'email', 'subject', 'message'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            return ['success' => false, 'message' => 'Please fill in all required fields.'];
        }
    }

    // Validate email format
    if (!is_email($_POST['email'])) {
        return ['success' => false, 'message' => 'Please enter a valid email address.'];
    }

    // Sanitize inputs
    $name = sanitize_text_field($_POST['fullName']);
    $email = sanitize_email($_POST['email']);
    $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $subject = sanitize_text_field($_POST['subject']);
    $message = sanitize_textarea_field($_POST['message']);

    // Email configuration
    $to = 'info@pinabacdao.gov.ph';
    
    // Email headers - Set reply-to to sender's email
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'Reply-To: ' . $name . ' <' . $email . '>'
    );

    // Email content with better formatting
    $email_content = "
    <html>
    <body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
        <div style='max-width: 600px; margin: 0 auto; padding: 20px;'>
            <h2 style='color: #2563eb; border-bottom: 2px solid #2563eb; padding-bottom: 10px;'>New Contact Form Submission</h2>
            
            <div style='background-color: #f8fafc; padding: 20px; border-radius: 8px; margin: 20px 0;'>
                <p style='margin: 10px 0;'><strong>Name:</strong> {$name}</p>
                <p style='margin: 10px 0;'><strong>Email:</strong> <a href='mailto:{$email}'>{$email}</a></p>
                <p style='margin: 10px 0;'><strong>Phone:</strong> " . ($phone ? $phone : 'Not provided') . "</p>
                <p style='margin: 10px 0;'><strong>Subject:</strong> {$subject}</p>
            </div>
            
            <div style='margin: 20px 0;'>
                <h3 style='color: #374151;'>Message:</h3>
                <div style='background-color: #ffffff; padding: 15px; border: 1px solid #e5e7eb; border-radius: 6px;'>
                    " . nl2br(esc_html($message)) . "
                </div>
            </div>
            
            <hr style='margin: 30px 0; border: none; border-top: 1px solid #e5e7eb;'>
            <p style='font-size: 12px; color: #6b7280;'>
                This message was sent from the contact form on " . get_site_url() . " on " . current_time('F j, Y \a\t g:i A') . "
            </p>
        </div>
    </body>
    </html>";

    // Configure email settings based on environment
    add_action('phpmailer_init', function($phpmailer) {
        // Check if we're in Local by Flywheel environment
        if (defined('WP_ENVIRONMENT_TYPE') && WP_ENVIRONMENT_TYPE === 'local') {
            // For Local by Flywheel, use basic mail settings (Mailpit will catch it automatically)
            $phpmailer->From = 'noreply@pinabacdao.local';
            $phpmailer->FromName = 'Pinabacdao Contact Form';
            
            // Don't use SMTP - let Local handle it with Mailpit
            // Local by Flywheel automatically intercepts wp_mail() calls
            
        } else {
            // Production Gmail SMTP configuration
            $phpmailer->isSMTP();
            $phpmailer->Host = SMTP_HOST;
            $phpmailer->SMTPAuth = true;
            $phpmailer->Port = SMTP_PORT;
            $phpmailer->Username = SMTP_USER;
            $phpmailer->Password = SMTP_PASS;
            $phpmailer->SMTPSecure = SMTP_SECURE;
            $phpmailer->From = SMTP_FROM;
            $phpmailer->FromName = SMTP_FROM_NAME;
            
            // Enable debugging for production issues
            if (defined('WP_DEBUG') && WP_DEBUG) {
                $phpmailer->SMTPDebug = 1;
                $phpmailer->Debugoutput = 'error_log';
            }
        }
    });

    // Send email
    $email_subject = "Contact Form: {$subject}";
    
    // Add debugging for local development
    if (defined('WP_ENVIRONMENT_TYPE') && WP_ENVIRONMENT_TYPE === 'local') {
        error_log("Local Development: Attempting to send email to: $to");
        error_log("Email subject: $email_subject");
    }
    
    $sent = wp_mail($to, $email_subject, $email_content, $headers);
    
    // Enhanced error handling
    if (!$sent) {
        error_log("wp_mail failed for contact form submission");
        if (defined('WP_ENVIRONMENT_TYPE') && WP_ENVIRONMENT_TYPE === 'local') {
            error_log("Check Mailpit at http://localhost:8025 or http://localhost:1025");
        }
    } else {
        if (defined('WP_ENVIRONMENT_TYPE') && WP_ENVIRONMENT_TYPE === 'local') {
            error_log("Email sent successfully! Check Mailpit interface for the email.");
        }
    }

    // Remove the phpmailer_init action to prevent conflicts
    remove_all_actions('phpmailer_init');

    if ($sent) {
        return ['success' => true, 'message' => 'Thank you for your message! We will get back to you soon.'];
    } else {
        // Get the last error for debugging
        global $phpmailer;
        $error_message = 'Failed to send message. Please try again later.';
        
        if (defined('WP_DEBUG') && WP_DEBUG && isset($phpmailer->ErrorInfo)) {
            error_log('Contact form mail error: ' . $phpmailer->ErrorInfo);
        }
        
        return ['success' => false, 'message' => $error_message];
    }
}

get_header();
?>

<!-- Dynamic Page Banner -->
<div><?php pageBanner(); ?></div>

<!-- Dynamic Breadcrumbs -->
<?php the_breadcrumbs(); ?>

<main class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex">
            <div class="w-full">
                <div class="max-w-7xl mx-auto">
                    <?php if (isset($response)) : ?>
                        <div class="mb-8 p-4 rounded-lg <?php echo $response['success'] ? 'bg-green-100 border border-green-300 text-green-800' : 'bg-red-100 border border-red-300 text-red-800'; ?>">
                            <div class="flex items-center">
                                <span class="mr-2">
                                    <?php if ($response['success']) : ?>
                                        ✅
                                    <?php else : ?>
                                        ❌
                                    <?php endif; ?>
                                </span>
                                <?php echo esc_html($response['message']); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold text-gray-800 mb-4">We'd Love to Hear From You!</h2>
                        <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                            Have questions, concerns, or need assistance? Our team is here to help.
                            We typically respond to all inquiries within 24-48 hours during business days.
                        </p>
                    </div>

                    <div class="grid lg:grid-cols-2 gap-12 mb-16">
                        <div class="space-y-8">
                            <!-- Contact information cards -->
                            <div class="space-y-4">
                                <div class="rounded-lg border bg-card text-card-foreground shadow-sm hover:shadow-lg ">
                                    <div class="p-6">
                                        <div class="flex items-start space-x-4">
                                            <?php echo get_service_icon_svg('location', 'w-6 h-6 text-primary-600 mt-1'); ?>
                                            <div>
                                                <h3 class="font-semibold text-gray-800 mb-2">Visit Us</h3>
                                                <p class="text-gray-600">Municipal Hall<br>Pinabacdao, Samar
                                                    6708<br>Philippines</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="rounded-lg border bg-card text-card-foreground shadow-sm hover:shadow-lg">
                                    <div class="p-6">
                                        <div class="flex items-start space-x-4">
                                            <?php echo get_service_icon_svg('phone', 'w-6 h-6 text-primary-600 mt-1'); ?>
                                            <div>
                                                <h3 class="font-semibold text-gray-800 mb-2">Call Us</h3>
                                                <button
                                                    class="text-primary-600 hover:text-primary-800 transition-colors">+63
                                                    (55) 123-4567</button>
                                                <p class="text-sm text-gray-500 mt-1">Tap to call on mobile</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="rounded-lg border bg-card text-card-foreground shadow-sm hover:shadow-lg">
                                    <div class="p-6">
                                        <div class="flex items-start space-x-4">
                                            <?php echo get_service_icon_svg('mail', 'w-6 h-6 text-primary-600 mt-1'); ?>
                                            <div>
                                                <h3 class="font-semibold text-gray-800 mb-2">Email Us</h3>
                                                <a href="mailto:info@pinabacdao.gov.ph"
                                                    class="text-primary-600 hover:text-primary-800 transition-colors">info@pinabacdao.gov.ph</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="rounded-lg border bg-card text-card-foreground shadow-sm hover:shadow-lg">
                                    <div class="p-6">
                                        <div class="flex items-start space-x-4">
                                            <?php echo get_service_icon_svg('clock', 'w-6 h-6 text-primary-600 mt-1'); ?>
                                            <div>
                                                <h3 class="font-semibold text-gray-800 mb-2">Business Hours</h3>
                                                <div class="space-y-1 text-gray-600">
                                                    <p>Monday - Friday: 8:00 AM - 5:00 PM</p>
                                                    <p>Saturday: 8:00 AM - 12:00 PM</p>
                                                    <p>Sunday: Closed</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="rounded-lg border bg-card text-card-foreground shadow-sm hover:shadow-lg mt-6">
                                    <div class="p-6">
                                        <h3 class="font-semibold text-gray-800 mb-4">Connect With Us</h3>
                                        <div class="flex space-x-4">
                                            <a href="#"
                                                class="flex items-center justify-center w-10 h-10 bg-primary-600 text-white rounded-full hover:bg-primary-500 transition-colors">
                                                <?php echo get_service_icon_svg('facebook', 'w-5 h-5'); ?>
                                            </a>
                                            <a href="#"
                                                class="flex items-center justify-center w-10 h-10 bg-primary-600 text-white rounded-full hover:bg-primary-500 transition-colors">
                                                <?php echo get_service_icon_svg('twitter', 'w-5 h-5'); ?>
                                            </a>
                                            <a href="/"
                                                class="flex items-center justify-center w-10 h-10 bg-primary-600 text-white rounded-full hover:bg-primary-500 transition-colors">
                                                <?php echo get_service_icon_svg('youtube', 'w-5 h-5'); ?>
                                            </a>
                                                                                        <a href="/"
                                                class="flex items-center justify-center w-10 h-10 bg-primary-600 text-white rounded-full hover:bg-primary-500 transition-colors">
                                                <?php echo get_service_icon_svg('instagram', 'w-5 h-5'); ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="rounded-lg border bg-card text-card-foreground shadow-lg">
                                <div class="flex flex-col space-y-1.5 p-6">
                                    <h3 class="font-semibold tracking-tight text-2xl text-gray-800">Send us a Message</h3>
                                    <p class="text-gray-600">Fill out the form below and we'll get back to you as soon as possible.</p>
                                </div>
                                <div class="p-6 pt-0">
                                    <form class="space-y-6" method="post" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" id="contact-form">
                                        <?php wp_nonce_field('submit_contact_form', 'contact_nonce'); ?>
                                        <input type="hidden" name="contact_submitted" value="1">
                                        
                                        <div class="space-y-2">
                                            <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="full-name">Full Name *</label>
                                            <input class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm" 
                                                   placeholder="Enter your full name" 
                                                   name="fullName" 
                                                   id="full-name" 
                                                   required 
                                                   maxlength="100"
                                                   value="<?php echo isset($_POST['fullName']) ? esc_attr($_POST['fullName']) : ''; ?>">
                                        </div>

                                        <div class="space-y-2">
                                            <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="email">Email Address *</label>
                                            <input type="email" 
                                                   class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm" 
                                                   placeholder="Enter your email" 
                                                   name="email" 
                                                   id="email" 
                                                   required 
                                                   maxlength="100"
                                                   value="<?php echo isset($_POST['email']) ? esc_attr($_POST['email']) : ''; ?>">
                                        </div>

                                        <div class="space-y-2">
                                            <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="phone">Phone Number (Optional)</label>
                                            <input class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm" 
                                                   placeholder="Enter your phone number" 
                                                   name="phone" 
                                                   id="phone" 
                                                   maxlength="20"
                                                   value="<?php echo isset($_POST['phone']) ? esc_attr($_POST['phone']) : ''; ?>">
                                        </div>

                                        <div class="space-y-2">
                                            <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="subject">Subject *</label>
                                            <select class="flex h-10 w-full items-center justify-between rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 [&>span]:line-clamp-1" 
                                                    id="subject" 
                                                    name="subject" 
                                                    required>
                                                <option value="">Select a subject...</option>
                                                <option value="General Inquiry" <?php selected(isset($_POST['subject']) && $_POST['subject'] === 'General Inquiry'); ?>>General Inquiry</option>
                                                <option value="Service Request" <?php selected(isset($_POST['subject']) && $_POST['subject'] === 'Service Request'); ?>>Service Request</option>
                                                <option value="Complaint or Concern" <?php selected(isset($_POST['subject']) && $_POST['subject'] === 'Complaint or Concern'); ?>>Complaint or Concern</option>
                                                <option value="Business Permit" <?php selected(isset($_POST['subject']) && $_POST['subject'] === 'Business Permit'); ?>>Business Permit</option>
                                                <option value="Civil Registration" <?php selected(isset($_POST['subject']) && $_POST['subject'] === 'Civil Registration'); ?>>Civil Registration</option>
                                                <option value="Building Permit" <?php selected(isset($_POST['subject']) && $_POST['subject'] === 'Building Permit'); ?>>Building Permit</option>
                                                <option value="Tourism Information" <?php selected(isset($_POST['subject']) && $_POST['subject'] === 'Tourism Information'); ?>>Tourism Information</option>
                                                <option value="Investment Opportunities" <?php selected(isset($_POST['subject']) && $_POST['subject'] === 'Investment Opportunities'); ?>>Investment Opportunities</option>
                                                <option value="Other" <?php selected(isset($_POST['subject']) && $_POST['subject'] === 'Other'); ?>>Other</option>
                                            </select>
                                        </div>

                                        <div class="space-y-2">
                                            <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="message">Message *</label>
                                            <textarea class="flex w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 min-h-32" 
                                                      placeholder="Enter your message here..." 
                                                      name="message" 
                                                      id="message" 
                                                      required
                                                      maxlength="2000"
                                                      rows="5"><?php echo isset($_POST['message']) ? esc_textarea($_POST['message']) : ''; ?></textarea>
                                            <p class="text-xs text-gray-500">Maximum 2000 characters</p>
                                        </div>

                                        <button class="inline-flex items-center justify-center w-full h-10 px-4 py-2 rounded-md text-sm font-medium text-white bg-primary-600 hover:bg-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed transition-colors" 
                                                type="submit"
                                                id="submit-btn">
                                            <span class="submit-text">Send Message</span>
                                            <span class="loading-text hidden">Sending...</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Immediate assistance section -->
                    <div class="rounded-lg border text-card-foreground shadow-sm hover:shadow-lg bg-primary-50 p-6">
                        <div class="p-8 text-center">
                            <h3 class="text-2xl font-bold text-gray-800 mb-4">Need Immediate Assistance?</h3>
                            <p class="text-gray-600 mb-6">For urgent matters or emergencies, please contact us directly
                                by phone or visit our office during business hours.</p>
                            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                <button
                                    class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border bg-background h-10 px-4 py-2 border-primary-600 text-primary-600 hover:bg-primary-600 hover:text-white">
                                    <?php echo get_service_icon_svg('phone', 'w-4 h-4 mr-2'); ?>
                                    Call Now
                                </button>
                                <a href="mailto:info@pinabacdao.gov.ph"
                                    class="inline-flex items-center justify-center px-6 py-3 bg-primary-600 hover:bg-primary-500 text-white font-medium rounded-md transition-colors duration-300">
                                    Send Email
                                    <?php get_service_icon_svg('email') ?>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contact-form');
    const submitBtn = document.getElementById('submit-btn');
    const submitText = submitBtn.querySelector('.submit-text');
    const loadingText = submitBtn.querySelector('.loading-text');

    form.addEventListener('submit', function() {
        submitBtn.disabled = true;
        submitText.classList.add('hidden');
        loadingText.classList.remove('hidden');
    });
});
</script>

<?php get_footer(); ?>