<?php 

// Register Custom Post Type for Services
function register_services_post_type() {
    $labels = array(
        'name'                  => 'Services',
        'singular_name'         => 'Service',
        'menu_name'             => 'Services',
        'name_admin_bar'        => 'Service',
        'archives'              => 'Service Archives',
        'attributes'            => 'Service Attributes',
        'parent_item_colon'     => 'Parent Service:',
        'all_items'             => 'All Services',
        'add_new_item'          => 'Add New Service',
        'add_new'               => 'Add New',
        'new_item'              => 'New Service',
        'edit_item'             => 'Edit Service',
        'update_item'           => 'Update Service',
        'view_item'             => 'View Service',
        'view_items'            => 'View Services',
        'search_items'          => 'Search Service',
        'not_found'             => 'Not found',
        'not_found_in_trash'    => 'Not found in Trash',
        'featured_image'        => 'Featured Image',
        'set_featured_image'    => 'Set featured image',
        'remove_featured_image' => 'Remove featured image',
        'use_featured_image'    => 'Use as featured image',
        'insert_into_item'      => 'Insert into service',
        'uploaded_to_this_item' => 'Uploaded to this service',
        'items_list'            => 'Services list',
        'items_list_navigation' => 'Services list navigation',
        'filter_items_list'     => 'Filter services list',
    );
    $args = [
        'label'         => 'Service',
        'description'   => 'Municipal services offered',
        'labels'        => $labels,
        'supports'      => ['title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'],
        'taxonomies'    => ['service_category'],
        'public'        => true,
        'show_in_rest'  => true,
        'menu_icon'     => 'dashicons-list-view',
        'rewrite'       => ['slug' => 'service', 'with_front' => false],
        'has_archive' => true,

    ];
    
    register_post_type('service', $args);
}
add_action('init', 'register_services_post_type', 0);

// Service Link Attributes Function
function get_service_link_attributes($post_id) {
    $redirect_url = get_field('service_application_url', $post_id);
    $open_new_tab = get_field('open_in_new_tab', $post_id);
    
    return [
        'href' => $redirect_url ?: get_permalink($post_id),
        'target' => ($redirect_url && $open_new_tab) ? '_blank' : '',
        'rel' => ($redirect_url && $open_new_tab) ? 'noopener noreferrer' : ''
    ];
}

// Service Display Shortcode
function services_shortcode($atts) {
    $atts = shortcode_atts([
        'limit' => -1,
        'columns' => 3,
        'show_description' => true
    ], $atts);

    $services = new WP_Query([
        'post_type'      => 'service',
        'posts_per_page' => intval($atts['limit']),
        'orderby'        => 'menu_order',
        'order'          => 'ASC'
    ]);

    if (!$services->have_posts()) return '<p>No services found.</p>';

    // Column class mapping
    $col_classes = [
        2 => 'md:grid-cols-2',
        4 => 'md:grid-cols-2 lg:grid-cols-4',
        'default' => 'md:grid-cols-2 lg:grid-cols-3'
    ];
    
    $column_class = $col_classes[$atts['columns']] ?? $col_classes['default'];

    ob_start(); ?>
    <div class="services-grid grid grid-cols-1 <?php echo esc_attr($column_class); ?> gap-6">
        <?php while ($services->have_posts()) : 
            $services->the_post();
            $link_attrs = get_service_link_attributes(get_the_ID());
            $service_icon = get_field('service_icon', get_the_ID());
            ?>
            <div class="service-card bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-6">
                <div class="flex items-center space-x-3 mb-3">
                    <?php if ($service_icon) : ?>
                        <div class="flex-shrink-0">
                            <?php echo get_service_icon_svg($service_icon, 'w-8 h-8 text-blue-600'); ?>
                        </div>
                    <?php endif; ?>
                    <h3 class="text-lg font-semibold text-gray-800">
                        <a href="<?php echo esc_url($link_attrs['href']); ?>"
                           <?php if ($link_attrs['target']) echo 'target="'.esc_attr($link_attrs['target']).'"'; ?>
                           <?php if ($link_attrs['rel']) echo 'rel="'.esc_attr($link_attrs['rel']).'"'; ?>
                           class="hover:text-blue-600 transition-colors">
                            <?php the_title(); ?>
                        </a>
                    </h3>
                </div>
                <?php if ($atts['show_description'] && $excerpt = get_the_excerpt()) : ?>
                    <p class="text-gray-600 text-sm"><?php echo wp_trim_words($excerpt, 15); ?></p>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
    <?php
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('services', 'services_shortcode');

// Requirements Display Helper
function display_service_requirements($post_id) {
    $requirements = get_field('service_requirements', $post_id);
    if (!$requirements) return '';
    
    // If using textarea with line breaks
    if (is_string($requirements)) {
        $items = array_filter(array_map('trim', explode("\n", $requirements)));
        if (empty($items)) return '';
        
        echo '<ul class="list-disc pl-5 space-y-1">';
        foreach ($items as $item) {
            echo '<li>'.esc_html($item).'</li>';
        }
        echo '</ul>';
    }
}

// Register Service Categories Taxonomy
function register_service_taxonomy() {
    $labels = array(
        'name'              => 'Service Categories',
        'singular_name'     => 'Service Category',
        'search_items'      => 'Search Categories',
        'all_items'         => 'All Categories',
        'parent_item'       => 'Parent Category',
        'parent_item_colon' => 'Parent Category:',
        'edit_item'         => 'Edit Category',
        'update_item'       => 'Update Category',
        'add_new_item'      => 'Add New Category',
        'new_item_name'     => 'New Category Name',
        'menu_name'         => 'Categories',
    );

    $args = array(
        'hierarchical'      => true, // Behaves like categories (not tags)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true, // Shows in admin dashboard
        'query_var'         => true,
        'rewrite'           => array('slug' => 'service-category'),
        'show_in_rest'      => true, // Needed for Gutenberg/block editor
    );

    register_taxonomy('service_category', array('service'), $args);
}
add_action('init', 'register_service_taxonomy', 0);