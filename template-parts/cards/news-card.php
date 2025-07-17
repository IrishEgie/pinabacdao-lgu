<?php
/**
 * Dynamic Post Card Template
 * 
 * @param array $args {
 *     @type int     $post_id      Post ID
 *     @type string  $type         Post type (news|events|announcements)
 *     @type string  $title        Post title
 *     @type string  $excerpt      Post excerpt
 *     @type string  $date         Formatted date
 *     @type string  $image_url    Featured image URL
 *     @type string  $permalink    Post permalink
 *     @type array   $meta_data    Additional meta fields (type-specific)
 *     @type array   $badges       Additional badges to display
 * }
 */
function render_post_card($args = []) {
    // Default arguments
    $defaults = [
        'post_id' => get_the_ID(),
        'type' => get_post_type(),
        'title' => get_the_title(),
        'excerpt' => get_the_excerpt(),
        'date' => get_the_date(),
        'image_url' => get_the_post_thumbnail_url() ?: 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=400&h=250&fit=crop',
        'permalink' => get_permalink(),
        'meta_data' => [],
        'badges' => []
    ];
    
    // Merge with provided arguments
    $args = wp_parse_args($args, $defaults);
    
    // Type-specific color classes
    $type_colors = [
        'news' => 'blue',
        'events' => 'green',
        'announcements' => 'orange'
    ];
    $color = $type_colors[$args['type']] ?? 'gray';
    
    // Default badge (post type)
    $default_badge = [
        'text' => ucfirst($args['type']),
        'color' => $color
    ];
    array_unshift($args['badges'], $default_badge);
    
    // Extract variables for easier use in template
    extract($args);
    ?>
    
    <a href="<?php echo esc_url($permalink); ?>" class="block">
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm group hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden cursor-pointer border-l-4 border-l-<?php echo esc_attr($color); ?>-500">
            <div class="relative overflow-hidden h-48">
                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                
                <?php if (!empty($badges)) : ?>
                    <div class="absolute top-4 left-4 space-y-2">
                        <?php foreach ($badges as $index => $badge) : ?>
                            <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent text-primary-foreground bg-<?php echo esc_attr($badge['color'] ?? $color); ?>-600 hover:bg-<?php echo esc_attr($badge['color'] ?? $color); ?>-700">
                                <?php echo esc_html($badge['text']); ?>
                            </span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="flex flex-col space-y-1.5 p-6 pb-2">
                <h3 class="tracking-tight text-lg font-semibold text-gray-800 group-hover:text-<?php echo esc_attr($color); ?>-600 transition-colors duration-300 line-clamp-2">
                    <?php echo esc_html($title); ?>
                </h3>
            </div>
            
            <div class="p-6 pt-0 space-y-4">
                <p class="text-gray-600 text-sm leading-relaxed line-clamp-2">
                    <?php echo esc_html($excerpt); ?>
                </p>
                
                <?php if (!empty($meta_data)) : ?>
                    <div class="space-y-2 text-sm text-gray-500">
                        <?php foreach ($meta_data as $meta) : ?>
                            <div class="flex items-center space-x-2">
                                <?php if (!empty($meta['icon'])) : ?>
                                    <?php echo get_service_icon_svg($meta['icon'], 'w-4 h-4'); ?>
                                <?php endif; ?>
                                <span><?php echo esc_html($meta['text']); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                
                <div class="flex justify-between items-center pt-2">
                    <span class="text-xs text-gray-500"><?php echo esc_html($date); ?></span>
                    <span class="text-xs text-<?php echo esc_attr($color); ?>-600 hover:text-<?php echo esc_attr($color); ?>-800">Read more</span>
                </div>
            </div>
        </div>
    </a>
    <?php
}

/**
 * Helper function to get post card arguments for a specific post type
 */
function get_post_card_args($post_id = null) {
    $post_id = $post_id ?: get_the_ID();
    $post_type = get_post_type($post_id);
    
    $args = [
        'post_id' => $post_id,
        'type' => $post_type,
        'title' => get_the_title($post_id),
        'excerpt' => get_the_excerpt($post_id),
        'date' => get_the_date('', $post_id),
        'image_url' => get_the_post_thumbnail_url($post_id),
        'permalink' => get_permalink($post_id),
        'meta_data' => [],
        'badges' => []
    ];
    
    // Type-specific fields
    switch ($post_type) {
        case 'news':
            if ($source = get_field('source', $post_id)) {
                $args['meta_data'][] = [
                    'icon' => 'link',
                    'text' => 'Source: ' . $source
                ];
            }
            break;
            
        case 'events':
            if ($start_date = get_field('event_datetime_start', $post_id)) {
                $args['meta_data'][] = [
                    'icon' => 'calendar',
                    'text' => $start_date
                ];
                
                if ($end_date = get_field('event_datetime_end', $post_id)) {
                    $args['meta_data'][] = [
                        'icon' => 'clock',
                        'text' => $end_date
                    ];
                }
            }
            
            if ($location = get_field('event_location', $post_id)) {
                $args['meta_data'][] = [
                    'icon' => 'location',
                    'text' => is_array($location) ? ($location['address'] ?? '') : $location
                ];
            }
            
            if ($attendees = get_field('expected_attendees', $post_id)) {
                $args['meta_data'][] = [
                    'icon' => 'users',
                    'text' => $attendees . ' expected attendees'
                ];
            }
            
            if ($organizer = get_field('organizer_name', $post_id)) {
                $args['badges'][] = [
                    'text' => $organizer,
                    'color' => 'purple'
                ];
            }
            break;
            
        case 'announcements':
            if ($expiry = get_field('announcement_expiry', $post_id)) {
                $args['meta_data'][] = [
                    'icon' => 'clock',
                    'text' => 'Expires: ' . $expiry
                ];
            }
            
            if ($priority = get_field('announcement_priority', $post_id)) {
                $args['badges'][] = [
                    'text' => 'Priority: ' . $priority,
                    'color' => 'red'
                ];
            }
            break;
    }
    
    return $args;
}