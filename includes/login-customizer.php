<?php 

function my_custom_login_logo() {
    $logo_url = get_stylesheet_directory_uri() . '/assets/images/logo.png';
    echo '
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(' . $logo_url . ');
            height: 80px;
            width: 300px;
            background-size: contain;
            background-repeat: no-repeat;
            padding-bottom: 30px;
        }
    </style>
    ';
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