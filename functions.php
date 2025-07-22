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
    // Include Icon functions
    require_once get_template_directory() . '/includes/icons.php';
    // Load cards templates
    require_once get_template_directory() . '/template-parts/cards/highlight-card.php';
    require_once get_template_directory() . '/template-parts/cards/officials-card.php';
    require_once get_template_directory() . '/template-parts/sections/tab-nav.php';
    require_once get_template_directory() . '/template-parts/sections/pagination.php';
    // Load components functionality
    require_once get_template_directory() . '/includes/breadcrumbs.php';
    require_once get_template_directory() . '/includes/breadcrumbs-template.php';
    require_once get_template_directory() . '/includes/page-banner.php';
    require_once get_template_directory() . '/includes/carousel-function.php';
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
// Add this to your functions.php
function add_editor_styles() {
    add_editor_style('/assets/css/editor-style.css');
}
add_action('after_setup_theme', 'add_editor_styles');
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
add_filter('show_admin_bar', '__return_true');
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

// Keep your existing rewrite rules
function custom_search_url_rewrite() {
    if (is_search() && !empty($_GET['s'])) {
        wp_redirect(home_url('/search/') . urlencode(get_query_var('s')));
        exit();
    }
}
add_action('template_redirect', 'custom_search_url_rewrite');

function custom_search_rewrite_rule() {
    add_rewrite_rule('^search/([^/]*)/?', 'index.php?s=$matches[1]', 'top');
    add_rewrite_rule('^search/?', 'index.php?pagename=search', 'top');
}
add_action('init', 'custom_search_rewrite_rule');

// Flush rewrite rules on theme activation (only once)
function theme_activation() {
    custom_search_rewrite_rule();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'theme_activation');

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