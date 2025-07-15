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
<?
renderTabNavigation([
    'tabs' => [
        ['id' => 'all_results', 'label' => 'All Results'],
        ['id' => 'events', 'label' => 'Events'],
        ['id' => 'news', 'label' => 'News'],
        ['id' => 'services', 'label' => 'Services'],
    ],
    'contents' => [
        'services' => '<div class="rounded-lg border bg-card text-card-foreground shadow-sm hover:shadow-md transition-shadow">
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
        'all_results' => '<div class="mt-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 space-y-4">
                                        <h3 class="text-lg font-semibold text-gray-800">Places &amp; Locations (3)</h3>

                                        <!-- Municipal Hall Card -->
                                        <div class="rounded-lg border bg-card text-card-foreground shadow-sm hover:shadow-md transition-shadow">
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
                                        </div>

                                        <!-- Health Center Card -->
                                        <div class="rounded-lg border bg-card text-card-foreground shadow-sm hover:shadow-md transition-shadow">
                                            <div class="p-4">
                                                <h4 class="font-medium text-gray-800 mb-2">Municipal Health Center</h4>
                                                <p class="text-gray-600 text-sm mb-2">Primary healthcare facility
                                                    serving the municipality.</p>
                                                <div class="flex items-center justify-between">
                                                    <span class="flex items-center text-xs text-gray-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-600 w-3 h-3 mr-1"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path><circle cx="12" cy="10" r="3"></circle></svg>                                                        Barangay Poblacion
                                                    </span>
                                                    <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent hover:bg-primary/80 bg-orange-100 text-orange-800">
                                                        Healthcare Facility</div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Municipal Plaza Card -->
                                        <div class="rounded-lg border bg-card text-card-foreground shadow-sm hover:shadow-md transition-shadow">
                                            <div class="p-4">
                                                <h4 class="font-medium text-gray-800 mb-2">Municipal Plaza</h4>
                                                <p class="text-gray-600 text-sm mb-2">Central plaza for community
                                                    gatherings and events.</p>
                                                <div class="flex items-center justify-between">
                                                    <span class="flex items-center text-xs text-gray-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-600 w-3 h-3 mr-1"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path><circle cx="12" cy="10" r="3"></circle></svg>                                                        Town Center
                                                    </span>
                                                    <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent hover:bg-primary/80 bg-orange-100 text-orange-800">
                                                        Public Space</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>',
        'about' => '<div>About us content here</div>'
    ]
]);
?>
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