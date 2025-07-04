<?php
/**
 * Template Name: Single Post
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
        <div class="grid gap-4 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Static Page Title -->
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">
                    Organization Chart
                </h2>
                <p class="text-lg text-gray-600">
                    Municipal Government Structure
                </p>
            </div>
            <div class="container-primary shadow-md hover:shadow-xl transition-shadow duration-300"></div>
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">
                    Executive Officials
                </h2>
                <p class="text-lg text-gray-600">
                    Municipal leadership and administration
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- I want to add the cards here -->
                 <?php officialCard(); ?>
            </div>
                        <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">
                    Sangguniang Bayan
                </h2>
                <p class="text-lg text-gray-600">
                    Legislative body of the municipality
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- I want to add the cards here -->
            </div>
                        <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">
                    Department Heads
                </h2>
                <p class="text-lg text-gray-600">
                    Leaders of municipal offices and services
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- I want to add the cards here -->
            </div>
                        <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">
                    Executive Offices
                </h2>
                <p class="text-lg text-gray-600">
                    Chief executive leadership and administration
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- I want to add the cards here -->
            </div>
                    <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">
                    Legislative Body
                </h2>
                <p class="text-lg text-gray-600">
                    Local lawmaking and policy development
                </p>
            </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- I want to add the cards here -->
            </div>
                    <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">
                    Core Administrative Offices
                </h2>
                <p class="text-lg text-gray-600">
                    Essential municipal services and administration
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- I want to add the cards here -->
            </div>
                    <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">
                    Public Safety and Order Offices
                </h2>
                <p class="text-lg text-gray-600">
                    Security, emergency response, and legal services
                </p>
            </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- I want to add the cards here -->
            </div>
                    <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">
                    Other Municipal Offices
                </h2>
                <p class="text-lg text-gray-600">
                    Specialized services and development programs
                </p>
            </div>
        </div>
    </main>

    <?php get_footer(); ?>
</div>