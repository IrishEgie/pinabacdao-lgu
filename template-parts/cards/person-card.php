<?php
/**
 * Person Card Component
 * 
 * Displays a card for personnel/officials with contact information
 * 
 * @param array $person {
 *     @type string $name          - Person's full name
 *     @type string $position      - Job position/title
 *     @type string $department    - Department/office
 *     @type string $email         - Email address
 *     @type string $phone         - Phone number
 *     @type string $role          - Role/badge (e.g. "Vice-Chairperson")
 *     @type string $icon          - Icon name from icons.php (default: 'users')
 *     @type string $icon_bg_class - Background class for icon (default: 'bg-gradient-to-br from-primary-400 to-primary-600')
 * }
 */

function person_card($person) {
    // Set defaults
    $defaults = array(
        'name' => '',
        'position' => '',
        'department' => '',
        'email' => '',
        'phone' => '',
        'role' => '',
        'post_id' => null, // Add post ID to get featured image
        'icon' => 'users',
        'icon_bg_class' => 'bg-gradient-to-br from-primary-400 to-primary-600',
    );
    
    $person = wp_parse_args($person, $defaults);
    
    // Start output
    ob_start();
    ?>
    <div class="rounded-lg border bg-white text-card-foreground shadow-sm hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
        <div class="flex flex-col space-y-1.5 p-6 text-center pb-4">
            <!-- Photo or Icon -->
            <div class="mx-auto w-20 h-20 <?php echo esc_attr($person['icon_bg_class']); ?> rounded-full flex items-center justify-center mb-4 overflow-hidden">
                <?php if ($person['post_id'] && has_post_thumbnail($person['post_id'])) : ?>
                    <?php echo get_the_post_thumbnail($person['post_id'], 'thumbnail', array(
                        'class' => 'w-full h-full object-cover',
                        'alt' => esc_attr($person['name'])
                    )); ?>
                <?php else : ?>
                    <?php 
                    $icon_svg = get_service_icon_svg($person['icon'], 'w-10 h-10 text-white');
                    echo $icon_svg; 
                    ?>
                <?php endif; ?>
            </div>
            
            <!-- Person Info -->
            <div>
                <h3 class="font-semibold tracking-tight text-lg text-gray-800"><?php echo esc_html($person['name']); ?></h3>
                <p class="text-primary-600 font-medium text-sm"><?php echo esc_html($person['position']); ?></p>
                <p class="text-gray-600 text-xs"><?php echo esc_html($person['department']); ?></p>
                
                <?php if (!empty($person['role'])) : ?>
                    <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 bg-green-100 text-green-800 mt-2">
                        <?php echo esc_html($person['role']); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Contact Info -->
        <div class="p-6 pt-0 space-y-3">
            <?php if (!empty($person['email'])) : ?>
                <div class="flex items-center space-x-3 text-sm text-gray-600">
                    <?php echo get_service_icon_svg('mail', 'w-4 h-4 text-primary-600'); ?>
                    <a href="mailto:<?php echo esc_attr($person['email']); ?>" class="truncate hover:text-primary-600"><?php echo esc_html($person['email']); ?></a>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($person['phone'])) : ?>
                <div class="flex items-center space-x-3 text-sm text-gray-600">
                    <?php echo get_service_icon_svg('phone', 'w-4 h-4 text-primary-600'); ?>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $person['phone'])); ?>" class="hover:text-primary-600"><?php echo esc_html($person['phone']); ?></a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php
    
    return ob_get_clean();
}

/**
 * Helper function to display the person card directly
 */
function display_person_card($person) {
    echo person_card($person);
}