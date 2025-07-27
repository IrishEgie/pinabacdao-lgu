<?php
/**
 * Page Banner Functionality
 * 
 * @package YourThemeName
 */

if (!function_exists('pageBanner')) {
    /**
     * Displays a customizable page banner
     * 
     * @param array $args {
     *     Optional. Array of arguments for the banner.
     *     
     *     @type string $title            The banner title. Default is current page title.
     *     @type string $subtitle         Subtitle text. Default empty.
     *     @type string $description      Description text. Default empty.
     *     @type string $background_image Background image URL. Default placeholder image.
     *     @type bool   $show_back_button Whether to show back button. Default false.
     *     @type string $action_text      Text for action button. Default empty.
     *     @type string $action_link      URL for action button. Default '#'.
     *     @type string $classes          Additional CSS classes. Default empty.
     *     @type string $type             Archive type (author/date/search/etc). Default empty.
     * }
     */
    function pageBanner($args = [])
    {
        // Default images with attribution
        $default_images = [
            'default' => [
                'url' => get_template_directory_uri() . '/assets/images/default-photo.avif',
                'credit' => 'Photo by Max Tcvetkov on Unsplash'
            ],
            'archive' => [
                'url' => 'https://images.unsplash.com/photo-1703114585390-cc095031ad84?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'credit' => 'Photo by Shino Nakamura on Unsplash'
            ],
            'author' => [
                'url' => 'https://images.unsplash.com/photo-1455390582262-044cdead277a?q=80&w=1073&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'credit' => 'Photo by Aaron Burden on Unsplash'
            ],
            'date' => [
                'url' => 'https://images.unsplash.com/photo-1597768164194-b804b42bd61a?q=80&w=1071&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'credit' => 'Photo by Zhuo Cheng you on Unsplash'
            ],
            'search' => [
                'url' => 'https://images.unsplash.com/photo-1516382799247-87df95d790b7?q=80&w=1474&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'credit' => 'Photo by Agence Olloweb on Unsplash'
            ],
            'news' => [
                'url' => 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'credit' => 'Photo by AboutVision on Unsplash'
            ],
        ];

        // Determine default image based on archive type
        $archive_type = $args['type'] ?? '';
        $default_image = $default_images[$archive_type] ?? $default_images['default'];
        
        // Default arguments
        $defaults = [
            'title' => get_the_title(),
            'subtitle' => get_field('page_banner_subtitle') ?: '',
            'description' => '',
            'background_image' => get_field('page_banner_background') ?: $default_image['url'],
            'show_back_button' => false,
            'action_text' => '',
            'action_link' => '#',
            'classes' => '',
            'type' => '',
            'show_credit' => true
        ];

        // Merge with provided args
        $args = wp_parse_args($args, $defaults);
        extract($args);
        ?>

        <div class="page-banner bg-gradient-to-r from-primary-600 to-primary-800 text-white py-16 bg-opacity-90 <?php echo esc_attr($classes); ?>"
            style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(<?php echo esc_url($background_image); ?>);
           background-size: cover;
           background-position: center;
           background-repeat: no-repeat;">

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <?php if ($show_back_button): ?>
                    <a href="javascript:history.back()"
                        class="back-button inline-flex items-center text-white hover:bg-white/10 mb-4 transition-colors duration-300 px-4 py-2 rounded">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                            </path>
                        </svg>
                        Back
                    </a>
                <?php endif; ?>

                <div class="banner-content flex flex-col md:flex-row md:items-center justify-between">
                    <div class="animate-fade-in">
                        <h1 class="title text-4xl md:text-5xl font-bold mb-4"><?php echo esc_html($title); ?></h1>
                        <?php if ($subtitle): ?>
                            <p class="subtitle text-primary-200 text-lg mb-2 font-medium"><?php echo esc_html($subtitle); ?></p>
                        <?php endif; ?>

                        <?php if ($description): ?>
                            <p class="description text-xl text-primary-100 max-w-3xl leading-relaxed">
                                <?php echo esc_html($description); ?>
                            </p>
                        <?php endif; ?>

                        <?php if ($show_credit && !get_field('page_banner_background') && isset($default_image['credit'])): ?>
                            <p class="image-credit text-xs text-white/60 mt-4">
                                <?php echo esc_html($default_image['credit']); ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <?php if ($action_text): ?>
                        <div class="action-button hidden md:block animate-fade-in">
                            <a href="<?php echo esc_url($action_link); ?>"
                                class="bg-white text-primary-600 px-6 py-2 rounded-md font-medium hover:bg-primary-50 transition-colors">
                                <?php echo esc_html($action_text); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
    }
}