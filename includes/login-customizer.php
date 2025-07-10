<?php 

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