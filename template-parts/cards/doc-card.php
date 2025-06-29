<div class="p-6 pb-4">
    <div class="flex items-start justify-between">
        <div class="flex items-center space-x-3">
            <div class="p-2 bg-primary-50 rounded-lg group-hover:bg-primary-100 transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="text-primary-600">
                    <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z">
                    </path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                </svg>
            </div>
            <div>
                <h3
                    class="text-lg font-semibold text-gray-800 group-hover:text-primary-500 transition-colors duration-300">
                    <?php echo esc_html($doc['title']); ?>
                </h3>
                <span
                    class="mt-1 inline-flex items-center rounded-md border border-gray-200 px-2.5 py-0.5 text-xs font-medium">
                    <?php echo esc_html($doc['category']); ?>
                </span>
            </div>
        </div>
    </div>
</div>