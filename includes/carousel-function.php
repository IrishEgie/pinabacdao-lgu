<?php 
// Add this to your existing functions.php file

/**
 * Enqueue Alpine.js for carousel functionality
 */
function enqueue_carousel_scripts() {
    // Enqueue Alpine.js
    wp_enqueue_script(
        'alpine-js',
        'https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js',
        array(),
        '3.12.0',
        true
    );
    
    // Optional: If you want to add autoplay functionality
    wp_enqueue_script(
        'alpine-autoplay',
        'https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.12.0/dist/cdn.min.js',
        array('alpine-js'),
        '3.12.0',
        true
    );
    
    // Initialize Alpine after all plugins are loaded
    wp_add_inline_script('alpine-js', '
        document.addEventListener("DOMContentLoaded", function() {
            Alpine.plugin(Intersect);
            Alpine.start();
        });
    ');
}
add_action('wp_enqueue_scripts', 'enqueue_carousel_scripts', 20); // Higher priority to load after theme scripts

/**
 * Include the carousel template part
 */
function include_carousel_templates() {
    // Include the carousel template
    require_once get_template_directory() . '/template-parts/sections/news-carousel.php';
    
}
add_action('after_setup_theme', 'include_carousel_templates');

/**
 * Add custom image size for carousel items
 */
function add_carousel_image_sizes() {
    add_image_size('carousel-large', 1200, 675, true); // 16:9 ratio for carousel
    add_image_size('carousel-thumbnail', 400, 225, true); // Smaller version for thumbnails
}
add_action('after_setup_theme', 'add_carousel_image_sizes');