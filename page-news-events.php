<?php
/**
 * Template Name: Pinabacdao Single Post
 * Description: WordPress template matching SinglePost component
 */
require_once get_template_directory() . '/template-parts/sections/news-carousel.php';
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
                    <?php featured_carousel_block(
                        array(
                            array(
                                'id' => '1',
                                'title' => 'First Item Title',
                                'excerpt' => 'First item description...',
                                'date' => 'Date 1',
                                'category' => 'Category 1',
                                'type' => 'announcement',
                                'imageUrl' => 'https://images.unsplash.com/photo-1714791831455-33f641a7aa04?q=80&w=1631&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
                            ),
                            array(
                                'id' => '2',
                                'title' => 'Second Item Title',
                                'excerpt' => 'Second item description...',
                                'date' => 'Date 2',
                                'category' => 'Category 2',
                                'type' => 'news',
                                'imageUrl' => 'https://images.unsplash.com/photo-1570993966746-bf59399fb987?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
                            )
                        )
                    ); ?>
                </div>
                <div class="flex items-center space-x-4 mb-8">
                    <?php echo get_service_icon_svg('bell', 'w-6 h-6 text-primary-600'); ?>
                    <h2 class="text-2xl text-gray-800">Latest Updates</h2>
                </div>
                <?php
renderTabNavigation([
    'tabs' => [
        ['id' => 'products', 'label' => 'Our Products'],
        ['id' => 'services', 'label' => 'Our Services'],
        ['id' => 'about', 'label' => 'About Us']
    ],
    'contents' => [
        'products' => '<div class="rounded-lg border bg-card text-card-foreground shadow-sm hover:shadow-md transition-shadow">
                                            <div class="p-4">
                                                <h4 class="font-medium text-gray-800 mb-2">Municipal Hall</h4>
                                                <p class="text-gray-600 text-sm mb-2">Main government building housing
                                                    various municipal offices.</p>
                                                <div class="flex items-center justify-between gap-2">
                                                    <span class="flex items-center text-xs text-gray-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-600 w-3 h-3 mr-1"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path><circle cx="12" cy="10" r="3"></circle></svg>                                                        Town Center, Pinabacdao
                                                    </span>
                                                    <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent hover:bg-primary/80 bg-orange-100 text-orange-800">
                                                        Government Building</div>
                                                </div>
                                            </div>
                                        </div>',
        'services' => '<div>Services content here</div>',
        'about' => '<div>About us content here</div>'
    ]
]);
                ?>
            </div>
        </div>
    </main>

    <?php get_footer(); ?>
</div>