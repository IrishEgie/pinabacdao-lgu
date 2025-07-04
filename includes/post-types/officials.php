<?php
/**
 * Officials Custom Post Type Registration
 */

// Register Official Post Type
function register_officials_post_type() {
    $labels = [
        'name'                  => _x('Officials', 'Post Type General Name', 'pinabacdao-lgu'),
        'singular_name'         => _x('Official', 'Post Type Singular Name', 'pinabacdao-lgu'),
        'menu_name'             => __('Government Officials', 'pinabacdao-lgu'),
        'name_admin_bar'        => __('Official', 'pinabacdao-lgu'),
        'archives'              => __('Official Archives', 'pinabacdao-lgu'),
        'attributes'            => __('Official Attributes', 'pinabacdao-lgu'),
        'parent_item_colon'     => __('Parent Official:', 'pinabacdao-lgu'),
        'all_items'             => __('All Officials', 'pinabacdao-lgu'),
        'add_new_item'          => __('Add New Official', 'pinabacdao-lgu'),
        'add_new'               => __('Add New', 'pinabacdao-lgu'),
        'new_item'              => __('New Official', 'pinabacdao-lgu'),
        'edit_item'             => __('Edit Official', 'pinabacdao-lgu'),
        'update_item'           => __('Update Official', 'pinabacdao-lgu'),
        'view_item'             => __('View Official', 'pinabacdao-lgu'),
        'view_items'            => __('View Officials', 'pinabacdao-lgu'),
        'search_items'          => __('Search Official', 'pinabacdao-lgu'),
        'not_found'             => __('Not found', 'pinabacdao-lgu'),
        'not_found_in_trash'    => __('Not found in Trash', 'pinabacdao-lgu'),
        'featured_image'        => __('Official Photo', 'pinabacdao-lgu'),
        'set_featured_image'    => __('Set official photo', 'pinabacdao-lgu'),
        'remove_featured_image' => __('Remove official photo', 'pinabacdao-lgu'),
        'use_featured_image'    => __('Use as official photo', 'pinabacdao-lgu'),
        'insert_into_item'      => __('Insert into official', 'pinabacdao-lgu'),
        'uploaded_to_this_item' => __('Uploaded to this official', 'pinabacdao-lgu'),
        'items_list'            => __('Officials list', 'pinabacdao-lgu'),
        'items_list_navigation' => __('Officials list navigation', 'pinabacdao-lgu'),
        'filter_items_list'     => __('Filter officials list', 'pinabacdao-lgu'),
    ];

    $args = [
        'label'                 => __('Official', 'pinabacdao-lgu'),
        'description'           => __('Municipal government officials directory', 'pinabacdao-lgu'),
        'labels'                => $labels,
        'supports'              => ['title', 'thumbnail', 'revisions'],
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 20,
        'menu_icon'             => 'dashicons-businessperson',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => ['slug' => 'officials', 'with_front' => false],
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    ];

    register_post_type('official', $args);
}
add_action('init', 'register_officials_post_type', 0);

// Register Official Type Taxonomy
function register_official_type_taxonomy() {
    $labels = [
        'name'              => _x('Official Types', 'Taxonomy General Name', 'pinabacdao-lgu'),
        'singular_name'     => _x('Official Type', 'Taxonomy Singular Name', 'pinabacdao-lgu'),
        'menu_name'         => __('Official Types', 'pinabacdao-lgu'),
        'all_items'         => __('All Official Types', 'pinabacdao-lgu'),
        'parent_item'       => __('Parent Official Type', 'pinabacdao-lgu'),
        'parent_item_colon' => __('Parent Official Type:', 'pinabacdao-lgu'),
        'new_item_name'     => __('New Official Type Name', 'pinabacdao-lgu'),
        'add_new_item'      => __('Add New Official Type', 'pinabacdao-lgu'),
        'edit_item'         => __('Edit Official Type', 'pinabacdao-lgu'),
        'update_item'       => __('Update Official Type', 'pinabacdao-lgu'),
        'view_item'         => __('View Official Type', 'pinabacdao-lgu'),
    ];

    $args = [
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => ['slug' => 'official-type'],
    ];

    register_taxonomy('official_type', ['official'], $args);
}
add_action('init', 'register_official_type_taxonomy', 0);

// Setup Admin Columns
function setup_official_admin_columns($columns) {
    $new_columns = [
        'cb' => $columns['cb'],
        'title' => __('Name', 'pinabacdao-lgu'),
        'position' => __('Position', 'pinabacdao-lgu'),
        'department' => __('Department', 'pinabacdao-lgu'),
        'official_type' => __('Type', 'pinabacdao-lgu'),
        'status' => __('Status', 'pinabacdao-lgu'),
        'date' => $columns['date'],
    ];
    return $new_columns;
}
add_filter('manage_official_posts_columns', 'setup_official_admin_columns');

function populate_official_admin_columns($column, $post_id) {
    switch ($column) {
        case 'position':
            echo esc_html(get_field('position', $post_id) ?: '—');
            break;
            
        case 'department':
            $dept = get_field('department', $post_id);
            if ($dept) {
                echo '<a href="' . esc_url(get_edit_post_link($dept->ID)) . '">';
                echo esc_html($dept->post_title);
                echo '</a>';
            } else {
                echo '—';
            }
            break;
            
        case 'official_type':
            $terms = get_the_terms($post_id, 'official_type');
            if ($terms && !is_wp_error($terms)) {
                $term_names = wp_list_pluck($terms, 'name');
                echo esc_html(implode(', ', $term_names));
            } else {
                echo '—';
            }
            break;
            
        case 'status':
            $status = get_field('term_stat', $post_id)['status'] ?? '';
            echo $status ? ucfirst(esc_html($status)) : '—';
            break;
    }
}
add_action('manage_official_posts_custom_column', 'populate_official_admin_columns', 10, 2);

// Make columns sortable
function make_official_columns_sortable($columns) {
    $columns['position'] = 'position';
    $columns['status'] = 'status';
    return $columns;
}
add_filter('manage_edit-official_sortable_columns', 'make_official_columns_sortable');

// Disable Gutenberg editor
add_filter('use_block_editor_for_post_type', function($use_block_editor, $post_type) {
    if ($post_type === 'official') return false;
    return $use_block_editor;
}, 10, 2);
