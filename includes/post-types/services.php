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
    $args = array(
        'label'                 => 'Service',
        'description'           => 'Municipal services offered',
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
        'taxonomies'            => array('service_category'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-list-view',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
        'show_in_rest'          => true,
            'rewrite' => array(
        'slug' => 'service', // This matches your URL structure
        'with_front' => false // Remove if you want /blog/ before your services
    ),
    );
    register_post_type('service', $args);
}
add_action('init', 'register_services_post_type', 0);

// Add meta boxes for service settings
function add_service_meta_boxes() {
    add_meta_box(
        'service_settings',
        'Service Settings',
        'service_settings_callback',
        'service',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_service_meta_boxes');

// Meta box callback function
function service_settings_callback($post) {
    // Add nonce for security
    wp_nonce_field('service_settings_nonce', 'service_settings_nonce_field');
    
    // Get current values
    $current_icon = get_post_meta($post->ID, '_service_icon', true);
    $redirect_url = get_post_meta($post->ID, '_service_redirect_url', true);
    $open_in_new_tab = get_post_meta($post->ID, '_service_open_new_tab', true);
    
    // Get icon options from your icons.php file
    $icon_options = get_service_icon_options();
    ?>
    
    <table class="form-table">
        <tr>
            <th scope="row">
                <label for="service_icon">Service Icon</label>
            </th>
            <td>
                <select name="service_icon" id="service_icon" class="regular-text">
                    <option value="">Select an icon</option>
                    <?php foreach ($icon_options as $key => $label) : ?>
                        <option value="<?php echo esc_attr($key); ?>" <?php selected($current_icon, $key); ?>>
                            <?php echo esc_html($label); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <p class="description">Choose an icon to represent this service.</p>
                
                <!-- Icon preview -->
                <div id="icon-preview" style="margin-top: 10px;">
                    <?php if ($current_icon) : ?>
                        <strong>Current Icon:</strong><br>
                        <div style="padding: 10px; background: #f0f0f1; border-radius: 4px; display: inline-block; margin-top: 5px;">
                            <?php echo get_service_icon_svg($current_icon, 'preview-icon'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </td>
        </tr>
        
        <tr>
            <th scope="row">
                <label for="service_redirect_url">Redirect URL</label>
            </th>
            <td>
                <input type="url" name="service_redirect_url" id="service_redirect_url" 
                       value="<?php echo esc_attr($redirect_url); ?>" class="regular-text" 
                       placeholder="https://example.com/service-page">
                <p class="description">
                    Optional: If provided, clicking on this service will redirect to this URL instead of showing the post content.
                    Leave empty to use the default post page.
                </p>
            </td>
        </tr>
        
        <tr>
            <th scope="row">
                <label for="service_open_new_tab">Open in New Tab</label>
            </th>
            <td>
                <label>
                    <input type="checkbox" name="service_open_new_tab" id="service_open_new_tab" 
                           value="1" <?php checked($open_in_new_tab, '1'); ?>>
                    Open redirect URL in a new tab/window
                </label>
                <p class="description">Only applies if a redirect URL is set above.</p>
            </td>
        </tr>
    </table>
    
    <style>
        .preview-icon {
            width: 32px;
            height: 32px;
            color: #333;
        }
        #icon-preview svg {
            width: 32px;
            height: 32px;
            color: #0073aa;
        }
    </style>
    
    <script>
    jQuery(document).ready(function($) {
        $('#service_icon').change(function() {
            var selectedIcon = $(this).val();
            var previewDiv = $('#icon-preview');
            
            if (selectedIcon) {
                // Make an AJAX call to get the SVG preview
                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'get_service_icon_preview',
                        icon: selectedIcon,
                        nonce: '<?php echo wp_create_nonce('service_icon_preview'); ?>'
                    },
                    success: function(response) {
                        if (response.success) {
                            previewDiv.html('<strong>Selected Icon:</strong><br><div style="padding: 10px; background: #f0f0f1; border-radius: 4px; display: inline-block; margin-top: 5px;">' + response.data + '</div>');
                        }
                    }
                });
            } else {
                previewDiv.html('');
            }
        });
    });
    </script>
    
    <?php
}

// AJAX handler for icon preview
function ajax_get_service_icon_preview() {
    if (!wp_verify_nonce($_POST['nonce'], 'service_icon_preview')) {
        wp_die('Security check failed');
    }
    
    $icon = sanitize_text_field($_POST['icon']);
    $svg = get_service_icon_svg($icon, 'preview-icon');
    
    wp_send_json_success($svg);
}
add_action('wp_ajax_get_service_icon_preview', 'ajax_get_service_icon_preview');

// Save meta box data
function save_service_settings($post_id) {
    // Check if nonce is valid
    if (!isset($_POST['service_settings_nonce_field']) || 
        !wp_verify_nonce($_POST['service_settings_nonce_field'], 'service_settings_nonce')) {
        return;
    }
    
    // Check if user has permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Check if not an autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Save service icon
    if (isset($_POST['service_icon'])) {
        $icon = sanitize_text_field($_POST['service_icon']);
        update_post_meta($post_id, '_service_icon', $icon);
    }
    
    // Save redirect URL
    if (isset($_POST['service_redirect_url'])) {
        $redirect_url = esc_url_raw($_POST['service_redirect_url']);
        update_post_meta($post_id, '_service_redirect_url', $redirect_url);
    }
    
    // Save open in new tab setting
    $open_new_tab = isset($_POST['service_open_new_tab']) ? '1' : '0';
    update_post_meta($post_id, '_service_open_new_tab', $open_new_tab);
}
add_action('save_post', 'save_service_settings');

// Helper functions to retrieve service meta data
function get_service_icon($post_id) {
    return get_post_meta($post_id, '_service_icon', true);
}

function get_service_redirect_url($post_id) {
    return get_post_meta($post_id, '_service_redirect_url', true);
}

function should_open_in_new_tab($post_id) {
    return get_post_meta($post_id, '_service_open_new_tab', true) === '1';
}

function get_service_link_attributes($post_id) {
    $redirect_url = get_service_redirect_url($post_id);
    $open_new_tab = should_open_in_new_tab($post_id);
    
    $attributes = array();
    
    if ($redirect_url) {
        $attributes['href'] = $redirect_url;
        if ($open_new_tab) {
            $attributes['target'] = '_blank';
            $attributes['rel'] = 'noopener noreferrer';
        }
    } else {
        $attributes['href'] = get_permalink($post_id);
    }
    
    return $attributes;
}

// Function to display service with icon and proper linking
function display_service_item($post_id, $show_icon = true, $icon_classes = '', $wrapper_classes = '') {
    $service_icon = get_service_icon($post_id);
    $link_attributes = get_service_link_attributes($post_id);
    $title = get_the_title($post_id);
    
    // Build attributes string
    $attr_string = '';
    foreach ($link_attributes as $attr => $value) {
        $attr_string .= sprintf(' %s="%s"', $attr, esc_attr($value));
    }
    
    $output = sprintf('<div class="service-item %s">', esc_attr($wrapper_classes));
    $output .= sprintf('<a%s>', $attr_string);
    
    if ($show_icon && $service_icon) {
        $output .= get_service_icon_svg($service_icon, $icon_classes);
    }
    
    $output .= sprintf('<span class="service-title">%s</span>', esc_html($title));
    $output .= '</a>';
    $output .= '</div>';
    
    return $output;
}

// Shortcode to display services with limit
function services_shortcode($atts) {
    $atts = shortcode_atts(array(
        'limit' => -1,
        'columns' => 3,
        'show_description' => true
    ), $atts);
    
    $args = array(
        'post_type'      => 'service',
        'posts_per_page' => intval($atts['limit']),
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'post_status'    => 'publish'
    );
    
    $services_query = new WP_Query($args);
    
    if (!$services_query->have_posts()) {
        return '<p>No services found.</p>';
    }
    
    $column_class = '';
    if ($atts['columns'] == 2) {
        $column_class = 'md:grid-cols-2';
    } elseif ($atts['columns'] == 4) {
        $column_class = 'md:grid-cols-2 lg:grid-cols-4';
    } else {
        $column_class = 'md:grid-cols-2 lg:grid-cols-3';
    }
    
    ob_start();
    ?>
    <div class="services-grid grid grid-cols-1 <?php echo esc_attr($column_class); ?> gap-6">
        <?php while ($services_query->have_posts()) : $services_query->the_post(); ?>
            <?php
            $service_id = get_the_ID();
            $service_icon = get_service_icon($service_id);
            $link_attributes = get_service_link_attributes($service_id);
            $target_attr = isset($link_attributes['target']) ? ' target="' . esc_attr($link_attributes['target']) . '"' : '';
            $rel_attr = isset($link_attributes['rel']) ? ' rel="' . esc_attr($link_attributes['rel']) . '"' : '';
            ?>
            <div class="service-card bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-6">
                <div class="flex items-center space-x-3 mb-3">
                    <?php if ($service_icon) : ?>
                        <div class="flex-shrink-0">
                            <?php echo get_service_icon_svg($service_icon, 'w-8 h-8 text-blue-600'); ?>
                        </div>
                    <?php endif; ?>
                    <h3 class="text-lg font-semibold text-gray-800">
                        <a href="<?php echo esc_url($link_attributes['href']); ?>"<?php echo $target_attr . $rel_attr; ?> class="hover:text-blue-600 transition-colors">
                            <?php the_title(); ?>
                        </a>
                    </h3>
                </div>
                <?php if ($atts['show_description'] && get_the_excerpt()) : ?>
                    <p class="text-gray-600 text-sm"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
    <?php
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('services', 'services_shortcode');