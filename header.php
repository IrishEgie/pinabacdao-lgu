<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <style>
        .animate-fade-in {
            animation: fadeIn 0.3s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body <?php body_class('bg-white'); ?>>
    <header class="bg-white shadow-lg sticky top-0 z-50 transition-all duration-300 ease-in-out" style="background-color: <?php echo get_theme_mod('header_bg_color', '#ffffff'); ?>">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 md:h-20">
                <!-- Logo and Municipality Name -->
                <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center space-x-2 md:space-x-4 group">
                    <?php
                    $logo = get_theme_mod('header_logo');
                    if ($logo) : ?>
                        <img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="w-10 h-10 md:w-16 md:h-16 object-contain transition-all duration-300 group-hover:scale-105">
                    <?php else : ?>
                        <!-- Fallback logo with animation -->
                        <div class="w-10 h-10 md:w-16 md:h-16 bg-blue-100 rounded-full flex items-center justify-center transition-all duration-500 group-hover:rotate-12">
                            <div class="w-8 h-8 md:w-12 md:h-12 bg-blue-600 rounded-full flex items-center justify-center transition-all duration-300 group-hover:bg-blue-700">
                                <span class="text-white font-bold text-sm md:text-lg transition-transform duration-300 group-hover:scale-110">P</span>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <div class="hidden sm:block transition-opacity duration-300 group-hover:opacity-90">
                        <h1 class="text-sm md:text-lg font-bold text-gray-800 leading-tight transition-colors duration-300 group-hover:text-gray-900">
                            <?php echo esc_html(get_theme_mod('municipality_name', 'Municipality of Pinabacdao')); ?>
                        </h1>
                        <p class="text-xs md:text-sm text-gray-600 transition-colors duration-300 group-hover:text-gray-700">
                            <?php echo esc_html(get_theme_mod('province_name', 'Province of Samar, Philippines')); ?>
                        </p>
                    </div>
                </a>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center space-x-8">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'primary',
                        'container' => false,
                        'items_wrap' => '%3$s',
                        'walker' => new Header_Nav_Walker(),
                        'fallback_cb' => false,
                        'depth' => 1
                    ]);
                    ?>
                </nav>

                <!-- Language Switch and Search -->
                <div class="flex items-center space-x-2 md:space-x-4">
                    <?php if (get_theme_mod('show_language_switcher', true)) : ?>
                        <div class="hidden md:flex items-center space-x-2 group">
                            <svg class="w-4 h-4 text-gray-600 transition-colors duration-300 group-hover:text-gray-900" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M2 12h20"></path>
                                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                            </svg>
                            <select class="text-sm border-none bg-transparent focus:outline-none cursor-pointer transition-all duration-300 hover:scale-105">
                                <option value="en">EN</option>
                                <option value="fil">FIL</option>
                            </select>
                        </div>
                    <?php endif; ?>
                    
                    <a href="<?php echo esc_url(home_url('/search')); ?>" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-all duration-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-9 px-2 md:px-3 hover:bg-blue-50 transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 text-gray-600 transition-colors duration-300 hover:text-gray-900" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </a>
                    
                    <!-- Mobile menu button with animated hamburger -->
                    <button id="mobile-menu-button" class="lg:hidden p-1 md:p-2 rounded-md hover:bg-blue-50 cursor-pointer group">
                        <div class="space-y-1.5">
                            <span id="mobile-menu-line1" class="block w-6 h-0.5 bg-gray-600 transition-all duration-300 group-hover:bg-gray-900"></span>
                            <span id="mobile-menu-line2" class="block w-6 h-0.5 bg-gray-600 transition-all duration-300 group-hover:bg-gray-900"></span>
                            <span id="mobile-menu-line3" class="block w-6 h-0.5 bg-gray-600 transition-all duration-300 group-hover:bg-gray-900"></span>
                        </div>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="lg:hidden bg-white border-t border-gray-200 hidden">
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
                    <div class="flex items-center space-x-2 pt-4 border-t border-gray-200">
                        <svg class="w-4 h-4 text-gray-600 transition-colors duration-300 hover:text-gray-900" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M2 12h20"></path>
                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                        </svg>
                        <select class="text-sm border-none bg-transparent focus:outline-none transition-all duration-300 hover:scale-105">
                            <option value="en">English</option>
                            <option value="fil">Filipino</option>
                        </select>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </header>
     
    <main>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const menuLines = [
            document.getElementById('mobile-menu-line1'),
            document.getElementById('mobile-menu-line2'),
            document.getElementById('mobile-menu-line3')
        ];
        
        let isMobileMenuOpen = false;
        let lastViewportState = getViewportState();
        
        // Initialize menu state based on initial viewport
        updateMenuForViewport();
        
        // Set up event listeners
        mobileMenuButton.addEventListener('click', toggleMobileMenu);
        
        // Use both resize and ResizeObserver for maximum compatibility
        window.addEventListener('resize', handleResize);
        const resizeObserver = new ResizeObserver(entries => {
            handleResize();
        });
        resizeObserver.observe(document.body);
        
        // Close menu when clicking on links
        const mobileLinks = mobileMenu.querySelectorAll('a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                isMobileMenuOpen = false;
                updateMenuState();
            });
        });
        
        function getViewportState() {
            return window.innerWidth >= 1024 ? 'desktop' : 'mobile';
        }
        
        function handleResize() {
            const currentViewportState = getViewportState();
            
            // Only proceed if viewport state actually changed
            if (currentViewportState !== lastViewportState) {
                lastViewportState = currentViewportState;
                updateMenuForViewport();
            }
        }
        
        function updateMenuForViewport() {
            const isDesktop = lastViewportState === 'desktop';
            
            if (isDesktop) {
                // Always close menu when in desktop view
                if (isMobileMenuOpen) {
                    isMobileMenuOpen = false;
                    updateMenuState();
                }
            }
        }
        
        function toggleMobileMenu() {
            isMobileMenuOpen = !isMobileMenuOpen;
            updateMenuState();
        }
        
        function updateMenuState() {
            // Update menu visibility
            if (isMobileMenuOpen) {
                mobileMenu.classList.remove('hidden');
                mobileMenu.classList.add('animate-fade-in');
            } else {
                mobileMenu.classList.add('hidden');
                mobileMenu.classList.remove('animate-fade-in');
            }
            
            // Update hamburger icon animation
            if (isMobileMenuOpen) {
                menuLines[0].classList.add('rotate-45', 'translate-y-1.5');
                menuLines[1].classList.add('opacity-0');
                menuLines[2].classList.add('-rotate-45', '-translate-y-1.5');
            } else {
                menuLines[0].classList.remove('rotate-45', 'translate-y-1.5');
                menuLines[1].classList.remove('opacity-0');
                menuLines[2].classList.remove('-rotate-45', '-translate-y-1.5');
            }
        }
        
        // Clean up on page unload
        window.addEventListener('beforeunload', () => {
            resizeObserver.disconnect();
            window.removeEventListener('resize', handleResize);
        });
    });
    </script>