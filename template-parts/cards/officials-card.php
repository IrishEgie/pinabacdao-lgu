<?php
/**
 * Officials Card Template with Helper Function
 *
 * @package pinabacdao-lgu
 */

if (!function_exists('get_official_full_name')) {
    function get_official_full_name($post_id)
    {
        $name = get_field('official_name', $post_id);
        if (!$name)
            return get_the_title($post_id);

        $full_name = $name['first_name'] . ' ' . $name['last_name'];
        if (!empty($name['middle_name'])) {
            $full_name = $name['first_name'] . ' ' . $name['middle_name'] . ' ' . $name['last_name'];
        }
        if (!empty($name['extension'])) {
            $full_name .= ' ' . $name['extension'];
        }

        return $full_name;
    }
}

if (!function_exists('officialCard')) {
    /**
     * Display an official card
     * 
     * @param array $args {
     *     Optional. Array of parameters.
     *     
     *     @type int    $post_id   Specific post ID to display. Default current post.
     *     @type string $position  Override position text.
     *     @type string $email     Override email.
     *     @type string $phone     Override phone.
     * }
     */
    function officialCard($args = [])
    {
        $defaults = [
            'post_id' => get_the_ID(),
            'position' => '',
            'email' => '',
            'phone' => ''
        ];

        $args = wp_parse_args($args, $defaults);

        // Get fields - use overrides if provided
        $position = $args['position'] ?: get_field('position', $args['post_id']);
        $department = get_field('department', $args['post_id']);

        // Get contact information group field
        $contact_info = get_field('contact_information', $args['post_id']);

        // Get nested fields from the group
        $email = $args['email'] ?: ($contact_info['email'] ?? '');
        $phone = $args['phone'] ?: ($contact_info['phone'] ?? '');
        $office_hours = $contact_info['office_hours'] ?? '';

        $thumbnail = get_the_post_thumbnail_url($args['post_id'], 'medium');

        // Get full name
        $full_name = get_official_full_name($args['post_id']);
        $department_name = $department ? $department->post_title : '';

        // Get the post URL
        $post_url = get_permalink($args['post_id']);
        ?>
        <a href="<?php echo esc_url($post_url); ?>" class="block no-underline">
            <div
                class="rounded-lg border bg-card text-card-foreground shadow-sm group hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex flex-col space-y-1.5 p-6 text-center pb-4">
                    <div class="mx-auto w-24 h-24 rounded-full overflow-hidden mb-4">
                        <?php if ($thumbnail): ?>
                            <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr($full_name); ?>"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <?php else: ?>
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500">No photo</span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div>
                        <h3
                            class="text-xl font-semibold text-gray-800 group-hover:text-primary-500 transition-colors duration-300">
                            <?php echo esc_html($full_name); ?>
                        </h3>

                        <?php if ($position): ?>
                            <p class="text-primary-600 font-medium">
                                <?php echo esc_html($position); ?>
                            </p>
                        <?php endif; ?>

                        <?php if ($department_name): ?>
                            <p class="text-sm text-gray-600">
                                <?php echo esc_html($department_name); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="p-6 pt-0 space-y-3">
                    <?php if ($email): ?>
                        <div class="flex items-center space-x-3 text-sm text-gray-600">
                            <?php echo display_service_icon('mail', 'w-4 h-4 text-primary-600'); ?>
                            <span><?php echo esc_html($email); ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if ($phone): ?>
                        <div class="flex items-center space-x-3 text-sm text-gray-600">
                            <?php echo display_service_icon('phone', 'w-4 h-4 text-primary-600'); ?>
                            <span><?php echo esc_html($phone); ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if ($office_hours): ?>
                        <div class="flex items-center space-x-3 text-sm text-gray-600">
                            <?php echo display_service_icon('clock', 'w-4 h-4 text-primary-600'); ?>
                            <span><?php echo esc_html($office_hours); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </a>
        <?php
    }
}

// This allows the file to be used both ways:
// 1. As a template part (get_template_part)
// 2. Via the officialCard() function
if (!isset($args) && get_the_ID()) {
    officialCard();
}
?>