<?php
// Register Officials Custom Post Type
function register_officials_post_type() {
    $labels = array(
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
    );

    $args = array(
        'label'                 => __('Official', 'pinabacdao-lgu'),
        'description'           => __('Municipal government officials directory', 'pinabacdao-lgu'),
        'labels'                => $labels,
        'supports'              => array('title', 'thumbnail', 'revisions'),
        'taxonomies'            => array(),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 20,
        'menu_icon'             => 'dashicons-businessperson',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'         => true,
        'rewrite'               => array('slug' => 'officials'),
    );

    register_post_type('official', $args);
}
add_action('init', 'register_officials_post_type', 0);

// Register Official Type Taxonomy
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
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
        'show_in_rest'               => true,
        'rewrite'                    => array('slug' => 'official-type'),
    );

    register_taxonomy('official_type', array('official'), $args);
}
add_action('init', 'register_official_type_taxonomy', 0);

// Register ACF Fields for Officials (if ACF is active)
if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
        'key' => 'group_official_fields',
        'title' => 'Official Information',
        'fields' => array(
            // Name Group (First, Middle, Last, Extension)
            array(
                'key' => 'field_official_name_group',
                'label' => 'Full Name',
                'name' => 'official_name',
                'type' => 'group',
                'layout' => 'table',
                'sub_fields' => array(
                    array(
                        'key' => 'field_official_first_name',
                        'label' => 'First Name',
                        'name' => 'first_name',
                        'type' => 'text',
                        'required' => 1,
                        'wrapper' => array(
                            'width' => '25%',
                        ),
                    ),
                    array(
                        'key' => 'field_official_middle_name',
                        'label' => 'Middle Name',
                        'name' => 'middle_name',
                        'type' => 'text',
                        'wrapper' => array(
                            'width' => '25%',
                        ),
                    ),
                    array(
                        'key' => 'field_official_last_name',
                        'label' => 'Last Name',
                        'name' => 'last_name',
                        'type' => 'text',
                        'required' => 1,
                        'wrapper' => array(
                            'width' => '25%',
                        ),
                    ),
                    array(
                        'key' => 'field_official_name_extension',
                        'label' => 'Extension',
                        'name' => 'name_extension',
                        'type' => 'text',
                        'instructions' => 'e.g., Jr., Sr., III',
                        'wrapper' => array(
                            'width' => '25%',
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_official_position',
                'label' => 'Position',
                'name' => 'position',
                'type' => 'text',
                'instructions' => 'The official position/title (e.g., Municipal Mayor)',
                'required' => 1,
                'wrapper' => array(
                    'width' => '50%',
                ),
            ),
            array(
                'key' => 'field_official_department',
                'label' => 'Department',
                'name' => 'department',
                'type' => 'post_object',
                'instructions' => 'Select the department this official belongs to',
                'required' => 0,
                'post_type' => array('department'),
                'taxonomy' => array(),
                'allow_null' => 1,
                'multiple' => 0,
                'return_format' => 'object',
                'ui' => 1,
                'wrapper' => array(
                    'width' => '50%',
                ),
            ),
            array(
                'key' => 'field_official_email',
                'label' => 'Email',
                'name' => 'email',
                'type' => 'email',
                'instructions' => 'Official email address',
                'required' => 0,
                'wrapper' => array(
                    'width' => '50%',
                ),
            ),
            array(
                'key' => 'field_official_phone',
                'label' => 'Phone',
                'name' => 'phone',
                'type' => 'text',
                'instructions' => 'Official phone number',
                'required' => 0,
                'wrapper' => array(
                    'width' => '50%',
                ),
            ),
            array(
                'key' => 'field_official_bio',
                'label' => 'Biography',
                'name' => 'biography',
                'type' => 'wysiwyg',
                'instructions' => 'Short biography/profile summary',
                'required' => 0,
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 0,
            ),
            array(
                'key' => 'field_official_office_hours',
                'label' => 'Office Hours',
                'name' => 'office_hours',
                'type' => 'text',
                'instructions' => 'Regular office hours (e.g., Mon-Fri 8:00 AM - 5:00 PM)',
                'required' => 0,
            ),
            array(
                'key' => 'field_official_term_start',
                'label' => 'Term Start Date',
                'name' => 'term_start',
                'type' => 'date_picker',
                'instructions' => 'When this official assumed office',
                'required' => 0,
                'display_format' => 'F j, Y',
                'return_format' => 'Y-m-d',
                'first_day' => 1,
                'wrapper' => array(
                    'width' => '50%',
                ),
            ),
            array(
                'key' => 'field_official_term_end',
                'label' => 'Term End Date',
                'name' => 'term_end',
                'type' => 'date_picker',
                'instructions' => 'When this official\'s term ends (leave blank if current)',
                'required' => 0,
                'display_format' => 'F j, Y',
                'return_format' => 'Y-m-d',
                'first_day' => 1,
                'wrapper' => array(
                    'width' => '50%',
                ),
            ),
            array(
                'key' => 'field_official_status',
                'label' => 'Status',
                'name' => 'status',
                'type' => 'select',
                'instructions' => 'Current status of this official',
                'required' => 1,
                'choices' => array(
                    'active' => 'Active',
                    'inactive' => 'Inactive',
                    'former' => 'Former',
                ),
                'default_value' => 'active',
                'allow_null' => 0,
                'wrapper' => array(
                    'width' => '50%',
                ),
            ),
            array(
                'key' => 'field_official_display_order',
                'label' => 'Display Order',
                'name' => 'display_order',
                'type' => 'number',
                'instructions' => 'Used to control sorting order on the front-end (lower numbers appear first)',
                'required' => 0,
                'default_value' => 0,
                'min' => 0,
                'max' => 100,
                'wrapper' => array(
                    'width' => '50%',
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'official',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));
}

// Modify the admin columns for Officials
function set_official_admin_columns($columns) {
    unset($columns['date']);
    return array_merge($columns, array(
        'position' => __('Position', 'pinabacdao-lgu'),
        'department' => __('Department', 'pinabacdao-lgu'),
        'official_type' => __('Type', 'pinabacdao-lgu'),
        'status' => __('Status', 'pinabacdao-lgu'),
        'featured_image' => __('Photo', 'pinabacdao-lgu'),
    ));
}
add_filter('manage_official_posts_columns', 'set_official_admin_columns');

function custom_official_column($column, $post_id) {
    switch ($column) {
        case 'position':
            echo get_field('position', $post_id);
            break;
        case 'department':
            $dept = get_field('department', $post_id);
            echo $dept ? $dept->post_title : '—';
            break;
        case 'official_type':
            $terms = get_the_terms($post_id, 'official_type');
            if ($terms && !is_wp_error($terms)) {
                $term_names = array_map(function($term) {
                    return $term->name;
                }, $terms);
                echo implode(', ', $term_names);
            } else {
                echo '—';
            }
            break;
        case 'status':
            echo ucfirst(get_field('status', $post_id));
            break;
        case 'featured_image':
            echo get_the_post_thumbnail($post_id, array(50, 50));
            break;
    }
}
add_action('manage_official_posts_custom_column', 'custom_official_column', 10, 2);

// Make admin columns sortable
function official_sortable_columns($columns) {
    $columns['position'] = 'position';
    $columns['status'] = 'status';
    return $columns;
}
add_filter('manage_edit-official_sortable_columns', 'official_sortable_columns');

// Add the post type to your theme setup
function add_officials_to_theme_setup() {
    require_once get_template_directory() . '/includes/post-types/officials.php';
}
add_action('after_setup_theme', 'add_officials_to_theme_setup');