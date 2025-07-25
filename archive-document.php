<?php
/**
 * Template Name: Documents Archive
 * Description: WordPress template for Document post type archive
 */

get_header();
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
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <!-- Archive Filters -->
                        <div class="border-b border-gray-200 p-4 bg-gray-50">
                            <div class="flex flex-wrap items-center gap-4">
                                <div class="relative w-full md:w-auto">
                                    <select class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                        <option>All Document Types</option>
                                        <?php
                                        $document_types = get_terms(array(
                                            'taxonomy' => 'document_type',
                                            'hide_empty' => false
                                        ));
                                        foreach ($document_types as $type) {
                                            echo '<option>' . esc_html($type->name) . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <?php get_service_icon_svg('arrow-down') ?>
                                    </div>
                                </div>
                                <div class="relative w-full md:w-auto">
                                    <select class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                        <option>All Years</option>
                                        <?php
                                        $years = get_posts(array(
                                            'post_type' => 'document',
                                            'posts_per_page' => -1,
                                            'fields' => 'ids',
                                            'orderby' => 'date',
                                            'order' => 'DESC'
                                        ));
                                        $unique_years = array();
                                        foreach ($years as $post_id) {
                                            $year = get_the_date('Y', $post_id);
                                            if (!in_array($year, $unique_years)) {
                                                $unique_years[] = $year;
                                                echo '<option>' . esc_html($year) . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <?php get_service_icon_svg('arrow-down') ?>
                                    </div>
                                </div>
                                <button class="bg-primary-600 hover:bg-primary-700 text-white font-medium py-2 px-4 rounded transition duration-150 ease-in-out">
                                    Filter
                                </button>
                            </div>
                        </div>

                        <!-- Archive List -->
                        <div class="divide-y divide-gray-200">
                            <?php
                            if (have_posts()) :
                                while (have_posts()) : the_post();
                                    $date_issued = get_field('document_date_issued', get_the_ID());
                                    $date_effective = get_field('document_date_effective', get_the_ID());
                                    $document_types = get_the_terms(get_the_ID(), 'document_type');
                                    $type_name = !empty($document_types) ? esc_html($document_types[0]->name) : 'Document';
                                    $issuing_office = get_field('document_issuing_office', get_the_ID());
                                    $document_number = get_field('document_number', get_the_ID());
                                    $day = $date_issued ? date('d', strtotime($date_issued)) : get_the_date('d');
                                    
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
                                    <a href="<?php the_permalink(); ?>" class="block p-6 hover:bg-gray-50 transition duration-150 ease-in-out group">
                                        <div class="flex flex-col md:flex-row md:items-center gap-4">
                                            <div class="flex-shrink-0">
                                                <span class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-primary-100 text-primary-600 font-bold">
                                                    <?php echo substr($type_name, 0, 1); ?>
                                                </span>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h3 class="text-lg font-bold text-gray-900 group-hover:text-primary-600 transition duration-150 ease-in-out">
                                                    <?php the_title(); ?>
                                                    <?php if ($document_number): ?>
                                                        <span class="text-gray-500 font-normal">(<?php echo esc_html($document_number); ?>)</span>
                                                    <?php endif; ?>
                                                </h3>
                                                <div class="flex flex-wrap gap-4 mt-1 text-sm text-gray-500">
                                                    <?php if ($date_issued): ?>
                                                        <span>Issued: <?php echo date('F j, Y', strtotime($date_issued)); ?></span>
                                                    <?php endif; ?>
                                                    <?php if ($date_effective): ?>
                                                        <span>Effective: <?php echo date('F j, Y', strtotime($date_effective)); ?></span>
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
                                                <span class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md text-primary-700 bg-primary-100 group-hover:bg-primary-200 transition duration-150 ease-in-out">
                                                    View Document
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                <?php
                                endwhile;
                            else:
                                ?>
                                <div class="p-6">
                                    <p class="text-gray-600">No documents found.</p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Pagination -->
                        <?php clean_pagination([
                            'show_numbers' => 20,
                            'prev_text' => 'Previous',
                            'next_text' => 'Next'
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php get_footer(); ?>
</div>