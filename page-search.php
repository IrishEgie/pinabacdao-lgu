<?php
/**
 * Template Name: Pinabacdao Search Page
 * Description: WordPress template for the municipality search page
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
            <div class="flex">
                <div class="w-full">
                    <section class="py-8">
                        <div class="animate-fade-in">
                            <div class="max-w-4xl mx-auto">
                                <!-- Search Card -->
                                <div class="rounded-lg border bg-card text-card-foreground shadow-sm mb-8">
                                    <div class="flex flex-col space-y-1.5 p-6">
                                        <h3
                                            class="text-2xl font-semibold leading-none tracking-tight flex items-center space-x-2">
                                            <?php echo get_service_icon_svg('search', 'text-gray-600 w-6 h-6 mr-1') ?>
                                            <span>Search Municipality Website</span>
                                        </h3>
                                    </div>
                                    <div class="p-6 pt-0">
                                        <form class="space-y-4">
                                            <div class="flex space-x-2">
                                                <input type="text"
                                                    class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm flex-1"
                                                    placeholder="Search for events, services, personnel, or places..."
                                                    value="">
                                                <button
                                                    class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2"
                                                    type="submit">
                                                    <?php echo get_service_icon_svg('search', 'text-black w-6 h-6') ?>
                                                    Search
                                                </button>
                                            </div>
                                            <p class="text-sm text-gray-600">Enter your search terms and click Search to
                                                find what you're looking for.</p>
                                        </form>
                                    </div>
                                </div>

                                <!-- Tabs -->
                                <div class="w-full">
                                    <div class="flex items-center space-x-4 mb-8">

                                    </div>


                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>

    <?php get_footer(); ?>
</div>