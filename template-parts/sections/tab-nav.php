<?php
/**
 * Tab Navigation Component
 * 
 * @param string $activeTab The currently active tab ('all', 'news', 'events', 'announcements')
 */
$activeTab = $activeTab ?? 'all';
?>

<div class="w-full">
    <div class="grid w-full grid-cols-4 mb-8 bg-gray-100 p-1 rounded-md">
        <button 
            class="p-1 tab-trigger inline-flex items-center justify-center whitespace-nowrap px-3 py-1.5 text-sm font-medium rounded-md transition-all <?php echo $activeTab === 'all' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-700'; ?>"
            data-tab="all"
        >
            All News & Events
        </button>
        <button 
            class="p-1 tab-trigger inline-flex items-center justify-center whitespace-nowrap px-3 py-1.5 text-sm font-medium rounded-md transition-all <?php echo $activeTab === 'news' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-700'; ?>"
            data-tab="news"
        >
            Municipal News
        </button>
        <button 
            class="p-1 tab-trigger inline-flex items-center justify-center whitespace-nowrap px-3 py-1.5 text-sm font-medium rounded-md transition-all <?php echo $activeTab === 'events' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-700'; ?>"
            data-tab="events"
        >
            Upcoming Events
        </button>
        <button 
            class="p-1 tab-trigger inline-flex items-center justify-center whitespace-nowrap px-3 py-1.5 text-sm font-medium rounded-md transition-all <?php echo $activeTab === 'announcements' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-700'; ?>"
            data-tab="announcements"
        >
            Announcements
        </button>
    </div>

    <div class="tab-content <?php echo $activeTab === 'all' ? 'block' : 'hidden'; ?>" data-tab="all">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Static content for demo purposes -->
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="text-lg font-medium">News Item 1</h3>
                <p class="text-gray-600">Sample news content</p>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="text-lg font-medium">Event Item 1</h3>
                <p class="text-gray-600">Sample event content</p>
            </div>
        </div>
        
        <div class="flex justify-center space-x-4 mt-8">
            <a href="/news" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                View all News
                <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </a>
            <a href="/events" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                View all Events
                <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </a>
            <a href="/announcements" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                View all Announcements
                <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </a>
        </div>
    </div>

    <div class="tab-content <?php echo $activeTab === 'news' ? 'block' : 'hidden'; ?>" data-tab="news">
        <div class="mb-6">
            <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                <div class="w-1 h-6 bg-blue-600 mr-3"></div>
                All Municipal News
            </h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Static news items -->
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="text-lg font-medium">News Item 1</h3>
                <p class="text-gray-600">Sample news content</p>
            </div>
        </div>
    </div>

    <div class="tab-content <?php echo $activeTab === 'events' ? 'block' : 'hidden'; ?>" data-tab="events">
        <div class="mb-6">
            <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                <div class="w-1 h-6 bg-green-600 mr-3"></div>
                All Upcoming Events
            </h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Static event items -->
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="text-lg font-medium">Event Item 1</h3>
                <p class="text-gray-600">Sample event content</p>
            </div>
        </div>
    </div>

    <div class="tab-content <?php echo $activeTab === 'announcements' ? 'block' : 'hidden'; ?>" data-tab="announcements">
        <div class="mb-6">
            <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                <div class="w-1 h-6 bg-orange-600 mr-3"></div>
                All Announcements
            </h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Static announcement items -->
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="text-lg font-medium">Announcement 1</h3>
                <p class="text-gray-600">Sample announcement content</p>
            </div>
        </div>
    </div>
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