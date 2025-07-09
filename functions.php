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
    require_once get_template_directory() . '/includes/class-header-nav-walker.php';
    require_once get_template_directory() . '/includes/class-mobile-nav-walker.php';
    require_once get_template_directory() . '/includes/class-simple-footer-menu-walker.php';
    // Include customizer settings
    require_once get_template_directory() . '/includes/header-customizer.php';
    require_once get_template_directory() . '/includes/footer-customizer.php';
    // Include Icon functions
    require_once get_template_directory() . '/includes/icons.php';
    // Load cards templates
    require_once get_template_directory() . '/template-parts/cards/highlight-card.php';
    require_once get_template_directory() . '/template-parts/cards/officials-card.php';
    // Load breadcrumbs functionality
    require_once get_template_directory() . '/includes/breadcrumbs.php';
    require_once get_template_directory() . '/includes/breadcrumbs-template.php';
    require_once get_template_directory() . '/includes/page-banner.php';
    // Load custom post types
    require_once get_template_directory() . '/includes/post-types/services.php';
    require_once get_template_directory() . '/includes/post-types/departments.php';
    require_once get_template_directory() . '/includes/post-types/officials.php';

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

// Change the login logo and styles
function my_custom_login_logo() {
    $logo_url = get_stylesheet_directory_uri() . '/assets/images/logo.png';
    
    ?>
    <style type="text/css">
        /* Logo styling */
        #login h1 a, .login h1 a {
            background-image: url(<?php echo esc_url($logo_url); ?>);
            height: 80px;
            width: 100%;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            padding-bottom: 30px;
        }
        
        /* Main colors */
        body.login {
            background-color: #f1f1f1;
        }
        
        /* Links */
        .login #backtoblog a, 
        .login #nav a,
        .login .message a {
            color: #2e7a56 !important;
        }
        
        .login #backtoblog a:hover, 
        .login #nav a:hover,
        .login .message a:hover {
            color: #1a5636 !important;
        }
        
        /* Buttons */
        .wp-core-ui .button-primary {
            background: #2e7a56 !important;
            border-color: #2e7a56 !important;
            box-shadow: none !important;
            text-shadow: none !important;
        }
        
        .wp-core-ui .button-primary:hover, 
        .wp-core-ui .button-primary:focus {
            background: #1a5636 !important;
            border-color: #1a5636 !important;
        }
        
        /* Input fields */
        input[type="checkbox"]:checked, 
        input[type="checkbox"]:focus,
        input[type="text"]:focus,
        input[type="password"]:focus,
        input[type="email"]:focus {
            border-color: #2e7a56 !important;
            box-shadow: 0 0 0 1px #2e7a56 !important;
        }
        
        /* Messages */
        .login .message {
            border-left: 4px solid #2e7a56 !important;
        }
        
        /* Login form box */
        .login form {
            box-shadow: 0 1px 3px rgba(46, 122, 86, 0.2);
        }
    </style>
    <?php
}
add_action('login_enqueue_scripts', 'my_custom_login_logo');

// Change the login logo URL to your site
function my_login_logo_url() {
    return home_url();
}
add_filter('login_headerurl', 'my_login_logo_url');

// Change the login logo URL title
function my_login_logo_url_title() {
    return get_bloginfo('name');
}
add_filter('login_headertext', 'my_login_logo_url_title');