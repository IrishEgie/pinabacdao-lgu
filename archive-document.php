<?php
/**
 * Template Name: Documents Archive
 * Description: WordPress template for Document post type archive
 */

get_header();

// Set up custom query with posts per page
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$documents_query = new WP_Query(array(
    'post_type' => 'document',
    'posts_per_page' => 10, // Adjust number as needed
    'paged' => $paged,
    'orderby' => 'meta_value',
    'meta_key' => 'document_date_issued',
    'order' => 'DESC'
));
?>

<div class="min-h-screen bg-gray-50">
    <!-- Dynamic Page Banner -->
    <div><?php pageBanner([
        'title' => 'Documents Archive',
        'subtitle' => 'Browse official documents, ordinances, and orders'
    ]); ?></div>

    <!-- Dynamic Breadcrumbs -->
    <?php the_breadcrumbs(); ?>

    <main class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex gap-8">
                <!-- Main Content Area -->
                <div class="w-full">
                    <!-- Resource Library Header -->
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center space-x-4">
                            <?php echo get_service_icon_svg('file-text', 'w-6 h-6 text-blue-600'); ?>
                            <h2 class="text-2xl font-bold text-gray-800">Resource Library</h2>
                        </div>
                    </div>
                    <div class="mb-8">
                        <p class="text-gray-600 leading-relaxed">
                            Welcome to our comprehensive document center. Here you can find important municipal
                            documents, annual reports, policy documents, forms, and technical resources. Use the
                            advanced filters below to quickly locate specific documents by category, date, or file type.
                        </p>
                    </div>

                    <!-- Archive Filters -->
                    <div class="space-y-4 p-4 bg-gray-50 rounded-lg border mb-6">
                        <!-- Search Field -->
                        <div class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="M21 21l-4.3-4.3"></path>
                            </svg>
                            <input type="text" placeholder="Search documents by title, description, or content..."
                                class="pl-10 w-full h-10 rounded-md border px-3 py-2 text-base placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        </div>

                        <!-- Filters -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
                            <button
                                class="flex h-10 w-full items-center justify-between rounded-md border px-3 py-2 text-sm bg-white hover:bg-gray-100 focus:ring-2 focus:ring-blue-500">
                                <span>Forms &amp; Applications</span>
                                <svg class="h-4 w-4 opacity-50" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path d="M6 9l6 6 6-6"></path>
                                </svg>
                            </button>
                            <button
                                class="flex h-10 w-full items-center justify-between rounded-md border px-3 py-2 text-sm bg-white hover:bg-gray-100 focus:ring-2 focus:ring-blue-500">
                                <span>All Years</span>
                                <svg class="h-4 w-4 opacity-50" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path d="M6 9l6 6 6-6"></path>
                                </svg>
                            </button>
                            <button
                                class="flex h-10 w-full items-center justify-between rounded-md border px-3 py-2 text-sm bg-white hover:bg-gray-100 focus:ring-2 focus:ring-blue-500">
                                <span>All Months</span>
                                <svg class="h-4 w-4 opacity-50" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path d="M6 9l6 6 6-6"></path>
                                </svg>
                            </button>
                            <button
                                class="flex h-10 w-full items-center justify-between rounded-md border px-3 py-2 text-sm bg-white hover:bg-gray-100 focus:ring-2 focus:ring-blue-500">
                                <span>All Types</span>
                                <svg class="h-4 w-4 opacity-50" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path d="M6 9l6 6 6-6"></path>
                                </svg>
                            </button>
                            <button
                                class="inline-flex items-center justify-center gap-2 w-full h-10 px-4 py-2 border rounded-md text-sm font-medium bg-white hover:bg-gray-100 focus:ring-2 focus:ring-blue-500">
                                <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path d="M18 6L6 18"></path>
                                    <path d="M6 6l12 12"></path>
                                </svg>
                                Clear All
                            </button>
                        </div>

                        <!-- Active Filters -->
                        <div class="flex flex-wrap gap-2 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                            </svg>
                            <span class="text-sm text-gray-600">Active filters:</span>
                            <div
                                class="inline-flex items-center rounded-full bg-gray-200 px-2.5 py-0.5 text-xs font-semibold text-gray-700">
                                Category: Forms &amp; Applications
                            </div>
                        </div>

                        <!-- Results Info -->
                        <div class="flex items-center justify-between text-sm text-gray-600">
                            <span>Showing 30 of 138 documents</span>
                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path d="M8 2v4"></path>
                                    <path d="M16 2v4"></path>
                                    <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                    <path d="M3 10h18"></path>
                                </svg>
                                <span>Use filters to narrow down results</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md overflow-hidden">



                        <!-- Archive List -->
                        <div class="divide-y divide-gray-200">
                            <?php
                            if ($documents_query->have_posts()):
                                while ($documents_query->have_posts()):
                                    $documents_query->the_post();
                                    $date_issued = get_field('document_date_issued', get_the_ID());
                                    $date_effective = get_field('document_date_effective', get_the_ID());
                                    $document_types = get_the_terms(get_the_ID(), 'document_type');
                                    $type_name = !empty($document_types) ? esc_html($document_types[0]->name) : 'Document';
                                    $issuing_office = get_field('document_issuing_office', get_the_ID());
                                    $document_number = get_field('document_number', get_the_ID());
                                    $document_file = get_field('document_file', get_the_ID());

                                    // Handle issuing office (could be WP_Post object or string)
                                    $office_name = '';
                                    if ($issuing_office) {
                                        if (is_object($issuing_office) && isset($issuing_office->post_title)) {
                                            $office_name = $issuing_office->post_title;
                                        } elseif (is_string($issuing_office)) {
                                            $office_name = $issuing_office;
                                        }
                                    }
                                    ?>
                                    <div class="group transition duration-150 ease-in-out">
                                        <div class="flex flex-col md:flex-row md:items-center gap-4 p-6 hover:bg-gray-50 cursor-pointer"
                                            onclick="window.location.href='<?php echo $document_file ? esc_url($document_file['url']) : the_permalink(); ?>'">
                                            <div class="flex-shrink-0">
                                                <?php echo get_service_icon_svg('file-text', 'h-12 w-12 text-primary-600'); ?>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h3
                                                    class="text-lg font-bold text-gray-900 group-hover:text-primary-600 transition duration-150 ease-in-out">
                                                    <?php the_title(); ?>
                                                    <?php if ($document_number): ?>
                                                        <span
                                                            class="text-gray-500 font-normal">(<?php echo esc_html($document_number); ?>)</span>
                                                    <?php endif; ?>
                                                </h3>
                                                <div class="flex flex-wrap gap-4 mt-1 text-sm text-gray-500">
                                                    <?php if ($date_issued): ?>
                                                        <span>Issued: <?php echo date('F j, Y', strtotime($date_issued)); ?></span>
                                                    <?php endif; ?>
                                                    <?php if ($date_effective): ?>
                                                        <span>Effective:
                                                            <?php echo date('F j, Y', strtotime($date_effective)); ?></span>
                                                    <?php endif; ?>
                                                    <span class="text-primary-600">Type: <?php echo $type_name; ?></span>
                                                    <?php if ($office_name): ?>
                                                        <span>Office: <?php echo esc_html($office_name); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="mt-2 text-gray-600">
                                                    <?php the_excerpt(); ?>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <span
                                                    class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md text-primary-700 bg-primary-100 group-hover:bg-primary-200 transition duration-150 ease-in-out">
                                                    <?php echo $document_file ? 'View File' : 'View Details'; ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                endwhile;

                                // Reset post data
                                wp_reset_postdata();
                            else:
                                ?>
                                <div class="p-6">
                                    <p class="text-gray-600">No documents found.</p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Pagination -->
                        <?php
                        clean_pagination([
                            'show_numbers' => 5,
                            'prev_text' => 'Previous',
                            'next_text' => 'Next'
                        ]);
                        ?>
                    </div>
                    <!-- Quick Access -->
                    <div
                        class="rounded-lg border bg-white text-white-foreground shadow-sm hover:shadow-lg transition-shadow duration-300 mt-12">
                        <div class="flex flex-col space-y-1.5 p-6">
                            <h3 class="font-semibold tracking-tight text-2xl text-gray-800">Quick Access</h3>
                        </div>
                        <div class="p-6 pt-0">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                                <!-- Forms & Applications -->
                                <div
                                    class="text-center p-4 border rounded-lg hover:bg-gray-50 transition-colors cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="w-8 h-8 mx-auto mb-2 text-blue-600">
                                        <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path>
                                        <path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
                                        <path d="M10 9H8"></path>
                                        <path d="M16 13H8"></path>
                                        <path d="M16 17H8"></path>
                                    </svg>
                                    <h4 class="font-semibold mb-1">Forms &amp; Applications</h4>
                                    <p class="text-sm text-gray-600">Download official forms</p>
                                </div>

                                <!-- Annual Reports -->
                                <div
                                    class="text-center p-4 border rounded-lg hover:bg-gray-50 transition-colors cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="w-8 h-8 mx-auto mb-2 text-green-600">
                                        <path d="M8 2v4"></path>
                                        <path d="M16 2v4"></path>
                                        <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                        <path d="M3 10h18"></path>
                                    </svg>
                                    <h4 class="font-semibold mb-1">Annual Reports</h4>
                                    <p class="text-sm text-gray-600">View yearly summaries</p>
                                </div>

                                <!-- Policies -->
                                <div
                                    class="text-center p-4 border rounded-lg hover:bg-gray-50 transition-colors cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="w-8 h-8 mx-auto mb-2 text-orange-600">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="7 10 12 15 17 10"></polyline>
                                        <line x1="12" x2="12" y1="15" y2="3"></line>
                                    </svg>
                                    <h4 class="font-semibold mb-1">Policies</h4>
                                    <p class="text-sm text-gray-600">Municipal regulations</p>
                                </div>

                                <!-- Search All -->
                                <div
                                    class="text-center p-4 border rounded-lg hover:bg-gray-50 transition-colors cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="w-8 h-8 mx-auto mb-2 text-purple-600">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <path d="m21 21-4.3-4.3"></path>
                                    </svg>
                                    <h4 class="font-semibold mb-1">Search All</h4>
                                    <p class="text-sm text-gray-600">Find specific documents</p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Need Help -->
                    <div
                        class="rounded-lg border bg-white text-white-foreground shadow-sm hover:shadow-lg transition-shadow duration-300 mt-8">
                        <div class="flex flex-col space-y-1.5 p-6">
                            <h3 class="font-semibold tracking-tight text-2xl text-gray-800">Need Help?</h3>
                        </div>
                        <div class="p-6 pt-0">
                            <div class="text-center">
                                <p class="text-gray-600 mb-4">
                                    Can't find what you're looking for? Our staff is here to help you locate the
                                    documents you need.
                                </p>
                                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                    <div class="text-sm">
                                        <strong>Email:</strong> documents@municipality.gov
                                    </div>
                                    <div class="text-sm">
                                        <strong>Phone:</strong> (555) 123-4567
                                    </div>
                                    <div class="text-sm">
                                        <strong>Office Hours:</strong> Mon-Fri 8:00 AM - 5:00 PM
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <?php get_footer(); ?>
</div>