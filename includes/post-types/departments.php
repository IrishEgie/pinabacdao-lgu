<?php
require_once __DIR__ . '/acf-fields/departments.php';

// Register Department Grouping Taxonomy
function register_department_grouping_taxonomy() {
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
        'show_ui'          => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'          => ['slug' => 'department-group'],
        'show_in_rest'      => true,
    ];

    register_taxonomy('department_group', ['department'], $args);
    
    // Add default terms
    $default_groups = [
        'executive' => 'Executive Offices',
        'legislative' => 'Legislative Body',
        'administrative' => 'Core Administrative Offices',
        'public_safety' => 'Public Safety and Order Offices',
        'other' => 'Other Municipal Offices'
    ];
    
    foreach ($default_groups as $slug => $name) {
        if (!term_exists($name, 'department_group')) {
            wp_insert_term($name, 'department_group', [
                'slug' => $slug,
                'description' => get_group_description($name)
            ]);
        }
    }
}

// Helper function to get group descriptions
function get_group_description($group_name) {
    $descriptions = [
        'Executive Offices' => 'Chief executive leadership and administration',
        'Legislative Body' => 'Local lawmaking and policy development',
        'Core Administrative Offices' => 'Essential municipal services and administration',
        'Public Safety and Order Offices' => 'Security, emergency response, and legal services',
        'Other Municipal Offices' => 'Specialized services and development programs'
    ];
    
    return $descriptions[$group_name] ?? '';
}

add_action('init', 'register_department_grouping_taxonomy', 0);

// Register Department Custom Post Type
function register_department_post_type() {
    $labels = get_default_labels('Department', 'Departments');
    
    $args = array(
        'label'                 => 'Department',
        'description'           => 'Municipal government departments and offices',
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'page-attributes', 'revisions'),
        'taxonomies'            => array('department_group'),
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
// Setup Admin Columns
function setup_department_admin_columns() {
    $columns = [
        'cb' => '<input type="checkbox" />',
        'title' => __('Department Name', 'pinabacdao-lgu'),
        'acronym' => [
            'label' => __('Acronym', 'pinabacdao-lgu'),
            'callback' => function($post_id) {
                echo esc_html(get_safe_acf_field('acronym', $post_id, '—'));
            },
            'sortable' => false,
            'width' => '8%'
        ],
        'department_group' => [
            'label' => __('Group', 'pinabacdao-lgu'),
            'callback' => function($post_id) {
                $terms = get_the_terms($post_id, 'department_group');
                if ($terms && !is_wp_error($terms)) {
                    $term_names = array_map(function($term) {
                        return esc_html($term->name);
                    }, $terms);
                    echo implode(', ', $term_names);
                } else {
                    echo '—';
                }
            },
            'sortable' => true,
            'width' => '12%'
        ],
        'head' => [
            'label' => __('Head', 'pinabacdao-lgu'),
            'callback' => function($post_id) {
                $head = get_field('department_head', $post_id);
                echo $head ? esc_html($head->post_title) : '—';
            },
            'sortable' => false,
            'width' => '20%'
        ],
        'services' => [
            'label' => __('Services', 'pinabacdao-lgu'),
            'callback' => function($post_id) {
                $services = get_field('services', $post_id);
                if ($services) {
                    $service_names = array_map(function($service) {
                        return esc_html($service->post_title);
                    }, $services);
                    echo implode(', ', $service_names);
                } else {
                    echo '—';
                }
            },
            'sortable' => false,
            'width' => '25%'
        ],
        'order' => [
            'label' => __('Order', 'pinabacdao-lgu'),
            'callback' => function($post_id) {
                echo (int) get_safe_acf_field('display_order', $post_id, 0);
            },
            'sortable' => true,
            'width' => '8%'
        ],
        'date' => [
            'label' => __('Date', 'pinabacdao-lgu'),
            'width' => '10%'
        ],
    ];

    $sortable = [
        'order' => 'display_order',
        'department_group' => 'department_group',
        'date' => ['date', true]
    ];

    setup_admin_columns('department', $columns, $sortable);
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