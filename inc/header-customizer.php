<?php
function theme_header_customizer($wp_customize) {
    // Logo Section
    $wp_customize->add_section('header_settings', array(
        'title' => __('Header Settings', 'text_domain'),
        'priority' => 30,
    ));
    
    // Logo Upload
    $wp_customize->add_setting('header_logo', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'header_logo',
        array(
            'label' => __('Upload Logo', 'text_domain'),
            'section' => 'header_settings',
            'settings' => 'header_logo',
        )
    ));
    
    // Municipality Name
    $wp_customize->add_setting('municipality_name', array(
        'default' => 'Municipality of Pinabacdao',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('municipality_name', array(
        'label' => __('Municipality Name', 'text_domain'),
        'section' => 'header_settings',
        'type' => 'text',
    ));
    
    // Province Name
    $wp_customize->add_setting('province_name', array(
        'default' => 'Province of Samar, Philippines',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('province_name', array(
        'label' => __('Province Name', 'text_domain'),
        'section' => 'header_settings',
        'type' => 'text',
    ));
    
    // Language Switcher Option
    $wp_customize->add_setting('show_language_switcher', array(
        'default' => true,
        'sanitize_callback' => 'theme_sanitize_checkbox',
    ));
    
    $wp_customize->add_control('show_language_switcher', array(
        'label' => __('Show Language Switcher', 'text_domain'),
        'section' => 'header_settings',
        'type' => 'checkbox',
    ));

        // Add color settings
    $wp_customize->add_setting('header_bg_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'header_bg_color',
        array(
            'label' => __('Header Background Color', 'text_domain'),
            'section' => 'header_settings',
            'settings' => 'header_bg_color',
        )
    ));
    
    $wp_customize->add_setting('primary_color', array(
        'default' => '#40986c',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'primary_color',
        array(
            'label' => __('Primary Color', 'text_domain'),
            'section' => 'header_settings',
            'settings' => 'primary_color',
        )
    ));
    
    // Add more color controls as needed

}
add_action('customize_register', 'theme_header_customizer');

function theme_sanitize_checkbox($checked) {
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}