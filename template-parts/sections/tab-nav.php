<?php
/**
 * Tab Navigation Component
 * 
 * @param string $activeTab The currently active tab (defaults to first tab if not specified)
 * @param array $tabs Array of tabs configuration (max 5 tabs)
 * @param array $contents Array of tab contents (can be HTML strings or callable functions)
 */
function renderTabNavigation($args = []) {
    // Default configuration
    $defaults = [
        'activeTab' => null,
        'tabs' => [
            [
                'id' => 'all',
                'label' => 'All News & Events'
            ],
            [
                'id' => 'news',
                'label' => 'Municipal News'
            ],
            [
                'id' => 'events',
                'label' => 'Upcoming Events'
            ],
            [
                'id' => 'announcements',
                'label' => 'Announcements'
            ]
        ],
        'contents' => [
            'all' => '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg shadow p-4">
                    <h3 class="text-lg font-medium">News Item 1</h3>
                    <p class="text-gray-600">Sample news content</p>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <h3 class="text-lg font-medium">Event Item 1</h3>
                    <p class="text-gray-600">Sample event content</p>
                </div>
            </div>',
            'news' => '<div class="mb-6">
                <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                    <div class="w-1 h-6 bg-blue-600 mr-3"></div>
                    All Municipal News
                </h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg shadow p-4">
                    <h3 class="text-lg font-medium">News Item 1</h3>
                    <p class="text-gray-600">Sample news content</p>
                </div>
            </div>',
            'events' => '<div class="mb-6">
                <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                    <div class="w-1 h-6 bg-green-600 mr-3"></div>
                    All Upcoming Events
                </h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg shadow p-4">
                    <h3 class="text-lg font-medium">Event Item 1</h3>
                    <p class="text-gray-600">Sample event content</p>
                </div>
            </div>',
            'announcements' => '<div class="mb-6">
                <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                    <div class="w-1 h-6 bg-orange-600 mr-3"></div>
                    All Announcements
                </h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg shadow p-4">
                    <h3 class="text-lg font-medium">Announcement 1</h3>
                    <p class="text-gray-600">Sample announcement content</p>
                </div>
            </div>'
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
    
    // Generate tab contents
    $tabContents = '';
    foreach ($args['tabs'] as $tab) {
        $tabId = $tab['id'];
        $isActive = $activeTab === $tabId;
        $content = '';
        
        if (isset($args['contents'][$tabId])) {
            $content = is_callable($args['contents'][$tabId]) 
                ? call_user_func($args['contents'][$tabId]) 
                : $args['contents'][$tabId];
        }
        
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
    // Get all tab triggers and contents
    const tabTriggers = document.querySelectorAll('.tab-trigger');
    const tabContents = document.querySelectorAll('.tab-content');
    
    // Function to activate a tab
    function activateTab(tab) {
        // Update tab buttons
        tabTriggers.forEach(t => {
            const isActive = t.dataset.tab === tab;
            t.classList.toggle('bg-white', isActive);
            t.classList.toggle('text-gray-900', isActive);
            t.classList.toggle('shadow-sm', isActive);
            t.classList.toggle('text-gray-500', !isActive);
            t.classList.toggle('hover:text-gray-700', !isActive);
        });
        
        // Update tab content
        tabContents.forEach(content => {
            content.classList.toggle('hidden', content.dataset.tab !== tab);
            content.classList.toggle('block', content.dataset.tab === tab);
        });
    }
    
    // Set click handlers for all tabs
    tabTriggers.forEach(trigger => {
        trigger.addEventListener('click', () => {
            activateTab(trigger.dataset.tab);
        });
    });
    
    // If no tab is active (shouldn't happen with PHP default, but good for JS-only cases)
    const activeTab = document.querySelector('.tab-trigger.bg-white');
    if (!activeTab && tabTriggers.length > 0) {
        activateTab(tabTriggers[0].dataset.tab); // Activate first tab by default
    }
});
</script>
HTML;
}