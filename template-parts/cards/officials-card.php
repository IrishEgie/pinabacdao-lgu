<?php
/**
 * Compact Official Card with Thumbnail and SVG Placeholder
 * 
 * Updated version with reduced padding and spacing for more compact display
 */

if (!function_exists('officialCard')) {
    /**
     * Display a compact official card with thumbnail
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

        // Get full name using existing helper function
        $full_name = get_official_full_name($args['post_id']);
        $department_name = $department ? $department->post_title : '';

        // Get the post URL
        $post_url = get_permalink($args['post_id']);
        ?>
        <a href="<?php echo esc_url($post_url); ?>" class="block no-underline group">
            <div class="group department-card rounded-lg border bg-card text-card-foreground shadow-sm hover:shadow-lg transition-shadow duration-300 cursor-pointer hover:bg-gray-50 group-core-administrative-offices block">
                <!-- Decorative background element -->
                <div class="absolute top-0 right-0 w-12 h-12 bg-blue-100 rounded-bl-full opacity-50"></div>
                
                <div class="flex flex-col space-y-1.5 p-6 text-center pb-4">
                    <!-- Thumbnail on the left -->
                    <div class="mx-auto w-24 h-24 rounded-full overflow-hidden mb-4">
                        <?php if ($thumbnail): ?>
                            <img src="<?php echo esc_url($thumbnail); ?>" 
                                 alt="<?php echo esc_attr($full_name); ?>"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <?php else: ?>
                            <div class="w-full h-full bg-gray-100 flex items-center justify-center rounded-lg">
                                <?php if (function_exists('display_service_icon')): ?>
                                    <?php echo display_service_icon('user', 'w-8 h-8 text-gray-400'); ?>
                                <?php else: ?>
                                    <span class="text-gray-400 text-lg">👤</span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Content on the right -->
                    <div class="min-w-0">
                        <h3 class="text-md font-bold text-gray-800 mb-0.5 group-hover:text-primary-500 transition-colors duration-300 leading-tight truncate">
                            <?php echo esc_html($full_name); ?>
                        </h3>
                        
                        <?php if ($position): ?>
                            <p class="text-sm text-primary-600 font-medium mb-0.5 leading-tight truncate">
                                <?php echo esc_html($position); ?>
                            </p>
                        <?php endif; ?>
                        
                        <?php if ($department_name): ?>
                            <p class="text-sm text-gray-500 mb-2 leading-tight truncate">
                                <?php echo esc_html($department_name); ?>
                            </p>
                        <?php endif; ?>
                        
                        <!-- Contact information with icons -->
                        <div class="m-4 space-y-1 flex flex-col space-y-1.5 text-center">
                            <?php if ($email): ?>
                                <div class="flex items-center text-sm text-gray-700">
                                    <div class="w-4 h-4 bg-blue-100 rounded-full flex items-center justify-center mr-2 flex-shrink-0">
                                        <?php if (function_exists('display_service_icon')): ?>
                                            <?php echo display_service_icon('mail', 'w-2.5 h-2.5 text-primary-600'); ?>
                                        <?php else: ?>
                                            <span class="text-blue-600 text-sm">@</span>
                                        <?php endif; ?>
                                    </div>
                                    <span class="hover:text-primary-600 truncate leading-none">
                                        <?php echo esc_html($email); ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($phone): ?>
                                <div class="flex items-center text-sm text-gray-700">
                                    <div class="w-4 h-4 bg-green-100 rounded-full flex items-center justify-center mr-2 flex-shrink-0">
                                        <?php if (function_exists('display_service_icon')): ?>
                                            <?php echo display_service_icon('phone', 'w-2.5 h-2.5 text-primary-600'); ?>
                                        <?php else: ?>
                                            <span class="text-green-600 text-sm">☎</span>
                                        <?php endif; ?>
                                    </div>
                                    <span class="hover:text-primary-600 leading-none">
                                        <?php echo esc_html($phone); ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($office_hours): ?>
                                <div class="flex items-center text-sm text-gray-700">
                                    <div class="w-4 h-4 bg-orange-100 rounded-full flex items-center justify-center mr-2 flex-shrink-0">
                                        <?php if (function_exists('display_service_icon')): ?>
                                            <?php echo display_service_icon('clock', 'w-2.5 h-2.5 text-primary-600'); ?>
                                        <?php else: ?>
                                            <span class="text-orange-600 text-sm">⏰</span>
                                        <?php endif; ?>
                                    </div>
                                    <span class="hover:text-primary-600 truncate leading-none">
                                        <?php echo esc_html($office_hours); ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
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