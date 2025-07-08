<?php
/**
 * Tab Navigation Component
 * 
 * @param string $activeTab The currently active tab ('all', 'news', 'events', 'announcements')
 */
?>

<div class="w-full">
    <div class="flex w-full border-b border-gray-200 mb-8">
        <button 
            class="tab-trigger px-4 py-3 text-sm font-medium <?php echo $activeTab === 'all' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700'; ?>"
            data-tab="all"
        >
            All News & Events
        </button>
        <button 
            class="tab-trigger px-4 py-3 text-sm font-medium <?php echo $activeTab === 'news' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700'; ?>"
            data-tab="news"
        >
            Municipal News
        </button>
        <button 
            class="tab-trigger px-4 py-3 text-sm font-medium <?php echo $activeTab === 'events' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700'; ?>"
            data-tab="events"
        >
            Upcoming Events
        </button>
        <button 
            class="tab-trigger px-4 py-3 text-sm font-medium <?php echo $activeTab === 'announcements' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700'; ?>"
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
// Simple tab switching functionality
document.querySelectorAll('.tab-trigger').forEach(trigger => {
    trigger.addEventListener('click', () => {
        const tab = trigger.dataset.tab;
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.toggle('hidden', content.dataset.tab !== tab);
            content.classList.toggle('block', content.dataset.tab === tab);
        });
        document.querySelectorAll('.tab-trigger').forEach(t => {
            t.classList.toggle('text-blue-600', t.dataset.tab === tab);
            t.classList.toggle('border-b-2', t.dataset.tab === tab);
            t.classList.toggle('border-blue-600', t.dataset.tab === tab);
            t.classList.toggle('text-gray-500', t.dataset.tab !== tab);
            t.classList.toggle('hover:text-gray-700', t.dataset.tab !== tab);
        });
    });
});
</script>