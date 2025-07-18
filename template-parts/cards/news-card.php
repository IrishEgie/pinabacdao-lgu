<?php
/**
 * Dynamic Post Card Template - Improved Design
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
    // Default arguments with type-specific fallback images
    $default_images = [
        'news' => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=400&h=250&fit=crop',
        'events' => 'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?w=400&h=250&fit=crop',
        'announcements' => 'https://images.unsplash.com/photo-1602189156324-4c5c6c2c02b3?w=400&h=250&fit=crop'
    ];
    
    $defaults = [
        'post_id' => get_the_ID(),
        'type' => get_post_type(),
        'title' => get_the_title(),
        'excerpt' => get_the_excerpt(),
        'date' => get_the_date(),
        'image_url' => get_the_post_thumbnail_url() ?: ($default_images[get_post_type()] ?? ''),
        'permalink' => get_permalink(),
        'meta_data' => [],
        'badges' => []
    ];
    
    // Merge with provided arguments
    $args = wp_parse_args($args, $defaults);
    
    // Type-specific color classes with better contrast
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
    
    <article class="group h-full flex flex-col">
        <a href="<?php echo esc_url($permalink); ?>" class="block h-full rounded-lg border bg-white text-card-foreground shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1 overflow-hidden cursor-pointer border-l-4 border-l-<?php echo esc_attr($color); ?>-600 flex flex-col">
            <div class="relative overflow-hidden h-48 bg-gray-100">
                <img 
                    src="<?php echo esc_url($image_url); ?>" 
                    alt="<?php echo esc_attr($title); ?>" 
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out"
                    loading="lazy"
                    width="400"
                    height="250"
                >
                
                <?php if (!empty($badges)) : ?>
                    <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                        <?php foreach ($badges as $index => $badge) : ?>
                            <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 text-white bg-<?php echo esc_attr($badge['color'] ?? $color); ?>-600 hover:bg-<?php echo esc_attr($badge['color'] ?? $color); ?>-700 shadow-sm">
                                <?php echo esc_html($badge['text']); ?>
                            </span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                
                <!-- Gradient overlay for better text contrast -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent"></div>
            </div>
            
            <div class="flex-1 p-6 flex flex-col">
                <h3 class="text-lg font-semibold text-gray-900 group-hover:text-<?php echo esc_attr($color); ?>-700 transition-colors duration-300 line-clamp-2 mb-3">
                    <?php echo esc_html($title); ?>
                </h3>
                
                <p class="text-gray-600 text-sm leading-relaxed line-clamp-3 mb-4 flex-1">
                    <?php echo esc_html($excerpt); ?>
                </p>
                
                <?php if (!empty($meta_data)) : ?>
                    <div class="space-y-2 text-sm text-gray-500 mb-4">
                        <?php foreach ($meta_data as $meta) : ?>
                            <div class="flex items-center space-x-2">
                                <?php if (!empty($meta['icon'])) : ?>
                                    <?php echo get_service_icon_svg($meta['icon'], 'w-4 h-4 flex-shrink-0'); ?>
                                <?php endif; ?>
                                <span class="truncate"><?php echo esc_html($meta['text']); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                
                <div class="flex justify-between items-center pt-3 border-t border-gray-100 mt-auto">
                    <time class="text-xs text-gray-500" datetime="<?php echo esc_attr(get_the_date('c', $post_id)); ?>">
                        <?php echo esc_html($date); ?>
                    </time>
                    <span class="text-xs font-medium text-<?php echo esc_attr($color); ?>-600 hover:text-<?php echo esc_attr($color); ?>-800 transition-colors inline-flex items-center">
                        Read more >

                    </span>
                </div>
            </div>
        </a>
    </article>
    <?php
}

/**
 * Helper function to get post card arguments for a specific post type
 * (Improved with better image handling and type-specific defaults)
 */
function get_post_card_args($post_id = null) {
    $post_id = $post_id ?: get_the_ID();
    $post_type = get_post_type($post_id);
    
    // Type-specific fallback images
    $fallback_images = [
        'news' => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=400&h=250&fit=crop',
        'events' => 'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?w=400&h=250&fit=crop',
        'announcements' => 'https://images.unsplash.com/photo-1602189156324-4c5c6c2c02b3?w=400&h=250&fit=crop'
    ];
    
    $args = [
        'post_id' => $post_id,
        'type' => $post_type,
        'title' => get_the_title($post_id),
        'excerpt' => get_the_excerpt($post_id),
        'date' => get_the_date('M j, Y', $post_id),
        'image_url' => get_the_post_thumbnail_url($post_id, 'medium_large') ?: ($fallback_images[$post_type] ?? ''),
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
                    'text' => esc_html__('Source:', 'textdomain') . ' ' . $source
                ];
            }
            break;
            
        case 'events':
            $start_date = get_field('event_datetime_start', $post_id);
            $end_date = get_field('event_datetime_end', $post_id);
            
            if ($start_date) {
                $args['meta_data'][] = [
                    'icon' => 'calendar',
                    'text' => date_i18n('M j, Y g:i a', strtotime($start_date))
                ];
                
                if ($end_date && $end_date !== $start_date) {
                    $args['meta_data'][] = [
                        'icon' => 'clock',
                        'text' => date_i18n('M j, Y g:i a', strtotime($end_date))
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
                    'text' => sprintf(_n('%d expected attendee', '%d expected attendees', $attendees, 'textdomain'), $attendees)
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
                    'text' => esc_html__('Expires:', 'textdomain') . ' ' . date_i18n('M j, Y', strtotime($expiry))
                ];
            }
            break;
    }
    
    return $args;
}