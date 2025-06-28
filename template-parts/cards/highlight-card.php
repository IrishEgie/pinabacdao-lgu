<?php
// wp-content/themes/pinabacdao-lgu/template-parts/cards/highlight-card.php

function highlight_card($args = array()) {
    // Default values
    $defaults = array(
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-target w-8 h-8 text-primary"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>',
        'title' => 'Default Title',
        'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'additional_classes' => ''
    );
    
    // Merge defaults with passed arguments
    $args = wp_parse_args($args, $defaults);
    
    // Output the card HTML
    ob_start(); ?>
    
    <div class="rounded-lg border bg-white text-card-foreground shadow-sm hover:shadow-lg transition-shadow duration-300 h-full <?php echo esc_attr($args['additional_classes']); ?>">
        <div class="flex flex-col space-y-1.5 p-6">
            <div class="flex items-center space-x-4">
                <?php echo $args['icon']; ?>
                <h3 class="font-semibold tracking-tight text-xl"><?php echo esc_html($args['title']); ?></h3>
            </div>
        </div>
        <div class="p-6 pt-0">
            <p class="text-gray-600"><?php echo esc_html($args['content']); ?></p>
        </div>
    </div>
    
    <?php
    return ob_get_clean();
}