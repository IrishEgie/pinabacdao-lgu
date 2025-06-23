<?php
/**
 * Template Name: About Pinabacdao
 */

get_header();
?>
<!-- Breadcrumbs -->

<div><?php pageBanner(); ?></div>
<?php the_breadcrumbs(); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Page Header -->
    <div class="mb-12">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">About Pinabacdao</h1>
        <p class="text-gray-600">Learn about our municipality's history, vision, and commitment to serving our community</p>
    </div>

    <!-- Highlights Grid -->
    <section class="mb-16">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <?php
            $highlights = array(
                array(
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-primary"><circle cx="12" cy="12" r="10"></circle><path d="M16 8s-1.5 2-4 2-4-2-4-2"></path></svg>',
                    'title' => 'Our Vision',
                    'description' => 'A progressive and sustainable municipality providing quality services to all residents.'
                ),
                array(
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-primary"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>',
                    'title' => 'Our Mission',
                    'description' => 'To deliver efficient public services while promoting inclusive development and good governance.'
                ),
                array(
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-primary"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>',
                    'title' => 'Location',
                    'description' => 'Located in the Province of Samar, Philippines, serving diverse barangays and communities.'
                ),
                array(
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-primary"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>',
                    'title' => 'Recognition',
                    'description' => 'Committed to excellence in public service and community development initiatives.'
                )
            );

            foreach ($highlights as $item) {
                echo '
                <div class="text-card-foreground border bg-card rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center space-x-4 mb-4">
                            ' . $item['icon'] . '
                            <h2 class="text-xl font-semibold text-gray-800">' . $item['title'] . '</h2>
                        </div>
                        <p class="text-gray-600">' . $item['description'] . '</p>
                    </div>
                </div>';
            }
            ?>
        </div>
    </section>

    <!-- Municipality Overview -->
    <section class="bg-white rounded-lg shadow-md p-6 mb-16">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Municipality Overview</h2>
            <p class="text-gray-600">Serving our community with dedication and transparency</p>
        </div>

        <div class="space-y-6">
            <div>
                <h3 class="text-lg font-semibold mb-3 text-gray-800">History</h3>
                <p class="text-gray-600 leading-relaxed">
                    The Municipality of Pinabacdao has a rich history of community service and development. 
                    Established as a municipality in the Province of Samar, we continue to build on our 
                    legacy of public service and community engagement.
                </p>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold mb-3 text-gray-800">Geographic Profile</h3>
                <p class="text-gray-600 leading-relaxed">
                    Located in the beautiful Province of Samar, Philippines, our municipality encompasses 
                    various barangays, each contributing to the diverse and vibrant community we serve today.
                </p>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-3 text-gray-800">Our Commitment</h3>
                <p class="text-gray-600 leading-relaxed">
                    We are dedicated to providing efficient, transparent, and responsive public services 
                    while fostering sustainable development and improving the quality of life for all residents.
                </p>
            </div>
        </div>
    </section>
</div>

<?php
get_footer();
?>