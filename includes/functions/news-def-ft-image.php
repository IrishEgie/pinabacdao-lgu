<?php

/**
 * Fallback Featured Image from Custom Gallery
 * * Logic: If a post has no featured image set, check if it has a custom gallery.
 * If yes, use the first image from the gallery as the featured image ID.
 */
function pinabacdao_fallback_featured_image($thumbnail_id, $post) {
    // If a featured image is already set, return it.
    if ($thumbnail_id) {
        return $thumbnail_id;
    }

    // Get the post ID
    $post_id = isset($post->ID) ? $post->ID : $post;

    // Check for our custom gallery IDs (The "Hard Way" method)
    $gallery_ids = get_post_meta($post_id, '_news_gallery_ids', true);

    if (!empty($gallery_ids)) {
        // Explode string "12,15,19" into array
        $ids_array = explode(',', $gallery_ids);
        
        // Return the first ID found
        if (!empty($ids_array[0])) {
            return (int) $ids_array[0];
        }
    }
    
    // Optional: Check ACF Fallback (Method 1 in your original code)
    if (function_exists('get_field')) {
        $acf_gallery = get_field('news_gallery_images', $post_id);
        if ($acf_gallery && is_array($acf_gallery) && !empty($acf_gallery[0]['id'])) {
             return $acf_gallery[0]['id'];
        }
    }

    return $thumbnail_id;
}
add_filter('post_thumbnail_id', 'pinabacdao_fallback_featured_image', 10, 2);