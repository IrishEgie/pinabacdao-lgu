<?php
// Theme setup
function theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_filter('template_include', 'custom_search_template');
    
    register_nav_menus([
        'primary' => __('Primary Menu', 'text_domain'),
        'mobile' => __('Mobile Menu', 'text_domain'),
        'footer_menu_1' => __('Footer Menu 1 (Site Map)', 'text_domain'),
        'footer_menu_2' => __('Footer Menu 2 (Archive)', 'text_domain'),
        'footer_menu_3' => __('Footer Menu 3 (Transparency)', 'text_domain'),
        'footer_menu_4' => __('Footer Menu 4 (Legal)', 'text_domain')
    ]);
    
    // Include walker classes
    require_once get_template_directory() . '/includes/class-header-nav-walker.php';
    require_once get_template_directory() . '/includes/class-mobile-nav-walker.php';
    require_once get_template_directory() . '/includes/class-simple-footer-menu-walker.php';
    // Include customizer settings
    require_once get_template_directory() . '/includes/header-customizer.php';
    require_once get_template_directory() . '/includes/footer-customizer.php';
    require_once get_template_directory() . '/includes/login-customizer.php';
    require_once get_template_directory() . '/includes/dashboard-customizer.php';
    // Include Icon functions
    require_once get_template_directory() . '/includes/icons.php';
    // Load cards templates
    require_once get_template_directory() . '/template-parts/cards/highlight-card.php';
    require_once get_template_directory() . '/template-parts/cards/officials-card.php';
    require_once get_template_directory() . '/template-parts/sections/tab-nav.php';
    require_once get_template_directory() . '/template-parts/sections/pagination.php';
    require_once get_template_directory() . '/template-parts/sections/quick-access.php';
    require_once get_template_directory() . '/template-parts/sections/need-help.php';
    // Load components functionality
    require_once get_template_directory() . '/includes/breadcrumbs.php';
    require_once get_template_directory() . '/includes/breadcrumbs-template.php';
    require_once get_template_directory() . '/includes/page-banner.php';
    require get_theme_file_path( '/includes/functions/doc-filter.php' );
    require get_theme_file_path( '/includes/functions/carousel-function.php' );
    require get_theme_file_path( '/includes/functions/search-ep.php' );
    // Load custom post types
    require_once get_template_directory() . '/includes/post-types/services.php';
    require_once get_template_directory() . '/includes/post-types/departments.php';
    require_once get_template_directory() . '/includes/post-types/officials.php';
    require_once get_template_directory() . '/includes/post-types/news.php';
    require_once get_template_directory() . '/includes/post-types/events.php';
    require_once get_template_directory() . '/includes/post-types/announcements.php';
    require_once get_template_directory() . '/includes/post-types/documents.php';
    

}
add_action('after_setup_theme', 'theme_setup');

// Enqueue styles and scripts
function theme_assets() {
        // Ensure jQuery is loaded
    wp_enqueue_script('jquery');
    
    // Main CSS
    wp_enqueue_style(
        'theme-style',
        get_template_directory_uri() . '/assets/css/tailwind-output.css',
        [],
        filemtime(get_template_directory() . '/assets/css/tailwind-output.css')
    );
    
    // Load main JavaScript file
    wp_enqueue_script('pin-script', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
    
    wp_localize_script('pin-script', 'wpvars', array(
        'home' => home_url(),
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('search_nonce')
    ));

    // Main CSS
    wp_enqueue_style(
        'theme-style',
        get_template_directory_uri() . '/assets/css/tailwind-output.css',
        [],
        filemtime(get_template_directory() . '/assets/css/tailwind-output.css')
    );
    
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
/**
 * Disable the admin bar for users with roles lower than or equal to 'subscriber'.
 */
function disable_admin_bar_for_low_level_users() {
    if (is_user_logged_in()) {
        $user = wp_get_current_user();
        $allowed_roles = array('editor', 'administrator', 'author', 'contributor', 'shop_manager', 'custom_role');

        // Check if the user has none of the allowed roles
        if (!array_intersect($allowed_roles, $user->roles)) {
            add_filter('show_admin_bar', '__return_false');
        }
    }
}
add_action('after_setup_theme', 'disable_admin_bar_for_low_level_users');
add_action('wp_enqueue_scripts', 'theme_assets');
add_image_size( 'official-portrait', 600, 800, true ); // 3:4 ratio, hard crop
function custom_search_template($template) {
    if (is_search()) {
        // Check if our custom search results page exists
        $search_page = get_page_by_path('search');
        
        if ($search_page) {
            // Use our custom template if the search page exists
            return locate_template('search-results.php');
        }
    }
    return $template;
}

/**
 * Control Gutenberg editor for specific post types
 */
function custom_gutenberg_control($can_edit, $post_type) {
    // List of post types that should use Classic Editor
    $classic_editor_post_types = array(         
        'events',        
        'announcements', 
        'department',
        'document',    
        'official',
        'service'       
    );
    
    // Check if this post type should use Classic Editor
    if (in_array($post_type, $classic_editor_post_types)) {
        return false;
    }
    
    // Default to WordPress/Gutenberg's decision
    return $can_edit;
}
add_filter('use_block_editor_for_post_type', 'custom_gutenberg_control', 10, 2);

function remove_default_posts_menu() {
    remove_menu_page('edit.php');
}
add_action('admin_menu', 'remove_default_posts_menu');

// Only show admin bar for logged-in users with appropriate roles
function control_admin_bar_display() {
    if (!is_user_logged_in()) {
        return false; // Never show for non-logged-in users
    }
    
    $user = wp_get_current_user();
    $allowed_roles = array('editor', 'administrator', 'author', 'contributor');
    
    // Only show for users with allowed roles
    return array_intersect($allowed_roles, $user->roles) ? true : false;
}
add_filter('show_admin_bar', 'control_admin_bar_display');