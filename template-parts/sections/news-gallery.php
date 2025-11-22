<?php
/**
 * News Gallery Component
 * Instagram-style image gallery with swipe support
 * Supports: Featured Image, ACF Gallery, Gutenberg Gallery Blocks
 * 
 * Location: template-parts/sections/news-gallery.php
 */

$post_id = get_the_ID();
$images = [];

// METHOD 0: Custom Meta Box (The "Hard Way")
$custom_gallery_ids = get_post_meta($post_id, '_news_gallery_ids', true);

if (!empty($custom_gallery_ids)) {
    $id_array = explode(',', $custom_gallery_ids);
    
    foreach ($id_array as $img_id) {
        // Skip if ID is empty
        if (empty($img_id)) continue;
        
        $images[] = [
            'id' => $img_id,
            'url' => wp_get_attachment_image_url($img_id, 'large'),
            'full' => wp_get_attachment_image_url($img_id, 'full'),
            'alt' => get_post_meta($img_id, '_wp_attachment_image_alt', true) ?: get_the_title(),
            'caption' => wp_get_attachment_caption($img_id)
        ];
    }
}

// METHOD 1: Try ACF Gallery first (if ACF is installed)
if (function_exists('get_field')) {
    $acf_gallery = get_field('news_gallery_images', $post_id);
    
    if ($acf_gallery && is_array($acf_gallery)) {
        foreach ($acf_gallery as $image) {
            $images[] = [
                'id' => $image['id'],
                'url' => $image['sizes']['large'] ?? $image['url'],
                'full' => $image['url'],
                'alt' => $image['alt'] ?? get_the_title(),
                'caption' => $image['caption'] ?? ''
            ];
        }
    }
}

// METHOD 2: If no ACF images, add featured image
if (empty($images) && has_post_thumbnail($post_id)) {
    $featured_id = get_post_thumbnail_id($post_id);
    $images[] = [
        'id' => $featured_id,
        'url' => get_the_post_thumbnail_url($post_id, 'large'),
        'full' => get_the_post_thumbnail_url($post_id, 'full'),
        'alt' => get_post_meta($featured_id, '_wp_attachment_image_alt', true),
        'caption' => wp_get_attachment_caption($featured_id)
    ];
}

// METHOD 3: Get images from Gutenberg gallery blocks (fallback)
if (empty($images)) {
    $post_content = get_post_field('post_content', $post_id);
    $blocks = parse_blocks($post_content);

    foreach ($blocks as $block) {
        // Check for core/gallery block
        if ($block['blockName'] === 'core/gallery' && !empty($block['innerBlocks'])) {
            foreach ($block['innerBlocks'] as $inner_block) {
                if ($inner_block['blockName'] === 'core/image' && !empty($inner_block['attrs']['id'])) {
                    $img_id = $inner_block['attrs']['id'];
                    
                    $images[] = [
                        'id' => $img_id,
                        'url' => wp_get_attachment_image_url($img_id, 'large'),
                        'full' => wp_get_attachment_image_url($img_id, 'full'),
                        'alt' => get_post_meta($img_id, '_wp_attachment_image_alt', true),
                        'caption' => wp_get_attachment_caption($img_id)
                    ];
                }
            }
        }
        
        // Check for core/image block (single images)
        if ($block['blockName'] === 'core/image' && !empty($block['attrs']['id'])) {
            $img_id = $block['attrs']['id'];
            
            $images[] = [
                'id' => $img_id,
                'url' => wp_get_attachment_image_url($img_id, 'large'),
                'full' => wp_get_attachment_image_url($img_id, 'full'),
                'alt' => get_post_meta($img_id, '_wp_attachment_image_alt', true),
                'caption' => wp_get_attachment_caption($img_id)
            ];
        }
    }
}

// Remove duplicate images based on ID
$unique_images = [];
$seen_ids = [];
foreach ($images as $image) {
    if (!in_array($image['id'], $seen_ids)) {
        $unique_images[] = $image;
        $seen_ids[] = $image['id'];
    }
}
$images = $unique_images;

// Only display gallery if we have images
if (!empty($images)) : 
    $total_images = count($images);
    $show_controls = $total_images > 1; // Only show controls if multiple images
?>

<div class="news-gallery-container rounded-lg overflow-hidden shadow-md mb-6" data-news-gallery>
    <!-- Gallery Wrapper -->
    <div class="relative bg-gray-900">
        <!-- Image Counter (Top Right) -->
        <?php if ($show_controls) : ?>
        <div class="absolute top-4 right-4 z-10 bg-black/60 text-white text-sm px-3 py-1 rounded-full backdrop-blur-sm">
            <span class="gallery-counter">
                <span class="current-slide">1</span> / <span class="total-slides"><?php echo $total_images; ?></span>
            </span>
        </div>
        <?php endif; ?>

        <!-- Images Container -->
        <div class="gallery-images-wrapper relative overflow-hidden">
            <div class="gallery-images flex transition-transform duration-300 ease-out" style="transform: translateX(0%);">
                <?php foreach ($images as $index => $image) : ?>
                    <div class="gallery-slide min-w-full flex-shrink-0" data-slide="<?php echo $index; ?>">
                        <img 
                            src="<?php echo esc_url($image['url']); ?>" 
                            alt="<?php echo esc_attr($image['alt'] ?: get_the_title()); ?>"
                            class="w-full h-auto object-cover max-h-[600px]"
                            loading="<?php echo $index === 0 ? 'eager' : 'lazy'; ?>"
                        />
                        <?php if (!empty($image['caption'])) : ?>
                            <div class="bg-gray-800/90 text-white text-sm p-3 absolute bottom-0 left-0 right-0">
                                <?php echo esc_html($image['caption']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Navigation Arrows -->
        <?php if ($show_controls) : ?>
        <button 
            class="gallery-prev absolute left-2 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white w-10 h-10 rounded-full flex items-center justify-center transition-all duration-200 backdrop-blur-sm z-10 opacity-0 hover:opacity-100 focus:opacity-100"
            aria-label="Previous image"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
        
        <button 
            class="gallery-next absolute right-2 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white w-10 h-10 rounded-full flex items-center justify-center transition-all duration-200 backdrop-blur-sm z-10 opacity-0 hover:opacity-100 focus:opacity-100"
            aria-label="Next image"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
        <?php endif; ?>
    </div>

    <!-- Dot Indicators -->
    <?php if ($show_controls) : ?>
    <div class="gallery-dots flex items-center justify-center gap-2 py-4 bg-white">
        <?php foreach ($images as $index => $image) : ?>
            <button 
                class="gallery-dot w-2 h-2 rounded-full transition-all duration-200 <?php echo $index === 0 ? 'bg-primary-600 w-8' : 'bg-gray-300 hover:bg-gray-400'; ?>"
                data-slide="<?php echo $index; ?>"
                aria-label="Go to image <?php echo $index + 1; ?>"
            ></button>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<?php endif; // End if images exist ?>