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
        <div class="grid gap-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Dynamic Page Title -->
            <div class="text-center">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">
                    About Pinabacdao
                </h2>
                <p class="text-lg text-gray-600">
                    What makes our municipality unique and vibrant
                </p>
            </div>
            <!-- Card container -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php
                $card_contents = array(
                    array(
                        'icon' => get_service_icon_svg('vision-mark', 'w-6 h-6 text-primary'),
                        'title' => 'Our Vision',
                        'content' => 'A progressive and sustainable municipality providing quality services to all residents.'
                    ),
                    array(
                        'icon' => get_service_icon_svg('users', 'w-6 h-6 text-primary'),
                        'title' => 'Our Mission',
                        'content' => 'To deliver efficient public services while promoting inclusive development and good governance.'
                    ),
                    array(
                        'icon' => get_service_icon_svg('location', 'w-6 h-6 text-primary'),
                        'title' => 'Location',
                        'content' => 'Located in the Province of Samar, Philippines, serving diverse barangays and communities.'
                    ),
                    array(
                        'icon' => get_service_icon_svg('award', 'w-6 h-6 text-primary'),
                        'title' => 'Recognition',
                        'content' => 'Committed to excellence in public service and community development initiatives.'
                    )
                );

                foreach ($card_contents as $card) {
                    echo '<div>';
                    echo highlight_card(array(
                        'icon' => $card['icon'],
                        'title' => $card['title'],
                        'content' => $card['content']
                    ));
                    echo '</div>';
                }
                ?>
            </div>
            <!-- Dynamic Page Title -->
            <div class="text-center">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">
                    Municipality Overview
                </h2>
                <p class="text-lg text-gray-600">
                    Serving our community with dedication and transparency
                </p>
            </div>
            <!-- Dynamic Content Area -->
            <div class="grid gap-4 bg-white rounded-lg shadow-lg p-12 px-16 mb-8">
                <?php
                the_content();
                ?>
            </div>

        </div>
    </main>

    <?php get_footer(); ?>
</div>