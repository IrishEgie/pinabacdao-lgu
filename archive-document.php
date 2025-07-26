<?php
/**
 * Template Name: Documents Archive
 * Description: WordPress template for Document post type archive with filtering
 */

get_header();

// Handle filtering parameters
$search_query = isset($_GET['document_search']) ? sanitize_text_field($_GET['document_search']) : '';
$selected_type = isset($_GET['document_type']) ? sanitize_text_field($_GET['document_type']) : '';
$selected_year = isset($_GET['document_year']) ? sanitize_text_field($_GET['document_year']) : '';
$selected_month = isset($_GET['document_month']) ? sanitize_text_field($_GET['document_month']) : '';
$selected_category = isset($_GET['document_category']) ? sanitize_text_field($_GET['document_category']) : '';

// Build query arguments
$query_args = [
    'post_type' => 'document',
    'posts_per_page' => -1,
    'orderby' => 'meta_value',
    'meta_key' => 'document_date_issued',
    'order' => 'DESC',
    'post_status' => 'publish'
];

// Add search to query
if (!empty($search_query)) {
    $query_args['s'] = $search_query;
}

// Add taxonomy query for document type
if (!empty($selected_type)) {
    $query_args['tax_query'] = [
        [
            'taxonomy' => 'document_type',
            'field' => 'slug',
            'terms' => $selected_type,
        ]
    ];
}

// Add meta queries for date and other filters
$meta_query = [];

if (!empty($selected_year)) {
    $meta_query[] = [
        'key' => 'document_date_issued',
        'value' => $selected_year,
        'compare' => 'LIKE',
    ];
}

if (!empty($selected_month)) {
    $month_padded = str_pad($selected_month, 2, '0', STR_PAD_LEFT);
    $meta_query[] = [
        'key' => 'document_date_issued',
        'value' => '-' . $month_padded . '-',
        'compare' => 'LIKE',
    ];
}

if (!empty($meta_query)) {
    $query_args['meta_query'] = $meta_query;
}

// Execute the query
$documents_query = new WP_Query($query_args);
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
                    <!-- Archive Filters -->
<div class="space-y-4 p-4 bg-white rounded-lg border shadow-sm mb-6">
    <!-- Search Field -->
    <form method="get" action="<?php echo esc_url(get_post_type_archive_link('document')); ?>" id="document-filters-form">
        <div class="relative">
            <?php echo get_service_icon_svg('search', 'absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4'); ?>
            <input 
                type="text" 
                name="document_search" 
                placeholder="Search documents by title, description, or content..."
                value="<?php echo esc_attr($search_query); ?>"
                class="pl-10 w-full h-10 rounded-md border border-gray-300 px-3 py-2 text-base placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500" 
            />
        </div>

        <!-- Filters - Single Row on Desktop, Column on Mobile -->
        <div class="flex flex-col sm:flex-row gap-3 mt-4">
            <!-- Document Type Filter -->
            <div class="relative group flex-1">
                <?php
                $document_types = get_terms([
                    'taxonomy' => 'document_type',
                    'hide_empty' => true,
                ]);
                ?>
                <select 
                    name="document_type" 
                    class="appearance-none flex h-10 w-full items-center justify-between rounded-md border border-gray-300 px-3 py-2 text-sm bg-white hover:bg-gray-50 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 cursor-pointer"
                    onchange="document.getElementById('document-filters-form').submit()"
                >
                    <option value="">All Types</option>
                    <?php foreach ($document_types as $type): ?>
                        <option value="<?php echo esc_attr($type->slug); ?>" <?php selected($selected_type, $type->slug); ?>>
                            <?php echo esc_html($type->name); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                    <?php echo get_service_icon_svg('arrow-down', 'h-4 w-4 opacity-50'); ?>
                </div>
            </div>

            <!-- Year Filter -->
            <div class="relative group flex-1">
                <?php $years = get_document_years(); ?>
                <select 
                    name="document_year" 
                    class="appearance-none flex h-10 w-full items-center justify-between rounded-md border border-gray-300 px-3 py-2 text-sm bg-white hover:bg-gray-50 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 cursor-pointer"
                    onchange="document.getElementById('document-filters-form').submit()"
                >
                    <option value="">All Years</option>
                    <?php if (!empty($years)): ?>
                        <?php foreach ($years as $year): ?>
                            <?php if (!empty($year)): ?>
                                <option value="<?php echo esc_attr($year); ?>" <?php selected($selected_year, $year); ?>>
                                    <?php echo esc_html($year); ?>
                                </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                    <?php echo get_service_icon_svg('arrow-down', 'h-4 w-4 opacity-50'); ?>
                </div>
            </div>

            <!-- Month Filter -->
            <div class="relative group flex-1">
                <select 
                    name="document_month" 
                    class="appearance-none flex h-10 w-full items-center justify-between rounded-md border border-gray-300 px-3 py-2 text-sm bg-white hover:bg-gray-50 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 cursor-pointer"
                    onchange="document.getElementById('document-filters-form').submit()"
                >
                    <option value="">All Months</option>
                    <?php foreach (range(1, 12) as $month): ?>
                        <option value="<?php echo $month; ?>" <?php selected($selected_month, $month); ?>>
                            <?php echo date('F', mktime(0, 0, 0, $month, 1)); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                    <?php echo get_service_icon_svg('arrow-down', 'h-4 w-4 opacity-50'); ?>
                </div>
            </div>

            <!-- Clear Filters Button -->
            <?php 
            $has_active_filters = !empty($search_query) || !empty($selected_type) || !empty($selected_year) || !empty($selected_month);
            if ($has_active_filters): 
            ?>
                <div class="flex-1 sm:flex-none">
                    <a 
                        href="<?php echo esc_url(get_post_type_archive_link('document')); ?>" 
                        class="inline-flex items-center justify-center gap-2 w-full h-10 px-4 py-2 border border-gray-300 rounded-md text-sm font-medium bg-white hover:bg-gray-50 focus:ring-2 focus:ring-primary-500 transition-colors"
                    >
                        <?php echo get_service_icon_svg('close', 'w-4 h-4'); ?>
                        Clear All
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <!-- Search Button for Mobile -->
        <div class="mt-3 sm:hidden">
            <button 
                type="submit"
                class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500"
            >
                <?php echo get_service_icon_svg('search', 'w-4 h-4 mr-2'); ?>
                Search Documents
            </button>
        </div>
    </form>

    <!-- Active Filters Display -->
    <?php if (!empty($search_query) || !empty($selected_type) || !empty($selected_year) || !empty($selected_month)): ?>
        <div class="flex flex-wrap gap-2 items-center pt-3 border-t border-gray-200">
            <?php echo get_service_icon_svg('filter', 'w-4 h-4 text-gray-500'); ?>
            <span class="text-sm text-gray-600">Active filters:</span>
            
            <?php if (!empty($search_query)): ?>
                <span class="inline-flex items-center rounded-full bg-primary-100 px-2.5 py-0.5 text-xs font-medium text-primary-800">
                    Search: <?php echo esc_html($search_query); ?>
                </span>
            <?php endif; ?>
            
            <?php if (!empty($selected_type)): ?>
                <?php $type = get_term_by('slug', $selected_type, 'document_type'); ?>
                <span class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800">
                    Type: <?php echo $type ? esc_html($type->name) : esc_html($selected_type); ?>
                </span>
            <?php endif; ?>
            
            <?php if (!empty($selected_year)): ?>
                <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">
                    Year: <?php echo esc_html($selected_year); ?>
                </span>
            <?php endif; ?>
            
            <?php if (!empty($selected_month)): ?>
                <span class="inline-flex items-center rounded-full bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800">
                    Month: <?php echo date('F', mktime(0, 0, 0, $selected_month, 1)); ?>
                </span>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- Results Summary -->
    <div class="flex items-center justify-between text-sm text-gray-600 pt-3 border-t border-gray-200">
        <span class="flex items-center gap-2">
            <?php echo get_service_icon_svg('file-text', 'w-4 h-4'); ?>
            Showing <strong><?php echo $documents_query->found_posts; ?></strong> documents
        </span>
        <?php if ($documents_query->found_posts > 0): ?>
            <span class="flex items-center gap-2">
                <?php echo get_service_icon_svg('info', 'w-4 h-4'); ?>
                Click any section to expand
            </span>
        <?php endif; ?>
    </div>
</div>

                    <!-- Document Archive Accordion -->
                    <?php if ($documents_query->have_posts()): ?>
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <div class="divide-y divide-gray-200">
                                <?php
                                // Group filtered documents by type
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
                                    $is_single_type = count($grouped_documents) === 1;
                                    ?>
                                    <div class="accordion-item">
                                        <h3 class="flex">
                                            <button type="button"
                                                class="accordion-trigger flex flex-1 items-center justify-between py-5 px-6 text-lg font-semibold transition-all hover:bg-gray-50 w-full text-left focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-inset"
                                                aria-expanded="<?php echo $is_single_type ? 'true' : 'false'; ?>" 
                                                aria-controls="<?php echo $accordion_id; ?>">
                                                <div class="flex items-center justify-between w-full pr-4">
                                                    <span class="text-gray-900"><?php echo esc_html($type_name); ?></span>
                                                    <span class="inline-flex items-center rounded-full border border-gray-200 bg-gray-50 px-2.5 py-0.5 text-xs font-semibold text-gray-700">
                                                        <?php echo count($documents); ?> document<?php echo count($documents) !== 1 ? 's' : ''; ?>
                                                    </span>
                                                </div>
                                                <?php echo get_service_icon_svg('arrow-down', 'h-5 w-5 shrink-0 transition-transform duration-200 text-gray-500' . ($is_single_type ? ' rotate-180' : '')); ?>
                                            </button>
                                        </h3>

                                        <div id="<?php echo $accordion_id; ?>" class="accordion-content <?php echo $is_single_type ? '' : 'hidden'; ?>">
                                            <div class="border-t border-gray-100">
                                                <?php foreach ($documents as $index => $document):
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

                                                    $target_url = $document_file ? esc_url($document_file['url']) : get_permalink($document['id']);
                                                    $is_external = $document_file ? true : false;
                                                    ?>
                                                    <div class="group transition-colors duration-150 ease-in-out <?php echo $index > 0 ? 'border-t border-gray-100' : ''; ?>">
                                                        <div class="flex flex-col lg:flex-row lg:items-center gap-4 p-6 hover:bg-gray-50 cursor-pointer"
                                                            onclick="<?php echo $is_external ? 'window.open(\'' . $target_url . '\', \'_blank\')' : 'window.location.href=\'' . $target_url . '\''; ?>">
                                                            
                                                            <!-- Document Icon -->
                                                            <div class="flex-shrink-0">
                                                                <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center group-hover:bg-primary-200 transition-colors">
                                                                    <?php echo get_service_icon_svg('file-text', 'h-6 w-6 text-primary-600'); ?>
                                                                </div>
                                                            </div>
                                                            
                                                            <!-- Document Details -->
                                                            <div class="flex-1 min-w-0">
                                                                <h4 class="text-lg font-semibold text-gray-900 group-hover:text-primary-700 transition-colors leading-tight">
                                                                    <?php echo esc_html($document['title']); ?>
                                                                    <?php if ($document_number): ?>
                                                                        <span class="text-gray-500 font-normal text-base ml-2">(<?php echo esc_html($document_number); ?>)</span>
                                                                    <?php endif; ?>
                                                                </h4>
                                                                
                                                                <!-- Document Metadata -->
                                                                <div class="flex flex-wrap gap-4 mt-2 text-sm text-gray-600">
                                                                    <?php if ($date_issued): ?>
                                                                        <span class="flex items-center gap-1">
                                                                            <?php echo get_service_icon_svg('calendar', 'w-4 h-4'); ?>
                                                                            Issued: <?php echo date('M j, Y', strtotime($date_issued)); ?>
                                                                        </span>
                                                                    <?php endif; ?>
                                                                    <?php if ($date_effective && $date_effective !== $date_issued): ?>
                                                                        <span class="flex items-center gap-1">
                                                                            <?php echo get_service_icon_svg('clock', 'w-4 h-4'); ?>
                                                                            Effective: <?php echo date('M j, Y', strtotime($date_effective)); ?>
                                                                        </span>
                                                                    <?php endif; ?>
                                                                    <?php if ($office_name): ?>
                                                                        <span class="flex items-center gap-1">
                                                                            <?php echo get_service_icon_svg('building', 'w-4 h-4'); ?>
                                                                            <?php echo esc_html($office_name); ?>
                                                                        </span>
                                                                    <?php endif; ?>
                                                                </div>
                                                                
                                                                <!-- Document Excerpt -->
                                                                <?php if ($document['excerpt']): ?>
                                                                    <div class="mt-3 text-gray-700 leading-relaxed">
                                                                        <?php echo wp_trim_words($document['excerpt'], 25, '...'); ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                            
                                                            <!-- Action Button -->
                                                            <div class="flex-shrink-0 flex items-center gap-2">
                                                                <span class="inline-flex items-center gap-2 px-4 py-2 border border-transparent text-sm font-medium rounded-md text-primary-700 bg-primary-100 group-hover:bg-primary-200 group-hover:text-primary-800 transition-colors">
                                                                    <?php if ($is_external): ?>
                                                                        <?php echo get_service_icon_svg('download', 'w-4 h-4'); ?>
                                                                        Download
                                                                    <?php else: ?>
                                                                        <?php echo get_service_icon_svg('file-text', 'w-4 h-4'); ?>
                                                                        View Details
                                                                    <?php endif; ?>
                                                                </span>
                                                                <?php if ($is_external): ?>
                                                                    <?php echo get_service_icon_svg('external-link', 'w-4 h-4 text-gray-400 group-hover:text-gray-600'); ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- No Results State -->
                        <div class="bg-white rounded-lg shadow-md p-12 text-center">
                            <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                                <?php echo get_service_icon_svg('search', 'w-8 h-8 text-gray-400'); ?>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">No documents found</h3>
                            <p class="text-gray-600 mb-6">
                                We couldn't find any documents matching your current filters. Try adjusting your search criteria.
                            </p>
                            <a 
                                href="<?php echo esc_url(get_post_type_archive_link('document')); ?>" 
                                class="inline-flex items-center gap-2 px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500"
                            >
                                <?php echo get_service_icon_svg('refresh', 'w-4 h-4'); ?>
                                Show All Documents
                            </a>
                        </div>
                    <?php endif; ?>

                    <!-- Quick Access Section -->
                    <?php
display_quick_access_section([
    'title' => 'Quick Access',
    'items' => [
        [
            'icon' => 'clock',
            'title' => 'Recent Documents',
            'description' => 'Added in last 30 days',
            'color' => 'primary-600',
            'link' => get_recent_documents_link()
        ],
        [
            'icon' => 'gavel',
            'title' => 'Ordinances',
            'description' => 'Local laws and regulations',
            'color' => 'yellow-600',
            'link' => add_query_arg('document_type', 'ordinance', get_post_type_archive_link('document'))
        ],
        [
            'icon' => 'file-text',
            'title' => 'Resolutions',
            'description' => 'Official decisions',
            'color' => 'orange-600',
            'link' => add_query_arg('document_type', 'resolution', get_post_type_archive_link('document'))
        ],
        [
            'icon' => 'star',
            'title' => 'Executive Orders',
            'description' => 'Executive directives',
            'color' => 'blue-600',
            'link' => add_query_arg('document_type', 'executive-order', get_post_type_archive_link('document'))
        ],
    ],
    'mt_class' => 'mt-12'
]);
?>

                    <!-- Need Help Section -->
                    <?php
                    display_need_help_section([
                        'title' => 'Need Help Finding Documents?',
                        'description' => 'Contact our records department for assistance with document requests and archives.',
                        'contact_info' => [
                            'phone' => '(123) 456-7890',
                            'email' => 'records@pinabacdao.gov.ph'
                        ],
                        'bg_color' => 'bg-primary-50',
                        'button' => [
                            'call_text' => 'Call Records',
                            'email_text' => 'Email Request',
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
</div>

<!-- Enhanced JavaScript for Accordion and Form Handling -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Accordion functionality
    const accordionTriggers = document.querySelectorAll('.accordion-trigger');

    accordionTriggers.forEach(trigger => {
        trigger.addEventListener('click', function (e) {
            e.preventDefault();
            
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            const content = document.getElementById(this.getAttribute('aria-controls'));
            const icon = this.querySelector('svg');

            if (!content || !icon) return;

            // Toggle the content with smooth animation
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

    // Auto-submit search form with debouncing
    const searchInput = document.querySelector('input[name="document_search"]');
    let searchTimeout;

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                document.getElementById('document-filters-form').submit();
            }, 1000); // Wait 1 second after user stops typing
        });

        // Also submit on Enter key
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('document-filters-form').submit();
            }
        });
    }

    // Prevent accordion from closing when clicking on document items
    const documentItems = document.querySelectorAll('.accordion-content [onclick]');
    documentItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });
});
</script>

<?php get_footer(); ?>