<?php
/**
 * Template Name: React-Style Single Post
 * Description: WordPress template matching SinglePost React component
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
            <!-- Dynamic Page Title -->
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">
                    Organization Chart
                </h2>
                <p class="text-lg text-gray-600">
                    Municipal Government Structure
                </p>
            </div>
            <!-- Dynamic Content Area -->
            <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
    
            </div>

        </div>
    </main>

    <?php get_footer(); ?>
</div>