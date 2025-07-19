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
                    <?php while (have_posts()): the_post(); 
                        $start_date = get_field('event_datetime_start');
                        $end_date = get_field('event_datetime_end');
                        $location = get_field('event_location');
                        $organizer = get_field('organizer_name');
                        $attendees = get_field('expected_attendees');
                    ?>
                    
                    <!-- Event Header -->
                    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-600">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900 mb-2"><?php the_title(); ?></h1>
                                
                                <!-- Event Meta -->
                                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                                    <?php if ($start_date): ?>
                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-days w-4 h-4 text-green-600">
                                            <path d="M8 2v4"></path>
                                            <path d="M16 2v4"></path>
                                            <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                            <path d="M3 10h18"></path>
                                            <path d="M8 14h.01"></path>
                                            <path d="M12 14h.01"></path>
                                            <path d="M16 14h.01"></path>
                                            <path d="M8 18h.01"></path>
                                            <path d="M12 18h.01"></path>
                                            <path d="M16 18h.01"></path>
                                        </svg>
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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin w-4 h-4 text-green-600">
                                            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                        <span><?php echo esc_html($location['address']); ?></span>
                                    </div>
                                    <?php endif; ?>
                                    
                                    <?php if ($organizer): ?>
                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user w-4 h-4 text-green-600">
                                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <span><?php echo esc_html($organizer); ?></span>
                                    </div>
                                    <?php endif; ?>
                                    
                                    <?php if ($attendees): ?>
                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users w-4 h-4 text-green-600">
                                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="9" cy="7" r="4"></circle>
                                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                        </svg>
                                        <span><?php echo sprintf(_n('%d attendee', '%d attendees', $attendees, 'textdomain'), $attendees); ?></span>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- Register Button -->
<?php if (get_field('registration_type') && get_field('registration_type') !== 'none'): ?>
    <a href="#register" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md bg-green-600 px-4 py-2 text-sm font-medium text-white shadow transition-colors hover:bg-green-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-600">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clipboard-list w-4 h-4">
            <rect width="8" height="4" x="8" y="2" rx="1" ry="1"></rect>
            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
            <path d="M12 11h4"></path>
            <path d="M12 16h4"></path>
            <path d="M8 11h.01"></path>
            <path d="M8 16h.01"></path>
        </svg>
        <?php echo esc_html(get_field('registration_button_text') ?: 'Register Now'); ?>
    </a>
<?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Event Highlights -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <?php 
                        echo highlight_card([
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-8 h-8 text-green-600"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
                            'title' => 'Event Schedule',
                            'content' => 'Detailed schedule will be provided upon registration. The event includes keynote speeches, workshops, and networking sessions.',
                            'additional_classes' => 'border-l-4 border-green-600'
                        ]);
                        
                        echo highlight_card([
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map w-8 h-8 text-green-600"><polygon points="3 6 9 3 15 6 21 3 21 18 15 21 9 18 3 21"/><line x1="9" x2="9" y1="3" y2="18"/><line x1="15" x2="15" y1="6" y2="21"/></svg>',
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

<div id="register" class="bg-white rounded-lg shadow-md p-6 border-t-4 border-green-600">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">Register for This Event</h2>
    
    <?php
    $registration_type = get_field('registration_type');
    $button_text = get_field('registration_button_text') ?: 'Register Now';
    
    switch ($registration_type) {
        case 'embed':
            $form_embed_code = get_field('form_embed_code');
            if ($form_embed_code): ?>
                <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                    <?php echo $form_embed_code; ?>
                </div>
            <?php else: ?>
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                    <p class="text-yellow-700">No form embed code provided. Please add the form embed code in the admin panel.</p>
                </div>
            <?php endif;
            break;
            
        case 'redirect':
            $form_url = get_field('form_url');
            if ($form_url): ?>
                <div class="bg-green-50 border border-green-200 rounded-lg p-6 text-center">
                    <p class="mb-6 text-gray-700">You'll be redirected to our secure registration form.</p>
                    <a href="<?php echo esc_url($form_url); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md bg-green-600 px-6 py-3 text-lg font-medium text-white shadow transition-colors hover:bg-green-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clipboard-list w-5 h-5">
                            <rect width="8" height="4" x="8" y="2" rx="1" ry="1"></rect>
                            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                            <path d="M12 11h4"></path>
                            <path d="M12 16h4"></path>
                            <path d="M8 11h.01"></path>
                            <path d="M8 16h.01"></path>
                        </svg>
                        <?php echo esc_html($button_text); ?>
                    </a>
                </div>
            <?php else: ?>
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                    <p class="text-yellow-700">No form URL provided. Please add the form URL in the admin panel.</p>
                </div>
            <?php endif;
            break;
            
        default: ?>
            <div class="bg-gray-50 border-l-4 border-gray-400 p-4">
                <p class="text-gray-700">Registration information will be available soon. Please check back later.</p>
            </div>
    <?php } ?>
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
                                    'icon' => 'calendar'
                                ],
                                [
                                    'type' => 'text',
                                    'title' => 'Location',
                                    'content' => $location && isset($location['address']) ? $location['address'] : 'TBD',
                                    'icon' => 'map-pin'
                                ],
                                [
                                    'type' => 'text',
                                    'title' => 'Organizer',
                                    'content' => $organizer ?: 'TBD',
                                    'icon' => 'user'
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
                                    'icon' => 'newspaper',
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