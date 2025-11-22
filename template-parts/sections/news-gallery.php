<?php
/**
 * News Gallery Component
 * 21:9 Ultra-Wide "Cinema" Aspect Ratio
 * Location: template-parts/sections/news-gallery.php
 */

$post_id = get_the_ID();
$images = [];

// METHOD 0: Custom Meta Box
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

// METHOD 1: ACF Gallery
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

// METHOD 2: Featured Image
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

// METHOD 3: Gutenberg Blocks
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

// Deduplicate
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

<!-- Main Container: Black bg, rounded -->
<div class="news-gallery-container group relative rounded-lg overflow-hidden shadow-lg mb-8 bg-black border border-gray-800" data-news-gallery>
    
    <!-- 
        ASPECT RATIO UPDATE: 4:3
        This creates a wide, cinematic strip that doesn't push content down too far.
        Used aspect-[4/3] utility (supported in JIT mode).
    -->
    <div class="relative w-full aspect-[4/3] bg-black">
        
        <!-- On-Page Counter (Top Right) -->
        <?php if ($show_controls) : ?>
        <div class="absolute top-4 right-4 z-30 bg-black/60 text-white/90 text-xs font-bold px-3 py-1 rounded-full backdrop-blur-sm border border-white/10">
            <span class="gallery-counter">
                <span class="current-slide">1</span> / <span class="total-slides"><?php echo $total_images; ?></span>
            </span>
        </div>
        <?php endif; ?>

        <!-- Images Wrapper -->
        <div class="gallery-images-wrapper relative w-full h-full overflow-hidden">
            <div class="gallery-images flex h-full transition-transform duration-300 ease-out" style="transform: translateX(0%);">
                <?php foreach ($images as $index => $image) : ?>
                    <div class="gallery-slide min-w-full h-full flex-shrink-0 relative flex items-center justify-center bg-black" data-slide="<?php echo $index; ?>">
                        <img 
                            src="<?php echo esc_url($image['url']); ?>" 
                            data-full-url="<?php echo esc_url($image['full']); ?>"
                            alt="<?php echo esc_attr($image['alt'] ?: get_the_title()); ?>"
                            class="relative z-10 max-w-full max-h-full w-auto h-auto object-contain select-none"
                            loading="<?php echo $index === 0 ? 'eager' : 'lazy'; ?>"
                        />
                        <?php if (!empty($image['caption'])) : ?>
                            <div class="absolute bottom-0 left-0 right-0 z-20 bg-gradient-to-t from-black via-black/80 to-transparent pt-12 pb-4 px-6 pointer-events-none">
                                <p class="text-white/90 text-sm text-center font-light">
                                    <?php echo esc_html($image['caption']); ?>
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Navigation Arrows (On Page) -->
        <?php if ($show_controls) : ?>
        <button 
            class="gallery-prev absolute left-0 top-0 bottom-0 z-20 w-12 flex items-center justify-center 
            bg-transparent hover:bg-white/5 transition-colors group/nav outline-none
            opacity-0 group-hover:opacity-100 focus:opacity-100"
            aria-label="Previous image"
        >
            <span class="w-8 h-8 rounded-full bg-black/50 backdrop-blur-sm border border-white/20 flex items-center justify-center text-white hover:bg-white hover:text-black transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </span>
        </button>
        
        <button 
            class="gallery-next absolute right-0 top-0 bottom-0 z-20 w-12 flex items-center justify-center 
            bg-transparent hover:bg-white/5 transition-colors group/nav outline-none
            opacity-0 group-hover:opacity-100 focus:opacity-100"
            aria-label="Next image"
        >
            <span class="w-8 h-8 rounded-full bg-black/50 backdrop-blur-sm border border-white/20 flex items-center justify-center text-white hover:bg-white hover:text-black transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </span>
        </button>
        <?php endif; ?>
    </div>

    <!-- Dots (On Page) -->
    <?php if ($show_controls) : ?>
    <div class="gallery-dots flex items-center justify-center gap-1.5 py-2 bg-black border-t border-white/10">
        <?php foreach ($images as $index => $image) : ?>
            <button 
                class="gallery-dot w-1.5 h-1.5 rounded-full transition-all duration-300 <?php echo $index === 0 ? 'bg-white w-4' : 'bg-gray-600 hover:bg-gray-400'; ?>"
                data-slide="<?php echo $index; ?>"
                aria-label="Go to image <?php echo $index + 1; ?>"
            ></button>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<?php endif; ?>