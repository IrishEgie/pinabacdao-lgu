<?php
// Helper functions for post type registration

/**
 * Gets default labels with just the singular and plural names
 * 
 * @param string $singular The singular name of the post type
 * @param string $plural The plural name of the post type
 * @return array Array of labels for post type registration
 */
function get_default_labels($singular, $plural) {
    return array(
        'name'                  => $plural,
        'singular_name'         => $singular,
        'menu_name'             => $plural,
        'name_admin_bar'        => $singular,
        'archives'              => sprintf(__('%s Archives', 'pinabacdao-lgu'), $singular),
        'attributes'            => sprintf(__('%s Attributes', 'pinabacdao-lgu'), $singular),
        'parent_item_colon'     => sprintf(__('Parent %s:', 'pinabacdao-lgu'), $singular),
        'all_items'             => sprintf(__('All %s', 'pinabacdao-lgu'), $plural),
        'add_new_item'          => sprintf(__('Add New %s', 'pinabacdao-lgu'), $singular),
        'add_new'               => __('Add New', 'pinabacdao-lgu'),
        'new_item'              => sprintf(__('New %s', 'pinabacdao-lgu'), $singular),
        'edit_item'             => sprintf(__('Edit %s', 'pinabacdao-lgu'), $singular),
        'update_item'           => sprintf(__('Update %s', 'pinabacdao-lgu'), $singular),
        'view_item'             => sprintf(__('View %s', 'pinabacdao-lgu'), $singular),
        'view_items'            => sprintf(__('View %s', 'pinabacdao-lgu'), $plural),
        'search_items'          => sprintf(__('Search %s', 'pinabacdao-lgu'), $plural),
        'not_found'             => __('Not found', 'pinabacdao-lgu'),
        'not_found_in_trash'    => __('Not found in Trash', 'pinabacdao-lgu'),
        'featured_image'        => sprintf(__('%s Image', 'pinabacdao-lgu'), $singular),
        'set_featured_image'    => sprintf(__('Set %s image', 'pinabacdao-lgu'), strtolower($singular)),
        'remove_featured_image' => sprintf(__('Remove %s image', 'pinabacdao-lgu'), strtolower($singular)),
        'use_featured_image'    => sprintf(__('Use as %s image', 'pinabacdao-lgu'), strtolower($singular)),
        'insert_into_item'      => sprintf(__('Insert into %s', 'pinabacdao-lgu'), strtolower($singular)),
        'uploaded_to_this_item' => sprintf(__('Uploaded to this %s', 'pinabacdao-lgu'), strtolower($singular)),
        'items_list'            => sprintf(__('%s list', 'pinabacdao-lgu'), $plural),
        'items_list_navigation' => sprintf(__('%s list navigation', 'pinabacdao-lgu'), $plural),
        'filter_items_list'     => sprintf(__('Filter %s list', 'pinabacdao-lgu'), strtolower($plural)),
    );
}

/**
 * Sets up admin columns for a custom post type
 * 
 * @param string $post_type The post type slug
 * @param array $columns Array of column configurations
 * @param array $sortable Array of sortable columns (optional)
 * @param array $column_widths Array of column widths (optional)
 */
function setup_admin_columns($post_type, $columns, $sortable = [], $column_widths = []) {
    // Validate parameters
    if (empty($post_type) || !is_string($post_type)) {
        return;
    }
    
    if (!is_array($columns) || empty($columns)) {
        return;
    }
    
    // Add custom columns
    add_filter("manage_{$post_type}_posts_columns", function($defaults) use ($columns) {
        // Remove date column to add it back at the end if needed
        $date_column = null;
        if (isset($defaults['date'])) {
            $date_column = $defaults['date'];
            unset($defaults['date']);
        }
        
        // Process custom columns
        $new_columns = [];
        foreach ($columns as $key => $config) {
            if (is_array($config) && isset($config['label'])) {
                $new_columns[$key] = $config['label'];
            } elseif (is_string($config)) {
                // Allow simple string labels for backward compatibility
                $new_columns[$key] = $config;
            }
        }
        
        // Merge with defaults
        $result = array_merge($defaults, $new_columns);
        
        // Add date back at the end if it existed
        if ($date_column) {
            $result['date'] = $date_column;
        }
        
        return $result;
    });
    
    // Handle custom column content
    add_action("manage_{$post_type}_posts_custom_column", function($column, $post_id) use ($columns) {
        if (isset($columns[$column])) {
            $config = $columns[$column];
            
            // Handle different callback formats
            if (is_array($config) && isset($config['callback'])) {
                $callback = $config['callback'];
            } elseif (is_callable($config)) {
                // Direct callback for backward compatibility
                $callback = $config;
            } else {
                return;
            }
            
            // Execute callback safely
            if (is_callable($callback)) {
                try {
                    call_user_func($callback, $post_id, $column);
                } catch (Exception $e) {
                    echo '<span style="color: #dc3232;">Error loading content</span>';
                    error_log("Admin column callback error: " . $e->getMessage());
                }
            }
        }
    }, 10, 2);
    
    // Handle sortable columns
    if (!empty($sortable) && is_array($sortable)) {
        add_filter("manage_edit-{$post_type}_sortable_columns", function($defaults) use ($sortable) {
            return array_merge($defaults, $sortable);
        });
        
        // Handle custom sorting for meta fields
        add_action('pre_get_posts', function($query) use ($post_type, $sortable) {
            if (!is_admin() || !$query->is_main_query()) {
                return;
            }
            
            if ($query->get('post_type') !== $post_type) {
                return;
            }
            
            $orderby = $query->get('orderby');
            if (isset($sortable[$orderby])) {
                $meta_key = $sortable[$orderby];
                $query->set('meta_key', $meta_key);
                $query->set('orderby', 'meta_value');
            }
        });
    }
    
    // Handle column widths
    if (!empty($column_widths) && is_array($column_widths)) {
        add_action('admin_head', function() use ($post_type, $column_widths) {
            $screen = get_current_screen();
            if ($screen && $screen->post_type === $post_type && $screen->base === 'edit') {
                echo '<style type="text/css">';
                foreach ($column_widths as $column => $width) {
                    echo ".wp-list-table .column-{$column} { width: {$width}; }";
                }
                echo '</style>';
            }
        });
    }
}

/**
 * Helper function to safely get ACF field value
 * 
 * @param string $field_name The ACF field name
 * @param int $post_id The post ID
 * @param mixed $default Default value if field is empty
 * @return mixed Field value or default
 */
function get_safe_acf_field($field_name, $post_id, $default = '—') {
    if (!function_exists('get_field')) {
        return $default;
    }
    
    $value = get_field($field_name, $post_id);
    return !empty($value) ? $value : $default;
}

/**
 * Helper function to display taxonomy terms for admin columns
 * 
 * @param int $post_id The post ID
 * @param string $taxonomy The taxonomy name
 * @param string $separator Separator for multiple terms
 * @return string Formatted terms or default message
 */
function get_admin_taxonomy_terms($post_id, $taxonomy, $separator = ', ') {
    $terms = get_the_terms($post_id, $taxonomy);
    
    if ($terms && !is_wp_error($terms)) {
        return implode($separator, wp_list_pluck($terms, 'name'));
    }
    
    return '—';
}

/**
 * Helper function to display post relationship for admin columns
 * 
 * @param int $post_id The post ID
 * @param string $field_name The ACF relationship field name
 * @param string $property Property to display (post_title, post_name, etc.)
 * @return string Formatted relationship or default message
 */
function get_admin_post_relationship($post_id, $field_name, $property = 'post_title') {
    $related_post = get_safe_acf_field($field_name, $post_id, null);
    
    if ($related_post && is_object($related_post) && isset($related_post->$property)) {
        return $related_post->$property;
    }
    
    return '—';
}

/**
 * Helper function to display thumbnail in admin columns
 * 
 * @param int $post_id The post ID
 * @param array $size Thumbnail size [width, height]
 * @return string HTML for thumbnail or default message
 */
function get_admin_thumbnail($post_id, $size = [50, 50]) {
    $thumbnail = get_the_post_thumbnail($post_id, $size);
    return !empty($thumbnail) ? $thumbnail : '<span style="color: #666;">No image</span>';
}