<?php
/**
 * Department Post Type ACF Fields - Simplified
 */
if (!defined('ABSPATH'))
    exit;

class PBD_Department_Fields
{
    private const FIELD_GROUP_KEY = 'group_department_fields';
    private const POST_TYPE = 'department';
    private const MAX_DOCUMENTS = 5;

    public function __construct()
    {
        add_action('acf/init', [$this, 'register_fields']);
        add_action('admin_head', [$this, 'add_help_tab']);
    }

    public function register_fields()
    {
        if (!function_exists('acf_add_local_field_group'))
            return;

        acf_add_local_field_group([
            'key' => self::FIELD_GROUP_KEY,
            'title' => __('Department Information', 'pinabacdao-lgu'),
            'fields' => $this->get_all_fields(),
            'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => self::POST_TYPE]]],
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'active' => true,
        ]);
    }

    private function get_all_fields()
    {
        return array_merge(
            $this->basic_fields(),
            $this->organizational_fields(),
            $this->functional_fields(),
            $this->contact_fields(),
            $this->document_fields(),
            $this->display_fields()
        );
    }

    private function basic_fields()
    {
        return [
            $this->create_field('text', 'acronym', 'Acronym', true, ['instructions' => 'Official acronym (e.g., MHO)', 'width' => '50%']),
            $this->create_field('taxonomy', 'department_group', 'Department Group', true, ['taxonomy' => 'department_group','field_type' => 'select','allow_null' => false,'add_term' => false,'save_terms' => true,'load_terms' => true,'return_format' => 'id','width' => '50%']),
            $this->create_field('post_object', 'parent_department', 'Parent Department', false, ['post_types' => [self::POST_TYPE], 'width' => '50%']),
            $this->create_field('text', 'acronym', 'Acronym', true, ['instructions' => 'Official acronym (e.g., MHO)', 'width' => '50%']),
            $this->create_field('post_object', 'parent_department', 'Parent Department', false, ['post_types' => [self::POST_TYPE], 'width' => '50%']),
            $this->create_field('textarea', 'mission', 'Mission', true, ['rows' => 3]),
            $this->create_field('textarea', 'vision', 'Vision', false, ['rows' => 3]),
            $this->create_field('wysiwyg', 'mandate', 'Mandate'),
        ];
    }

    private function organizational_fields()
    {
        return [
            $this->create_field('post_object', 'department_head', 'Department Head', false, ['post_types' => ['official']]),
            $this->create_field('image', 'organizational_structure', 'Organizational Structure'),
            $this->create_repeater('divisions', 'Divisions/Units', [
                $this->create_field('text', 'division_name', 'Name', true, ['width' => '40%']),
                $this->create_field('text', 'division_head', 'Head', false, ['width' => '30%']),
                $this->create_field('text', 'division_contact', 'Contact', false, ['width' => '30%']),
            ]),
            $this->create_group('employee_count', 'Number of Employees', [
                $this->create_field('number', 'regular', 'Regular'),
                $this->create_field('number', 'casual', 'Casual'),
                $this->create_field('number', 'job_order', 'Job Order'),
            ], ['layout' => 'table']),
        ];
    }

    private function functional_fields()
    {
        return [
            $this->create_field('wysiwyg', 'functions', 'Functions and Responsibilities'),
            $this->create_field('relationship', 'services', 'Related Services', false, ['post_types' => ['service']]),
            $this->create_field('file', 'citizens_charter', "Citizen's Charter"),
        ];
    }

    private function contact_fields()
    {
        return [
            $this->create_group('contact_info', 'Contact Information', [
                $this->create_field('email', 'email', 'Email', false, ['width' => '50%']),
                $this->create_field('text', 'phone', 'Phone', false, ['width' => '50%']),
                $this->create_field('text', 'location', 'Location'),
                $this->create_field('text', 'hours', 'Operating Hours'),
            ], ['layout' => 'table']),
            $this->create_social_media_group(),
        ];
    }

    private function document_fields()
    {
        $docs = [];
        for ($i = 1; $i <= self::MAX_DOCUMENTS; $i++) {
            $docs[] = $this->create_group("document_{$i}", "Document {$i}", [
                $this->create_field('text', "document_{$i}_title", 'Title', false, ['width' => '50%']),
                $this->create_field('file', "document_{$i}_file", 'File'),
                $this->create_field('true_false', "document_{$i}_public", 'Make Public', false, [
                    'message' => __('Show on website', 'pinabacdao-lgu'),
                    'default_value' => true
                ]),
            ]);
        }

        return [
            $this->create_group('documents', 'Public Documents', $docs, [
                'instructions' => __('Upload files that should be publicly available on the department page.', 'pinabacdao-lgu'),
                'layout' => 'block'
            ])
        ];
    }

    private function display_fields()
    {
        return [
            $this->create_field('number', 'display_order', 'Display Order', false, [
                'default_value' => 0,
                'min' => 0,
                'max' => 100
            ])
        ];
    }

    private function create_social_media_group()
    {
        $platforms = [
            'facebook' => ['Facebook URL', 'https://facebook.com/username'],
            'twitter' => ['Twitter/X URL', 'https://twitter.com/username'],
            'instagram' => ['Instagram URL', 'https://instagram.com/username'],
            'youtube' => ['YouTube URL', 'https://youtube.com/username'],
        ];

        $fields = [];
        foreach ($platforms as $platform => [$label, $placeholder]) {
            $fields[] = $this->create_field('url', $platform, $label, false, [
                'placeholder' => $placeholder,
                'width' => '50%'
            ]);
        }

        return $this->create_group('social_media', 'Social Media Links', $fields, ['layout' => 'table']);
    }

    private function create_field($type, $name, $label, $required = false, $args = [])
    {
        $field = [
            'key' => "field_department_{$name}",
            'label' => __($label, 'pinabacdao-lgu'),
            'name' => $name,
            'type' => $type,
            'required' => $required,
        ];

        // Handle special field types
        if ($type === 'post_object') {
            $field['post_type'] = $args['post_types'] ?? [];
            $field['allow_null'] = true;
            $field['return_format'] = 'object';
            $field['ui'] = true;
            $field['ajax'] = true;
        } elseif ($type === 'wysiwyg') {
            $field['tabs'] = 'visual';
            $field['toolbar'] = 'basic';
            $field['media_upload'] = false;
        }

        // Add additional arguments
        foreach ($args as $key => $value) {
            if ($key === 'instructions') {
                $field[$key] = __($value, 'pinabacdao-lgu');
            } elseif ($key !== 'post_types') { // Skip post_types as we already handled it
                $field[$key] = $value;
            }
        }

        // Handle wrapper separately
        if (isset($args['width'])) {
            $field['wrapper'] = ['width' => $args['width']];
        }

        return $field;
    }

    private function create_group($name, $label, $sub_fields, $args = [])
    {
        $group = [
            'key' => "field_department_{$name}",
            'label' => __($label, 'pinabacdao-lgu'),
            'name' => $name,
            'type' => 'group',
            'sub_fields' => $sub_fields,
        ];

        return array_merge($group, $args);
    }

    private function create_repeater($name, $label, $sub_fields, $args = [])
    {
        $repeater = [
            'key' => "field_department_{$name}",
            'label' => __($label, 'pinabacdao-lgu'),
            'name' => $name,
            'type' => 'repeater',
            'layout' => 'block',
            'button_label' => sprintf(__('Add %s', 'pinabacdao-lgu'), $label),
            'sub_fields' => $sub_fields,
        ];

        return array_merge($repeater, $args);
    }

    public function add_help_tab()
    {
        $screen = get_current_screen();
        if ($screen && self::POST_TYPE === $screen->post_type) {
            $screen->add_help_tab([
                'id' => 'department_files_help',
                'title' => __('Uploading Public Files', 'pinabacdao-lgu'),
                'content' => '<h3>' . __('Uploading Public Files', 'pinabacdao-lgu') . '</h3><p>' . __('Use the document upload section to add files that will be visible to the public on your department page.', 'pinabacdao-lgu') . '</p><ul><li>' . __('Give each document a clear title that visitors will understand', 'pinabacdao-lgu') . '</li><li>' . __('Upload the file (PDF, Word, Excel, etc.)', 'pinabacdao-lgu') . '</li><li>' . __('Make sure "Make Public" is checked if you want the file visible on the website', 'pinabacdao-lgu') . '</li><li>' . __('Documents are automatically organized by type', 'pinabacdao-lgu') . '</li><li>' . sprintf(__('You can upload up to %d documents per department', 'pinabacdao-lgu'), self::MAX_DOCUMENTS) . '</li></ul>',
            ]);
        }
    }
}

new PBD_Department_Fields();