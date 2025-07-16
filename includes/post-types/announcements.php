<?php
/**
 * Announcements Custom Post Type
 */

function create_announcements_cpt() {
    $labels = array(
        'name'                  => _x('Announcements', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Announcement', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Announcements', 'text_domain'),
        'name_admin_bar'        => __('Announcement', 'text_domain'),
        'archives'              => __('Announcement Archives', 'text_domain'),
        'attributes'            => __('Announcement Attributes', 'text_domain'),
        'parent_item_colon'     => __('Parent Announcement:', 'text_domain'),
        'all_items'             => __('All Announcements', 'text_domain'),
        'add_new_item'          => __('Add New Announcement', 'text_domain'),
        'add_new'               => __('Add New', 'text_domain'),
        'new_item'              => __('New Announcement', 'text_domain'),
        'edit_item'             => __('Edit Announcement', 'text_domain'),
        'update_item'           => __('Update Announcement', 'text_domain'),
        'view_item'             => __('View Announcement', 'text_domain'),
        'view_items'            => __('View Announcements', 'text_domain'),
        'search_items'          => __('Search Announcements', 'text_domain'),
        'not_found'             => __('Not found', 'text_domain'),
        'not_found_in_trash'    => __('Not found in Trash', 'text_domain'),
        'featured_image'        => __('Featured Image', 'text_domain'),
        'set_featured_image'    => __('Set featured image', 'text_domain'),
        'remove_featured_image' => __('Remove featured image', 'text_domain'),
        'use_featured_image'    => __('Use as featured image', 'text_domain'),
        'insert_into_item'      => __('Insert into announcement', 'text_domain'),
        'uploaded_to_this_item' => __('Uploaded to this announcement', 'text_domain'),
        'items_list'            => __('Announcements list', 'text_domain'),
        'items_list_navigation' => __('Announcements list navigation', 'text_domain'),
        'filter_items_list'     => __('Filter announcements list', 'text_domain'),
    );

    $args = array(
        'label'                 => __('Announcement', 'text_domain'),
        'description'           => __('Important announcements and notices', 'text_domain'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'revisions'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-megaphone',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rewrite'               => array('slug' => 'announcements'),
    );

    register_post_type('announcements', $args);
}
add_action('init', 'create_announcements_cpt', 0);

// Add custom columns to admin view
function set_announcements_admin_columns($columns) {
    unset($columns['date']);
    return array_merge($columns, array(
        'announcement_expiry'  => __('Expires On'),
        'announcement_priority' => __('Priority'),
        'date'                 => __('Published Date')
    ));
}
add_filter('manage_announcements_posts_columns', 'set_announcements_admin_columns');

function custom_announcements_column($column, $post_id) {
    switch ($column) {
        case 'announcement_expiry':
            echo get_field('announcement_expiry', $post_id);
            break;
        case 'announcement_priority':
            echo get_field('announcement_priority', $post_id);
            break;
    }
}
add_action('manage_announcements_posts_custom_column', 'custom_announcements_column', 10, 2);

// Make custom columns sortable
function announcements_sortable_columns($columns) {
    $columns['announcement_expiry'] = 'announcement_expiry';
    return $columns;
}
add_filter('manage_edit-announcements_sortable_columns', 'announcements_sortable_columns');

// Auto-expire announcements
function check_expired_announcements() {
    $today = date('Ymd');
    $args = array(
        'post_type'      => 'announcements',
        'posts_per_page' => -1,
        'meta_query'    => array(
            array(
                'key'     => 'announcement_expiry',
                'value'   => $today,
                'compare' => '<',
                'type'    => 'DATE'
            )
        ),
        'fields' => 'ids'
    );

    $expired_posts = get_posts($args);
    foreach ($expired_posts as $post_id) {
        wp_update_post(array(
            'ID'          => $post_id,
            'post_status' => 'draft'
        ));
    }
}
add_action('init', 'check_expired_announcements');