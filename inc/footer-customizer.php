<?php
function footer_customizer_settings($wp_customize) {
    // Footer Section
    $wp_customize->add_section('footer_settings', [
        'title' => __('Footer Settings', 'text_domain'),
        'priority' => 120,
    ]);

    // Municipality Info
    $wp_customize->add_setting('footer_municipality_name', [
        'default' => 'Municipality of Pinabacdao',
        'sanitize_callback' => 'sanitize_text_field'
    ]);
    $wp_customize->add_setting('footer_municipality_subtitle', [
        'default' => 'Province of Samar, Philippines',
        'sanitize_callback' => 'sanitize_text_field'
    ]);
    
    // Contact Info
    $wp_customize->add_setting('footer_address', [
        'default' => 'Municipal Hall, Pinabacdao, Samar',
        'sanitize_callback' => 'sanitize_text_field'
    ]);
    $wp_customize->add_setting('footer_phone', [
        'default' => '+63 (55) 123-4567',
        'sanitize_callback' => 'sanitize_text_field'
    ]);
    $wp_customize->add_setting('footer_email', [
        'default' => 'info@pinabacdao.gov.ph',
        'sanitize_callback' => 'sanitize_email'
    ]);

    // Logo Settings
    $wp_customize->add_setting('footer_logo_primary', [
        'sanitize_callback' => 'esc_url_raw'
    ]);
    $wp_customize->add_setting('footer_logo_secondary', [
        'sanitize_callback' => 'esc_url_raw'
    ]);

    // Social Media
    $socials = ['facebook', 'twitter', 'youtube', 'instagram'];
    foreach ($socials as $social) {
        $wp_customize->add_setting('footer_' . $social . '_url', [
            'sanitize_callback' => 'esc_url_raw'
        ]);
    }

    // Agency Links
    $agencies = ['dict', 'dilg', 'dbm'];
    foreach ($agencies as $agency) {
        $wp_customize->add_setting('footer_' . $agency . '_url', [
            'sanitize_callback' => 'esc_url_raw'
        ]);
    }

    // Copyright Text
    $wp_customize->add_setting('footer_copyright_text', [
        'default' => '© 2024 Municipality of Pinabacdao. All rights reserved.',
        'sanitize_callback' => 'sanitize_text_field'
    ]);

    // Footer Menu Titles
    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting('footer_menu_' . $i . '_title', [
            'default' => $i == 1 ? 'Site Map' : ($i == 2 ? 'Archive' : ($i == 3 ? 'Transparency' : 'Legal')),
            'sanitize_callback' => 'sanitize_text_field'
        ]);
    }

    // Add Controls
    $wp_customize->add_control('footer_municipality_name_control', [
        'label' => __('Municipality Name', 'text_domain'),
        'section' => 'footer_settings',
        'settings' => 'footer_municipality_name',
        'type' => 'text'
    ]);

    $wp_customize->add_control('footer_municipality_subtitle_control', [
        'label' => __('Municipality Subtitle', 'text_domain'),
        'section' => 'footer_settings',
        'settings' => 'footer_municipality_subtitle',
        'type' => 'text'
    ]);

    $wp_customize->add_control('footer_address_control', [
        'label' => __('Address', 'text_domain'),
        'section' => 'footer_settings',
        'settings' => 'footer_address',
        'type' => 'text'
    ]);

    $wp_customize->add_control('footer_phone_control', [
        'label' => __('Phone Number', 'text_domain'),
        'section' => 'footer_settings',
        'settings' => 'footer_phone',
        'type' => 'text'
    ]);

    $wp_customize->add_control('footer_email_control', [
        'label' => __('Email Address', 'text_domain'),
        'section' => 'footer_settings',
        'settings' => 'footer_email',
        'type' => 'email'
    ]);

    // Logo Controls
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer_logo_primary_control', [
        'label' => __('Primary Logo', 'text_domain'),
        'section' => 'footer_settings',
        'settings' => 'footer_logo_primary'
    ]));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer_logo_secondary_control', [
        'label' => __('Secondary Logo', 'text_domain'),
        'section' => 'footer_settings',
        'settings' => 'footer_logo_secondary'
    ]));

    // Social Media Controls
    foreach ($socials as $social) {
        $wp_customize->add_control('footer_' . $social . '_url_control', [
            'label' => ucfirst($social) . ' URL',
            'section' => 'footer_settings',
            'settings' => 'footer_' . $social . '_url',
            'type' => 'url'
        ]);
    }

    // Agency Link Controls
    foreach ($agencies as $agency) {
        $wp_customize->add_control('footer_' . $agency . '_url_control', [
            'label' => strtoupper($agency) . ' URL',
            'section' => 'footer_settings',
            'settings' => 'footer_' . $agency . '_url',
            'type' => 'url'
        ]);
    }

    // Copyright Text Control
    $wp_customize->add_control('footer_copyright_text_control', [
        'label' => __('Copyright Text', 'text_domain'),
        'section' => 'footer_settings',
        'settings' => 'footer_copyright_text',
        'type' => 'textarea'
    ]);

    // Footer Menu Title Controls
    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_control('footer_menu_' . $i . '_title_control', [
            'label' => __('Footer Menu ' . $i . ' Title', 'text_domain'),
            'section' => 'footer_settings',
            'settings' => 'footer_menu_' . $i . '_title',
            'type' => 'text'
        ]);
    }
}
add_action('customize_register', 'footer_customizer_settings');