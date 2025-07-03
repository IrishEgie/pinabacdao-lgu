<?php
/**
 * Department Custom Post Type Registration
 */

// Register Department Taxonomy
function register_department_group_taxonomy() {
    $labels = [
        'name'              => _x('Department Groups', 'taxonomy general name', 'pinabacdao-lgu'),
        'singular_name'     => _x('Department Group', 'taxonomy singular name', 'pinabacdao-lgu'),
        'search_items'      => __('Search Department Groups', 'pinabacdao-lgu'),
        'all_items'         => __('All Department Groups', 'pinabacdao-lgu'),
        'parent_item'       => __('Parent Group', 'pinabacdao-lgu'),
        'parent_item_colon' => __('Parent Group:', 'pinabacdao-lgu'),
        'edit_item'         => __('Edit Group', 'pinabacdao-lgu'),
        'update_item'       => __('Update Group', 'pinabacdao-lgu'),
        'add_new_item'      => __('Add New Department Group', 'pinabacdao-lgu'),
        'new_item_name'     => __('New Group Name', 'pinabacdao-lgu'),
        'menu_name'         => __('Department Groups', 'pinabacdao-lgu'),
    ];

    $args = [
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'          => ['slug' => 'department-group'],
        'show_in_rest'      => true,
    ];

    register_taxonomy('department_group', ['department'], $args);

    // Insert default terms if they don't exist
    $default_groups = [
        'executive' => 'Executive Offices',
        'legislative' => 'Legislative Body',
        'administrative' => 'Core Administrative Offices',
        'public_safety' => 'Public Safety and Order Offices',
        'other' => 'Other Municipal Offices'
    ];
    
    foreach ($default_groups as $slug => $name) {
        if (!term_exists($name, 'department_group')) {
            wp_insert_term($name, 'department_group', ['slug' => $slug]);
        }
    }
}
add_action('init', 'register_department_group_taxonomy', 0);

// Register Department Post Type
function register_department_post_type() {
    $labels = [
        'name'                  => _x('Departments', 'Post Type General Name', 'pinabacdao-lgu'),
        'singular_name'         => _x('Department', 'Post Type Singular Name', 'pinabacdao-lgu'),
        'menu_name'             => __('Departments', 'pinabacdao-lgu'),
        'name_admin_bar'        => __('Department', 'pinabacdao-lgu'),
        'archives'              => __('Department Archives', 'pinabacdao-lgu'),
        'attributes'            => __('Department Attributes', 'pinabacdao-lgu'),
        'parent_item_colon'     => __('Parent Department:', 'pinabacdao-lgu'),
        'all_items'             => __('All Departments', 'pinabacdao-lgu'),
        'add_new_item'          => __('Add New Department', 'pinabacdao-lgu'),
        'add_new'              => __('Add New', 'pinabacdao-lgu'),
        'new_item'             => __('New Department', 'pinabacdao-lgu'),
        'edit_item'            => __('Edit Department', 'pinabacdao-lgu'),
        'update_item'          => __('Update Department', 'pinabacdao-lgu'),
        'view_item'            => __('View Department', 'pinabacdao-lgu'),
        'view_items'           => __('View Departments', 'pinabacdao-lgu'),
        'search_items'         => __('Search Department', 'pinabacdao-lgu'),
        'not_found'            => __('Not found', 'pinabacdao-lgu'),
        'not_found_in_trash'   => __('Not found in Trash', 'pinabacdao-lgu'),
        'featured_image'       => __('Department Image', 'pinabacdao-lgu'),
        'set_featured_image'   => __('Set department image', 'pinabacdao-lgu'),
        'remove_featured_image' => __('Remove department image', 'pinabacdao-lgu'),
        'use_featured_image'   => __('Use as department image', 'pinabacdao-lgu'),
        'insert_into_item'    => __('Insert into department', 'pinabacdao-lgu'),
        'uploaded_to_this_item' => __('Uploaded to this department', 'pinabacdao-lgu'),
        'items_list'          => __('Departments list', 'pinabacdao-lgu'),
        'items_list_navigation' => __('Departments list navigation', 'pinabacdao-lgu'),
        'filter_items_list'   => __('Filter departments list', 'pinabacdao-lgu'),
    ];

    $args = [
        'label'                 => __('Department', 'pinabacdao-lgu'),
        'description'           => __('Municipal government departments directory', 'pinabacdao-lgu'),
        'labels'                => $labels,
        'supports'              => ['title', 'editor', 'thumbnail', 'page-attributes', 'revisions'],
        'taxonomies'            => ['department_group'],
        'hierarchical'          => true, // Allows parent/child relationships
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 21,
        'menu_icon'             => 'dashicons-building',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => ['slug' => 'department', 'with_front' => false],
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rest_base'             => 'departments',
    ];

    register_post_type('department', $args);
}
add_action('init', 'register_department_post_type', 0);

// Setup Admin Columns
function setup_department_admin_columns($columns) {
    $new_columns = [
        'cb' => $columns['cb'],
        'title' => __('Name', 'pinabacdao-lgu'),
        'acronym' => __('Acronym', 'pinabacdao-lgu'),
        'department_group' => __('Group', 'pinabacdao-lgu'),
        'department_head' => __('Head', 'pinabacdao-lgu'),
        'date' => $columns['date'],
    ];
    return $new_columns;
}
add_filter('manage_department_posts_columns', 'setup_department_admin_columns');

function populate_department_admin_columns($column, $post_id) {
    switch ($column) {
        case 'acronym':
            echo esc_html(get_field('acronym', $post_id) ?: '—');
            break;
            
        case 'department_group':
            $terms = get_the_terms($post_id, 'department_group');
            if ($terms && !is_wp_error($terms)) {
                $term_names = wp_list_pluck($terms, 'name');
                echo esc_html(implode(', ', $term_names));
            } else {
                echo '—';
            }
            break;
            
        case 'department_head':
            $head = get_field('department_head', $post_id);
            if ($head) {
                echo '<a href="' . esc_url(get_edit_post_link($head->ID)) . '">';
                echo esc_html($head->post_title);
                echo '</a>';
            } else {
                echo '—';
            }
            break;
    }
}
add_action('manage_department_posts_custom_column', 'populate_department_admin_columns', 10, 2);

// Make columns sortable
function make_department_columns_sortable($columns) {
    $columns['acronym'] = 'acronym';
    $columns['department_group'] = 'department_group';
    return $columns;
}
add_filter('manage_edit-department_sortable_columns', 'make_department_columns_sortable');

// Disable Gutenberg editor
add_filter('use_block_editor_for_post_type', function($use_block_editor, $post_type) {
    if ($post_type === 'department') return false;
    return $use_block_editor;
}, 10, 2);