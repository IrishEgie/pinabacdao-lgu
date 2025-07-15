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
                                    <div role="tablist" aria-orientation="horizontal"
                                        class="h-10 items-center justify-center rounded-md bg-muted p-1 text-muted-foreground grid w-full grid-cols-5">
                                        <button type="button" role="tab"
                                            class="inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 data-[state=active]:bg-background data-[state=active]:text-foreground data-[state=active]:shadow-sm">All
                                            Results</button>
                                        <button type="button" role="tab"
                                            class="inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 data-[state=active]:bg-background data-[state=active]:text-foreground data-[state=active]:shadow-sm">Events</button>
                                        <button type="button" role="tab"
                                            class="inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 data-[state=active]:bg-background data-[state=active]:text-foreground data-[state=active]:shadow-sm">Services</button>
                                        <button type="button" role="tab"
                                            class="inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 data-[state=active]:bg-background data-[state=active]:text-foreground data-[state=active]:shadow-sm">Personnel</button>
                                        <button type="button" role="tab"
                                            class="inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 data-[state=active]:bg-background data-[state=active]:text-foreground data-[state=active]:shadow-sm"
                                            data-state="active">Places</button>
                                    </div>

                                    <!-- Places Tab Content -->
                                    <div
                                        class="mt-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 space-y-4">
                                        <h3 class="text-lg font-semibold text-gray-800">Places &amp; Locations (3)</h3>

                                        <!-- Municipal Hall Card -->
                                        <div
                                            class="rounded-lg border bg-card text-card-foreground shadow-sm hover:shadow-md transition-shadow">
                                            <div class="p-4">
                                                <h4 class="font-medium text-gray-800 mb-2">Municipal Hall</h4>
                                                <p class="text-gray-600 text-sm mb-2">Main government building housing
                                                    various municipal offices.</p>
                                                <div class="flex items-center justify-between gap-2">
                                                    <span class="flex items-center text-xs text-gray-500">
                                                        <?php echo get_service_icon_svg('location', 'text-gray-600 w-3 h-3 mr-1') ?>
                                                        Town Center, Pinabacdao
                                                    </span>
                                                    <div
                                                        class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent hover:bg-primary/80 bg-orange-100 text-orange-800">
                                                        Government Building</div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Health Center Card -->
                                        <div
                                            class="rounded-lg border bg-card text-card-foreground shadow-sm hover:shadow-md transition-shadow">
                                            <div class="p-4">
                                                <h4 class="font-medium text-gray-800 mb-2">Municipal Health Center</h4>
                                                <p class="text-gray-600 text-sm mb-2">Primary healthcare facility
                                                    serving the municipality.</p>
                                                <div class="flex items-center justify-between">
                                                    <span class="flex items-center text-xs text-gray-500">
                                                        <?php echo get_service_icon_svg('location', 'text-gray-600 w-3 h-3 mr-1') ?>
                                                        Barangay Poblacion
                                                    </span>
                                                    <div
                                                        class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent hover:bg-primary/80 bg-orange-100 text-orange-800">
                                                        Healthcare Facility</div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Municipal Plaza Card -->
                                        <div
                                            class="rounded-lg border bg-card text-card-foreground shadow-sm hover:shadow-md transition-shadow">
                                            <div class="p-4">
                                                <h4 class="font-medium text-gray-800 mb-2">Municipal Plaza</h4>
                                                <p class="text-gray-600 text-sm mb-2">Central plaza for community
                                                    gatherings and events.</p>
                                                <div class="flex items-center justify-between">
                                                    <span class="flex items-center text-xs text-gray-500">
                                                        <?php echo get_service_icon_svg('location', 'text-gray-600 w-3 h-3 mr-1') ?>
                                                        Town Center
                                                    </span>
                                                    <div
                                                        class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent hover:bg-primary/80 bg-orange-100 text-orange-800">
                                                        Public Space</div>
                                                </div>
                                            </div>
                                        </div>
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