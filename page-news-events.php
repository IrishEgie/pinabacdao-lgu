<?php
/**
 * Template Name: Pinabacdao News & Events
 * Description: WordPress template for News & Events page with tabbed navigation
 */
require_once get_template_directory() . '/template-parts/sections/news-carousel.php';
require_once get_template_directory() . '/template-parts/cards/news-card.php';
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
                <!-- Featured Section -->
                <div class="flex items-center space-x-4">
                    <?php echo get_service_icon_svg('star', 'w-6 h-6 text-primary-600'); ?>
                    <h2 class="text-2xl text-gray-800">Featured</h2>
                </div>
                
                <!-- Featured Carousel -->
                <div class="relative w-full mb-8">

                </div>
                
                <!-- Latest Updates Section -->
                <div class="flex items-center space-x-4 mb-8">
                    <?php echo get_service_icon_svg('bell', 'w-6 h-6 text-primary-600'); ?>
                    <h2 class="text-2xl text-gray-800">Latest Updates</h2>
                </div>
                
                <!-- Tab Navigation with News Cards -->
                <div>
                    <?php
                    renderTabNavigationWithCards([
                        'posts_per_page' => 9,
                        'tabs' => [
                            ['id' => 'all', 'label' => 'All'],
                            ['id' => 'news', 'label' => 'News'],
                            ['id' => 'events', 'label' => 'Events'],
                            ['id' => 'announcements', 'label' => 'Announcements'],
                        ],
                        'query_args' => [
                            'all' => [
                                'post_type' => ['news', 'events', 'announcements'],
                                'posts_per_page' => 9,
                                'orderby' => 'date',
                                'order' => 'DESC'
                            ],
                            'news' => [
                                'post_type' => 'news',
                                'posts_per_page' => 9,
                                'orderby' => 'date',
                                'order' => 'DESC'
                            ],
                            'events' => [
                                'post_type' => 'events',
                                'posts_per_page' => 9,
                                'orderby' => 'meta_value',
                                'meta_key' => 'event_datetime_start',
                                'order' => 'ASC',
                                'meta_query' => [
                                    [
                                        'key' => 'event_datetime_start',
                                        'value' => date('Y-m-d H:i:s'),
                                        'compare' => '>=',
                                        'type' => 'DATETIME'
                                    ]
                                ]
                            ],
                            'announcements' => [
                                'post_type' => 'announcements',
                                'posts_per_page' => 9,
                                'orderby' => 'date',
                                'order' => 'DESC',
                                'meta_query' => [
                                    [
                                        'key' => 'announcement_expiry',
                                        'value' => date('Y-m-d'),
                                        'compare' => '>=',
                                        'type' => 'DATE'
                                    ]
                                ]
                            ]
                        ]
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </main>

    <?php get_footer(); ?>
</div>