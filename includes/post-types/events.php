<?php
/**
 * Events Custom Post Type
 */

function create_events_cpt() {
    $labels = array(
        'name'                  => _x('Events', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Event', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Events', 'text_domain'),
        'name_admin_bar'        => __('Event', 'text_domain'),
        'archives'              => __('Event Archives', 'text_domain'),
        'attributes'            => __('Event Attributes', 'text_domain'),
        'parent_item_colon'     => __('Parent Event:', 'text_domain'),
        'all_items'             => __('All Events', 'text_domain'),
        'add_new_item'          => __('Add New Event', 'text_domain'),
        'add_new'               => __('Add New', 'text_domain'),
        'new_item'              => __('New Event', 'text_domain'),
        'edit_item'             => __('Edit Event', 'text_domain'),
        'update_item'           => __('Update Event', 'text_domain'),
        'view_item'             => __('View Event', 'text_domain'),
        'view_items'            => __('View Events', 'text_domain'),
        'search_items'          => __('Search Events', 'text_domain'),
        'not_found'             => __('Not found', 'text_domain'),
        'not_found_in_trash'    => __('Not found in Trash', 'text_domain'),
        'featured_image'        => __('Event Image', 'text_domain'),
        'set_featured_image'    => __('Set event image', 'text_domain'),
        'remove_featured_image' => __('Remove event image', 'text_domain'),
        'use_featured_image'    => __('Use as event image', 'text_domain'),
        'insert_into_item'      => __('Insert into event', 'text_domain'),
        'uploaded_to_this_item' => __('Uploaded to this event', 'text_domain'),
        'items_list'            => __('Events list', 'text_domain'),
        'items_list_navigation' => __('Events list navigation', 'text_domain'),
        'filter_items_list'     => __('Filter events list', 'text_domain'),
    );

    $args = array(
        'label'                 => __('Event', 'text_domain'),
        'description'           => __('Upcoming and past events', 'text_domain'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'revisions'),
        'taxonomies'            => array('category'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-calendar-alt',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rewrite'               => array('slug' => 'events'),
    );

    register_post_type('events', $args);
}
add_action('init', 'create_events_cpt', 0);

// Add custom columns to admin view
function set_events_admin_columns($columns) {
    unset($columns['date']);
    return array_merge($columns, array(
        'event_datetime_start' => __('Start Date'),
        'event_datetime_end'   => __('End Date'),
        'event_location'      => __('Location'),
        'date'                => __('Published Date')
    ));
}
add_filter('manage_events_posts_columns', 'set_events_admin_columns');

function custom_events_column($column, $post_id) {
    switch ($column) {
        case 'event_datetime_start':
            echo get_field('event_datetime_start', $post_id) ?: '—';
            break;
            
        case 'event_datetime_end':
            echo get_field('event_datetime_end', $post_id) ?: '—';
            break;
            
        case 'event_location':
            $location = get_field('event_location', $post_id);
            if ($location && isset($location['address'])) {
                echo esc_html($location['address']);
            } else {
                echo '—'; // Show dash if no location
            }
            break;
    }
}
add_action('manage_events_posts_custom_column', 'custom_events_column', 10, 2);

// Make custom columns sortable
function events_sortable_columns($columns) {
    $columns['event_datetime_start'] = 'event_datetime_start';
    return $columns;
}
add_filter('manage_edit-events_sortable_columns', 'events_sortable_columns');