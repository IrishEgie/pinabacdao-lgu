<?php
/**
 * Services Section Template Part
 * 
 * @package your-theme
 */

// Get the number of services to display (default to all if not specified)
$services_limit = $services_limit ?? -1;

$args = array(
    'post_type' => 'service',
    'posts_per_page' => $services_limit,
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'post_status' => 'publish'
);

$services_query = new WP_Query($args);
?>

<!-- Services Section -->
<section id="services" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php if ($services_query->have_posts()): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php while ($services_query->have_posts()):
                    $services_query->the_post(); 
                    $service_id = get_the_ID();
                    $service_icon = get_field('service_icon', $service_id);
                    $service_description = get_the_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 20);
                    $redirect_url = get_field('service_application_url', $service_id);
                    $open_new_tab = get_field('open_in_new_tab', $service_id);
                    $link_attributes = array(
                        'href' => $redirect_url ?: get_permalink(),
                        'target' => ($redirect_url && $open_new_tab) ? '_blank' : '',
                        'rel' => ($redirect_url && $open_new_tab) ? 'noopener noreferrer' : ''
                    );
                    ?>
                    <?php
                        $terms = get_the_terms($service_id, 'service_category');
                        if ($terms && !is_wp_error($terms)) : 
                            echo '<div class="flex flex-wrap gap-2 mt-2">';
                            foreach ($terms as $term) {
                                echo '<span class="bg-gray-100 text-gray-800 text-xs px-3 py-1 rounded-full">';
                                echo esc_html($term->name);
                                echo '</span>';
                            }
                            echo '</div>';
                        endif;
                    ?>
<div class="group bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-l-primary-600 h-full flex flex-col">
    <a 
        href="<?php echo esc_url($link_attributes['href']); ?>" 
        class="block h-full p-6 flex flex-col"
        <?php if (!empty($link_attributes['target'])) echo 'target="'.esc_attr($link_attributes['target']).'"'; ?>
        <?php if (!empty($link_attributes['rel'])) echo 'rel="'.esc_attr($link_attributes['rel']).'"'; ?>
    >
        <div class="flex items-start space-x-4 pb-4 min-h-[72px]"> <!-- Added min-height for icon+title -->
            <div class="p-3 bg-primary-50 rounded-lg group-hover:bg-primary-100 transition-colors duration-300 flex-shrink-0">
                <?php
                $icon_name = !empty($service_icon) ? sanitize_text_field($service_icon) : 'briefcase';
                $icon_name = array_key_exists($icon_name, get_service_icon_options()) ? $icon_name : 'briefcase';
                echo get_service_icon_svg($icon_name, 'w-6 h-6 text-primary-600');
                ?>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 group-hover:text-primary-600 transition-colors duration-300 line-clamp-2" title="<?php the_title_attribute(); ?>">
                <?php the_title(); ?>
            </h3>
        </div>
        
        <div class="flex-grow mb-4"> <!-- Changed to mb-4 for consistent spacing -->
            <p class="text-gray-600 leading-relaxed line-clamp-3"><?php echo esc_html($service_description); ?></p>
        </div>
        
        <div class="mt-auto pt-4"> <!-- Ensured button stays at bottom -->
            <button class="inline-flex items-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 w-full justify-between group-hover:bg-primary-50 transition-colors duration-300">
                <div class="flex items-center text-primary-600 group-hover:text-primary-700 transition-colors duration-300">
                    <span class="mr-2">Learn More</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-300">
                        <path d="M5 12h14" />
                        <path d="m12 5 7 7-7 7" />
                    </svg>
                </div>
            </button>
        </div>
    </a>
</div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        <?php else: ?>
            <div class="text-center py-12">
                <p class="text-gray-600 text-lg">No services available at the moment.</p>
            </div>
        <?php endif; ?>
    </div>
</section>