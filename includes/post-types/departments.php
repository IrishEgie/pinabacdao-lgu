<?php
// Register Department Custom Post Type
function register_department_post_type() {
    $labels = array(
        'name'                  => 'Departments',
        'singular_name'         => 'Department',
        'menu_name'             => 'Departments',
        'name_admin_bar'        => 'Department',
        'archives'              => 'Department Archives',
        'attributes'            => 'Department Attributes',
        'parent_item_colon'     => 'Parent Department:',
        'all_items'             => 'All Departments',
        'add_new_item'          => 'Add New Department',
        'add_new'               => 'Add New',
        'new_item'              => 'New Department',
        'edit_item'             => 'Edit Department',
        'update_item'           => 'Update Department',
        'view_item'             => 'View Department',
        'view_items'            => 'View Departments',
        'search_items'          => 'Search Department',
        'not_found'             => 'Not found',
        'not_found_in_trash'    => 'Not found in Trash',
        'featured_image'        => 'Department Logo',
        'set_featured_image'    => 'Set department logo',
        'remove_featured_image' => 'Remove department logo',
        'use_featured_image'    => 'Use as department logo',
        'insert_into_item'      => 'Insert into department',
        'uploaded_to_this_item' => 'Uploaded to this department',
        'items_list'            => 'Departments list',
        'items_list_navigation' => 'Departments list navigation',
        'filter_items_list'     => 'Filter departments list',
    );

    $args = array(
        'label'                 => 'Department',
        'description'           => 'Municipal government departments and offices',
        'labels'                => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'page-attributes', 'revisions'),
        'taxonomies'            => array(),
        'hierarchical'          => true, // Allows parent/child relationships
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 21, // Below Officials
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

// Register ACF Fields for Departments
if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
        'key' => 'group_department_fields',
        'title' => 'Department Information',
        'fields' => array(
            // Basic Information
            array(
                'key' => 'field_department_acronym',
                'label' => 'Acronym',
                'name' => 'acronym',
                'type' => 'text',
                'instructions' => 'Official acronym of the department (e.g., MHO for Municipal Health Office)',
                'wrapper' => array(
                    'width' => '50%',
                ),
            ),
            array(
                'key' => 'field_department_parent',
                'label' => 'Parent Department',
                'name' => 'parent_department',
                'type' => 'post_object',
                'instructions' => 'Select if this department is under another department',
                'post_type' => array('department'),
                'taxonomy' => array(),
                'allow_null' => true,
                'multiple' => false,
                'return_format' => 'object',
                'ui' => true,
                'wrapper' => array(
                    'width' => '50%',
                ),
            ),
            array(
                'key' => 'field_department_mission',
                'label' => 'Mission',
                'name' => 'mission',
                'type' => 'textarea',
                'rows' => 3,
            ),
            array(
                'key' => 'field_department_vision',
                'label' => 'Vision',
                'name' => 'vision',
                'type' => 'textarea',
                'rows' => 3,
            ),
            array(
                'key' => 'field_department_mandate',
                'label' => 'Mandate',
                'name' => 'mandate',
                'type' => 'wysiwyg',
                'instructions' => 'Legal basis or mandate of this department',
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => false,
            ),
            
            // Organizational Information
            array(
                'key' => 'field_department_head',
                'label' => 'Department Head',
                'name' => 'department_head',
                'type' => 'post_object',
                'instructions' => 'Select the official who heads this department',
                'post_type' => array('official'),
                'taxonomy' => array(),
                'allow_null' => true,
                'multiple' => false,
                'return_format' => 'object',
                'ui' => true,
            ),
            array(
                'key' => 'field_department_structure',
                'label' => 'Organizational Structure',
                'name' => 'organizational_structure',
                'type' => 'image',
                'instructions' => 'Upload the organizational structure chart',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
            ),
            array(
                'key' => 'field_department_divisions',
                'label' => 'Divisions/Units',
                'name' => 'divisions',
                'type' => 'repeater',
                'instructions' => 'List the divisions or units under this department',
                'layout' => 'block',
                'button_label' => 'Add Division/Unit',
                'sub_fields' => array(
                    array(
                        'key' => 'field_division_name',
                        'label' => 'Name',
                        'name' => 'name',
                        'type' => 'text',
                        'wrapper' => array(
                            'width' => '40%',
                        ),
                    ),
                    array(
                        'key' => 'field_division_head',
                        'label' => 'Head',
                        'name' => 'head',
                        'type' => 'text',
                        'wrapper' => array(
                            'width' => '30%',
                        ),
                    ),
                    array(
                        'key' => 'field_division_contact',
                        'label' => 'Contact',
                        'name' => 'contact',
                        'type' => 'text',
                        'wrapper' => array(
                            'width' => '30%',
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_department_employee_count',
                'label' => 'Number of Employees',
                'name' => 'employee_count',
                'type' => 'group',
                'instructions' => 'Approximate number of employees (for internal use only)',
                'layout' => 'table',
                'sub_fields' => array(
                    array(
                        'key' => 'field_regular_employees',
                        'label' => 'Regular',
                        'name' => 'regular',
                        'type' => 'number',
                        'min' => 0,
                    ),
                    array(
                        'key' => 'field_casual_employees',
                        'label' => 'Casual',
                        'name' => 'casual',
                        'type' => 'number',
                        'min' => 0,
                    ),
                    array(
                        'key' => 'field_job_order_employees',
                        'label' => 'Job Order',
                        'name' => 'job_order',
                        'type' => 'number',
                        'min' => 0,
                    ),
                ),
            ),
            
            // Functional Information
            array(
                'key' => 'field_department_functions',
                'label' => 'Functions and Responsibilities',
                'name' => 'functions',
                'type' => 'wysiwyg',
                'instructions' => 'List the main functions and responsibilities of this department',
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => false,
            ),
            array(
                'key' => 'field_department_services',
                'label' => 'Related Services',
                'name' => 'services',
                'type' => 'relationship',
                'instructions' => 'Select services offered by this department',
                'post_type' => array('service'),
                'taxonomy' => array(),
                'filters' => array('search'),
                'elements' => '',
                'min' => '',
                'max' => '',
                'return_format' => 'object',
            ),
            array(
                'key' => 'field_department_citizens_charter',
                'label' => 'Citizen\'s Charter',
                'name' => 'citizens_charter',
                'type' => 'file',
                'instructions' => 'Upload the Citizen\'s Charter document',
                'return_format' => 'array',
                'library' => 'all',
            ),
            
            // Contact Information
            array(
                'key' => 'field_department_contact_info',
                'label' => 'Contact Information',
                'name' => 'contact_info',
                'type' => 'group',
                'layout' => 'table',
                'sub_fields' => array(
                    array(
                        'key' => 'field_department_email',
                        'label' => 'Email',
                        'name' => 'email',
                        'type' => 'email',
                        'wrapper' => array(
                            'width' => '50%',
                        ),
                    ),
                    array(
                        'key' => 'field_department_phone',
                        'label' => 'Phone',
                        'name' => 'phone',
                        'type' => 'text',
                        'wrapper' => array(
                            'width' => '50%',
                        ),
                    ),
                    array(
                        'key' => 'field_department_location',
                        'label' => 'Location',
                        'name' => 'location',
                        'type' => 'text',
                        'instructions' => 'Building/Floor/Barangay',
                    ),
                    array(
                        'key' => 'field_department_hours',
                        'label' => 'Operating Hours',
                        'name' => 'hours',
                        'type' => 'text',
                        'instructions' => 'e.g., Mon-Fri 8:00 AM - 5:00 PM',
                    ),
                ),
            ),
            array(
                'key' => 'field_department_social_media',
                'label' => 'Social Media Links',
                'name' => 'social_media',
                'type' => 'repeater',
                'instructions' => 'Add social media accounts for this department',
                'layout' => 'table',
                'button_label' => 'Add Social Media',
                'sub_fields' => array(
                    array(
                        'key' => 'field_social_media_platform',
                        'label' => 'Platform',
                        'name' => 'platform',
                        'type' => 'select',
                        'choices' => array(
                            'facebook' => 'Facebook',
                            'twitter' => 'Twitter',
                            'instagram' => 'Instagram',
                            'youtube' => 'YouTube',
                            'linkedin' => 'LinkedIn',
                            'other' => 'Other',
                        ),
                        'wrapper' => array(
                            'width' => '30%',
                        ),
                    ),
                    array(
                        'key' => 'field_social_media_url',
                        'label' => 'URL',
                        'name' => 'url',
                        'type' => 'url',
                        'wrapper' => array(
                            'width' => '70%',
                        ),
                    ),
                ),
            ),
            
            // Documents
            array(
                'key' => 'field_department_documents',
                'label' => 'Documents',
                'name' => 'documents',
                'type' => 'repeater',
                'instructions' => 'Upload important documents related to this department',
                'layout' => 'block',
                'button_label' => 'Add Document',
                'sub_fields' => array(
                    array(
                        'key' => 'field_document_title',
                        'label' => 'Title',
                        'name' => 'title',
                        'type' => 'text',
                        'wrapper' => array(
                            'width' => '30%',
                        ),
                    ),
                    array(
                        'key' => 'field_document_type',
                        'label' => 'Type',
                        'name' => 'type',
                        'type' => 'select',
                        'choices' => array(
                            'annual_report' => 'Annual Report',
                            'budget' => 'Budget Report',
                            'procurement' => 'Procurement Plan',
                            'ordinance' => 'Ordinance',
                            'memo' => 'Memorandum',
                            'other' => 'Other',
                        ),
                        'wrapper' => array(
                            'width' => '20%',
                        ),
                    ),
                    array(
                        'key' => 'field_document_file',
                        'label' => 'File',
                        'name' => 'file',
                        'type' => 'file',
                        'return_format' => 'array',
                        'library' => 'all',
                        'wrapper' => array(
                            'width' => '50%',
                        ),
                    ),
                ),
            ),
            
            // Display Settings
            array(
                'key' => 'field_department_display_order',
                'label' => 'Display Order',
                'name' => 'display_order',
                'type' => 'number',
                'instructions' => 'Controls sorting order on department listings (lower numbers appear first)',
                'default_value' => 0,
                'min' => 0,
                'max' => 100,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'department',
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

// Custom Admin Columns for Departments
function set_department_admin_columns($columns) {
    unset($columns['date']);
    return array_merge($columns, array(
        'acronym' => __('Acronym', 'pinabacdao-lgu'),
        'head' => __('Department Head', 'pinabacdao-lgu'),
        'services' => __('Services', 'pinabacdao-lgu'),
        'order' => __('Order', 'pinabacdao-lgu'),
    ));
}
add_filter('manage_department_posts_columns', 'set_department_admin_columns');

function custom_department_column($column, $post_id) {
    switch ($column) {
        case 'acronym':
            echo get_field('acronym', $post_id) ?: '—';
            break;
        case 'head':
            $head = get_field('department_head', $post_id);
            echo $head ? $head->post_title : '—';
            break;
        case 'services':
            $services = get_field('services', $post_id);
            if ($services) {
                $service_names = array_map(function($service) {
                    return $service->post_title;
                }, $services);
                echo implode(', ', $service_names);
            } else {
                echo '—';
            }
            break;
        case 'order':
            echo get_field('display_order', $post_id) ?: 0;
            break;
    }
}
add_action('manage_department_posts_custom_column', 'custom_department_column', 10, 2);

// Make admin columns sortable
function department_sortable_columns($columns) {
    $columns['order'] = 'display_order';
    return $columns;
}
add_filter('manage_edit-department_sortable_columns', 'department_sortable_columns');

// Modify the Officials ACF field to link to Departments
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

// Add the post type to your theme setup
function add_departments_to_theme_setup() {
    require_once get_template_directory() . '/includes/post-types/departments.php';
}
add_action('after_setup_theme', 'add_departments_to_theme_setup');
add_filter('use_block_editor_for_post_type', function($use_block_editor, $post_type) {
    if ($post_type === 'department') return false;
    return $use_block_editor;
}, 10, 2);