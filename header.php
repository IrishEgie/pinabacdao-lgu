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
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Chevron rotation animation (matches React version) */
        .chevron-down {
            transition: transform 0.2s ease;
        }

        .group:hover .chevron-down {
            transform: rotate(180deg);
        }

        /* Dropdown menu animation (fade + slide) */
        .dropdown-menu {
            opacity: 0;
            visibility: hidden;
            transform: translateY(-5px);
            transition:
                opacity 0.2s ease,
                transform 0.2s ease,
                visibility 0.2s;
        }

        .group:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        /* Active link underline animation */
        .nav-link-underline {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 2px;
            background-color: #28e060; /* blue-500 */
            /* blue-500 */
            transition: width 0.3s ease;
        }

        .group:hover .nav-link-underline {
            width: 100%;
        }
    </style>
</head>

<body <?php body_class('bg-white'); ?>>
    <header class="bg-white shadow-lg sticky top-0 z-50"
        style="background-color: <?php echo get_theme_mod('header_bg_color', '#ffffff'); ?>">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo and Municipality Name -->
                <a href="<?php echo esc_url(home_url('/')); ?>"
                    class="flex items-center space-x-4 hover:opacity-80 transition-opacity">
                    <?php
                    $logo = get_theme_mod('header_logo');
                    if ($logo): ?>
                        <img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>"
                            class="w-16 h-16 object-contain">
                    <?php else: ?>
                        <!-- Fallback logo -->
                        <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center">
                            <div class="w-12 h-12 bg-primary-600 rounded-full flex items-center justify-center">
                                <span class="text-white font-bold text-lg">P</span>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="hidden md:block">
                        <h1 class="text-lg font-bold text-gray-800 leading-tight">
                            <?php echo esc_html(get_theme_mod('municipality_name', 'Municipality of Pinabacdao')); ?>
                        </h1>
                        <p class="text-sm text-gray-600">
                            <?php echo esc_html(get_theme_mod('province_name', 'Province of Samar, Philippines')); ?>
                        </p>
                    </div>
                </a>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex">
                    <ul class="flex space-x-1">
                        <?php
                        wp_nav_menu([
                            'theme_location' => 'primary',
                            'container' => false,
                            'items_wrap' => '%3$s',
                            'walker' => new Header_Nav_Walker(),
                            'fallback_cb' => false,
                            'depth' => 2
                        ]);
                        ?>
                    </ul>
                </nav>

                <!-- Language Switch and Search -->
                <div class="flex items-center space-x-4">
                    <?php if (get_theme_mod('show_language_switcher', true)): ?>
                        <div class="hidden md:flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M2 12h20"></path>
                                <path
                                    d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                </path>
                            </svg>
                            <select class="text-sm border-none bg-transparent focus:outline-none cursor-pointer">
                                <option value="en">EN</option>
                                <option value="fil">FIL</option>
                            </select>
                        </div>
                    <?php endif; ?>

                    <a href="<?php echo esc_url(home_url('/search')); ?>"
                        class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-primary-50 transition-colors duration-300 h-9 px-3">
                        <svg class="w-5 h-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </a>

                    <!-- Mobile menu button -->
                    <button id="mobile-menu-button"
                        class="lg:hidden p-2 rounded-md hover:bg-primary-50 transition-colors duration-300">
                        <svg id="mobile-menu-icon" class="w-6 h-6 text-gray-600" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                        <svg id="mobile-close-icon" class="w-6 h-6 text-gray-600 hidden"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="lg:hidden bg-white border-t border-gray-200 hidden animate-fade-in">
            <div class="px-4 py-4 space-y-4">
                <?php
                wp_nav_menu([
                    'theme_location' => 'mobile',
                    'container' => false,
                    'menu_class' => 'space-y-2',
                    'walker' => new Mobile_Nav_Walker(),
                    'fallback_cb' => false,
                    'depth' => 2
                ]);
                ?>

                <?php if (get_theme_mod('show_language_switcher', true)): ?>
                    <div class="flex items-center space-x-2 pt-4 border-t">
                        <svg class="w-4 h-4 text-gray-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M2 12h20"></path>
                            <path
                                d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                            </path>
                        </svg>
                        <select class="text-sm border-none bg-transparent focus:outline-none">
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
            document.addEventListener('DOMContentLoaded', function () {
                const mobileMenu = document.getElementById('mobile-menu');
                const mobileMenuButton = document.getElementById('mobile-menu-button');
                const menuIcon = document.getElementById('mobile-menu-icon');
                const closeIcon = document.getElementById('mobile-close-icon');

                let isMobileMenuOpen = false;

                // Toggle mobile menu
                mobileMenuButton.addEventListener('click', function () {
                    isMobileMenuOpen = !isMobileMenuOpen;

                    if (isMobileMenuOpen) {
                        mobileMenu.classList.remove('hidden');
                        menuIcon.classList.add('hidden');
                        closeIcon.classList.remove('hidden');
                    } else {
                        mobileMenu.classList.add('hidden');
                        menuIcon.classList.remove('hidden');
                        closeIcon.classList.add('hidden');
                    }
                });

                // Close menu when clicking on links
                const mobileLinks = mobileMenu.querySelectorAll('a');
                mobileLinks.forEach(link => {
                    link.addEventListener('click', () => {
                        mobileMenu.classList.add('hidden');
                        menuIcon.classList.remove('hidden');
                        closeIcon.classList.add('hidden');
                        isMobileMenuOpen = false;
                    });
                });

                // Handle dropdown menus on desktop
                const navItems = document.querySelectorAll('.nav-item');
                navItems.forEach(item => {
                    const link = item.querySelector('a');
                    const dropdown = item.querySelector('.dropdown-menu');

                    if (dropdown) {
                        // Show dropdown on hover
                        item.addEventListener('mouseenter', () => {
                            dropdown.classList.add('show');
                        });

                        item.addEventListener('mouseleave', () => {
                            dropdown.classList.remove('show');
                        });

                        // Keep dropdown open when hovering over it
                        dropdown.addEventListener('mouseenter', () => {
                            dropdown.classList.add('show');
                        });

                        dropdown.addEventListener('mouseleave', () => {
                            dropdown.classList.remove('show');
                        });
                    }
                });
            });
        </script>