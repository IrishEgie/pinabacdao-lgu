<?php
// Officials Custom Post Type

require_once __DIR__ . '/post-type-helpers.php';

function register_officials_post_type() {
    $labels = get_default_labels(
        _x('Official', 'Post Type Singular Name', 'pinabacdao-lgu'),
        _x('Officials', 'Post Type General Name', 'pinabacdao-lgu')
    );
    
    // Override specific labels
    $labels['featured_image'] = __('Official Photo', 'pinabacdao-lgu');
    $labels['set_featured_image'] = __('Set official photo', 'pinabacdao-lgu');
    $labels['remove_featured_image'] = __('Remove official photo', 'pinabacdao-lgu');
    $labels['use_featured_image'] = __('Use as official photo', 'pinabacdao-lgu');
    $labels['menu_name'] = __('Government Officials', 'pinabacdao-lgu');

    $args = array(
        'label'                 => __('Official', 'pinabacdao-lgu'),
        'description'           => __('Municipal government officials directory', 'pinabacdao-lgu'),
        'labels'                => $labels,
        'supports'              => array('title', 'thumbnail', 'revisions'),
        'public'                => true,
        'show_in_rest'          => true,
        'menu_position'         => 20,
        'menu_icon'             => 'dashicons-businessperson',
        'rewrite'              => array('slug' => 'officials'),
        'capability_type'       => 'post',
    );

    register_post_type('official', $args);
}
add_action('init', 'register_officials_post_type', 0);

function register_official_type_taxonomy() {
    $labels = array(
        'name'                       => _x('Official Types', 'Taxonomy General Name', 'pinabacdao-lgu'),
        'singular_name'              => _x('Official Type', 'Taxonomy Singular Name', 'pinabacdao-lgu'),
        'menu_name'                  => __('Official Types', 'pinabacdao-lgu'),
        'all_items'                  => __('All Official Types', 'pinabacdao-lgu'),
        'parent_item'                => __('Parent Official Type', 'pinabacdao-lgu'),
        'parent_item_colon'          => __('Parent Official Type:', 'pinabacdao-lgu'),
        'new_item_name'              => __('New Official Type Name', 'pinabacdao-lgu'),
        'add_new_item'               => __('Add New Official Type', 'pinabacdao-lgu'),
        'edit_item'                  => __('Edit Official Type', 'pinabacdao-lgu'),
        'update_item'                => __('Update Official Type', 'pinabacdao-lgu'),
        'view_item'                  => __('View Official Type', 'pinabacdao-lgu'),
        'separate_items_with_commas' => __('Separate official types with commas', 'pinabacdao-lgu'),
        'add_or_remove_items'        => __('Add or remove official types', 'pinabacdao-lgu'),
        'choose_from_most_used'      => __('Choose from the most used', 'pinabacdao-lgu'),
        'popular_items'              => __('Popular Official Types', 'pinabacdao-lgu'),
        'search_items'               => __('Search Official Types', 'pinabacdao-lgu'),
        'not_found'                  => __('Not Found', 'pinabacdao-lgu'),
        'no_terms'                   => __('No official types', 'pinabacdao-lgu'),
        'items_list'                 => __('Official types list', 'pinabacdao-lgu'),
        'items_list_navigation'      => __('Official types list navigation', 'pinabacdao-lgu'),
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'     => true,
        'public'           => true,
        'show_admin_column'=> true,
        'show_in_rest'     => true,
        'rewrite'          => array('slug' => 'official-type'),
    );

    register_taxonomy('official_type', array('official'), $args);
}
add_action('init', 'register_official_type_taxonomy', 0);

// Setup admin columns with the new helper functions
setup_admin_columns('official', [
    'position' => [
        'label' => __('Position', 'pinabacdao-lgu'),
        'callback' => function($post_id) {
            echo get_safe_acf_field('position', $post_id);
        }
    ],
    'role' => [
        'label' => __('Role', 'pinabacdao-lgu'),
        'callback' => function($post_id) {
            echo get_safe_acf_field('role', $post_id);
        }
    ],
    'department' => [
        'label' => __('Department', 'pinabacdao-lgu'),
        'callback' => function($post_id) {
            echo get_admin_post_relationship($post_id, 'department');
        }
    ],
    'official_type' => [
        'label' => __('Type', 'pinabacdao-lgu'),
        'callback' => function($post_id) {
            echo get_admin_taxonomy_terms($post_id, 'official_type');
        }
    ],
    'status' => [
        'label' => __('Status', 'pinabacdao-lgu'),
        'callback' => function($post_id) {
            $status = get_safe_acf_field('status', $post_id);
            echo $status ? ucfirst($status) : '—';
        }
    ],
    'featured_image' => [
        'label' => __('Photo', 'pinabacdao-lgu'),
        'callback' => function($post_id) {
            echo get_admin_thumbnail($post_id);
        }
    ]
], [
    'position' => 'position',
    'status' => 'status'
]);

// Move ACF fields to a separate file if they exist
function register_official_acf_fields() {
    if (file_exists(__DIR__ . '/acf-fields/officials.php')) {
        require_once __DIR__ . '/acf-fields/officials.php';
    }
}
add_action('acf/init', 'register_official_acf_fields');