<?php
// ACF Fields for Officials Custom Post Type

if (!function_exists('acf_add_local_field_group')) {
    return;
}

// Helper function to get department choices for select fields
function get_department_choices() {
    $choices = [];
    
    // Get all departments ordered by title
    $departments = get_posts([
        'post_type' => 'department',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
        'post_status' => 'publish'
    ]);
    
    if (!empty($departments)) {
        foreach ($departments as $department) {
            $title = $department->post_title;
            $acronym = get_field('acronym', $department->ID);
            
            // Add acronym if available
            if ($acronym) {
                $title .= " ({$acronym})";
            }
            
            $choices[$department->ID] = $title;
        }
    }
    
    return $choices;
}

acf_add_local_field_group([
    'key' => 'group_official_fields',
    'title' => 'Official Information',
    'fields' => [
        // Name Group (First, Middle, Last, Extension)
        [
            'key' => 'field_official_name_group',
            'label' => 'Full Name',
            'name' => 'official_name',
            'type' => 'group',
            'layout' => 'table',
            'sub_fields' => [
                [
                    'key' => 'field_official_first_name',
                    'label' => 'First Name',
                    'name' => 'first_name',
                    'type' => 'text',
                    'required' => 1,
                    'wrapper' => [
                        'width' => '25%',
                    ],
                ],
                [
                    'key' => 'field_official_middle_name',
                    'label' => 'Middle Name',
                    'name' => 'middle_name',
                    'type' => 'text',
                    'wrapper' => [
                        'width' => '25%',
                    ],
                ],
                [
                    'key' => 'field_official_last_name',
                    'label' => 'Last Name',
                    'name' => 'last_name',
                    'type' => 'text',
                    'required' => 1,
                    'wrapper' => [
                        'width' => '25%',
                    ],
                ],
                [
                    'key' => 'field_official_name_extension',
                    'label' => 'Extension',
                    'name' => 'name_extension',
                    'type' => 'text',
                    'instructions' => 'e.g., Jr., Sr., III',
                    'wrapper' => [
                        'width' => '25%',
                    ],
                ],
            ],
        ],
        [
            'key' => 'field_official_position',
            'label' => 'Position',
            'name' => 'position',
            'type' => 'text',
            'instructions' => 'The official position/title (e.g., Municipal Mayor)',
            'required' => 1,
            'wrapper' => [
                'width' => '50%',
            ],
        ],
        [
            'key' => 'field_official_role',
            'label' => 'Role',
            'name' => 'role',
            'type' => 'text',
            'instructions' => 'Additional role in councils or committees (e.g., Chairperson, Member)',
            'wrapper' => [
                'width' => '50%',
            ],
        ],
        [
            'key' => 'field_official_department',
            'label' => 'Department',
            'name' => 'department',
            'type' => 'select',
            'instructions' => 'Select the department this official belongs to',
            'choices' => get_department_choices(),
            'allow_null' => 1,
            'ui' => 1,
            'ajax' => 1,
            'wrapper' => [
                'width' => '50%',
            ],
        ],
        [
            'key' => 'field_official_email',
            'label' => 'Email',
            'name' => 'email',
            'type' => 'email',
            'instructions' => 'Official email address',
            'wrapper' => [
                'width' => '50%',
            ],
        ],
        [
            'key' => 'field_official_phone',
            'label' => 'Phone',
            'name' => 'phone',
            'type' => 'text',
            'instructions' => 'Official phone number',
            'wrapper' => [
                'width' => '50%',
            ],
        ],
        [
            'key' => 'field_official_bio',
            'label' => 'Biography',
            'name' => 'biography',
            'type' => 'wysiwyg',
            'instructions' => 'Short biography/profile summary',
            'tabs' => 'visual',
            'toolbar' => 'basic',
            'media_upload' => 0,
        ],
        [
            'key' => 'field_official_office_hours',
            'label' => 'Office Hours',
            'name' => 'office_hours',
            'type' => 'text',
            'instructions' => 'Regular office hours (e.g., Mon-Fri 8:00 AM - 5:00 PM)',
        ],
        [
            'key' => 'field_official_term_start',
            'label' => 'Term Start Date',
            'name' => 'term_start',
            'type' => 'date_picker',
            'instructions' => 'When this official assumed office',
            'display_format' => 'F j, Y',
            'return_format' => 'Y-m-d',
            'first_day' => 1,
            'wrapper' => [
                'width' => '50%',
            ],
        ],
        [
            'key' => 'field_official_term_end',
            'label' => 'Term End Date',
            'name' => 'term_end',
            'type' => 'date_picker',
            'instructions' => 'When this official\'s term ends (leave blank if current)',
            'display_format' => 'F j, Y',
            'return_format' => 'Y-m-d',
            'first_day' => 1,
            'wrapper' => [
                'width' => '50%',
            ],
        ],
        [
            'key' => 'field_official_status',
            'label' => 'Status',
            'name' => 'status',
            'type' => 'select',
            'instructions' => 'Current status of this official',
            'required' => 1,
            'choices' => [
                'active' => 'Active',
                'inactive' => 'Inactive',
                'former' => 'Former',
            ],
            'default_value' => 'active',
            'wrapper' => [
                'width' => '50%',
            ],
        ],
        [
            'key' => 'field_official_display_order',
            'label' => 'Display Order',
            'name' => 'display_order',
            'type' => 'number',
            'instructions' => 'Used to control sorting order on the front-end (lower numbers appear first)',
            'default_value' => 0,
            'min' => 0,
            'max' => 100,
            'wrapper' => [
                'width' => '50%',
            ],
        ],
    ],
    'location' => [
        [
            [
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'official',
            ],
        ],
    ],
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
]);