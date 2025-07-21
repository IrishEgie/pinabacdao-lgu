<?php
/**
 * Clean Pagination Component - Matches Modern Design
 * 
 * Features:
 * - Clean minimal design with subtle borders
 * - Smooth hover animations
 * - Dynamic page number display
 * - Mobile responsive
 * 
 * Usage: clean_pagination();
 */
function clean_pagination($args = []) {
    global $wp_query;
    
    // Exit if no pagination needed
    if ($wp_query->max_num_pages <= 1) return;
    
    // Default settings
    $defaults = [
        'show_numbers' => 9,           // How many page numbers to show
        'prev_text' => 'Previous',     // Previous button text
        'next_text' => 'Next',         // Next button text
        'container_class' => 'my-8'    // Container wrapper class
    ];
    
    $args = array_merge($defaults, $args);
    $current = max(1, get_query_var('paged'));
    $total = $wp_query->max_num_pages;
    
    ?>
    <div class="<?php echo esc_attr($args['container_class']); ?>">
        <nav class="flex items-center justify-center" aria-label="Pagination">
            <ul class="flex items-center gap-1">
                
                <!-- Previous Button -->
                <li>
                    <?php if ($current > 1): ?>
                        <a href="<?php echo get_pagenum_link($current - 1); ?>" 
                           class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-white transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-gray-100 hover:text-gray-900 h-10 px-4 py-2 gap-1 pl-2.5"
                           aria-label="Go to previous page">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 shrink-0 pointer-events-none">
                                <path d="m15 18-6-6 6-6"></path>
                            </svg>
                            <span><?php echo $args['prev_text']; ?></span>
                        </a>
                    <?php else: ?>
                        <span class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-white transition-colors disabled:pointer-events-none disabled:opacity-50 h-10 px-4 py-2 gap-1 pl-2.5 pointer-events-none opacity-50"
                              aria-label="Go to previous page">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 shrink-0 pointer-events-none">
                                <path d="m15 18-6-6 6-6"></path>
                            </svg>
                            <span><?php echo $args['prev_text']; ?></span>
                        </span>
                    <?php endif; ?>
                </li>
                
                <!-- Page Numbers -->
                <?php
                // Calculate range of pages to show
                $start = max(1, $current - floor($args['show_numbers'] / 2));
                $end = min($total, $start + $args['show_numbers'] - 1);
                
                // Adjust start if we're near the end
                if ($end - $start < $args['show_numbers'] - 1) {
                    $start = max(1, $end - $args['show_numbers'] + 1);
                }
                
                // Always show all pages if total is within range
                if ($total <= $args['show_numbers']) {
                    $start = 1;
                    $end = $total;
                }
                
                // Show page numbers in range
                for ($i = $start; $i <= $end; $i++): ?>
                    <li>
                        <?php if ($i == $current): ?>
                            <span class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-white transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-gray-300 bg-white hover:bg-gray-100 hover:text-gray-900 h-10 w-10" 
                                  aria-current="page">
                                <?php echo $i; ?>
                            </span>
                        <?php else: ?>
                            <a href="<?php echo get_pagenum_link($i); ?>" 
                               class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-white transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-gray-100 hover:text-gray-900 h-10 w-10 cursor-pointer">
                                <?php echo $i; ?>
                            </a>
                        <?php endif; ?>
                    </li>
                <?php endfor; ?>
                
                <!-- Next Button -->
                <li>
                    <?php if ($current < $total): ?>
                        <a href="<?php echo get_pagenum_link($current + 1); ?>" 
                           class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-white transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-gray-100 hover:text-gray-900 h-10 px-4 py-2 gap-1 pr-2.5"
                           aria-label="Go to next page">
                            <span><?php echo $args['next_text']; ?></span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 shrink-0 pointer-events-none">
                                <path d="m9 18 6-6-6-6"></path>
                            </svg>
                        </a>
                    <?php else: ?>
                        <span class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-white transition-colors disabled:pointer-events-none disabled:opacity-50 h-10 px-4 py-2 gap-1 pr-2.5 pointer-events-none opacity-50"
                              aria-label="Go to next page">
                            <span><?php echo $args['next_text']; ?></span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 shrink-0 pointer-events-none">
                                <path d="m9 18 6-6-6-6"></path>
                            </svg>
                        </span>
                    <?php endif; ?>
                </li>
                
            </ul>
        </nav>
    </div>
    <?php
}

/**
 * Usage Examples:
 * 
 * Basic usage:
 * clean_pagination();
 * 
 * Custom options:
 * clean_pagination([
 *     'show_numbers' => 5,
 *     'prev_text' => 'Back',
 *     'next_text' => 'Forward',
 *     'container_class' => 'my-12'
 * ]);
 */
?>