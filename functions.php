<?php
// Theme setup
function theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    
    register_nav_menus([
        'primary' => __('Primary Menu', 'text_domain'),
        'mobile' => __('Mobile Menu', 'text_domain'),
        'footer_menu_1' => __('Footer Menu 1 (Site Map)', 'text_domain'),
        'footer_menu_2' => __('Footer Menu 2 (Archive)', 'text_domain'),
        'footer_menu_3' => __('Footer Menu 3 (Transparency)', 'text_domain'),
        'footer_menu_4' => __('Footer Menu 4 (Legal)', 'text_domain')
    ]);
    
    // Include walker classes
    require_once get_template_directory() . '/inc/class-header-nav-walker.php';
    require_once get_template_directory() . '/inc/class-mobile-nav-walker.php';
    require_once get_template_directory() . '/inc/class-simple-footer-menu-walker.php';
    // Include customizer settings
    require_once get_template_directory() . '/inc/header-customizer.php';
    require_once get_template_directory() . '/inc/footer-customizer.php';
    // Include Icon functions
    require_once get_template_directory() . '/inc/icons.php';
    // Load breadcrumbs functionality
    require_once get_template_directory() . '/inc/breadcrumbs.php';
    require_once get_template_directory() . '/inc/breadcrumbs-template.php';
    require_once get_template_directory() . '/inc/page-banner.php';
    // Load custom post types
    require_once get_template_directory() . '/inc/post-types/services.php';
   
}
add_action('after_setup_theme', 'theme_setup');

// Enqueue styles and scripts
function theme_assets() {
    // Main CSS
    wp_enqueue_style(
        'theme-style',
        get_template_directory_uri() . '/assets/css/tailwind-output.css',
        [],
        filemtime(get_template_directory() . '/assets/css/tailwind-output.css')
    );
    
    // Main JS
    wp_enqueue_script(
        'theme-script',
        get_template_directory_uri() . '/assets/js/script.js',
        [],
        filemtime(get_template_directory() . '/assets/js/script.js'),
        true
    );
    
    wp_localize_script('theme-script', 'themeData', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'homeUrl' => home_url('/')
    ]);

    // Enqueue Google Fonts
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Open+Sans&display=swap',
        [],
        null
    );
    
    // Enqueue Font Awesome 6 (Free version)
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
        [],
        '6.4.0'
    );
}
add_action('wp_enqueue_scripts', 'theme_assets');


/**
 * Helper function to get Font Awesome icon classes for social media
 */
function get_social_icon_class($platform) {
    $icons = [
        'facebook' => 'fab fa-facebook-f',
        'twitter' => 'fab fa-twitter',
        'youtube' => 'fab fa-youtube',
        'instagram' => 'fab fa-instagram',
        'linkedin' => 'fab fa-linkedin-in',
        'pinterest' => 'fab fa-pinterest-p'
    ];
    
    return $icons[strtolower($platform)] ?? 'fas fa-share-alt';
}
