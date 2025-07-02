<?php
/**
 * Department Post Type ACF Fields - Refactored
 * 
 * @package Pinabacdao-LGU
 * @version 2.0.0
 */

if (!defined('ABSPATH')) exit;

class PBD_Department_Fields {
    
    private const FIELD_GROUP_KEY = 'group_department_fields';
    private const POST_TYPE = 'department';
    private const MAX_DOCUMENTS = 5;
    
    public function __construct() {
        add_action('acf/init', [$this, 'register_fields']);
        add_action('admin_head', [$this, 'add_help_tab']);
    }
    
    public function register_fields() {
        if (!function_exists('acf_add_local_field_group')) {
            error_log('ACF not available for department fields registration');
            return;
        }
        
        acf_add_local_field_group([
            'key' => self::FIELD_GROUP_KEY,
            'title' => __('Department Information', 'pinabacdao-lgu'),
            'fields' => $this->get_all_fields(),
            'location' => [[[
                'param' => 'post_type',
                'operator' => '==',
                'value' => self::POST_TYPE,
            ]]],
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'active' => true,
        ]);
    }
    
    private function get_all_fields() {
        return array_merge(
            $this->basic_fields(),
            $this->organizational_fields(),
            $this->functional_fields(),
            $this->contact_fields(),
            $this->document_fields(),
            $this->display_fields()
        );
    }
    
    private function basic_fields() {
        return [
            $this->text_field('acronym', 'Acronym', true, 'Official acronym (e.g., MHO)', '50%'),
            $this->post_object_field('parent_department', 'Parent Department', [self::POST_TYPE], '50%'),
            $this->textarea_field('mission', 'Mission', true, 3),
            $this->textarea_field('vision', 'Vision', false, 3),
            $this->wysiwyg_field('mandate', 'Mandate'),
        ];
    }
    
    private function organizational_fields() {
        return [
            $this->post_object_field('department_head', 'Department Head', ['official']),
            $this->image_field('organizational_structure', 'Organizational Structure'),
            $this->divisions_repeater(),
            $this->employee_count_group(),
        ];
    }
    
    private function functional_fields() {
        return [
            $this->wysiwyg_field('functions', 'Functions and Responsibilities'),
            $this->relationship_field('services', 'Related Services', ['service']),
            $this->file_field('citizens_charter', "Citizen's Charter"),
        ];
    }
    
    private function contact_fields() {
        return [
            $this->contact_info_group(),
            $this->social_media_group(),
        ];
    }
    
    private function document_fields() {
        $document_fields = [];
        for ($i = 1; $i <= self::MAX_DOCUMENTS; $i++) {
            $document_fields[] = $this->document_group($i);
        }
        
        return [[
            'key' => 'field_department_documents',
            'label' => __('Public Documents', 'pinabacdao-lgu'),
            'name' => 'documents',
            'type' => 'group',
            'layout' => 'block',
            'instructions' => __('Upload files that should be publicly available on the department page.', 'pinabacdao-lgu'),
            'sub_fields' => $document_fields,
        ]];
    }
    
    private function display_fields() {
        return [[
            'key' => 'field_department_display_order',
            'label' => __('Display Order', 'pinabacdao-lgu'),
            'name' => 'display_order',
            'type' => 'number',
            'default_value' => 0,
            'min' => 0,
            'max' => 100,
        ]];
    }
    
    // Helper methods for field creation
    private function text_field($name, $label, $required = false, $instructions = '', $width = '100%') {
        $field = [
            'key' => "field_department_{$name}",
            'label' => __($label, 'pinabacdao-lgu'),
            'name' => $name,
            'type' => 'text',
            'wrapper' => ['width' => $width],
        ];
        
        if ($required) $field['required'] = true;
        if ($instructions) $field['instructions'] = __($instructions, 'pinabacdao-lgu');
        
        return $field;
    }
    
    private function textarea_field($name, $label, $required = false, $rows = 4) {
        $field = [
            'key' => "field_department_{$name}",
            'label' => __($label, 'pinabacdao-lgu'),
            'name' => $name,
            'type' => 'textarea',
            'rows' => $rows,
        ];
        
        if ($required) $field['required'] = true;
        return $field;
    }
    
    private function wysiwyg_field($name, $label) {
        return [
            'key' => "field_department_{$name}",
            'label' => __($label, 'pinabacdao-lgu'),
            'name' => $name,
            'type' => 'wysiwyg',
            'tabs' => 'visual',
            'toolbar' => 'basic',
            'media_upload' => false,
        ];
    }
    
    private function post_object_field($name, $label, $post_types, $width = '100%') {
        return [
            'key' => "field_department_{$name}",
            'label' => __($label, 'pinabacdao-lgu'),
            'name' => $name,
            'type' => 'post_object',
            'post_type' => $post_types,
            'allow_null' => true,
            'return_format' => 'object',
            'ui' => true,
            'ajax' => true,
            'wrapper' => ['width' => $width],
        ];
    }
    
    private function image_field($name, $label) {
        return [
            'key' => "field_department_{$name}",
            'label' => __($label, 'pinabacdao-lgu'),
            'name' => $name,
            'type' => 'image',
            'return_format' => 'array',
            'preview_size' => 'medium',
            'library' => 'all',
        ];
    }
    
    private function file_field($name, $label) {
        return [
            'key' => "field_department_{$name}",
            'label' => __($label, 'pinabacdao-lgu'),
            'name' => $name,
            'type' => 'file',
            'return_format' => 'array',
            'library' => 'all',
        ];
    }
    
    private function relationship_field($name, $label, $post_types) {
        return [
            'key' => "field_department_{$name}",
            'label' => __($label, 'pinabacdao-lgu'),
            'name' => $name,
            'type' => 'relationship',
            'post_type' => $post_types,
            'return_format' => 'object',
            'ui' => true,
            'ajax' => true,
        ];
    }
    
    private function divisions_repeater() {
        return [
            'key' => 'field_department_divisions',
            'label' => __('Divisions/Units', 'pinabacdao-lgu'),
            'name' => 'divisions',
            'type' => 'repeater',
            'layout' => 'block',
            'button_label' => __('Add Division/Unit', 'pinabacdao-lgu'),
            'sub_fields' => [
                $this->text_field('division_name', 'Name', true, '', '40%'),
                $this->text_field('division_head', 'Head', false, '', '30%'),
                $this->text_field('division_contact', 'Contact', false, '', '30%'),
            ],
        ];
    }
    
    private function employee_count_group() {
        return [
            'key' => 'field_department_employee_count',
            'label' => __('Number of Employees', 'pinabacdao-lgu'),
            'name' => 'employee_count',
            'type' => 'group',
            'layout' => 'table',
            'sub_fields' => [
                $this->number_field('regular', 'Regular'),
                $this->number_field('casual', 'Casual'),
                $this->number_field('job_order', 'Job Order'),
            ],
        ];
    }
    
    private function contact_info_group() {
        return [
            'key' => 'field_department_contact_info',
            'label' => __('Contact Information', 'pinabacdao-lgu'),
            'name' => 'contact_info',
            'type' => 'group',
            'layout' => 'table',
            'sub_fields' => [
                $this->email_field('email', 'Email', '50%'),
                $this->text_field('phone', 'Phone', false, '', '50%'),
                $this->text_field('location', 'Location'),
                $this->text_field('hours', 'Operating Hours'),
            ],
        ];
    }
    
    private function social_media_group() {
        $platforms = [
            'facebook' => ['Facebook URL', 'https://facebook.com/username'],
            'twitter' => ['Twitter/X URL', 'https://twitter.com/username'],
            'instagram' => ['Instagram URL', 'https://instagram.com/username'],
            'youtube' => ['YouTube URL', 'https://youtube.com/username'],
        ];
        
        $fields = [];
        foreach ($platforms as $platform => $config) {
            $fields[] = [
                'key' => "field_social_{$platform}",
                'label' => __($config[0], 'pinabacdao-lgu'),
                'name' => $platform,
                'type' => 'url',
                'placeholder' => $config[1],
                'wrapper' => ['width' => '50%'],
            ];
        }
        
        return [
            'key' => 'field_department_social_media',
            'label' => __('Social Media Links', 'pinabacdao-lgu'),
            'name' => 'social_media',
            'type' => 'group',
            'layout' => 'table',
            'sub_fields' => $fields,
        ];
    }
    
    private function document_group($index) {
        return [
            'key' => "field_document_{$index}",
            'label' => sprintf(__('Document %d', 'pinabacdao-lgu'), $index),
            'name' => "document_{$index}",
            'type' => 'group',
            'sub_fields' => [
                $this->text_field("document_{$index}_title", 'Title', false, '', '50%'),
                $this->file_field("document_{$index}_file", 'File'),
                [
                    'key' => "field_document_{$index}_public",
                    'label' => __('Make Public', 'pinabacdao-lgu'),
                    'name' => 'is_public',
                    'type' => 'true_false',
                    'message' => __('Show on website', 'pinabacdao-lgu'),
                    'default_value' => true,
                ],
            ],
        ];
    }
    
    private function number_field($name, $label, $min = 0, $default = 0) {
        return [
            'key' => "field_{$name}_employees",
            'label' => __($label, 'pinabacdao-lgu'),
            'name' => $name,
            'type' => 'number',
            'min' => $min,
            'default_value' => $default,
        ];
    }
    
    private function email_field($name, $label, $width = '100%') {
        return [
            'key' => "field_department_{$name}",
            'label' => __($label, 'pinabacdao-lgu'),
            'name' => $name,
            'type' => 'email',
            'wrapper' => ['width' => $width],
        ];
    }
    
    public function add_help_tab() {
        $screen = get_current_screen();
        
        if ($screen && self::POST_TYPE === $screen->post_type) {
            $screen->add_help_tab([
                'id' => 'department_files_help',
                'title' => __('Uploading Public Files', 'pinabacdao-lgu'),
                'content' => $this->get_help_content(),
            ]);
        }
    }
    
    private function get_help_content() {
        return sprintf(
            '<h3>%s</h3><p>%s</p><ul><li>%s</li><li>%s</li><li>%s</li><li>%s</li><li>%s</li></ul>',
            __('Uploading Public Files', 'pinabacdao-lgu'),
            __('Use the document upload section to add files that will be visible to the public on your department page.', 'pinabacdao-lgu'),
            __('Give each document a clear title that visitors will understand', 'pinabacdao-lgu'),
            __('Upload the file (PDF, Word, Excel, etc.)', 'pinabacdao-lgu'),
            __('Make sure "Make Public" is checked if you want the file visible on the website', 'pinabacdao-lgu'),
            __('Documents are automatically organized by type', 'pinabacdao-lgu'),
            __('You can upload up to ' . self::MAX_DOCUMENTS . ' documents per department', 'pinabacdao-lgu')
        );
    }
}

// Initialize the class
new PBD_Department_Fields();