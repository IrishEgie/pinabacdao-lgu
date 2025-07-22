<?php 
/**
 * Documents Custom Post Type with all specified fields
 */

function register_document_post_type() {
    $labels = array(
        'name'                  => _x('Documents', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Document', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Documents', 'text_domain'),
        'name_admin_bar'        => __('Document', 'text_domain'),
        'archives'              => __('Document Archives', 'text_domain'),
        'attributes'            => __('Document Attributes', 'text_domain'),
        'parent_item_colon'     => __('Parent Document:', 'text_domain'),
        'all_items'             => __('All Documents', 'text_domain'),
        'add_new_item'          => __('Add New Document', 'text_domain'),
        'add_new'               => __('Add New', 'text_domain'),
        'new_item'              => __('New Document', 'text_domain'),
        'edit_item'             => __('Edit Document', 'text_domain'),
        'update_item'           => __('Update Document', 'text_domain'),
        'view_item'             => __('View Document', 'text_domain'),
        'view_items'            => __('View Documents', 'text_domain'),
        'search_items'          => __('Search Documents', 'text_domain'),
        'not_found'             => __('Not found', 'text_domain'),
        'not_found_in_trash'    => __('Not found in Trash', 'text_domain'),
        'featured_image'        => __('Featured Image', 'text_domain'),
        'set_featured_image'    => __('Set featured image', 'text_domain'),
        'remove_featured_image' => __('Remove featured image', 'text_domain'),
        'use_featured_image'    => __('Use as featured image', 'text_domain'),
        'insert_into_item'      => __('Insert into document', 'text_domain'),
        'uploaded_to_this_item' => __('Uploaded to this document', 'text_domain'),
        'items_list'            => __('Documents list', 'text_domain'),
        'items_list_navigation' => __('Documents list navigation', 'text_domain'),
        'filter_items_list'     => __('Filter documents list', 'text_domain'),
    );
    
    $args = array(
        'label'                 => __('Document', 'text_domain'),
        'description'           => __('Official documents, ordinances, and orders', 'text_domain'),
        'labels'                => $labels,
        'supports'              => array('title', 'excerpt', 'revisions', 'custom-fields'),
        'taxonomies'            => array('document_type', 'post_tag'), // 'post_tag' for document_tags
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-media-document',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'          => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );
    
    register_post_type('document', $args);
}
add_action('init', 'register_document_post_type', 0);

function register_document_type_taxonomy() {
    $labels = array(
        'name'                       => _x('Document Types', 'Taxonomy General Name', 'text_domain'),
        'singular_name'              => _x('Document Type', 'Taxonomy Singular Name', 'text_domain'),
        'menu_name'                  => __('Document Types', 'text_domain'),
        'all_items'                  => __('All Document Types', 'text_domain'),
        'parent_item'                => __('Parent Document Type', 'text_domain'),
        'parent_item_colon'          => __('Parent Document Type:', 'text_domain'),
        'new_item_name'               => __('New Document Type Name', 'text_domain'),
        'add_new_item'              => __('Add New Document Type', 'text_domain'),
        'edit_item'                  => __('Edit Document Type', 'text_domain'),
        'update_item'                => __('Update Document Type', 'text_domain'),
        'view_item'                  => __('View Document Type', 'text_domain'),
        'separate_items_with_commas' => __('Separate document types with commas', 'text_domain'),
        'add_or_remove_items'        => __('Add or remove document types', 'text_domain'),
        'choose_from_most_used'      => __('Choose from the most used', 'text_domain'),
        'popular_items'              => __('Popular Document Types', 'text_domain'),
        'search_items'               => __('Search Document Types', 'text_domain'),
        'not_found'                  => __('Not Found', 'text_domain'),
        'no_terms'                   => __('No document types', 'text_domain'),
        'items_list'                 => __('Document types list', 'text_domain'),
        'items_list_navigation'      => __('Document types list navigation', 'text_domain'),
    );
    
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
    );
    
    register_taxonomy('document_type', array('document'), $args);
}
add_action('init', 'register_document_type_taxonomy', 0);

function insert_default_document_terms() {
    $default_terms = array(
        'Ordinance',
        'Executive Order',
        'Memorandum',
        'Circular',
        'Resolution',
        'Policy',
        'Guideline',
        'Notice'
    );
    
    foreach ($default_terms as $term) {
        if (!term_exists($term, 'document_type')) {
            wp_insert_term($term, 'document_type');
        }
    }
}
add_action('init', 'insert_default_document_terms');

/**
 * Custom Admin Columns for Documents
 */
add_filter('manage_document_posts_columns', 'set_custom_document_columns');
function set_custom_document_columns($columns) {
    unset($columns['date']);
    $columns['document_number'] = __('Document Number', 'text_domain');
    $columns['document_type'] = __('Type', 'text_domain');
    $columns['issuing_office'] = __('Issuing Office', 'text_domain');
    $columns['date_issued'] = __('Date Issued', 'text_domain');
    $columns['date_effective'] = __('Effective Date', 'text_domain');
    $columns['date'] = __('Published', 'text_domain');
    return $columns;
}

add_action('manage_document_posts_custom_column', 'custom_document_column', 10, 2);
function custom_document_column($column, $post_id) {
    switch ($column) {
        case 'document_number':
            echo esc_html(get_field('document_number', $post_id));
            break;
            
        case 'document_type':
            $terms = get_the_terms($post_id, 'document_type');
            if ($terms && !is_wp_error($terms)) {
                $term_names = array();
                foreach ($terms as $term) {
                    $term_names[] = $term->name;
                }
                echo esc_html(implode(', ', $term_names));
            }
            break;
            
        case 'issuing_office':
            $office = get_field('document_issuing_office', $post_id);
            if ($office) {
                echo esc_html(get_the_title($office));
            }
            break;
            
        case 'date_issued':
            echo esc_html(get_field('document_date_issued', $post_id));
            break;
            
        case 'date_effective':
            echo esc_html(get_field('document_date_effective', $post_id));
            break;
    }
}

// Make columns sortable
add_filter('manage_edit-document_sortable_columns', 'document_sortable_columns');
function document_sortable_columns($columns) {
    $columns['document_number'] = 'document_number';
    $columns['date_issued'] = 'date_issued';
    $columns['date_effective'] = 'date_effective';
    return $columns;
}

/**
 * Add document meta to REST API response
 */
add_action('rest_api_init', 'register_document_rest_fields');
function register_document_rest_fields() {
    register_rest_field('document',
        'document_meta',
        array(
            'get_callback' => 'get_document_meta_for_api',
            'schema' => null,
        )
    );
}

function get_document_meta_for_api($object) {
    $post_id = $object['id'];
    
    return array(
        'document_number' => get_field('document_number', $post_id),
        'issuing_office' => get_field('document_issuing_office', $post_id),
        'date_issued' => get_field('document_date_issued', $post_id),
        'date_effective' => get_field('document_date_effective', $post_id),
        'legal_basis' => get_field('document_legal_basis', $post_id),
        'file_url' => get_field('document_file', $post_id) ? get_field('document_file', $post_id)['url'] : null,
        'related_documents' => get_field('document_related', $post_id),
        'document_types' => wp_get_post_terms($post_id, 'document_type', array('fields' => 'names')),
        'document_tags' => wp_get_post_tags($post_id, array('fields' => 'names')),
        'document_summary' => get_the_excerpt($post_id)
    );
}

/**
 * Document query modifications
 */
add_action('pre_get_posts', 'document_query_modifications');
function document_query_modifications($query) {
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('document')) {
        // Order by date issued by default
        $query->set('meta_key', 'document_date_issued');
        $query->set('orderby', 'meta_value');
        $query->set('order', 'DESC');
        
        // Add meta_query for effective date filtering if needed
        if (isset($_GET['effective_after'])) {
            $query->set('meta_query', array(
                array(
                    'key' => 'document_date_effective',
                    'value' => sanitize_text_field($_GET['effective_after']),
                    'compare' => '>=',
                    'type' => 'DATE'
                )
            ));
        }
    }
}