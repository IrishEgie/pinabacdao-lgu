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
                <?php
                $executive_officials = new WP_Query([
                    'post_type' => 'official',
                    'posts_per_page' => 2,
                    'orderby' => 'menu_order',
                    'order' => 'ASC',
                    'meta_query' => [
                        [
                            'key' => 'official_type',
                            'value' => 'Executive Officials',
                            'compare' => '=',
                        ]
                    ],
                ]);

                if ($executive_officials->have_posts()) {
                    while ($executive_officials->have_posts()) {
                        $executive_officials->the_post();
                        officialCard(['post_id' => get_the_ID()]);
                    }
                    wp_reset_postdata();
                } else {
                    echo '<p class=" text-center col-span-full text-gray-500">No executive officials found.</p>';
                }
                ?>
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
                <?php
                $sanguniang_bayan = new WP_Query([
                    'post_type' => 'official',
                    'posts_per_page' => 2,
                    'orderby' => 'menu_order',
                    'order' => 'ASC',
                    'meta_query' => [
                        [
                            'key' => 'official_type',
                            'value' => 'Sangguniang Bayan',
                            'compare' => '=',
                        ]
                    ],
                ]);

                if ($sanguniang_bayan->have_posts()) {
                    while ($sanguniang_bayan->have_posts()) {
                        $sanguniang_bayan->the_post();
                        officialCard(['post_id' => get_the_ID()]);
                    }
                    wp_reset_postdata();
                } else {
                    echo '<p class="text-center col-span-full text-gray-500">No Sangguniang Bayan officials found.</p>';
                }
                ?>
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
                <?php
                $department_heads = new WP_Query([
                    'post_type' => 'official',
                    'posts_per_page' => -1,
                    'orderby' => 'menu_order',
                    'order' => 'ASC',
                    'meta_query' => [
                        [
                            'key' => 'official_type',
                            'value' => 'Department Heads',
                            'compare' => '=',
                        ]
                    ],
                ]);

                if ($department_heads->have_posts()) {
                    while ($department_heads->have_posts()) {
                        $department_heads->the_post();
                        officialCard(['post_id' => get_the_ID()]);
                    }
                    wp_reset_postdata();
                } else {
                    echo '<p class=" text-center col-span-full text-gray-500">No Department Heads found.</p>';
                }
                ?>
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
                <?php 
                echo get_template_part('template-parts/cards/departments-card', null, 
                    array('group' => 'executive')
                ); 
                ?>

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
                <?php 
                echo get_template_part('template-parts/cards/departments-card', null, 
                    array('group' => 'legislative')
                ); 
                ?>

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
                                 <?php 
                echo get_template_part('template-parts/cards/departments-card', null, 
                    array('group' => 'administrative')
                ); 
                ?>
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
                                 <?php 
                echo get_template_part('template-parts/cards/departments-card', null, 
                    array('group' => 'public_safety')
                ); 
                ?>
            </div>
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">
                    Other Municipal Offices
                </h2>
                <p class="text-lg text-gray-600">
                    Specialized services and development programs
                </p>
            </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- I want to add the cards here -->
                                 <?php 
                echo get_template_part('template-parts/cards/departments-card', null, 
                    array('group' => 'other')
                ); 
                ?>
            </div>
        </div>
    </main>

    <?php get_footer(); ?>
</div>