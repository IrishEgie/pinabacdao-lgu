<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-white'); ?>>
    <header class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo on the left -->
                <div class="flex items-center">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center space-x-4 hover:opacity-80 transition-opacity">
                        <?php
                        $logo = get_theme_mod('header_logo');
                        $municipality_name = get_theme_mod('municipality_name', 'Municipality of Pinabacdao');
                        $province_name = get_theme_mod('province_name', 'Province of Samar, Philippines');
                        
                        if ($logo) : ?>
                            <img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="w-16 h-16 object-contain">
                        <?php else : ?>
                            <!-- Fallback logo if none is uploaded -->
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                                <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold text-lg">P</span>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <div class="hidden md:block">
                            <h1 class="text-lg font-bold text-gray-800 leading-tight">
                                <?php echo esc_html($municipality_name); ?>
                            </h1>
                            <p class="text-sm text-gray-600"><?php echo esc_html($province_name); ?></p>
                        </div>
                    </a>
                </div>

                <!-- Navigation and right-side elements -->
                <div class="flex items-center space-x-8">
                    <!-- Desktop Navigation -->
                    <nav class="hidden lg:flex items-center space-x-8">
                        <?php
                        wp_nav_menu([
                            'theme_location' => 'primary',
                            'container' => false,
                            'menu_class' => 'flex space-x-8',
                            'walker' => new Header_Nav_Walker(),
                            'fallback_cb' => false,
                            'depth' => 1
                        ]);
                        ?>
                    </nav>

                    <!-- Language and mobile toggle -->
                    <div class="flex items-center space-x-4">
                        <?php if (get_theme_mod('show_language_switcher', true)) : ?>
                            <div class="hidden md:flex items-center space-x-2">
                                <svg class="w-4 h-4 text-gray-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <path d="M2 12h20"></path>
                                    <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                </svg>
                                <select class="text-sm border-none bg-transparent focus:outline-none cursor-pointer">
                                    <option value="en">EN</option>
                                    <option value="fil">FIL</option>
                                </select>
                            </div>
                        <?php endif; ?>
                        
                        <button class="hover:bg-blue-50 transition-colors duration-300 p-2 rounded-md">
                            <svg class="w-5 h-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </button>
                        
                        <button id="mobile-menu-toggle" class="lg:hidden p-2 rounded-md hover:bg-gray-100">
                            <svg id="mobile-menu-open" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="3" y1="12" x2="21" y2="12"></line>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <line x1="3" y1="18" x2="21" y2="18"></line>
                            </svg>
                            <svg id="mobile-menu-close" class="w-6 h-6 hidden" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-gray-200">
                <div class="px-4 py-4 space-y-4">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'mobile',
                        'container' => false,
                        'menu_class' => 'space-y-4',
                        'walker' => new Mobile_Nav_Walker(),
                        'fallback_cb' => false,
                        'depth' => 1
                    ]);
                    ?>
                    
                    <?php if (get_theme_mod('show_language_switcher', true)) : ?>
                        <div class="flex items-center space-x-2 pt-4 border-t">
                            <svg class="w-4 h-4 text-gray-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M2 12h20"></path>
                                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                            </svg>
                            <select class="text-sm border-none bg-transparent focus:outline-none">
                                <option value="en">English</option>
                                <option value="fil">Filipino</option>
                            </select>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>
    
    <main>