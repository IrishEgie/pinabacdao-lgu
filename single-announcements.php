<?php
/**
 * Template Name: Single Announcement
 * Description: Custom template for single announcement posts
 */
require_once get_template_directory() . '/template-parts/cards/news-card.php';
get_header();
?>

<div class="min-h-screen bg-gray-50">
    <!-- Dynamic Page Banner -->
    <?php pageBanner(
        [
            'title' => 'Announcement Details',
        ]

    ); ?>

    <!-- Dynamic Breadcrumbs -->
    <?php the_breadcrumbs(); ?>

    <main class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Main Content Area -->
                <div class="flex-1 space-y-8">
                    <?php while (have_posts()):
                        the_post();
                        $expiry_date = get_field('announcement_expiry');
                        $priority = get_field('announcement_priority');
                        ?>

                        <!-- Announcement Header -->
                        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-orange-600">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <div>
                                    <h1 class="text-3xl font-bold text-gray-900 mb-2"><?php the_title(); ?></h1>

                                    <!-- Announcement Meta -->
                                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                                        <div class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-calendar-days w-4 h-4 text-orange-600">
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
                                            <span>Posted on <?php echo get_the_date('F j, Y'); ?></span>
                                        </div>

                                        <?php if ($expiry_date): ?>
                                            <div class="flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-clock w-4 h-4 text-orange-600">
                                                    <circle cx="12" cy="12" r="10" />
                                                    <polyline points="12 6 12 12 16 14" />
                                                </svg>
                                                <span>Expires on
                                                    <?php echo date_i18n('F j, Y', strtotime($expiry_date)); ?></span>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($priority): ?>
                                            <div class="flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-alert-triangle w-4 h-4 text-orange-600">
                                                    <path
                                                        d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z" />
                                                    <path d="M12 9v4" />
                                                    <path d="M12 17h.01" />
                                                </svg>
                                                <span>Priority: <?php echo esc_html($priority); ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Share Button -->
                                <div
                                    class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border border-input bg-white hover:shadow-md hover:text-primary-500 h-9 rounded-md px-3">
                                    <?php echo get_service_icon_svg('share', 'w-6 h-6 text-primary-500');
                                    echo do_shortcode('[addtoany]'); ?>
                                </div>
                            </div>
                        </div>

                        <!-- Announcement Highlights -->
                        <div class="bg-orange-50 rounded-lg p-6 border border-orange-100">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-megaphone w-6 h-6 text-orange-600">
                                        <path d="m3 11 18-5v12L3 14v-3z" />
                                        <path d="M11.6 16.8a3 3 0 1 1-5.8-1.6" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-orange-800 mb-2">Important Notice</h3>
                                    <p class="text-orange-700">This announcement contains important information that may
                                        require your attention. Please read it carefully and take any necessary action
                                        before the expiration date.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Featured Image -->
                        <?php if (has_post_thumbnail()): ?>
                            <div class="rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                                <?php the_post_thumbnail('large', ['class' => 'w-full h-auto max-h-96 object-cover']); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Full Announcement Content -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">Full Announcement Details</h2>
                            <div class="prose content-area max-w-none text-gray-700">
                                <?php the_content(); ?>
                            </div>
                        </div>

                        <!-- Related News Section -->
                        <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl shadow-lg overflow-hidden">
                            <div class="p-8">
                                <h2 class="text-3xl font-bold text-gray-900 mb-2">Related News</h2>
                                <p class="text-orange-600 text-center mb-6">Stay informed with these recent updates</p>

                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                    <?php
                                    $related_news = get_posts([
                                        'post_type' => 'news',
                                        'posts_per_page' => 3,
                                        'orderby' => 'rand',
                                        'date_query' => [
                                            [
                                                'after' => '1 month ago',
                                                'inclusive' => true,
                                            ]
                                        ]
                                    ]);

                                    if ($related_news):
                                        foreach ($related_news as $post):
                                            setup_postdata($post);
                                            render_post_card(get_post_card_args($post->ID));
                                        endforeach;
                                        wp_reset_postdata();
                                    else:
                                        echo '<p class="text-gray-500 col-span-3">No recent news found. Check back later!</p>';
                                    endif;
                                    ?>
                                </div>
                            </div>

                            <div class="bg-gray-50 px-8 py-4 border-t border-gray-200 text-center">
                                <a href="<?php echo esc_url(get_post_type_archive_link('news')); ?>"
                                    class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md bg-orange-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-orange-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-orange-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-newspaper w-4 h-4">
                                        <path
                                            d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2" />
                                        <path d="M18 14h-8" />
                                        <path d="M15 18h-5" />
                                        <path d="M10 6h8v4h-8V6Z" />
                                    </svg>
                                    View All News
                                </a>
                            </div>
                        </div>

                    <?php endwhile; ?>
                </div>

                <!-- Sidebar -->
                <div class="w-full lg:w-80 xl:w-80">
                    <aside class="space-y-6 sticky top-8">
                        <?php
                        // Announcement Quick Info
                        get_template_part('template-parts/sections/sidebar-dynamic', null, [
                            'title' => 'Announcement Details',
                            'subtitle' => 'Important information',
                            'content' => [
                                [
                                    'type' => 'text',
                                    'title' => 'Published Date',
                                    'content' => get_the_date('F j, Y'),
                                    'icon' => 'calendar'
                                ],
                                [
                                    'type' => 'text',
                                    'title' => 'Expiry Date',
                                    'content' => $expiry_date ? date_i18n('F j, Y', strtotime($expiry_date)) : 'No expiry date',
                                    'icon' => 'clock'
                                ],
                                [
                                    'type' => 'text',
                                    'title' => 'Priority Level',
                                    'content' => $priority ?: 'Normal',
                                    'icon' => 'triangle-alert'
                                ],
                                [
                                    'type' => 'text',
                                    'title' => 'Status',
                                    'content' => $expiry_date && date('Ymd') > date('Ymd', strtotime($expiry_date)) ? 'Expired' : 'Active',
                                    'icon' => 'info'
                                ]
                            ],
                            'container_class' => 'bg-white rounded-lg shadow-md p-6 border-l-4 border-orange-600'
                        ]);

                        // Latest Announcements
                        $latest_announcements = get_posts([
                            'post_type' => 'announcements',
                            'posts_per_page' => 5,
                            'post__not_in' => [get_the_ID()],
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'meta_query' => [
                                [
                                    'key' => 'announcement_expiry',
                                    'value' => date('Ymd'),
                                    'compare' => '>=',
                                    'type' => 'DATE'
                                ]
                            ]
                        ]);

                        if ($latest_announcements):
                            $announcements_content = [];
                            foreach ($latest_announcements as $post) {
                                setup_postdata($post);
                                $expiry = get_field('announcement_expiry', $post->ID);
                                $announcements_content[] = [
                                    'type' => 'link',
                                    'title' => get_the_date('M j, Y', $post->ID),
                                    'content' => get_the_title($post->ID),
                                    'icon' => 'megaphone',
                                    'link' => get_permalink($post->ID),
                                    'target' => '_self',
                                    'class' => $expiry && date('Ymd') > date('Ymd', strtotime($expiry)) ? 'opacity-60' : ''
                                ];
                            }
                            wp_reset_postdata();

                            get_template_part('template-parts/sections/sidebar-dynamic', null, [
                                'title' => 'Recent Announcements',
                                'subtitle' => 'Stay up to date',
                                'content' => $announcements_content,
                                'button' => [
                                    'show' => true,
                                    'text' => 'View All Announcements',
                                    'icon' => 'arrow-right',
                                    'alignment' => 'center',
                                    'url' => get_post_type_archive_link('announcements'),
                                    'target' => '_self'
                                ],
                                'container_class' => 'bg-white rounded-lg shadow-md p-6'
                            ]);
                        endif;

                        // Quick Links
                        get_template_part('template-parts/sections/sidebar-dynamic', null, [
                            'title' => 'Quick Links',
                            'subtitle' => 'Helpful resources',
                            'content' => [
                                [
                                    'type' => 'link',
                                    'title' => '',
                                    'content' => 'Contact Support',
                                    'icon' => 'mail',
                                    'link' => '/contact',
                                    'target' => '_self'
                                ],
                                [
                                    'type' => 'link',
                                    'title' => '',
                                    'content' => 'FAQs',
                                    'icon' => 'info',
                                    'link' => '/faqs',
                                    'target' => '_self'
                                ],
                                [
                                    'type' => 'link',
                                    'title' => '',
                                    'content' => 'Documentation',
                                    'icon' => 'file-text',
                                    'link' => '/docs',
                                    'target' => '_self'
                                ]
                            ],
                            'container_class' => 'bg-white rounded-lg shadow-md p-6'
                        ]);
                        ?>
                    </aside>
                </div>
            </div>
        </div>
    </main>
</div>

<?php get_footer(); ?>