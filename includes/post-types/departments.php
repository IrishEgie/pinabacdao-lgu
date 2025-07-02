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
    $columns = [
        'cb' => '<input type="checkbox" />', // Add checkbox column for bulk actions
        'title' => __('Department Name', 'pinabacdao-lgu'), // Show post title
        'acronym' => [
            'label' => __('Acronym', 'pinabacdao-lgu'),
            'callback' => function($post_id) {
                echo esc_html(get_safe_acf_field('acronym', $post_id, '—'));
            },
            'sortable' => false,
        ],
        'head' => [
            'label' => __('Department Head', 'pinabacdao-lgu'),
            'callback' => function($post_id) {
                $head = get_field('department_head', $post_id);
                if ($head) {
                    echo '<a href="' . esc_url(get_edit_post_link($head->ID)) . '">';
                    echo esc_html($head->post_title);
                    echo '</a>';
                } else {
                    echo '—';
                }
            },
            'sortable' => false,
        ],
        'services' => [
            'label' => __('Services', 'pinabacdao-lgu'),
            'callback' => function($post_id) {
                $services = get_field('services', $post_id);
                if ($services) {
                    $service_links = array_map(function($service) {
                        return '<a href="' . esc_url(get_edit_post_link($service->ID)) . '">' 
                               . esc_html($service->post_title) . '</a>';
                    }, $services);
                    echo implode(', ', $service_links);
                } else {
                    echo '—';
                }
            },
            'sortable' => false,
        ],
        'order' => [
            'label' => __('Order', 'pinabacdao-lgu'),
            'callback' => function($post_id) {
                echo (int) get_safe_acf_field('display_order', $post_id, 0);
            },
            'sortable' => true,
        ],
        'date' => __('Last Modified', 'pinabacdao-lgu'), // Changed label
    ];

    $sortable = [
        'order' => 'display_order',
        'date' => ['date', true] // Sort by modified date descending by default
    ];

    $column_widths = [
        'cb' => '2%',
        'title' => '18%',
        'acronym' => '10%',
        'head' => '20%',
        'services' => '30%',
        'order' => '10%',
        'date' => '10%'
    ];

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