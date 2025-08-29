<footer class="border-t border-gray-200 bg-secondary-bg text-black">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- MAIN FOOTER CONTENT SECTION -->
        <div class="flex flex-col items-stretch py-8 gap-6 sm:flex-row sm:justify-between sm:items-start sm:gap-4">

            <!-- LOGO SECTION -->
            <div class="flex flex-col items-start"> <!-- Added container -->
                <div class="w-[150px] max-w-full flex-shrink-0">
                    <?php
                    $footer_logo = get_theme_mod('footer_logo_primary');
                    if ($footer_logo) {
                        echo '<a href="https://www.gov.ph/the-govph/" target="_blank" rel="noopener noreferrer">';
                        echo '<img src="' . esc_url($footer_logo) . '" 
             alt="' . esc_attr(get_theme_mod('footer_municipality_name', 'Republic Seal')) . '"
             class="w-full h-auto object-contain">';
                        echo '</a>';
                    } else {
                        echo '<div class="w-full aspect-square bg-gray-200 flex items-center justify-center rounded-sm">
        <span class="text-xs text-gray-500">Seal</span>
      </div>';
                    }
                    ?>
                </div>
                <!-- Add these new lines -->
                <div class="mt-4">
                    <h2 class="text-lg font-bold">
                        <?php echo esc_html(get_theme_mod('footer_municipality_name', 'Municipality of Pinabacdao')); ?>
                    </h2>
                    <p class="text-sm">
                        <?php echo esc_html(get_theme_mod('footer_municipality_subtitle', 'Province of Samar, Philippines')); ?>
                    </p>
                </div>
            </div>

            <!-- NAVIGATION LINKS SECTION - Changed to items-start -->
            <div class="grid grid-cols-2 gap-4 sm:flex sm:flex-row sm:gap-8 sm:items-start">
                <?php for ($i = 1; $i <= 4; $i++): ?>
                    <div class="text-left"> <!-- Added text-left -->
                        <?php
                        $menu_title = get_theme_mod(
                            'footer_menu_' . $i . '_title',
                            $i == 1 ? 'Site Map' :
                            ($i == 2 ? 'Archive' :
                                ($i == 3 ? 'Transparency' : 'Legal'))
                        );
                        ?>

                        <!-- Menu Title -->
                        <h3 class="text-sm font-bold text-primary-text mb-2"> <!-- Added mb-2 -->
                            <?php echo esc_html($menu_title); ?>
                        </h3>

                        <?php
                        if (has_nav_menu('footer_menu_' . $i)) {
                            wp_nav_menu([
                                'theme_location' => 'footer_menu_' . $i,
                                'menu_class' => 'mt-2 space-y-1 text-left', // Added text-left
                                'container' => false,
                                'depth' => 1,
                                'walker' => new Simple_Footer_Menu_Walker()
                            ]);
                        }
                        ?>
                    </div>
                <?php endfor; ?>
            </div>
        </div>

        <!-- CONTACT AND SOCIAL MEDIA SECTION -->
        <div class="py-6 border-t border-gray-200 grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-4">
            <!-- CONTACT INFORMATION COLUMN -->
            <div class="text-left">
                <h3 class="text-sm font-bold text-primary-text mb-2">Contact Us</h3>
                <ul class="space-y-1 text-sm">
                    <?php if ($address = get_theme_mod('footer_address')): ?>
                        <li class="flex items-start">
                            <i class="icon-map-pin mt-0.5"></i>
                            <span><?php echo esc_html($address); ?></span>
                        </li>
                    <?php endif; ?>

                    <?php if ($phone = get_theme_mod('footer_phone')): ?>
                        <li class="flex items-center">
                            <i class="icon-phone"></i>
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>"
                                class="hover:text-primary transition-colors">
                                <?php echo esc_html($phone); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if ($email = get_theme_mod('footer_email')): ?>
                        <li class="flex items-center">
                            <i class="icon-mail"></i>
                            <a href="mailto:<?php echo esc_attr($email); ?>" class="hover:text-primary transition-colors">
                                <?php echo esc_html($email); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Social Media - LEFT ALIGNED ON MOBILE, CENTER ON DESKTOP -->
            <div class="text-left md:text-center">
                <h3 class="text-sm font-bold text-primary-text mb-2">Follow Us</h3>
                <div class="flex justify-start md:justify-center gap-4">
                    <?php
                    $socials = [
                        'facebook' => 'Facebook',
                        'twitter' => 'Twitter', 
                        'youtube' => 'YouTube',
                        'instagram' => 'Instagram'
                    ];
                    
                    foreach ($socials as $social => $name):
                        if ($url = get_theme_mod('footer_' . $social . '_url')):
                            ?>
                            <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer"
                                class="text-gray-600 hover:text-primary transition-colors text-lg"
                                aria-label="Follow us on <?php echo esc_attr($name); ?>">
                                <i class="<?php echo esc_attr(get_social_icon_class($social)); ?>"></i>
                                <span class="sr-only"><?php echo esc_html($name); ?></span>
                            </a>
                            <?php
                        endif;
                    endforeach;
                    ?>
                </div>
            </div>

            <!-- GOVERNMENT AGENCY LINKS COLUMN - LEFT ALIGNED ON MOBILE, RIGHT ON DESKTOP -->
            <div class="text-left md:text-right">
                <h3 class="text-sm font-bold text-primary-text mb-2">Government Links</h3>
                <div class="flex flex-wrap justify-start md:justify-end gap-4">
                    <?php
                    for ($i = 1; $i <= 3; $i++):
                        $agency_label = get_theme_mod('footer_agency_' . $i . '_label');
                        $agency_url = get_theme_mod('footer_agency_' . $i . '_url');
                        
                        if ($agency_label && $agency_url):
                            ?>
                            <a href="<?php echo esc_url($agency_url); ?>" target="_blank" rel="noopener noreferrer"
                                class="text-primary hover:underline">
                                <?php echo esc_html($agency_label); ?>
                            </a>
                            <?php
                        endif;
                    endfor;
                    ?>
                </div>
            </div>
        </div>
        <!-- COPYRIGHT SECTION -->
        <div class="py-4 border-t border-gray-200 text-center text-xs text-gray-500">
            <?php
            echo get_theme_mod(
                'footer_copyright_text',
                'Â© ' . date('Y') . ' ' . get_theme_mod('footer_municipality_name', 'Municipality') . '. All rights reserved.'
            );
            ?>
        </div>
    </div>
</footer>
</main> <!-- Close the main tag opened in header.php -->
<?php wp_footer(); ?> <!-- Move wp_footer() outside footer and after closing main -->