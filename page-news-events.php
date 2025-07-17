<?php
/**
 * Template Name: Pinabacdao Single Post
 * Description: WordPress template matching SinglePost component
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
                <!-- Main Content Area -->
                <div class="flex items-center space-x-4">
                    <?php echo get_service_icon_svg('star', 'w-6 h-6 text-primary-600'); ?>
                    <h2 class="text-2xl text-gray-800">Featured</h2>
                </div>
                <div class="relative w-full mb-8">
                    <!-- Carousel Featured Area -->
                </div>
                <div class="flex items-center space-x-4 mb-8">
                    <?php echo get_service_icon_svg('bell', 'w-6 h-6 text-primary-600'); ?>
                    <h2 class="text-2xl text-gray-800">Latest Updates</h2>
                </div>
                <div>
                    <?php
                    renderTabNavigation([
                        'tabs' => [
                            ['id' => 'all', 'label' => 'All'],
                            ['id' => 'news', 'label' => 'News'],
                            ['id' => 'events', 'label' => 'Events'],
                            ['id' => 'anouncements', 'label' => 'Announcements'],
                        ],
                        'contents' => [
                            'all' => '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                            card card card
                                        </div>',
                            'news' => '<div>Services content here</div>',
                            'anouncements' => '<div>About us content here</div>'
                        ]
                    ]);
                    ?>
                </div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php
    // Query for all post types
    $args = array(
        'post_type' => array('news', 'events', 'announcements'),
        'posts_per_page' => -1, // Adjust number of posts to show
        'orderby' => 'date',
        'order' => 'DESC',
        'post_status' => 'publish'
    );
    
    $posts_query = new WP_Query($args);
    
    if ($posts_query->have_posts()) :
        while ($posts_query->have_posts()) : $posts_query->the_post();
            // Get the appropriate card arguments for this post
            $card_args = get_post_card_args(get_the_ID());
            
            // Add featured badge if this is a featured post
            if (get_field('featured_post', get_the_ID())) {
                $card_args['badges'][] = [
                    'text' => 'Featured',
                    'color' => 'yellow'
                ];
            }
            
            // Render the card
            render_post_card($card_args);
        endwhile;
        wp_reset_postdata();
    else :
        echo '<p class="col-span-full text-center text-gray-500">No posts found.</p>';
    endif;
    ?>
</div>
            </div>
        </div>
    </main>

    <?php get_footer(); ?>
</div>