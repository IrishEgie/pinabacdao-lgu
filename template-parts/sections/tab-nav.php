<?php
/**
 * Enhanced Tab Navigation Component with News Cards, Pagination, and View All Links
 * 
 * @param array $args {
 *     @type string $activeTab The currently active tab
 *     @type array  $tabs Array of tabs configuration
 *     @type array  $query_args Custom query arguments for each tab
 *     @type int    $posts_per_page Posts per page (default 6)
 *     @type array  $view_all_urls URLs for "View All" links for each tab
 * }
 */
function renderTabNavigationWithCards($args = []) {
    // Get current page from URL
    $current_page = max(1, get_query_var('paged'));
    $current_tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : null;
    
    // Default configuration
    $defaults = [
        'activeTab' => $current_tab,
        'posts_per_page' => 6,
        'tabs' => [
            ['id' => 'all', 'label' => 'All'],
            ['id' => 'news', 'label' => 'News'],
            ['id' => 'events', 'label' => 'Events'],
            ['id' => 'announcements', 'label' => 'Announcements']
        ],
        'query_args' => [
            'all' => [
                'post_type' => ['news', 'events', 'announcements'],
                'orderby' => 'date',
                'order' => 'DESC'
            ],
            'news' => [
                'post_type' => 'news',
                'orderby' => 'date',
                'order' => 'DESC'
            ],
            'events' => [
                'post_type' => 'events',
                'orderby' => 'date',
                'order' => 'DESC',
                'meta_key' => 'event_datetime_start',
                'orderby' => 'meta_value',
                'meta_query' => [
                    [
                        'key' => 'event_datetime_start',
                        'value' => date('Y-m-d H:i:s'),
                        'compare' => '>=',
                        'type' => 'DATETIME'
                    ]
                ]
            ],
            'announcements' => [
                'post_type' => 'announcements',
                'orderby' => 'date',
                'order' => 'DESC',
                'meta_query' => [
                    [
                        'key' => 'announcement_expiry',
                        'value' => date('Y-m-d'),
                        'compare' => '>=',
                        'type' => 'DATE'
                    ]
                ]
            ]
        ],
        // Default View All URLs - customize these for your site
        'view_all_urls' => [
            'all' => '/news-events/',
            'news' => '/news/',
            'events' => '/events/',
            'announcements' => '/announcements/'
        ],
        // Option to show view all links
        'show_view_all' => true,
        // Minimum posts required to show "View All" link
        'view_all_threshold' => 6
    ];
    
    // Merge defaults with provided arguments
    $args = wp_parse_args($args, $defaults);
    
    // Validate tabs (limit to 5)
    $args['tabs'] = array_slice($args['tabs'], 0, 5);
    
    // Set active tab (default to first tab if not specified)
    $activeTab = $args['activeTab'] ?? $args['tabs'][0]['id'];
    
    // Generate tab buttons with URL parameters
    $tabButtons = '';
    foreach ($args['tabs'] as $tab) {
        $isActive = $activeTab === $tab['id'];
        $tab_url = add_query_arg(['tab' => $tab['id']], remove_query_arg('paged'));
        
        $tabButtons .= sprintf(
            '<a href="%s" class="p-1 tab-trigger inline-flex items-center justify-center whitespace-nowrap px-3 py-1.5 text-sm font-medium rounded-md transition-all %s" data-tab="%s">%s</a>',
            esc_url($tab_url),
            $isActive ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-700',
            esc_attr($tab['id']),
            esc_html($tab['label'])
        );
    }
    
    // Generate tab contents with news cards and pagination
    $tabContents = '';
    foreach ($args['tabs'] as $tab) {
        $tabId = $tab['id'];
        $isActive = $activeTab === $tabId;
        
        // Only process active tab to avoid unnecessary queries
        if (!$isActive) {
            $tabContents .= sprintf(
                '<div class="tab-content hidden" data-tab="%s"></div>',
                esc_attr($tabId)
            );
            continue;
        }
        
        // Prepare query arguments with pagination
        $query_args = $args['query_args'][$tabId] ?? [];
        $query_args['posts_per_page'] = $args['posts_per_page'];
        $query_args['paged'] = $current_page;
        
        // Create custom WP_Query for pagination
        $posts_query = new WP_Query($query_args);
        
        // Get total posts count for "View All" decision
        $total_query_args = $query_args;
        $total_query_args['posts_per_page'] = -1;
        $total_query_args['fields'] = 'ids';
        unset($total_query_args['paged']);
        $total_query = new WP_Query($total_query_args);
        $total_posts = $total_query->found_posts;
        wp_reset_postdata();
        
        // Start content with section header and optional View All link
        $header_content = '';
        
        // Add View All link if conditions are met
        if ($args['show_view_all'] && 
            $total_posts >= $args['view_all_threshold'] && 
            isset($args['view_all_urls'][$tabId])) {
            
            $view_all_url = $args['view_all_urls'][$tabId];
            $header_content = sprintf(
                '<div class="mb-6 flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                        <div class="w-1 h-6 bg-%s-600 mr-3"></div>
                        %s
                        <span class="ml-2 text-sm font-normal text-gray-500">(%d %s)</span>
                    </h3>
                    <a href="%s" class="inline-flex items-center gap-2 text-sm font-medium text-primary-600 hover:text-primary-700 transition-colors group">
                        View All %s
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>',
                esc_attr($tabId === 'all' ? 'gray' : ($tabId === 'news' ? 'blue' : ($tabId === 'events' ? 'green' : 'orange'))),
                esc_html($tab['label']),
                $total_posts,
                $total_posts === 1 ? 'item' : 'items',
                esc_url($view_all_url),
                esc_html($tab['label'])
            );
        } else {
            // Standard header without View All
            $header_content = sprintf(
                '<div class="mb-6">
                    <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                        <div class="w-1 h-6 bg-%s-600 mr-3"></div>
                        %s
                        <span class="ml-2 text-sm font-normal text-gray-500">(%d %s)</span>
                    </h3>
                </div>',
                esc_attr($tabId === 'all' ? 'gray' : ($tabId === 'news' ? 'blue' : ($tabId === 'events' ? 'green' : 'orange'))),
                esc_html($tab['label']),
                $total_posts,
                $total_posts === 1 ? 'item' : 'items'
            );
        }
        
        // Add the grid of news cards
        $content = $header_content . '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">';
        
        if ($posts_query->have_posts()) {
            while ($posts_query->have_posts()) {
                $posts_query->the_post();
                
                // Get card arguments
                $card_args = get_post_card_args(get_the_ID());
                
                // Add featured badge if needed
                if (get_field('featured_post', get_the_ID())) {
                    $card_args['badges'][] = [
                        'text' => 'Featured',
                        'color' => 'yellow'
                    ];
                }
                
                // Render the card
                ob_start();
                render_post_card($card_args);
                $content .= ob_get_clean();
            }
        } else {
            $content .= '<p class="col-span-full text-center text-gray-500 py-8">No posts found.</p>';
        }
        
        $content .= '</div>'; // Close grid
        
        // Add pagination if there are multiple pages
        if ($posts_query->max_num_pages > 1) {
            // Temporarily override global $wp_query for pagination
            global $wp_query;
            $original_query = $wp_query;
            $wp_query = $posts_query;
            
            ob_start();
            clean_pagination([
                'container_class' => 'mt-8',
                'show_numbers' => 5
            ]);
            $pagination = ob_get_clean();
            
            // Restore original query
            $wp_query = $original_query;
            
            // Modify pagination URLs to include tab parameter
            $pagination = preg_replace_callback(
                '/href="([^"]*)"/',
                function($matches) use ($tabId) {
                    $url = $matches[1];
                    return 'href="' . esc_url(add_query_arg('tab', $tabId, $url)) . '"';
                },
                $pagination
            );
            
            $content .= $pagination;
        }
        
        wp_reset_postdata();
        
        // Add to tab contents
        $tabContents .= sprintf(
            '<div class="tab-content %s" data-tab="%s">%s</div>',
            $isActive ? 'block' : 'hidden',
            esc_attr($tabId),
            $content
        );
    }
    
    // Output the HTML
    echo <<<HTML
<div class="w-full">
    <div class="grid w-full grid-cols-4 mb-8 bg-gray-100 p-1 rounded-md">
        {$tabButtons}
    </div>
    {$tabContents}
</div>
HTML;
}
?>