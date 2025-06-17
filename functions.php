<?php
// Theme setup
function theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    
    register_nav_menus([
        'primary' => __('Primary Menu', 'text_domain'),
        'mobile' => __('Mobile Menu', 'text_domain')
    ]);
    
    // Include walker classes
    require_once get_template_directory() . '/inc/class-header-nav-walker.php';
    require_once get_template_directory() . '/inc/class-mobile-nav-walker.php';
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

        // Enqueue Lucide Icons
    wp_enqueue_style(
        'lucide-icons',
        'https://cdn.jsdelivr.net/npm/lucide-static@0.16.29/font/lucide.css',
        [],
        '0.16.29',
        'google-fonts', 'https://fonts.googleapis.com/css2?family=Open+Sans&display=swap',
    );
}
add_action('wp_enqueue_scripts', 'theme_assets');

// Customizer settings
require get_template_directory() . '/inc/header-customizer.php';


// Register footer menus
register_nav_menus([
    'primary' => __('Primary Menu', 'text_domain'),
    'mobile' => __('Mobile Menu', 'text_domain'),
    'footer_menu_1' => __('Footer Menu 1 (Site Map)', 'text_domain'),
    'footer_menu_2' => __('Footer Menu 2 (Archive)', 'text_domain'),
    'footer_menu_3' => __('Footer Menu 3 (Transparency)', 'text_domain'),
    'footer_menu_4' => __('Footer Menu 4 (Legal)', 'text_domain')
]);

// Include footer customizer
require_once get_template_directory() . '/inc/footer-customizer.php';

// Include footer menu walker
require_once get_template_directory() . '/inc/class-simple-footer-menu-walker.php';

// Add footer menu title settings
function footer_menu_customizer_settings($wp_customize) {
    $wp_customize->add_section('footer_menu_settings', [
        'title' => __('Footer Menu Titles', 'text_domain'),
        'priority' => 121,
    ]);

    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting('footer_menu_' . $i . '_title', [
            'default' => $i == 1 ? 'Site Map' : ($i == 2 ? 'Archive' : ($i == 3 ? 'Transparency' : 'Legal')),
            'sanitize_callback' => 'sanitize_text_field'
        ]);

        $wp_customize->add_control('footer_menu_' . $i . '_title_control', [
            'label' => __('Footer Menu ' . $i . ' Title', 'text_domain'),
            'section' => 'footer_menu_settings',
            'settings' => 'footer_menu_' . $i . '_title',
            'type' => 'text'
        ]);
    }
}
add_action('customize_register', 'footer_menu_customizer_settings');