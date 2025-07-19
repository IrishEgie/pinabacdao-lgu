<?php
/**
 * Template Name: Announcements Archive
 * Description: WordPress template for Announcements post type archive
 */

get_header();
?>

<div class="min-h-screen bg-gray-50">
    <!-- Dynamic Page Banner -->
    <div><?php pageBanner([
    'title' => 'Announcements',
    'subtitle' => 'Important notices and updates from the municipality'
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
                                        <option>All Priorities</option>
                                        <option>High</option>
                                        <option>Medium</option>
                                        <option>Low</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <?php get_service_icon_svg('arrow-down')?>
                                    </div>
                                </div>
                                <div class="relative w-full md:w-auto">
                                    <select class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                        <option>All Years</option>
                                        <?php
                                        $years = get_posts(array(
                                            'post_type' => 'announcements',
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
                                        <?php get_service_icon_svg('arrow-down')?>
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
                                    $post_date = get_the_date('F j, Y');
                                    $expiry_date = get_field('announcement_expiry');
                                    $priority = get_field('announcement_priority');
                                    $priority_color = 'blue'; // default
                                    
                                    if ($priority === 'High') {
                                        $priority_color = 'red';
                                    } elseif ($priority === 'Medium') {
                                        $priority_color = 'yellow';
                                    } elseif ($priority === 'Low') {
                                        $priority_color = 'green';
                                    }
                                    
                                    $day = get_the_date('d');
                                    ?>
                                    <div class="p-6 hover:bg-gray-50 transition duration-150 ease-in-out">
                                        <div class="flex flex-col md:flex-row md:items-center gap-4">
                                            <div class="flex-shrink-0">
                                                <span class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-<?php echo $priority_color; ?>-100 text-<?php echo $priority_color; ?>-600 font-bold">
                                                    <?php echo $day; ?>
                                                </span>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h3 class="text-lg font-medium text-gray-900 hover:text-primary-600 transition duration-150 ease-in-out">
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </h3>
                                                <div class="flex flex-wrap gap-4 mt-1 text-sm text-gray-500">
                                                    <span>Posted on: <?php echo $post_date; ?></span>
                                                    <?php if ($expiry_date) : ?>
                                                        <span>Expires on: <?php echo date('F j, Y', strtotime($expiry_date)); ?></span>
                                                    <?php endif; ?>
                                                    <span class="text-<?php echo $priority_color; ?>-600">Priority: <?php echo $priority ?: 'Normal'; ?></span>
                                                </div>
                                                <div class="mt-2 text-gray-600">
                                                    <?php the_excerpt(); ?>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <a href="<?php the_permalink(); ?>" class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md text-<?php echo $priority_color; ?>-700 bg-<?php echo $priority_color; ?>-100 hover:bg-<?php echo $priority_color; ?>-200 transition duration-150 ease-in-out">
                                                    View Details
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                endwhile;
                            else :
                                ?>
                                <div class="p-6">
                                    <p class="text-gray-600">No current announcements available.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="bg-gray-50 px-6 py-4 flex items-center justify-between border-t border-gray-200">
                            <div class="flex-1 flex justify-between sm:hidden">
                                <?php previous_posts_link('Previous'); ?>
                                <?php next_posts_link('Next'); ?>
                            </div>
                            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-sm text-gray-700">
                                        <?php
                                        global $wp_query;
                                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                                        $per_page = get_query_var('posts_per_page');
                                        $total = $wp_query->found_posts;
                                        $first = ($per_page * $paged) - $per_page + 1;
                                        $last = min($per_page * $paged, $total);
                                        printf(
                                            'Showing <span class="font-medium">%1$d</span> to <span class="font-medium">%2$d</span> of <span class="font-medium">%3$d</span> results',
                                            $first,
                                            $last,
                                            $total
                                        );
                                        ?>
                                    </p>
                                </div>
                                <div>
                                    <?php
                                    the_posts_pagination(array(
                                        'mid_size' => 2,
                                        'prev_text' => '<span class="sr-only">Previous</span>' . get_service_icon_svg('arrow-left'),
                                        'next_text' => '<span class="sr-only">Next</span>' . get_service_icon_svg('arrow-right'),
                                        'screen_reader_text' => ' ',
                                        'type' => 'list'
                                    ));
                                    ?>
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