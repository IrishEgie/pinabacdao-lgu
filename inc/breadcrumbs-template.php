<?php
/**
 * Breadcrumbs Template
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
/**
 * Display breadcrumb navigation
 */
if (!function_exists('the_breadcrumbs')) {
    function the_breadcrumbs($class = '') {
        $items = get_wp_breadcrumbs();
        
        if (empty($items)) return;
        
        // Render breadcrumbs directly
        render_breadcrumbs($items, $class);
    }
}
/**
 * Render breadcrumb navigation
 * 
 * @param array $items Array of breadcrumb items
 * @param string $class Additional CSS classes
 */
function render_breadcrumbs($items, $class = '') {
    ?>
    <nav class="bg-white border-b border-gray-200 py-3  <?php echo esc_attr($class); ?>" aria-label="Breadcrumb">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <ol class="flex items-center space-x-2 text-sm">

                
                <?php foreach ($items as $index => $item): ?>
                    <li class="flex items-center">
                        <?php if ($index > 0 || is_front_page()): ?>
                            <svg class="w-4 h-4 text-gray-400 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        <?php endif; ?>
                        
                        <?php if (isset($item['href']) && $index !== count($items) - 1): ?>
                            <a href="<?php echo esc_url($item['href']); ?>"
                               class="text-primary-500 hover:text-primary-600 transition-colors duration-200">
                                <?php echo esc_html($item['label']); ?>
                            </a>
                        <?php else: ?>
                            <span class="text-gray-700 font-medium" aria-current="page">
                                <?php echo esc_html($item['label']); ?>
                            </span>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ol>
        </div>
    </nav>
    <?php
}