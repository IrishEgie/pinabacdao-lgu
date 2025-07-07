<?php
/**
 * Template Name: Contact Page
 */
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
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold text-gray-800 mb-4">We'd Love to Hear From You!</h2>
                        <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                            Have questions, concerns, or need assistance? Our team is here to help.
                            We typically respond to all inquiries within 24-48 hours during business days.
                        </p>
                    </div>

                    <div class="grid lg:grid-cols-2 gap-12 mb-16">
                        <div class="space-y-8">
                            <div class="space-y-4">
                                <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
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

                                <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
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

                                <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
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

                                <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
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

                                <div class="rounded-lg border bg-card text-card-foreground shadow-sm mt-6">
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
                                    <h3 class="font-semibold tracking-tight text-2xl text-gray-800">Send us a Message
                                    </h3>
                                    <p class="text-gray-600">Fill out the form below and we'll get back to you as soon
                                        as possible.</p>
                                </div>
                                <div class="p-6 pt-0">
                                    <form class="space-y-6">
                                        <div class="space-y-2">
                                            <label
                                                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                                for="full-name">Full Name *</label>
                                            <input
                                                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                                                placeholder="Enter your full name" name="fullName" id="full-name">
                                        </div>

                                        <div class="space-y-2">
                                            <label
                                                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                                for="email">Email Address *</label>
                                            <input type="email"
                                                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                                                placeholder="Enter your email" name="email" id="email">
                                        </div>

                                        <div class="space-y-2">
                                            <label
                                                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                                for="phone">Phone Number (Optional)</label>
                                            <input
                                                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                                                placeholder="Enter your phone number" name="phone" id="phone">
                                        </div>

                                        <div class="space-y-2">
                                            <label
                                                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                                for="subject">Subject *</label>
                                            <select
                                                class="flex h-10 w-full items-center justify-between rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 [&>span]:line-clamp-1"
                                                id="subject">
                                                <option value="General Inquiry">General Inquiry</option>
                                                <option value="Service Request">Service Request</option>
                                                <option value="Complaint or Concern">Complaint or Concern</option>
                                                <option value="Business Permit">Business Permit</option>
                                                <option value="Civil Registration">Civil Registration</option>
                                                <option value="Building Permit">Building Permit</option>
                                                <option value="Tourism Information">Tourism Information</option>
                                                <option value="Investment Opportunities">Investment Opportunities
                                                </option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>

                                        <div class="space-y-2">
                                            <label
                                                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                                for="message">Message *</label>
                                            <textarea
                                                class="flex w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 min-h-32"
                                                placeholder="Enter your message here..." name="message"
                                                id="message"></textarea>
                                        </div>

                                        <button
                                            class="inline-flex items-center justify-center w-full h-10 px-4 py-2 rounded-md text-sm font-medium text-white bg-primary-600 hover:bg-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                                            type="submit">Send Message</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-lg border text-card-foreground shadow-sm bg-primary-50">
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

<?php get_footer(); ?>