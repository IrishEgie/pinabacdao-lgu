<?php
// wp-content/themes/pinabacdao-lgu/template-parts/cards/highlight-card.php

function highlight_card($args = array()) {
    // Default values
    $defaults = array(
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-target"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>',
        'title' => 'Default Title',
        'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'additional_classes' => '',
        'icon_classes' => 'w-12 h-12 text-primary-500',
        'style' => 'modern', // Options: 'modern', 'minimal', 'gradient', 'shadow'
        'hover_effect' => true,
        'icon_bg' => true, // Whether to add background to icon
        'link' => '', // Optional link URL
    );
    
    // Merge defaults with passed arguments
    $args = wp_parse_args($args, $defaults);
    
    // Define style variations
    $style_classes = '';
    $icon_wrapper_classes = '';
    
    switch ($args['style']) {
        case 'gradient':
            $style_classes = 'bg-gradient-to-br from-white to-primary-50 border border-primary-100 shadow-sm';
            $icon_wrapper_classes = 'bg-gradient-to-br from-primary-500 to-primary-500 text-white rounded-full p-3 mb-4 mx-auto inline-flex items-center justify-center shadow-lg';
            break;
            
        case 'shadow':
            $style_classes = 'bg-white border border-gray-100 shadow-lg shadow-gray-100/50';
            $icon_wrapper_classes = 'bg-primary-50 text-primary-500 rounded-full p-3 mb-4 mx-auto inline-flex items-center justify-center border border-primary-100';
            break;
            
        case 'minimal':
            $style_classes = 'bg-white border border-gray-200';
            $icon_wrapper_classes = 'mb-4 mx-auto inline-flex items-center justify-center';
            break;
            
        default: // modern
            $style_classes = 'bg-white border border-gray-200 shadow-sm';
            $icon_wrapper_classes = 'bg-primary-500/10 text-primary-500 rounded-xl p-3 mb-4 mx-auto inline-flex items-center justify-center';
            break;
    }
    
    // Add hover effects if enabled
    if ($args['hover_effect']) {
        $style_classes .= ' transition-all duration-300 hover:shadow-lg hover:shadow-gray-200/50 hover:-translate-y-1';
    }
    
    // Combine all classes
    $card_classes = "group text-center p-8 rounded-xl {$style_classes} {$args['additional_classes']}";
    
    // Start output buffering
    ob_start(); 
    
    // Determine if this should be a link or div
    $tag = !empty($args['link']) ? 'a' : 'div';
    $href_attr = !empty($args['link']) ? 'href="' . esc_url($args['link']) . '"' : '';
    ?>
    
    <<?php echo $tag; ?> class="<?php echo esc_attr($card_classes); ?>" <?php echo $href_attr; ?>>
        <!-- Icon Container -->
        <div class="<?php echo esc_attr($icon_wrapper_classes); ?>">
            <?php 
            // Handle icon display
            if (function_exists('get_service_icon_svg') && is_string($args['icon']) && !str_contains($args['icon'], '<svg')) {
                // Use service icon function if available
                $icon_html = get_service_icon_svg($args['icon'], $args['icon_classes']);
                echo $icon_html;
            } else {
                // Use direct SVG with proper classes
                $icon_svg = $args['icon'];
                // Add classes to the SVG if not already present
                if (strpos($icon_svg, 'class=') === false) {
                    $icon_svg = str_replace('<svg', '<svg class="' . esc_attr($args['icon_classes']) . '"', $icon_svg);
                }
                echo $icon_svg;
            }
            ?>
        </div>
        
        <!-- Content -->
        <div class="space-y-3">
            <h3 class="text-xl font-bold text-gray-900 group-hover:text-primary-500 transition-colors duration-200">
                <?php echo esc_html($args['title']); ?>
            </h3>
            
            <p class="text-gray-600 leading-relaxed">
                <?php echo esc_html($args['content']); ?>
            </p>
        </div>
        
        <?php if (!empty($args['link'])): ?>
            <!-- Optional link indicator -->
            <div class="mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                <span class="text-primary-500 text-sm font-medium inline-flex items-center">
                    Learn more
                    <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </span>
            </div>
        <?php endif; ?>
    </<?php echo $tag; ?>>
    
    <?php
    return ob_get_clean();
}

// Helper function for quick card creation with preset styles
function quick_highlight_card($icon, $title, $content, $style = 'modern', $link = '') {
    return highlight_card(array(
        'icon' => $icon,
        'title' => $title,
        'content' => $content,
        'style' => $style,
        'link' => $link
    ));
}
?>