<?php
/**
 * Template Name: Services Page
 */
get_header();
?>

<div class="min-h-screen bg-gray-50">
    <?php pageBanner([
        'background_image' => 'https://images.unsplash.com/photo-1605152276897-4f618f831968?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'?: get_template_directory_uri() . '/assets/images/default-photo.avif',
        'show_credit' => true,
        'credit' => 'Photo by Erik Mclean on Unsplash',
    ]); ?>
    <?php the_breadcrumbs(); ?>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 bg-gray-50">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Municipal Services</h2>
            <p class="text-lg text-gray-600">Comprehensive government services for residents, businesses, and visitors
            </p>
        </div>

        <!-- Services Grid -->
        <?php
            // Set limit for homepage display
            $services_limit = -1; // Show only 6 services on homepage
            include get_template_directory() . '/template-parts/sections/services-section.php';
        ?>

        <!-- Service Hours Card -->
        <div class="px-8">
            <div class="container-primary shadow-md hover:shadow-xl transition-shadow duration-300">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-800">Service Hours</h2>
                    <p class="text-gray-600">When our offices are open to serve you</p>
                </div>
                <div class="px-6 pb-6">
                    <div class="grid md:grid-cols-2 gap-8">
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Regular Hours</h3>
                            <div class="space-y-2 text-gray-600">
                                <p><strong>Monday - Friday:</strong> 8:00 AM - 5:00 PM</p>
                                <p><strong>Saturday:</strong> 8:00 AM - 12:00 PM</p>
                                <p><strong>Sunday:</strong> Closed</p>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Contact Information</h3>
                            <div class="space-y-2 text-gray-600">
                                <p><strong>Main Office:</strong> +63 (55) 123-4567</p>
                                <p><strong>Email:</strong> services@pinabacdao.gov.ph</p>
                                <p><strong>Emergency:</strong> 911</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Need Help Section -->
        <?php 
        display_need_help_section([
            'title' => 'Need assistance?',
            'description' => 'For assistance accessing public services contact our Municipal Service Officer.',
            'contact_info' => [
                'phone' => '(555) 123-4567',
                'email' => 'services@municipality.gov'
            ],
            'mt_class' => 'mt-12',
            'bg_color' => 'bg-primary-50',
            'button' => [
                'call_text' => 'Call Help Desk',
                'email_text' => 'Email for Assistance',
                'call_class' => 'border border-primary-600 text-primary-600 hover:bg-primary-600 hover:text-white',
                'email_class' => 'bg-primary-600 hover:bg-primary-700 text-white'
            ]
        ]);
        ?>



    </div>
</div>
<?php get_footer(); ?>