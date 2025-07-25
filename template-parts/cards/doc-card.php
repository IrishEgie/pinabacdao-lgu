<?php
/**
 * Document Card Template
 * Usage: get_template_part('template-parts/cards/doc-card', null, ['doc' => $doc_data]);
 * 
 * Expected $args['doc'] structure:
 * - title: Document title
 * - type: Document type name
 * - description: Document excerpt/description
 * - fileType: File extension (PDF, DOC, etc.)
 * - fileSize: Formatted file size
 * - date: Formatted date
 * - downloadUrl: Direct download URL
 * - document_number: Optional document number
 */

$doc = $args['doc'] ?? [];
if (empty($doc) || empty($doc['downloadUrl'])) {
    return;
}

// Set defaults
$title = $doc['title'] ?? 'Untitled Document';
$type = $doc['type'] ?? 'Document';
$description = $doc['description'] ?? '';
$fileType = strtoupper($doc['fileType'] ?? 'FILE');
$fileSize = $doc['fileSize'] ?? '';
$date = $doc['date'] ?? '';
$downloadUrl = $doc['downloadUrl'];
$showType = $doc['showType'] ?? true;
$showSize = $doc['showSize'] ?? true;
?>

<a href="<?php echo esc_url($downloadUrl); ?>" 
   target="_blank" 
   class="block border rounded-lg p-4 hover:shadow-md transition-all duration-200 hover:border-blue-200 group cursor-pointer bg-white">
   
    <!-- Header with type and file info -->
    <div class="flex items-start justify-between mb-2">
        <?php if ($showType): ?>
            <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded group-hover:bg-blue-200 transition-colors">
                <?php echo esc_html($type); ?>
            </span>
        <?php endif; ?>
        
        <div class="flex items-center gap-2 text-xs text-gray-500">
            <span class="font-medium"><?php echo esc_html($fileType); ?></span>
            <?php if ($showSize && $fileSize): ?>
                <span>•</span>
                <span><?php echo esc_html($fileSize); ?></span>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Document title -->
    <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-800 transition-colors">
        <?php echo esc_html($title); ?>
    </h3>
    
    <!-- Description -->
    <?php if ($description): ?>
        <p class="text-sm text-gray-600 mb-3 line-clamp-2">
            <?php echo esc_html($description); ?>
        </p>
    <?php endif; ?>
    
    <!-- Footer with date and download indicator -->
    <div class="flex items-center justify-between">
        <?php if ($date): ?>
            <span class="text-xs text-gray-500">
                <?php echo esc_html($date); ?>
            </span>
        <?php endif; ?>
        
        <div class="flex items-center text-blue-600 group-hover:text-blue-800 text-sm font-medium transition-colors">
            <span>Download</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-4-4m4 4l4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
    </div>
</a>