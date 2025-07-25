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
    'posts_per_page' => 10,
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
                            <?php echo get_service_icon_svg('file-text', 'w-6 h-6 text-primary-600'); ?>
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
                            <?php echo get_service_icon_svg('search', 'absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4'); ?>
                            <input type="text" placeholder="Search documents by title, description, or content..."
                                class="pl-10 w-full h-10 rounded-md border px-3 py-2 text-base placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500" />
                        </div>

                        <!-- Filters -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
                            <button
                                class="flex h-10 w-full items-center justify-between rounded-md border px-3 py-2 text-sm bg-white hover:bg-gray-100 focus:ring-2 focus:ring-primary-500">
                                <span>Forms &amp; Applications</span>
                                <?php echo get_service_icon_svg('arrow-down', 'h-4 w-4 opacity-50'); ?>
                            </button>
                            <button
                                class="flex h-10 w-full items-center justify-between rounded-md border px-3 py-2 text-sm bg-white hover:bg-gray-100 focus:ring-2 focus:ring-primary-500">
                                <span>All Years</span>
                                <?php echo get_service_icon_svg('arrow-down', 'h-4 w-4 opacity-50'); ?>
                            </button>
                            <button
                                class="flex h-10 w-full items-center justify-between rounded-md border px-3 py-2 text-sm bg-white hover:bg-gray-100 focus:ring-2 focus:ring-primary-500">
                                <span>All Months</span>
                                <?php echo get_service_icon_svg('arrow-down', 'h-4 w-4 opacity-50'); ?>
                            </button>
                            <button
                                class="flex h-10 w-full items-center justify-between rounded-md border px-3 py-2 text-sm bg-white hover:bg-gray-100 focus:ring-2 focus:ring-primary-500">
                                <span>All Types</span>
                                <?php echo get_service_icon_svg('arrow-down', 'h-4 w-4 opacity-50'); ?>
                            </button>
                            <button
                                class="inline-flex items-center justify-center gap-2 w-full h-10 px-4 py-2 border rounded-md text-sm font-medium bg-white hover:bg-gray-100 focus:ring-2 focus:ring-primary-500">
                                <?php echo get_service_icon_svg('close', 'w-4 h-4 mr-2'); ?>
                                Clear All
                            </button>
                        </div>

                        <!-- Active Filters -->
                        <div class="flex flex-wrap gap-2 items-center">
                            <?php echo get_service_icon_svg('filter', 'w-4 h-4 text-gray-500'); ?>
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
                                <?php echo get_service_icon_svg('calendar', 'w-4 h-4'); ?>
                                <span>Use filters to narrow down results</span>
                            </div>
                        </div>
                    </div>

                    <!-- Document Archive Accordion Grouped by Type -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <!-- Accordion Container -->
                        <div class="divide-y divide-gray-200">
                            <?php
                            // Get all document types
                            $document_types = get_terms([
                                'taxonomy' => 'document_type',
                                'hide_empty' => true,
                            ]);

                            // Query all documents
                            $documents_query = new WP_Query([
                                'post_type' => 'document',
                                'posts_per_page' => -1,
                                'orderby' => 'meta_value',
                                'meta_key' => 'document_date_issued',
                                'order' => 'DESC'
                            ]);

                            // Group documents by type
                            $grouped_documents = [];
                            while ($documents_query->have_posts()):
                                $documents_query->the_post();
                                $types = get_the_terms(get_the_ID(), 'document_type');
                                $primary_type = !empty($types) ? $types[0]->name : 'Uncategorized';

                                if (!isset($grouped_documents[$primary_type])) {
                                    $grouped_documents[$primary_type] = [];
                                }

                                $grouped_documents[$primary_type][] = [
                                    'title' => get_the_title(),
                                    'id' => get_the_ID(),
                                    'date_issued' => get_field('document_date_issued', get_the_ID()),
                                    'date_effective' => get_field('document_date_effective', get_the_ID()),
                                    'document_types' => $types,
                                    'issuing_office' => get_field('document_issuing_office', get_the_ID()),
                                    'document_number' => get_field('document_number', get_the_ID()),
                                    'document_file' => get_field('document_file', get_the_ID()),
                                    'excerpt' => get_the_excerpt()
                                ];
                            endwhile;
                            wp_reset_postdata();

                            // Sort types alphabetically
                            ksort($grouped_documents);

                            foreach ($grouped_documents as $type_name => $documents):
                                $accordion_id = 'accordion-' . sanitize_title($type_name);
                                ?>
                                <div class="accordion-item">
                                    <h3 class="flex">
                                        <button type="button"
                                            class="accordion-trigger flex flex-1 items-center justify-between py-4 px-6 text-lg font-semibold transition-all hover:underline w-full text-left"
                                            aria-expanded="false" aria-controls="<?php echo $accordion_id; ?>">
                                            <div class="flex items-center justify-between w-full pr-4">
                                                <span><?php echo esc_html($type_name); ?></span>
                                                <div
                                                    class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 text-foreground">
                                                    <?php echo count($documents); ?> documents
                                                </div>
                                            </div>
                                            <?php echo get_service_icon_svg('arrow-down', 'h-4 w-4 shrink-0 transition-transform duration-200'); ?>
                                        </button>
                                    </h3>

                                    <div id="<?php echo $accordion_id; ?>" class="accordion-content hidden">
                                        <?php foreach ($documents as $document):
                                            $date_issued = $document['date_issued'];
                                            $date_effective = $document['date_effective'];
                                            $issuing_office = $document['issuing_office'];
                                            $document_number = $document['document_number'];
                                            $document_file = $document['document_file'];

                                            // Handle issuing office
                                            $office_name = '';
                                            if ($issuing_office) {
                                                if (is_object($issuing_office)) {
                                                    $office_name = $issuing_office->post_title;
                                                } elseif (is_string($issuing_office)) {
                                                    $office_name = $issuing_office;
                                                }
                                            }
                                            ?>
                                            <div class="group transition duration-150 ease-in-out">
                                                <div class="flex flex-col md:flex-row md:items-center gap-4 p-6 hover:bg-gray-50 cursor-pointer"
                                                    onclick="window.location.href='<?php echo $document_file ? esc_url($document_file['url']) : get_permalink($document['id']); ?>'">
                                                    <div class="flex-shrink-0">
                                                        <?php echo get_service_icon_svg('file-text', 'h-12 w-12 text-primary-600'); ?>
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <h3
                                                            class="text-lg font-bold text-gray-900 group-hover:text-primary-600 transition duration-150 ease-in-out">
                                                            <?php echo esc_html($document['title']); ?>
                                                            <?php if ($document_number): ?>
                                                                <span
                                                                    class="text-gray-500 font-normal">(<?php echo esc_html($document_number); ?>)</span>
                                                            <?php endif; ?>
                                                        </h3>
                                                        <div class="flex flex-wrap gap-4 mt-1 text-sm text-gray-500">
                                                            <?php if ($date_issued): ?>
                                                                <span>Issued:
                                                                    <?php echo date('F j, Y', strtotime($date_issued)); ?></span>
                                                            <?php endif; ?>
                                                            <?php if ($date_effective): ?>
                                                                <span>Effective:
                                                                    <?php echo date('F j, Y', strtotime($date_effective)); ?></span>
                                                            <?php endif; ?>
                                                            <?php if ($office_name): ?>
                                                                <span>Office: <?php echo esc_html($office_name); ?></span>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="mt-2 text-gray-600">
                                                            <?php echo $document['excerpt']; ?>
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
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <?php if (empty($grouped_documents)): ?>
                                <div class="p-6">
                                    <p class="text-gray-600">No documents found.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Quick Access -->
<?php
display_quick_access_section([
    'title' => 'Quick Access',
    'items' => [
        [
            'icon' => 'file-text',
            'title' => 'Forms & Applications',
            'description' => 'Download official forms',
            'color' => 'primary-600',
            'link' => '#forms'
        ],
        [
            'icon' => 'calendar',
            'title' => 'Annual Reports',
            'description' => 'View yearly summaries',
            'color' => 'green-600',
            'link' => '#reports'
        ],
        [
            'icon' => 'shield',
            'title' => 'Policies',
            'description' => 'Municipal regulations',
            'color' => 'orange-600',
            'link' => '#policies'
        ],
        [
            'icon' => 'search',
            'title' => 'Search All',
            'description' => 'Find specific documents',
            'color' => 'blue-600',
            'link' => '#search'
        ]
    ],
    'mt_class' => 'mt-12'
]);
?>
                    <!-- Need Help -->
<?php
display_need_help_section([
    'title' => 'Need Immediate Help?',
    'description' => 'Contact our support team 24/7 for urgent assistance with municipal services.',
    'contact_info' => [
        'phone' => '(123) 456-7890',
        'email' => 'support@pinabacdao.gov.ph'
    ],
    'bg_color' => 'bg-primary-50',
    'button' => [
        'call_text' => 'Emergency Call',
        'email_text' => 'Email Support',
        'call_class' => 'border border-primary-600 text-primary-600 hover:bg-primary-600 hover:text-white',
        'email_class' => 'bg-primary-600 hover:bg-primary-500 text-white'
    ],
    'mt_class' => 'mt-10'
]);
?>
                </div>
            </div>
        </div>
    </main>

    <?php get_footer(); ?>
</div>


<!-- Add this JavaScript to handle the accordion functionality -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const accordionTriggers = document.querySelectorAll('.accordion-trigger');

        accordionTriggers.forEach(trigger => {
            trigger.addEventListener('click', function () {
                const isExpanded = this.getAttribute('aria-expanded') === 'true';
                const content = document.getElementById(this.getAttribute('aria-controls'));
                const icon = this.querySelector('svg');

                // Toggle the content
                if (isExpanded) {
                    content.classList.add('hidden');
                    this.setAttribute('aria-expanded', 'false');
                    icon.classList.remove('rotate-180');
                } else {
                    content.classList.remove('hidden');
                    this.setAttribute('aria-expanded', 'true');
                    icon.classList.add('rotate-180');
                }
            });
        });
    });
</script>