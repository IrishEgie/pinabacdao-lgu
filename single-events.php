<?php
/**
 * Template Name: Single Event
 * Description: Custom template for single event posts
 */
require_once get_template_directory() . '/template-parts/cards/news-card.php';
get_header();
?>

<div class="min-h-screen bg-gray-50">
    <!-- Dynamic Page Banner -->
    <?php pageBanner(); ?>

    <!-- Dynamic Breadcrumbs -->
    <?php the_breadcrumbs(); ?>

    <main class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Main Content Area -->
                <div class="flex-1 space-y-8">
                    <?php while (have_posts()):
                        the_post();
                        $start_date = get_field('event_datetime_start');
                        $end_date = get_field('event_datetime_end');
                        $location = get_field('event_location');
                        $organizer = get_field('event_organizer_name');
                        $attendees = get_field('event_expected_attendees');
                        ?>

<div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-600">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2"><?php the_title(); ?></h1>

            <!-- Event Meta -->
            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                <?php if ($start_date): ?>
                    <div class="flex items-center gap-2">
                        <?php echo get_service_icon_svg('calendar', 'text-green-600 w-4 h-4') ?>
                        <span>
                            <?php echo date_i18n('F j, Y g:i a', strtotime($start_date)); ?>
                            <?php if ($end_date && $end_date !== $start_date): ?>
                                - <?php echo date_i18n('F j, Y g:i a', strtotime($end_date)); ?>
                            <?php endif; ?>
                        </span>
                    </div>
                <?php endif; ?>

                <?php if ($location && isset($location['address'])): ?>
                    <div class="flex items-center gap-2">
                        <?php echo get_service_icon_svg('location', 'text-green-600 w-4 h-4') ?>
                        <span><?php echo esc_html($location['address']); ?></span>
                    </div>
                <?php endif; ?>

                <?php if ($organizer): ?>
                    <div class="flex items-center gap-2">
                        <?php echo get_service_icon_svg('user', 'text-green-600 w-4 h-4') ?>
                        <span><?php echo esc_html($organizer); ?></span>
                    </div>
                <?php endif; ?>

                <?php if ($attendees): ?>
                    <div class="flex items-center gap-2">
                        <?php echo get_service_icon_svg('users', 'text-green-600 w-4 h-4') ?>
                        <span><?php echo sprintf(_n('%d attendee', '%d attendees', $attendees, 'textdomain'), $attendees); ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Share Button -->
        <div class="flex space-x-2">
            <div
                class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border border-input bg-white hover:shadow-md hover:text-primary-500 h-9 rounded-md px-3">
                <?php echo get_service_icon_svg('share', 'w-6 h-6 text-primary-500'); ?>
                <?php echo do_shortcode('[addtoany]'); ?>
            </div>
        </div>
    </div>
</div>


                        <!-- Event Highlights -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <?php
                            echo highlight_card([
                                'icon' => get_service_icon_svg('clock', 'text-green-600 w-8 h-8'),
                                'title' => 'Event Schedule',
                                'content' => 'Detailed schedule will be provided upon registration. The event includes keynote speeches, workshops, and networking sessions.',
                                'additional_classes' => 'border-l-4 border-green-600'
                            ]);

                            echo highlight_card([
                                'icon' => get_service_icon_svg('map', 'text-green-600 w-8 h-8'),
                                'title' => 'Venue Information',
                                'content' => $location && isset($location['address']) ? esc_html($location['address']) : 'Venue details will be shared with registered attendees.',
                                'additional_classes' => 'border-l-4 border-green-600'
                            ]);
                            ?>
                        </div>

                        <!-- Featured Image -->
                        <?php if (has_post_thumbnail()): ?>
                            <div class="rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                                <?php the_post_thumbnail('large', ['class' => 'w-full h-auto max-h-96 object-cover']); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Event Description -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">About This Event</h2>
                            <div class="prose max-w-none text-gray-700">
                                <?php the_content(); ?>
                            </div>
                        </div>

                        <!-- Registration Form Section -->
                        <div id="register"
                            class="bg-gradient-to-br from-green-50 to-white rounded-xl shadow-lg overflow-hidden border border-green-100">
                            <div class="p-8">
                                <h2 class="text-3xl font-bold text-gray-900 mb-2 text-center">Register for This Event</h2>
                                <p class="text-green-600 text-center mb-6">Secure your spot today</p>

                                <?php
                                $iframe_code = get_field('event_registration');
                                if ($iframe_code):
                                    $allowed_html = [
                                        'iframe' => [
                                            'src' => [],
                                            'width' => [],
                                            'height' => [],
                                            'frameborder' => [],
                                            'marginheight' => [],
                                            'marginwidth' => [],
                                            'loading' => [],
                                            'sandbox' => [],
                                            'allow' => [],
                                            'title' => [],
                                            'class' => [],
                                            'style' => [],
                                            'data-*' => []
                                        ]
                                    ];
                                    ?>
                                    <div
                                        class="registration-form-container bg-white rounded-lg shadow-inner overflow-hidden border border-gray-200">
                                        <?php echo wp_kses($iframe_code, $allowed_html); ?>
                                    </div>
                                <?php else: ?>
                                    <div class="text-center py-12">
                                        <div class="flex items-center justify-center">
                                            <?php echo get_service_icon_svg('clipboard', 'text-gray-400 w-12 h-12 text-center') ?>
                                        </div>

                                        <h3 class="mt-4 text-lg font-medium text-gray-700">Registration Coming Soon</h3>
                                        <p class="mt-2 text-gray-500">We're preparing the registration form. Please check back
                                            later.</p>
                                        <div class="mt-6 animate-pulse">
                                            <div class="h-12 bg-gray-100 rounded-lg w-1/2 mx-auto"></div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <?php if ($iframe_code): ?>
                                <div class="bg-gray-50 px-8 py-4 border-t border-gray-200 text-center">
                                    <p class="text-xs text-gray-500 flex items-center justify-center space-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                        <span>Secure form powered by Google</span>
                                    </p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!-- Similar Events -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6">More Events You Might Like</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                <?php
                                $similar_events = get_posts([
                                    'post_type' => 'events',
                                    'posts_per_page' => 3,
                                    'post__not_in' => [get_the_ID()],
                                    'orderby' => 'rand',
                                    'meta_query' => [
                                        [
                                            'key' => 'event_datetime_start',
                                            'value' => date('Y-m-d H:i:s'),
                                            'compare' => '>=',
                                            'type' => 'DATETIME'
                                        ]
                                    ]
                                ]);

                                if ($similar_events):
                                    foreach ($similar_events as $post):
                                        setup_postdata($post);
                                        render_post_card(get_post_card_args($post->ID));
                                    endforeach;
                                    wp_reset_postdata();
                                else:
                                    echo '<p class="text-gray-500 col-span-3">No upcoming events found. Check back later!</p>';
                                endif;
                                ?>
                            </div>
                        </div>

                    <?php endwhile; ?>
                </div>

                <!-- Sidebar -->
                <div class="w-full lg:w-80 xl:w-80">
                    <aside class="space-y-6 sticky top-8">
                        <?php
                        // Event Quick Info
                        get_template_part('template-parts/sections/sidebar-dynamic', null, [
                            'title' => 'Event Quick Info',
                            'subtitle' => 'Everything you need to know',
                            'content' => [
                                [
                                    'type' => 'text',
                                    'title' => 'Date & Time',
                                    'content' => $start_date ? date_i18n('F j, Y g:i a', strtotime($start_date)) . ($end_date ? ' - ' . date_i18n('F j, Y g:i a', strtotime($end_date)) : '') : 'TBD',
                                    'icon' => 'clock'
                                ],
                                [
                                    'type' => 'text',
                                    'title' => 'Location',
                                    'content' => $location && isset($location['address']) ? $location['address'] : 'TBD',
                                    'icon' => 'location'
                                ],
                                [
                                    'type' => 'text',
                                    'title' => 'Organizer',
                                    'content' => $organizer ?: 'TBD',
                                    'icon' => 'user-check'
                                ],
                                [
                                    'type' => 'text',
                                    'title' => 'Expected Attendees',
                                    'content' => $attendees ? sprintf(_n('%d person', '%d people', $attendees, 'textdomain'), $attendees) : 'TBD',
                                    'icon' => 'users'
                                ]
                            ],
                            'container_class' => 'bg-white rounded-lg shadow-md p-6 border-l-4 border-green-600'
                        ]);

                        // Latest News (different from news page)
                        $latest_news = get_posts([
                            'post_type' => 'news',
                            'posts_per_page' => 4,
                            'orderby' => 'date',
                            'order' => 'DESC'
                        ]);

                        if ($latest_news):
                            $news_content = [];
                            foreach ($latest_news as $post) {
                                setup_postdata($post);
                                $news_content[] = [
                                    'type' => 'link',
                                    'title' => get_the_date('M j, Y'),
                                    'content' => get_the_title(),
                                    'icon' => 'file-text',
                                    'link' => get_permalink(),
                                    'target' => '_self'
                                ];
                            }
                            wp_reset_postdata();

                            get_template_part('template-parts/sections/sidebar-dynamic', null, [
                                'title' => 'Latest News',
                                'subtitle' => 'Stay updated with our community',
                                'content' => $news_content,
                                'button' => [
                                    'show' => true,
                                    'text' => 'View All News',
                                    'icon' => 'arrow-right',
                                    'alignment' => 'center',
                                    'url' => get_post_type_archive_link('news'),
                                    'target' => '_self'
                                ],
                                'container_class' => 'bg-white rounded-lg shadow-md p-6'
                            ]);
                        endif;

                        // Upcoming Events
                        $upcoming_events = get_posts([
                            'post_type' => 'events',
                            'posts_per_page' => 3,
                            'post__not_in' => [get_the_ID()],
                            'orderby' => 'meta_value',
                            'meta_key' => 'event_datetime_start',
                            'order' => 'ASC',
                            'meta_query' => [
                                [
                                    'key' => 'event_datetime_start',
                                    'value' => date('Y-m-d H:i:s'),
                                    'compare' => '>=',
                                    'type' => 'DATETIME'
                                ]
                            ]
                        ]);

                        if ($upcoming_events):
                            $events_content = [];
                            foreach ($upcoming_events as $post) {
                                setup_postdata($post);
                                $start = get_field('event_datetime_start', $post->ID);
                                $events_content[] = [
                                    'type' => 'link',
                                    'title' => $start ? date_i18n('M j, Y', strtotime($start)) : 'TBD',
                                    'content' => get_the_title($post->ID),
                                    'icon' => 'calendar',
                                    'link' => get_permalink($post->ID),
                                    'target' => '_self'
                                ];
                            }
                            wp_reset_postdata();

                            get_template_part('template-parts/sections/sidebar-dynamic', null, [
                                'title' => 'Upcoming Events',
                                'subtitle' => 'Mark your calendar',
                                'content' => $events_content,
                                'button' => [
                                    'show' => true,
                                    'text' => 'View All Events',
                                    'icon' => 'calendar',
                                    'alignment' => 'center',
                                    'url' => get_post_type_archive_link('events'),
                                    'target' => '_self'
                                ],
                                'container_class' => 'bg-white rounded-lg shadow-md p-6'
                            ]);
                        endif;
                        ?>
                    </aside>
                </div>
            </div>
        </div>
    </main>
</div>

<?php get_footer(); ?>