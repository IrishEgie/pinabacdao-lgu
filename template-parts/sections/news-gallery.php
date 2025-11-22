<?php
/**
 * News Gallery Component
 * Instagram-style image gallery with swipe support
 * Supports: Featured Image, ACF Gallery, Gutenberg Gallery Blocks
 * * Location: template-parts/sections/news-gallery.php
 */

$post_id = get_the_ID();
$images = [];

// METHOD 0: Custom Meta Box (The "Hard Way")
$custom_gallery_ids = get_post_meta($post_id, '_news_gallery_ids', true);

if (!empty($custom_gallery_ids)) {
    $id_array = explode(',', $custom_gallery_ids);
    
    foreach ($id_array as $img_id) {
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

// METHOD 1: ACF Gallery (Fallback)
if (empty($images) && function_exists('get_field')) {
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

// METHOD 2: Featured Image (Fallback)
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

// METHOD 3: Gutenberg Blocks (Last Resort)
if (empty($images)) {
    $post_content = get_post_field('post_content', $post_id);
    $blocks = parse_blocks($post_content);

    foreach ($blocks as $block) {
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
    }
}

// Remove duplicate images
$unique_images = [];
$seen_ids = [];
foreach ($images as $image) {
    if (!in_array($image['id'], $seen_ids)) {
        $unique_images[] = $image;
        $seen_ids[] = $image['id'];
    }
}
$images = $unique_images;

if (!empty($images)) : 
    $total_images = count($images);
    $show_controls = $total_images > 1;
?>

<!-- Added 'group' class for hover states -->
<div class="news-gallery-container group relative rounded-xl overflow-hidden shadow-2xl mb-8 bg-gray-900" data-news-gallery>
    
    <!-- Gallery Wrapper: Added Aspect Ratios for Mobile (4/3) vs Desktop (16/9) -->
    <div class="relative w-full aspect-[4/3] md:aspect-[16/9] lg:h-[600px] lg:aspect-auto bg-gray-900">
        
        <!-- Image Counter -->
        <?php if ($show_controls) : ?>
        <div class="absolute top-4 right-4 z-20 bg-black/60 text-white text-xs font-bold px-3 py-1.5 rounded-full backdrop-blur-md border border-white/10 shadow-lg">
            <span class="gallery-counter">
                <span class="current-slide">1</span> / <span class="total-slides"><?php echo $total_images; ?></span>
            </span>
        </div>
        <?php endif; ?>

        <!-- Images Container -->
        <div class="gallery-images-wrapper relative w-full h-full overflow-hidden">
            <div class="gallery-images flex h-full transition-transform duration-300 ease-out" style="transform: translateX(0%);">
                <?php foreach ($images as $index => $image) : ?>
                    <!-- Slide: Added h-full and relative positioning -->
                    <div class="gallery-slide min-w-full h-full flex-shrink-0 relative flex items-center justify-center overflow-hidden" data-slide="<?php echo $index; ?>">
                        
                        <!-- 1. BLURRED BACKGROUND (The "Dark/Intense" Effect) -->
                        <div class="absolute inset-0 z-0 overflow-hidden">
                            <img 
                                src="<?php echo esc_url($image['url']); ?>" 
                                class="w-full h-full object-cover blur-2xl opacity-40 scale-110"
                                alt=""
                                aria-hidden="true"
                            >
                            <!-- Dark overlay to ensure content pops -->
                            <div class="absolute inset-0 bg-gray-900/50"></div>
                        </div>

                        <!-- 2. MAIN IMAGE -->
                        <img 
                            src="<?php echo esc_url($image['url']); ?>" 
                            data-full-url="<?php echo esc_url($image['full']); ?>"
                            alt="<?php echo esc_attr($image['alt'] ?: get_the_title()); ?>"
                            class="relative z-10 w-full h-full object-contain shadow-xl transition-transform duration-500"
                            loading="<?php echo $index === 0 ? 'eager' : 'lazy'; ?>"
                        />

                        <!-- Caption -->
                        <?php if (!empty($image['caption'])) : ?>
                            <div class="absolute bottom-0 left-0 right-0 z-20 bg-gradient-to-t from-black/90 via-black/60 to-transparent pt-12 pb-4 px-4">
                                <p class="text-white text-sm md:text-base text-center font-medium drop-shadow-md">
                                    <?php echo esc_html($image['caption']); ?>
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Navigation Arrows (Fixed for Mobile) -->
        <?php if ($show_controls) : ?>
        <button 
            class="gallery-prev absolute left-2 top-1/2 -translate-y-1/2 z-20 bg-black/40 hover:bg-black/80 text-white w-10 h-10 md:w-12 md:h-12 rounded-full flex items-center justify-center transition-all duration-300 backdrop-blur-sm border border-white/10 
            opacity-100 md:opacity-0 md:group-hover:opacity-100 translate-x-0 md:-translate-x-4 md:group-hover:translate-x-0"
            aria-label="Previous image"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
        
        <button 
            class="gallery-next absolute right-2 top-1/2 -translate-y-1/2 z-20 bg-black/40 hover:bg-black/80 text-white w-10 h-10 md:w-12 md:h-12 rounded-full flex items-center justify-center transition-all duration-300 backdrop-blur-sm border border-white/10 
            opacity-100 md:opacity-0 md:group-hover:opacity-100 translate-x-0 md:translate-x-4 md:group-hover:translate-x-0"
            aria-label="Next image"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
        <?php endif; ?>
    </div>

    <!-- Dot Indicators (Updated Colors for Dark Theme) -->
    <?php if ($show_controls) : ?>
    <div class="gallery-dots flex items-center justify-center gap-2 py-3 bg-gray-900 border-t border-gray-800">
        <?php foreach ($images as $index => $image) : ?>
            <button 
                class="gallery-dot w-2 h-2 rounded-full transition-all duration-200 <?php echo $index === 0 ? 'bg-primary-500 w-8' : 'bg-gray-600 hover:bg-gray-400'; ?>"
                data-slide="<?php echo $index; ?>"
                aria-label="Go to image <?php echo $index + 1; ?>"
            ></button>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<?php endif; ?>