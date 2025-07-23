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

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
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
            
            foreach ($document_types as $type) {
                $icon = isset($type_icons[$type->name]) ? $type_icons[$type->name] : 'file-text';
                $count = $type->count;
                
                echo '
                <a href="#' . sanitize_title($type->name) . '" class="border bg-white rounded-lg shadow-sm hover:shadow-lg transition-shadow duration-300 cursor-pointer">
                    <div class="p-6">
                        <div class="flex items-center space-x-4 mb-4">
                            ' . get_service_icon_svg($icon, 'w-8 h-8 text-primary-600') . '
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">' . esc_html($type->name) . '</h3>
                                <p class="text-sm text-primary-600">' . $count . ' document' . ($count != 1 ? 's' : '') . '</p>
                            </div>
                        </div>
                        <p class="text-gray-600">Browse all ' . esc_html($type->name) . ' documents issued by the municipality</p>
                    </div>
                </a>';
            }
            ?>
        </div>
    </section>

    <!-- Recent Documents Section -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Recent Documents</h2>
        <p class="text-gray-600 mb-6">Latest transparency reports and public documents</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php
            // Get recent documents
            $recent_docs = new WP_Query([
                'post_type' => 'document',
                'posts_per_page' => 3,
                'orderby' => 'date',
                'order' => 'DESC'
            ]);
            
            if ($recent_docs->have_posts()) {
                while ($recent_docs->have_posts()) {
                    $recent_docs->the_post();
                    $document_file = get_field('document_file');
                    $document_type = wp_get_post_terms(get_the_ID(), 'document_type');
                    $type_name = !empty($document_type) ? $document_type[0]->name : 'Document';
                    
                    $issuance_data = [
                        'title' => get_the_title(),
                        'type' => $type_name,
                        'description' => get_the_excerpt(),
                        'fileType' => pathinfo($document_file['filename'], PATHINFO_EXTENSION),
                        'fileSize' => size_format($document_file['filesize'], 1),
                        'date' => get_the_date('M j, Y'),
                        'downloadUrl' => $document_file['url']
                    ];
                    
                    get_template_part('template-parts/cards/issuance-card', null, ['issuance' => $issuance_data]);
                }
                wp_reset_postdata();
            }
            ?>
        </div>
    </section>

    <!-- Document Types Sections -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Official Issuances</h2>
        <p class="text-gray-600 mb-6">Local laws, orders, and resolutions enacted by the municipality</p>

        <!-- Document Types Navigation -->
        <div class="flex flex-wrap gap-2 mb-6">
            <?php foreach ($document_types as $type): ?>
                <a href="#<?php echo sanitize_title($type->name); ?>" 
                   class="px-4 py-2 bg-primary-100 text-primary-800 rounded-full text-sm font-medium hover:bg-primary-200 transition-colors">
                    <?php echo esc_html($type->name); ?>
                </a>
            <?php endforeach; ?>
        </div>

        <?php foreach ($document_types as $type): ?>
            <div id="<?php echo sanitize_title($type->name); ?>" class="mb-8">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <?php 
                    $icon = isset($type_icons[$type->name]) ? $type_icons[$type->name] : 'file-text';
                    echo get_service_icon_svg($icon, 'text-primary-600 w-6 h-6'); 
                    ?>
                    <?php echo esc_html($type->name); ?>
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php
                    $type_docs = new WP_Query([
                        'post_type' => 'document',
                        'posts_per_page' => 6,
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'tax_query' => [
                            [
                                'taxonomy' => 'document_type',
                                'field' => 'term_id',
                                'terms' => $type->term_id,
                            ]
                        ]
                    ]);
                    
                    if ($type_docs->have_posts()) {
                        while ($type_docs->have_posts()) {
                            $type_docs->the_post();
                            $document_file = get_field('document_file');
                            $document_number = get_field('document_number');
                            
                            $issuance_data = [
                                'title' => $document_number ? $document_number . ' - ' . get_the_title() : get_the_title(),
                                'type' => $type->name,
                                'description' => get_the_excerpt(),
                                'fileType' => pathinfo($document_file['filename'], PATHINFO_EXTENSION),
                                'fileSize' => size_format($document_file['filesize'], 1),
                                'date' => get_the_date('M j, Y'),
                                'downloadUrl' => $document_file['url']
                            ];
                            
                            get_template_part('template-parts/cards/issuance-card', null, ['issuance' => $issuance_data]);
                        }
                        wp_reset_postdata();
                    } else {
                        echo '<p class="text-gray-500">No ' . esc_html($type->name) . ' documents found.</p>';
                    }
                    ?>
                </div>
                
                <?php if ($type_docs->found_posts > 6): ?>
                    <div class="mt-6 text-center">
                        <a href="<?php echo get_term_link($type); ?>" 
                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700">
                            View All <?php echo esc_html($type->name); ?> Documents
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </section>

    <!-- Enhanced Freedom of Information Section -->
    <section class="bg-gradient-to-r from-primary-50 to-indigo-50 rounded-lg shadow-md p-6 mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Freedom of Information (FOI)</h2>
        <p class="text-gray-600 mb-6">Your constitutional right to access public information</p>

        <div class="space-y-8">
            <?php 
            get_template_part('template-parts/sections/transparency-seal');
            get_template_part('template-parts/sections/transparency-hri');
            get_template_part('template-parts/sections/transparency-foi');
            ?>   
        </div>
    </section>
</div>

<?php get_footer(); ?>