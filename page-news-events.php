<?php
/**
 * Template Name: Pinabacdao Single Post
 * Description: WordPress template matching SinglePost component
 */

get_header();
?>

<div class="min-h-screen bg-gray-50">
    <!-- Dynamic Page Banner -->
    <div><?php pageBanner(); ?></div>

    <!-- Dynamic Breadcrumbs -->
    <?php the_breadcrumbs(); ?>

    <main class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-8">
                <!-- Main Content Area -->
                <div class="flex items-center space-x-4"><?php get_service_icon_svg('bell', 'w-6 h-6 text-blue-600'); ?>
                    <h2 class="text-2xl font-bold text-gray-800">Latest Updates</h2>
                </div>
                <?php
                // Include the tab navigation with 'all' as the default active tab
                get_template_part('template-parts/sections/tab-nav', null, array(
                    'activeTab' => 'all'
                ));
                ?>
            </div>
        </div>
    </main>

    <?php get_footer(); ?>
</div>