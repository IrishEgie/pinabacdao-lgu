<?php
if (!function_exists('register_department_acf_fields')) {
    function register_department_acf_fields() {
        if (!function_exists('acf_add_local_field_group')) return;

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
            'wrapper' => array('width' => '50%'),
        ),
        array(
            'key' => 'field_department_parent',
            'label' => 'Parent Department',
            'name' => 'parent_department',
            'type' => 'post_object',
            'instructions' => 'Select if this department is under another department',
            'post_type' => array('department'),
            'allow_null' => true,
            'ui' => true,
            'wrapper' => array('width' => '50%'),
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
            'post_type' => array('official'),
            'allow_null' => true,
            'return_format' => 'object',
            'ui' => true,
        ),
        array(
            'key' => 'field_department_structure',
            'label' => 'Organizational Structure',
            'name' => 'organizational_structure',
            'type' => 'image',
            'return_format' => 'array',
            'preview_size' => 'medium',
        ),
        array(
            'key' => 'field_department_divisions',
            'label' => 'Divisions/Units',
            'name' => 'divisions',
            'type' => 'repeater',
            'layout' => 'block',
            'button_label' => 'Add Division/Unit',
            'sub_fields' => array(
                array(
                    'key' => 'field_division_name',
                    'label' => 'Name',
                    'name' => 'name',
                    'type' => 'text',
                    'wrapper' => array('width' => '40%'),
                ),
                array(
                    'key' => 'field_division_head',
                    'label' => 'Head',
                    'name' => 'head',
                    'type' => 'text',
                    'wrapper' => array('width' => '30%'),
                ),
                array(
                    'key' => 'field_division_contact',
                    'label' => 'Contact',
                    'name' => 'contact',
                    'type' => 'text',
                    'wrapper' => array('width' => '30%'),
                ),
            ),
        ),
        array(
            'key' => 'field_department_employee_count',
            'label' => 'Number of Employees',
            'name' => 'employee_count',
            'type' => 'group',
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
            'tabs' => 'visual',
            'toolbar' => 'basic',
            'media_upload' => false,
        ),
        array(
            'key' => 'field_department_services',
            'label' => 'Related Services',
            'name' => 'services',
            'type' => 'relationship',
            'post_type' => array('service'),
            'return_format' => 'object',
        ),
        array(
            'key' => 'field_department_citizens_charter',
            'label' => 'Citizen\'s Charter',
            'name' => 'citizens_charter',
            'type' => 'file',
            'return_format' => 'array',
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
                    'wrapper' => array('width' => '50%'),
                ),
                array(
                    'key' => 'field_department_phone',
                    'label' => 'Phone',
                    'name' => 'phone',
                    'type' => 'text',
                    'wrapper' => array('width' => '50%'),
                ),
                array(
                    'key' => 'field_department_location',
                    'label' => 'Location',
                    'name' => 'location',
                    'type' => 'text',
                ),
                array(
                    'key' => 'field_department_hours',
                    'label' => 'Operating Hours',
                    'name' => 'hours',
                    'type' => 'text',
                ),
            ),
        ),
        array(
            'key' => 'field_department_social_media',
            'label' => 'Social Media Links',
            'name' => 'social_media',
            'type' => 'repeater',
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
                    'wrapper' => array('width' => '30%'),
                ),
                array(
                    'key' => 'field_social_media_url',
                    'label' => 'URL',
                    'name' => 'url',
                    'type' => 'url',
                    'wrapper' => array('width' => '70%'),
                ),
            ),
        ),
        
        // Documents
        array(
            'key' => 'field_department_documents',
            'label' => 'Documents',
            'name' => 'documents',
            'type' => 'repeater',
            'layout' => 'block',
            'button_label' => 'Add Document',
            'sub_fields' => array(
                array(
                    'key' => 'field_document_title',
                    'label' => 'Title',
                    'name' => 'title',
                    'type' => 'text',
                    'wrapper' => array('width' => '30%'),
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
                    'wrapper' => array('width' => '20%'),
                ),
                array(
                    'key' => 'field_document_file',
                    'label' => 'File',
                    'name' => 'file',
                    'type' => 'file',
                    'return_format' => 'array',
                    'wrapper' => array('width' => '50%'),
                ),
            ),
        ),
        
                // Display Settings
                array(
                    'key' => 'field_department_display_order',
                    'label' => 'Display Order',
                    'name' => 'display_order',
                    'type' => 'number',
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
            'active' => true,
        ));
    }
    add_action('acf/init', 'register_department_acf_fields');
}

if (!function_exists('register_department_acf_fields')) {
    function register_department_acf_fields() {
        if (!function_exists('acf_add_local_field_group')) return;

        acf_add_local_field_group(array(
            'key' => 'group_department_fields',
            'title' => 'Department Information',
            'fields' => get_department_acf_fields(),
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
            'active' => true,
        ));
    }
    add_action('acf/init', 'register_department_acf_fields');
}