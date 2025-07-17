<?php
/**
 * Tab Navigation Component with News Cards
 * 
 * @param array $args {
 *     @type string $activeTab The currently active tab
 *     @type array  $tabs Array of tabs configuration
 *     @type array  $query_args Custom query arguments for each tab
 * }
 */
function renderTabNavigationWithCards($args = []) {
    // Default configuration
    $defaults = [
        'activeTab' => null,
        'tabs' => [
            ['id' => 'all', 'label' => 'All'],
            ['id' => 'news', 'label' => 'News'],
            ['id' => 'events', 'label' => 'Events'],
            ['id' => 'announcements', 'label' => 'Announcements']
        ],
        'query_args' => [
            'all' => [
                'post_type' => ['news', 'events', 'announcements'],
                'posts_per_page' => 6,
                'orderby' => 'date',
                'order' => 'DESC'
            ],
            'news' => [
                'post_type' => 'news',
                'posts_per_page' => 6,
                'orderby' => 'date',
                'order' => 'DESC'
            ],
            'events' => [
                'post_type' => 'events',
                'posts_per_page' => 6,
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
                'posts_per_page' => 6,
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
        ]
    ];
    
    // Merge defaults with provided arguments
    $args = wp_parse_args($args, $defaults);
    
    // Validate tabs (limit to 5)
    $args['tabs'] = array_slice($args['tabs'], 0, 5);
    
    // Set active tab (default to first tab if not specified)
    $activeTab = $args['activeTab'] ?? $args['tabs'][0]['id'];
    
    // Generate tab buttons
    $tabButtons = '';
    foreach ($args['tabs'] as $tab) {
        $isActive = $activeTab === $tab['id'];
        $tabButtons .= sprintf(
            '<button class="p-1 tab-trigger inline-flex items-center justify-center whitespace-nowrap px-3 py-1.5 text-sm font-medium rounded-md transition-all %s" data-tab="%s">%s</button>',
            $isActive ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-700',
            esc_attr($tab['id']),
            esc_html($tab['label'])
        );
    }
    
    // Generate tab contents with news cards
    $tabContents = '';
    foreach ($args['tabs'] as $tab) {
        $tabId = $tab['id'];
        $isActive = $activeTab === $tabId;
        
        // Start content with section header
        $content = sprintf(
            '<div class="mb-6">
                <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                    <div class="w-1 h-6 bg-%s-600 mr-3"></div>
                    %s
                </h3>
            </div>',
            esc_attr($tabId === 'all' ? 'gray' : ($tabId === 'news' ? 'blue' : ($tabId === 'events' ? 'green' : 'orange'))),
            esc_html($tab['label'])
        );
        
        // Add the grid of news cards
        $content .= '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">';
        
        // Get posts for this tab
        $query_args = $args['query_args'][$tabId] ?? [];
        $posts_query = new WP_Query($query_args);
        
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
            wp_reset_postdata();
        } else {
            $content .= '<p class="col-span-full text-center text-gray-500 py-8">No posts found.</p>';
        }
        
        $content .= '</div>'; // Close grid
        
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabTriggers = document.querySelectorAll('.tab-trigger');
    const tabContents = document.querySelectorAll('.tab-content');
    
    function activateTab(tab) {
        tabTriggers.forEach(t => {
            const isActive = t.dataset.tab === tab;
            t.classList.toggle('bg-white', isActive);
            t.classList.toggle('text-gray-900', isActive);
            t.classList.toggle('shadow-sm', isActive);
            t.classList.toggle('text-gray-500', !isActive);
            t.classList.toggle('hover:text-gray-700', !isActive);
        });
        
        tabContents.forEach(content => {
            content.classList.toggle('hidden', content.dataset.tab !== tab);
            content.classList.toggle('block', content.dataset.tab === tab);
        });
    }
    
    tabTriggers.forEach(trigger => {
        trigger.addEventListener('click', () => {
            activateTab(trigger.dataset.tab);
        });
    });
    
    const activeTab = document.querySelector('.tab-trigger.bg-white');
    if (!activeTab && tabTriggers.length > 0) {
        activateTab(tabTriggers[0].dataset.tab);
    }
});
</script>
HTML;
}