<?php

    require_once __DIR__ . '/acf-fields/departments.php';
// Register Department Custom Post Type
function register_department_post_type() {
    $labels = get_default_labels('Department', 'Departments');
    
    $args = array(
        'label'                 => 'Department',
        'description'           => 'Municipal government departments and offices',
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'page-attributes', 'revisions'),
        'taxonomies'            => array(),
        'hierarchical'          => true,
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
        'rewrite'               => array('slug' => 'department'),
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );

    register_post_type('department', $args);
}
add_action('init', 'register_department_post_type', 0);

// Setup Admin Columns
function setup_department_admin_columns() {
    $columns = array(
        'acronym' => array(
            'label' => __('Acronym', 'pinabacdao-lgu'),
            'callback' => function($post_id) {
                echo get_safe_acf_field('acronym', $post_id);
            }
        ),
        'head' => array(
            'label' => __('Department Head', 'pinabacdao-lgu'),
            'callback' => function($post_id) {
                echo get_admin_post_relationship($post_id, 'department_head');
            }
        ),
        'services' => array(
            'label' => __('Services', 'pinabacdao-lgu'),
            'callback' => function($post_id) {
                $services = get_field('services', $post_id);
                if ($services) {
                    $service_names = array_map(function($service) {
                        return $service->post_title;
                    }, $services);
                    echo implode(', ', $service_names);
                } else {
                    echo '—';
                }
            }
        ),
        'order' => array(
            'label' => __('Order', 'pinabacdao-lgu'),
            'callback' => function($post_id) {
                echo get_safe_acf_field('display_order', $post_id, 0);
            }
        ),
    );

    $sortable = array(
        'order' => 'display_order',
    );

    $column_widths = array(
        'acronym' => '10%',
        'head' => '20%',
        'services' => '40%',
        'order' => '10%',
    );

    setup_admin_columns('department', $columns, $sortable, $column_widths);
}
add_action('admin_init', 'setup_department_admin_columns');

// Link Departments to Officials
function update_official_department_field() {
    if (function_exists('acf_update_field')) {
        $field = acf_get_field('field_official_department');
        if ($field) {
            $field['post_type'] = array('department');
            acf_update_field($field);
        }
    }
}
add_action('acf/init', 'update_official_department_field');

// Disable Gutenberg for Departments
add_filter('use_block_editor_for_post_type', function($use_block_editor, $post_type) {
    if ($post_type === 'department') return false;
    return $use_block_editor;
}, 10, 2);