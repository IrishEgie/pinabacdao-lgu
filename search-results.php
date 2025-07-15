<?php
/**
 * Template Name: Search Results
 * Description: Custom search results page template
 */

get_header();
?>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Search Results</h1>
    
    <?php 
    // Get the search query from URL
    $search_query = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
    
    if (!empty($search_query)) {
        // Perform the search
        $search_args = array(
            's' => $search_query,
            'post_type' => array('post', 'page', 'services', 'departments', 'officials'),
            'posts_per_page' => 10
        );
        $search_results = new WP_Query($search_args);
        
        if ($search_results->have_posts()) {
            echo '<div class="space-y-6">';
            while ($search_results->have_posts()) {
                $search_results->the_post();
                ?>
                <article class="border-b border-gray-200 pb-6">
                    <h2 class="text-xl font-semibold mb-2">
                        <a href="<?php the_permalink(); ?>" class="hover:text-primary-600 transition-colors">
                            <?php the_title(); ?>
                        </a>
                    </h2>
                    <div class="text-gray-600">
                        <?php the_excerpt(); ?>
                    </div>
                    <div class="mt-2 text-sm text-gray-500">
                        <?php echo get_post_type_object(get_post_type())->labels->singular_name; ?>
                    </div>
                </article>
                <?php
            }
            echo '</div>';
            
            // Pagination
            echo '<div class="mt-8">';
            the_posts_pagination(array(
                'mid_size'  => 2,
                'prev_text' => __('Previous', 'textdomain'),
                'next_text' => __('Next', 'textdomain'),
            ));
            echo '</div>';
            
            wp_reset_postdata();
        } else {
            echo '<p class="text-gray-600">No results found for "' . esc_html($search_query) . '"</p>';
            get_search_form();
        }
    } else {
        echo '<p class="text-gray-600">Please enter a search term</p>';
        get_search_form();
    }
    ?>
</div>

<?php get_footer(); ?>