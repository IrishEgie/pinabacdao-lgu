<?php
$issuance = $args['issuance'] ?? null;
?>
<div class="group hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 bg-white rounded-lg border border-gray-200 overflow-hidden">
    <div class="p-6 pb-4">
        <div class="flex items-start justify-between">
            <div class="flex items-center space-x-3">
                <div class="p-2 bg-primary-50 rounded-lg group-hover:bg-primary-100 transition-colors duration-300">
                    <?php echo get_service_icon_svg('file-text', 'text-primary-600 w-5 h-5'); ?>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 group-hover:text-primary-500 transition-colors duration-300">
                        <?php echo esc_html($issuance['title']); ?>
                    </h3>
                    <span class="mt-1 inline-flex items-center rounded-md border border-gray-200 px-2.5 py-0.5 text-xs font-medium">
                        <?php echo esc_html($issuance['type']); ?>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="px-6 pb-6 space-y-4">
        <p class="text-gray-600 text-sm leading-relaxed">
            <?php echo esc_html($issuance['description']); ?>
        </p>

        <div class="flex items-center justify-between text-sm text-gray-500">
            <div class="flex items-center space-x-4">
                <span class="font-medium"><?php echo esc_html($issuance['fileType']); ?></span>
                <span><?php echo esc_html($issuance['fileSize']); ?></span>
            </div>
            <div class="flex items-center space-x-2">
                <?php echo get_service_icon_svg('calendar', 'w-4 h-4'); ?>
                <span><?php echo esc_html($issuance['date']); ?></span>
            </div>
        </div>

        <button class="w-full group-hover:bg-primary-500 transition-colors duration-300 bg-primary-600 text-white py-2 px-4 rounded-md inline-flex items-center justify-center"
                onclick="window.open('<?php echo esc_url($issuance['downloadUrl']); ?>', '_blank')">
            <?php echo get_service_icon_svg('download', 'mr-2 w-4 h-4'); ?>
            Download
        </button>
    </div>
</div>