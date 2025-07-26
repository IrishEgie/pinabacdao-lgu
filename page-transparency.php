<?php
/*
Template Name: Transparency Page
*/
get_header();
?>

<div><?php pageBanner(); ?></div>
<?php the_breadcrumbs(); ?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Transparency Seal Section -->
    <div class="rounded-lg border bg-card text-card-foreground shadow-sm hover:shadow-lg transition-shadow duration-300 mb-8">
        <div class="flex flex-col lg:flex-row items-center gap-8 p-6">
            <div class="flex-shrink-0">
                <div class="w-32 h-32 lg:w-40 lg:h-40 bg-gradient-to-br from-primary-50 to-primary-100 rounded-full flex items-center justify-center shadow-lg">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR9SKvRPjCLHuewuaJb55kZr3_hDwrfJkLqvQ&s" 
                         alt="Seal of Transparency" class="w-24 h-24 lg:w-32 lg:h-32 object-contain" />
                </div>
            </div>
            <div class="flex-1 text-center lg:text-left">
                <h2 class="text-2xl lg:text-3xl font-bold text-gray-800 mb-4">
                    Committed to Transparency
                </h2>
                <p class="text-gray-600 leading-relaxed text-lg">
                    We are dedicated to maintaining the highest standards of transparency and accountability
                    in all our operations. Our commitment to open governance ensures that citizens have
                    access to information about how their government operates and how public resources are utilized.
                </p>
            </div>
        </div>
    </div>

    <!-- Document Categories Section -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Document Categories</h2>
        <p class="text-gray-600 mb-6">Organized access to public information and reports</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php
            // Get all document types with counts
            $document_types = get_terms([
                'taxonomy' => 'document_type',
                'hide_empty' => true,
            ]);
            
            // Define icons for each document type
            $type_icons = [
                'Ordinance' => 'gavel',
                'Executive Order' => 'file-text',
                'Memorandum' => 'clipboard',
                'Circular' => 'file-text',
                'Resolution' => 'file-text',
                'Policy' => 'file-text',
                'Guideline' => 'file-text',
                'Notice' => 'bell'
            ];
            
            if ($document_types && !is_wp_error($document_types)) {
                foreach ($document_types as $type) {
                    $icon_name = isset($type_icons[$type->name]) ? $type_icons[$type->name] : 'file-text';
                    $icon_svg = get_service_icon_svg($icon_name, 'w-8 h-8 text-primary-600');
                    $count = $type->count;
                    
                    echo '
                    <a href="#' . sanitize_title($type->name) . '" class="border bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 cursor-pointer">
                        <div class="p-5">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8">' . $icon_svg . '</div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800">' . esc_html($type->name) . '</h3>
                                    <p class="text-xs text-primary-600">' . $count . ' document' . ($count != 1 ? 's' : '') . '</p>
                                </div>
                            </div>
                            <p class="text-sm text-gray-600 mt-2">Browse all ' . esc_html($type->name) . ' documents</p>
                        </div>
                    </a>';
                }
            }
            ?>
        </div>
    </section>

    <!-- Recent Documents Section -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Recent Documents</h2>
        <p class="text-gray-600 mb-6">Latest transparency reports and public documents</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php
            // Get recent documents
            $recent_docs = new WP_Query([
                'post_type' => 'document',
                'posts_per_page' => 6,
                'orderby' => 'date',
                'order' => 'DESC',
                'meta_query' => [
                    [
                        'key' => 'document_file',
                        'compare' => 'EXISTS'
                    ]
                ]
            ]);
            
            if ($recent_docs->have_posts()) {
                while ($recent_docs->have_posts()) {
                    $recent_docs->the_post();
                    $document_file = get_field('document_file');
                    $document_type = wp_get_post_terms(get_the_ID(), 'document_type');
                    $type_name = !empty($document_type) ? $document_type[0]->name : 'Document';
                    $document_number = get_field('document_number');
                    $date_issued = get_field('document_date_issued');
                    $issuing_office = get_field('document_issuing_office');
                    
                    if ($document_file) {
                        $doc_data = [
                            'title' => $document_number ? $document_number . ' - ' . get_the_title() : get_the_title(),
                            'type' => $type_name,
                            'description' => get_the_excerpt(),
                            'fileType' => pathinfo($document_file['filename'], PATHINFO_EXTENSION),
                            'fileSize' => size_format($document_file['filesize'], 1),
                            'date' => $date_issued ? date('M j, Y', strtotime($date_issued)) : get_the_date('M j, Y'),
                            'downloadUrl' => $document_file['url'],
                            'showType' => true,
                            'showSize' => true
                        ];
                        
                        get_template_part('template-parts/cards/doc-card', null, ['doc' => $doc_data]);
                    }
                }
                wp_reset_postdata();
            } else {
                echo '<p class="text-gray-500 col-span-full text-center py-8">No recent documents found.</p>';
            }
            ?>
        </div>
    </section>

    <!-- Document Types Sections -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Official Issuances</h2>
        <p class="text-gray-600 mb-6">Local laws, orders, and resolutions enacted by the municipality</p>

        <!-- Document Types Navigation -->
        <?php if ($document_types && !is_wp_error($document_types)): ?>
        <div class="flex flex-wrap gap-2 mb-6">
            <?php foreach ($document_types as $type): ?>
                <a href="#<?php echo sanitize_title($type->name); ?>" 
                   class="px-3 py-1.5 bg-primary-100 text-primary-800 rounded-full text-xs font-medium hover:bg-primary-200 transition-colors">
                    <?php echo esc_html($type->name); ?>
                </a>
            <?php endforeach; ?>
        </div>

        <?php foreach ($document_types as $type): ?>
            <div id="<?php echo sanitize_title($type->name); ?>" class="mb-8">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <?php 
                    $icon_name = isset($type_icons[$type->name]) ? $type_icons[$type->name] : 'file-text';
                    echo display_service_icon($icon_name, 'w-6 h-6 text-primary-600');
                    ?>
                    <?php echo esc_html($type->name); ?>
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <?php
                    $type_docs = new WP_Query([
                        'post_type' => 'document',
                        'posts_per_page' => 3,
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'tax_query' => [
                            [
                                'taxonomy' => 'document_type',
                                'field' => 'term_id',
                                'terms' => $type->term_id,
                            ]
                        ],
                        'meta_query' => [
                            [
                                'key' => 'document_file',
                                'compare' => 'EXISTS'
                            ]
                        ]
                    ]);
                    
                    if ($type_docs->have_posts()) {
                        while ($type_docs->have_posts()) {
                            $type_docs->the_post();
                            $document_file = get_field('document_file');
                            $document_number = get_field('document_number');
                            $date_issued = get_field('document_date_issued');
                            
                            if ($document_file) {
                                $doc_data = [
                                    'title' => $document_number ? $document_number . ' - ' . get_the_title() : get_the_title(),
                                    'type' => $type->name,
                                    'description' => get_the_excerpt(),
                                    'fileType' => pathinfo($document_file['filename'], PATHINFO_EXTENSION),
                                    'fileSize' => size_format($document_file['filesize'], 1),
                                    'date' => $date_issued ? date('M j, Y', strtotime($date_issued)) : get_the_date('M j, Y'),
                                    'downloadUrl' => $document_file['url'],
                                    'showType' => false, // Don't show type since it's already in the section
                                    'showSize' => true
                                ];
                                
                                get_template_part('template-parts/cards/doc-card', null, ['doc' => $doc_data]);
                            }
                        }
                        wp_reset_postdata();
                    } else {
                        echo '<p class="text-gray-500 text-sm">No ' . esc_html($type->name) . ' documents found.</p>';
                    }
                    ?>
                </div>
                
                <?php if ($type->count > 3): ?>
                    <div class="mt-4">
                        <a href="<?php echo get_term_link($type); ?>" 
                           class="text-sm text-primary-600 hover:text-primary-800 font-medium inline-flex items-center">
                            View all <?php echo esc_html($type->name); ?> documents
                            <?php echo display_service_icon('arrow-right', 'h-4 w-4 ml-1'); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </section>

    <!-- Need Help Section -->
    <?php 
    display_need_help_section([
        'title' => 'Need Help With Transparency Documents?',
        'description' => 'For assistance accessing public documents or filing FOI requests, contact our transparency office.',
        'contact_info' => [
            'phone' => '(555) 123-4567',
            'email' => 'ict@municipality.gov'
        ],
        'mt_class' => 'mt-12',
        'bg_color' => 'bg-primary-50',
        'button' => [
            'call_text' => 'Call Information Communications Tech Office',
            'email_text' => 'Email Document Request',
            'call_class' => 'border border-primary-600 text-primary-600 hover:bg-primary-600 hover:text-white',
            'email_class' => 'bg-primary-600 hover:bg-primary-700 text-white'
        ]
    ]);
    ?>
</div>

<?php get_footer(); ?>