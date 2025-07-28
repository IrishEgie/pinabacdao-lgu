<?php
/**
 * WordPress Dashboard Customizer
 * Applies custom colors from Pinabacdao LGU theme to the admin dashboard
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

function pbd_lgu_admin_color_scheme()
{
    // Get the theme directory URI
    $theme_uri = get_stylesheet_directory_uri();

    // Primary color shades (adjusted to be darker for admin menu)
    $primary_colors = [
        '50' => '#f0f9f4',
        '100' => '#d9f0e2',
        '200' => '#b7e1ca',
        '300' => '#88cbac',
        '400' => '#52ae89',
        '500' => '#28e060',
        '600' => '#2e7a56',
        '700' => '#1e4d38',  // Darkened
        '800' => '#153828',  // Darkened
        '900' => '#0f2a1f',  // Darkened
        '950' => '#081c13'   // Darkened
    ];

    // Secondary color shades
    $secondary_colors = [
        '500' => '#ffa300',
        '600' => '#7f6b55'
    ];

    // Admin color scheme CSS
    $css = "
    :root {
        --pbd-primary: {$primary_colors['500']};
        --pbd-primary-dark: {$primary_colors['600']};
        --pbd-primary-darker: {$primary_colors['700']};
        --pbd-primary-light: {$primary_colors['400']};
        --pbd-primary-lighter: {$primary_colors['200']};
        --pbd-secondary: {$secondary_colors['500']};
        --pbd-secondary-dark: {$secondary_colors['600']};
    }

    /* =============================================
       MAIN TEXT & LINK COLORS
       ============================================= */
    a,
    .wp-core-ui a,
    .wp-core-ui .button-link,
    .edit-post-sidebar a,
    .editor-post-publish-panel a,
    .components-panel__body a,
    .components-notice a,
    .edit-post-header a,
    .media-modal a,
    .media-frame a,
    .media-toolbar a,
    .attachment-details a,
    .media-sidebar a,
    #screen-meta-links a,
    .contextual-help-tabs a,
    .wrap .add-new-h2,
    .wrap .page-title-action,
    .plugin-install-php .upload-view-toggle a,
    .theme-install-php .upload-view-toggle a,
    .importer-title,
    .about-wrap .button-hero,
    .nav-tab-wrapper .nav-tab,
    .wp-filter .filter-links li > a,
    .media-frame .media-frame-menu a,
    .media-frame .media-frame-title h1 a,
    .media-frame .media-frame-router a,
    .media-frame .attachments-browser .attachments-info a,
    .postbox .handlediv,
    .postbox .hndle a,
    #dashboard_right_now a,
    #dashboard_activity a,
    .dashboard-widgets-wrap a,
    .welcome-panel-content a,
    .community-events li a,
    .wordpress-news a,
    .rssSummary a,
    #wp-version-message a,
    #footer-upgrade,
    .plugin-card a,
    .theme-browser .theme a,
    .widget-control-actions a,
    .widget-top a,
    .widget-inside a,
    .menu-item-handle a,
    .menu-item-settings a,
    .wp-list-table a,
    .tablenav-pages a,
    .subsubsub a,
    .row-actions a,
    .plugin-action-buttons a,
    .theme-actions a,
    .user-comment-shortcuts-wrap a,
    .comment-ays a,
    .feature-filter a,
    .install-theme-info a,
    .theme-overlay a,
    .theme-browser .theme.add-new-theme a:focus,
    .theme-browser .theme.add-new-theme a:hover,
    .theme-section.current a,
    .theme-browser .theme.active a,
    .theme-browser .theme.active .theme-actions a,
    .theme-browser .theme.active .theme-name a,
    .theme-browser .theme.active .theme-version a,
    .theme-browser .theme.active .theme-description a,
    .theme-browser .theme.active .theme-author a,
    .theme-browser .theme.active .theme-tags a,
    .theme-browser .theme.active .theme-actions .button-primary,
    .theme-browser .theme.active .theme-actions .button-secondary,
    .theme-browser .theme.active .theme-actions .button-link,
    .theme-browser .theme.active .theme-actions .button {
        color: {$primary_colors['600']};
    }
#adminmenu .wp-submenu a:hover,
#adminmenu .wp-submenu a:focus,
#adminmenu .wp-submenu li.current a:hover,
#adminmenu .wp-submenu li.current a:focus,
#adminmenu .wp-submenu li.current a:active,
#adminmenu .wp-has-current-submenu .wp-submenu a:hover,
#adminmenu .wp-has-current-submenu .wp-submenu a:focus,
#adminmenu .wp-not-current-submenu .wp-submenu a:hover,
#adminmenu .wp-not-current-submenu .wp-submenu a:focus,
#adminmenu a.wp-has-current-submenu:focus + .wp-submenu a:hover,
#adminmenu .wp-submenu li a:focus,
#adminmenu .wp-submenu li a:hover {
    color: #fff !important;
    background-color: {$primary_colors['700']} !important;
}

/* For folded (collapsed) menu hover states */
.folded #adminmenu .wp-submenu a:hover,
.folded #adminmenu .wp-submenu a:focus {
    color: #fff !important;
    background-color: {$primary_colors['700']} !important;
}
    a:hover,
    a:focus,
    a:active,
    .wp-core-ui a:hover,
    .wp-core-ui a:focus,
    .wp-core-ui .button-link:hover,
    .wp-core-ui .button-link:focus {
        color: {$primary_colors['500']};
    }

    /* =============================================
       BUTTON STYLES (Remove all blue buttons)
       ============================================= */
    .wp-core-ui .button,
    .wp-core-ui .button-secondary {
        color: {$primary_colors['800']};
        border-color: {$primary_colors['300']};
        background: #f6f6f6;
    }

    .wp-core-ui .button:hover,
    .wp-core-ui .button:focus,
    .wp-core-ui .button-secondary:hover,
    .wp-core-ui .button-secondary:focus {
        color: {$primary_colors['900']};
        border-color: {$primary_colors['400']};
        background: #eee;
    }

    .wp-core-ui .button-primary {
        background: {$primary_colors['600']};
        border-color: {$primary_colors['700']} {$primary_colors['800']} {$primary_colors['800']};
        color: #fff;
        text-shadow: 0 -1px 1px {$primary_colors['800']}, 1px 0 1px {$primary_colors['800']}, 0 1px 1px {$primary_colors['800']}, -1px 0 1px {$primary_colors['800']};
        box-shadow: 0 1px 0 {$primary_colors['800']};
    }

    .wp-core-ui .button-primary:hover,
    .wp-core-ui .button-primary:focus {
        background: {$primary_colors['700']};
        border-color: {$primary_colors['800']};
        color: #fff;
    }

    .wp-core-ui .button-primary:active {
        background: {$primary_colors['800']};
        border-color: {$primary_colors['900']};
        box-shadow: inset 0 2px 0 {$primary_colors['900']};
    }

    .wp-core-ui .button-primary:disabled,
    .wp-core-ui .button-primary:disabled:hover,
    .wp-core-ui .button-primary.disabled,
    .wp-core-ui .button-primary.disabled:hover {
        background: {$primary_colors['400']} !important;
        border-color: {$primary_colors['500']} !important;
        color: #fff !important;
    }

    /* Gutenberg editor buttons */
    .editor-post-publish-button,
    .editor-post-publish-panel__toggle,
    .editor-post-publish-button__button {
        background: {$primary_colors['600']} !important;
        border-color: {$primary_colors['700']} !important;
    }

    .editor-post-publish-button:hover,
    .editor-post-publish-panel__toggle:hover,
    .editor-post-publish-button__button:hover {
        background: {$primary_colors['700']} !important;
        border-color: {$primary_colors['800']} !important;
    }

    /* =============================================
       ADMIN INTERFACE COLORS
       ============================================= */
    /* Main admin colors - Darkened significantly */
    #wpadminbar,
    #adminmenuback,
    #adminmenuwrap,
    #adminmenu,
    #adminmenu .wp-submenu,
    #wpadminbar .ab-submenu {
        background-color: {$primary_colors['900']};
    }

    #adminmenu .wp-has-current-submenu .wp-submenu,
    #adminmenu .wp-has-current-submenu .wp-submenu.sub-open,
    #adminmenu .wp-has-current-submenu.opensub .wp-submenu,
    #adminmenu a.wp-has-current-submenu:focus + .wp-submenu,
    .folded #adminmenu .wp-has-current-submenu .wp-submenu {
        background-color: {$primary_colors['950']};
    }

    /* Admin menu items */
    #adminmenu div.wp-menu-image:before,
    #adminmenu a.menu-top,
    #adminmenu .wp-submenu a,
    #collapse-menu,
    #collapse-button div:after,
    #adminmenu li.current a.menu-top,
    #adminmenu li.wp-has-current-submenu a.wp-has-current-submenu {
        color: rgba(255, 255, 255, 0.9);
    }

    #adminmenu .awaiting-mod,
    #adminmenu .update-plugins {
        background-color: {$secondary_colors['500']};
        color: #000;
    }

    /* Hover states - Darkened */
    #adminmenu a.menu-top:hover,
    #adminmenu li.menu-top:hover,
    #adminmenu li.opensub > a.menu-top,
    #adminmenu li > a.menu-top:focus,
    #adminmenu li a:focus div.wp-menu-image:before,
    #adminmenu li.opensub div.wp-menu-image:before,
    #adminmenu li:hover div.wp-menu-image:before {
        color: #fff;
        background-color: {$primary_colors['800']};
    }

    /* Current menu item - Darkened */
    #adminmenu li.current a.menu-top,
    #adminmenu li.wp-has-current-submenu a.wp-has-current-submenu,
    #adminmenu li.wp-has-current-submenu .wp-submenu .wp-submenu-head,
    #adminmenu .wp-submenu li.current a,
    #adminmenu .wp-submenu li.current a:hover,
    #adminmenu .wp-submenu li.current a:focus {
        color: #fff;
        background-color: {$primary_colors['700']};
    }

    /* Admin bar - Darkened */
    #wpadminbar {
        background-color: {$primary_colors['950']} !important;
    }
    #wpadminbar .ab-item,
    #wpadminbar a.ab-item,
    #wpadminbar > #wp-toolbar span.ab-label,
    #wpadminbar > #wp-toolbar span.noticon,
    #wpadminbar .ab-icon,
    #wpadminbar .ab-icon:before,
    #wpadminbar .ab-item:before {
        color: rgba(255, 255, 255, 0.9);
    }
    #wpadminbar .ab-item:hover,
    #wpadminbar .ab-item:focus,
    #wpadminbar .ab-item:focus:before,
    #wpadminbar .ab-top-menu > li:hover > .ab-item,
    #wpadminbar.nojq .quicklinks .ab-top-menu > li > .ab-item:focus,
    #wpadminbar .ab-top-menu > li > .ab-item:focus,
    #wpadminbar .ab-top-menu > li.hover > .ab-item,
    #wpadminbar li:hover .ab-icon:before,
    #wpadminbar li:hover .ab-item:before,
    #wpadminbar li a:focus .ab-icon:before,
    #wpadminbar li .ab-item:focus:before,
    #wpadminbar li .ab-item:hover:before,
    #wpadminbar li.hover .ab-icon:before,
    #wpadminbar.nojs .ab-top-menu > li.menupop:hover > .ab-item,
    #wpadminbar .menupop .ab-sub-wrapper {
        color: #fff;
        background-color: {$primary_colors['800']};
    }

    /* Post state and notices */
    .post-state,
    .display-post-state {
        color: {$primary_colors['600']};
    }
    .notice,
    div.updated {
        border-left-color: {$primary_colors['500']};
    }
    div.error {
        border-left-color: #dc3232;
    }

    /* Media uploader */
    .media-modal {
        z-index: 999999;
    }
    .media-modal .media-frame-title,
    .media-modal .media-frame-router,
    .media-modal .media-frame-content,
    .media-modal .media-frame-toolbar,
    .media-modal .media-frame {
        background: #fff;
    }
    .media-modal .media-frame-title {
        border-bottom: 1px solid #ddd;
    }
    .media-modal .media-frame-router a.media-menu-item.active {
        border-bottom-color: {$primary_colors['500']};
    }

    /* Custom admin bar logo */
    #wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
        background-image: url('{$theme_uri}/assets/images/logo-icon.png');
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        color: rgba(0, 0, 0, 0);
    }
    #wpadminbar #wp-admin-bar-wp-logo > .ab-item {
        padding-left: 5px;
        padding-right: 5px;
    }
    #wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon {
        width: 20px;
        height: 20px;
        margin-right: 0;
    }

    /* Dashboard widgets */
    .postbox .hndle {
        border-bottom: 1px solid #eee;
        background-color: {$primary_colors['50']};
    }

    /* Custom welcome panel */
    .welcome-panel {
        border-color: {$primary_colors['200']};
    }
    .welcome-panel:before {
        background: {$primary_colors['50']};
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    ::-webkit-scrollbar-thumb {
        background: {$primary_colors['400']};
    }
    ::-webkit-scrollbar-thumb:hover {
        background: {$primary_colors['500']};
    }

    /* =============================================
       FORM ELEMENTS
       ============================================= */
    input[type='checkbox']:checked,
    input[type='color']:focus,
    input[type='date']:focus,
    input[type='datetime-local']:focus,
    input[type='datetime']:focus,
    input[type='email']:focus,
    input[type='month']:focus,
    input[type='number']:focus,
    input[type='password']:focus,
    input[type='radio']:checked,
    input[type='search']:focus,
    input[type='tel']:focus,
    input[type='text']:focus,
    input[type='time']:focus,
    input[type='url']:focus,
    input[type='week']:focus,
    select:focus,
    textarea:focus {
        border-color: {$primary_colors['500']};
        box-shadow: 0 0 0 1px {$primary_colors['500']};
    }

    /* =============================================
       MISCELLANEOUS BLUE ELEMENTS
       ============================================= */
    /* Calendar */
    #wp-calendar #today {
        background: {$primary_colors['100']};
        color: {$primary_colors['800']};
    }

    /* Media library selected items */
    .media-frame .attachments-browser .attachments .attachment.selected .attachment-preview:after {
        box-shadow: inset 0 0 0 3px {$primary_colors['500']}, inset 0 0 0 7px #fff;
    }

    /* Customizer */
    .customize-controls-close:hover,
    .customize-panel-back:hover {
        color: {$primary_colors['500']};
    }

    /* Thickbox */
    #TB_window .button-primary {
        background: {$primary_colors['600']} !important;
        border-color: {$primary_colors['700']} !important;
    }
    #TB_window .button-primary:hover {
        background: {$primary_colors['700']} !important;
    }
    ";

    // Minify CSS
    $css = preg_replace('/\s+/', ' ', $css);
    $css = preg_replace('/\/\*.*?\*\//', '', $css);
    $css = trim($css);

    wp_add_inline_style('wp-admin', $css);
}
add_action('admin_enqueue_scripts', 'pbd_lgu_admin_color_scheme');

/**
 * Add custom logo to admin bar
 */
function pbd_lgu_admin_bar_logo()
{
    global $wp_admin_bar;

    // Remove default WordPress logo
    $wp_admin_bar->remove_node('wp-logo');

    // Add custom logo
    $wp_admin_bar->add_node(array(
        'id' => 'pbd-logo',
        'title' => '<span class="ab-icon"></span>',
        'href' => home_url(),
        'meta' => array(
            'title' => get_bloginfo('name'),
        )
    ));
}
add_action('admin_bar_menu', 'pbd_lgu_admin_bar_logo', 1);

/**
 * Custom admin footer text
 */
function pbd_lgu_admin_footer_text()
{
    return sprintf(
        __('Thank you for creating with <a href="%s">%s</a>.', 'pinabacdao-lgu'),
        'https://wordpress.org/',
        'WordPress'
    );
}
add_filter('admin_footer_text', 'pbd_lgu_admin_footer_text');

/**
 * Custom dashboard styles
 */
function pbd_lgu_dashboard_styles()
{
    $primary_500 = '#28e060';
    $primary_600 = '#2e7a56';
    $primary_900 = '#0f2a1f';

    echo '<style>
        /* Dashboard widgets */
        .dashboard-widgets-wrap #dashboard_right_now a:before,
        .dashboard-widgets-wrap #dashboard_activity .activity-block > ul li:before {
            color: ' . esc_attr($primary_500) . ';
        }
        
        /* Quick draft */
        #quick-press .submit input {
            background: ' . esc_attr($primary_600) . ';
            border-color: ' . esc_attr($primary_900) . ';
            color: #fff;
        }
        
        /* At a glance */
        #dashboard_right_now .post-count,
        #dashboard_right_now .comment-count,
        #dashboard_right_now a {
            color: ' . esc_attr($primary_600) . ';
        }
        
        /* Welcome panel links */
        .welcome-panel-content .welcome-panel-column-container a {
            color: ' . esc_attr($primary_600) . ';
        }
        .welcome-panel-content .welcome-panel-column-container a:hover {
            color: ' . esc_attr($primary_500) . ';
        }
        
        /* Screen options and help tabs */
        .screen-meta-toggle a {
            color: ' . esc_attr($primary_600) . ';
        }
        .screen-meta-toggle a:hover {
            color: ' . esc_attr($primary_500) . ';
        }
    </style>';
}
add_action('admin_head-index.php', 'pbd_lgu_dashboard_styles');