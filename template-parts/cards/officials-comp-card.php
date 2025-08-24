<?php
/**
 * Compact Official Card with Thumbnail - Design 4
 * 
 * Usage: Can be used as a standalone function or as part of existing officialCard system
 */

if (!function_exists('compactOfficialCard')) {
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
    function compactOfficialCard($args = [])
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

        $thumbnail = get_the_post_thumbnail_url($args['post_id'], 'medium');

        // Get full name using existing helper function
        $full_name = get_official_full_name($args['post_id']);
        $department_name = $department ? $department->post_title : '';

        // Get the post URL
        $post_url = get_permalink($args['post_id']);
        ?>
        <a href="<?php echo esc_url($post_url); ?>" class="block no-underline group">
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-4 max-w-sm relative overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <!-- Decorative background element -->
                <div class="absolute top-0 right-0 w-16 h-16 bg-blue-100 rounded-bl-full opacity-50"></div>
                
                <div class="relative flex items-start space-x-3">
                    <!-- Thumbnail on the left -->
                    <div class="flex-shrink-0 w-16 h-16 rounded-lg overflow-hidden">
                        <?php if ($thumbnail): ?>
                            <img src="<?php echo esc_url($thumbnail); ?>" 
                                 alt="<?php echo esc_attr($full_name); ?>"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <?php else: ?>
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center rounded-lg">
                                <span class="text-gray-400 text-xs">👤</span>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Content on the right -->
                    <div class="flex-1 min-w-0">
                        <h3 class="text-base font-bold text-gray-800 mb-1 group-hover:text-blue-600 transition-colors duration-300 truncate">
                            <?php echo esc_html($full_name); ?>
                        </h3>
                        
                        <?php if ($position): ?>
                            <p class="text-sm text-blue-600 font-medium mb-1 truncate">
                                <?php echo esc_html($position); ?>
                            </p>
                        <?php endif; ?>
                        
                        <?php if ($department_name): ?>
                            <p class="text-xs text-gray-500 mb-3 truncate">
                                <?php echo esc_html($department_name); ?>
                            </p>
                        <?php endif; ?>
                        
                        <!-- Contact information -->
                        <div class="space-y-1">
                            <?php if ($email): ?>
                                <div class="flex items-center text-xs text-gray-700">
                                    <div class="w-5 h-5 bg-blue-100 rounded-full flex items-center justify-center mr-2 flex-shrink-0">
                                        <span class="text-blue-600 text-xs">@</span>
                                    </div>
                                    <span class="hover:text-blue-600 truncate">
                                        <?php echo esc_html($email); ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($phone): ?>
                                <div class="flex items-center text-xs text-gray-700">
                                    <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-2 flex-shrink-0">
                                        <span class="text-green-600 text-xs">☎</span>
                                    </div>
                                    <span class="hover:text-blue-600">
                                        <?php echo esc_html($phone); ?>
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

// Alternative: Modified version of your existing officialCard function
// You can replace your existing officialCard function with this compact version

if (!function_exists('officialCardCompact')) {
    /**
     * Compact version of the existing officialCard function
     */
    function officialCardCompact($args = [])
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
        <a href="<?php echo esc_url($post_url); ?>" class="block no-underline group">
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-4 max-w-sm relative overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <!-- Decorative background element -->
                <div class="absolute top-0 right-0 w-16 h-16 bg-blue-100 rounded-bl-full opacity-50"></div>
                
                <div class="relative flex items-start space-x-3">
                    <!-- Thumbnail on the left -->
                    <div class="flex-shrink-0 w-16 h-16 rounded-lg overflow-hidden">
                        <?php if ($thumbnail): ?>
                            <img src="<?php echo esc_url($thumbnail); ?>" 
                                 alt="<?php echo esc_attr($full_name); ?>"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <?php else: ?>
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center rounded-lg">
                                <span class="text-gray-400 text-xs">👤</span>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Content on the right -->
                    <div class="flex-1 min-w-0">
                        <h3 class="text-base font-bold text-gray-800 mb-1 group-hover:text-primary-500 transition-colors duration-300 truncate">
                            <?php echo esc_html($full_name); ?>
                        </h3>
                        
                        <?php if ($position): ?>
                            <p class="text-sm text-primary-600 font-medium mb-1 truncate">
                                <?php echo esc_html($position); ?>
                            </p>
                        <?php endif; ?>
                        
                        <?php if ($department_name): ?>
                            <p class="text-xs text-gray-500 mb-3 truncate">
                                <?php echo esc_html($department_name); ?>
                            </p>
                        <?php endif; ?>
                        
                        <!-- Contact information with icons -->
                        <div class="space-y-1">
                            <?php if ($email): ?>
                                <div class="flex items-center text-xs text-gray-700">
                                    <div class="w-5 h-5 bg-blue-100 rounded-full flex items-center justify-center mr-2 flex-shrink-0">
                                        <?php if (function_exists('display_service_icon')): ?>
                                            <?php echo display_service_icon('mail', 'w-3 h-3 text-primary-600'); ?>
                                        <?php else: ?>
                                            <span class="text-blue-600 text-xs">@</span>
                                        <?php endif; ?>
                                    </div>
                                    <span class="hover:text-primary-600 truncate">
                                        <?php echo esc_html($email); ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($phone): ?>
                                <div class="flex items-center text-xs text-gray-700">
                                    <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-2 flex-shrink-0">
                                        <?php if (function_exists('display_service_icon')): ?>
                                            <?php echo display_service_icon('phone', 'w-3 h-3 text-primary-600'); ?>
                                        <?php else: ?>
                                            <span class="text-green-600 text-xs">☎</span>
                                        <?php endif; ?>
                                    </div>
                                    <span class="hover:text-primary-600">
                                        <?php echo esc_html($phone); ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($office_hours): ?>
                                <div class="flex items-center text-xs text-gray-700">
                                    <div class="w-5 h-5 bg-orange-100 rounded-full flex items-center justify-center mr-2 flex-shrink-0">
                                        <?php if (function_exists('display_service_icon')): ?>
                                            <?php echo display_service_icon('clock', 'w-3 h-3 text-primary-600'); ?>
                                        <?php else: ?>
                                            <span class="text-orange-600 text-xs">⏰</span>
                                        <?php endif; ?>
                                    </div>
                                    <span class="hover:text-primary-600 truncate">
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

// Usage Instructions:
/*
To use in your page-government.php, replace calls like:
officialCard(['post_id' => get_the_ID()]);

With:
compactOfficialCard(['post_id' => get_the_ID()]);

Or if you want to replace your existing function entirely,
rename officialCardCompact to officialCard and replace your existing function.
*/
?>