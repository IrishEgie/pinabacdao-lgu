<?php
/**
 * Template Name: Services Page
 */
get_header();
?>

<div class="min-h-screen bg-gray-50">
    <?php pageBanner(); ?>
    <?php the_breadcrumbs(); ?>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 bg-gray-50">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Municipal Services</h2>
            <p class="text-lg text-gray-600">Comprehensive government services for residents, businesses, and visitors
            </p>
        </div>

        <!-- Services Grid -->
        <?php get_template_part('template-parts/services-section'); ?>

        <!-- Service Hours Card -->
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm hover:shadow-lg transition-shadow duration-300 ">
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
</div>
<?php get_footer(); ?>