<?php
/**
 * Template Name: Single News
 * Description: Custom template for single news posts
 */

get_header();
?>

<div class="min-h-screen bg-gray-50">
    <!-- Dynamic Page Banner -->
    <?php
    pageBanner();
    ?>

    <!-- Dynamic Breadcrumbs -->
    <?php the_breadcrumbs(); ?>

    <main class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Main Content Area -->
                <div class="flex-1 space-y-8">
                    <?php while (have_posts()):
                        the_post(); ?>

                        <!-- News Stats -->
                        <div class="flex items-center gap-4 mb-4">
                            <?php
                            // Get the first category
                            $categories = get_the_terms(get_the_ID(), 'category');
                            if ($categories && !is_wp_error($categories)): ?>
                                <div
                                    class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent text-primary-foreground bg-blue-600 hover:bg-blue-700">
                                    <?php echo esc_html($categories[0]->name); ?>
                                </div>
                            <?php endif; ?>

                            <div class="flex items-center text-gray-500 text-sm gap-4">
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4">
                                        <path d="M8 2v4"></path>
                                        <path d="M16 2v4"></path>
                                        <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                        <path d="M3 10h18"></path>
                                    </svg>
                                    <span><?php echo get_the_date('F j, Y'); ?></span>
                                </div>

                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-eye w-4 h-4">
                                        <path
                                            d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0">
                                        </path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                    <span>
                                        <?php
                                        $views = get_post_meta(get_the_ID(), 'post_views', true);
                                        echo number_format($views ? (int) $views : 0);
                                        ?> views
                                    </span>
                                </div>

                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-user w-4 h-4">
                                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <span><?php the_author(); ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Excerpt & Share Button -->
                        <div class="flex justify-between items-start mb-6">
                            <div class="flex-1">
                                <?php if (has_excerpt()): ?>
                                    <h3 class="text-gray-700 leading-relaxed"><?php echo get_the_excerpt(); ?></h2>
                                <?php else: ?>
                                    <p class="text-lg text-gray-600 leading-relaxed">
                                        <?php echo wp_trim_words(get_the_content(), 20); ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border border-input bg-white hover:shadow-md hover:text-primary-500 h-9 rounded-md px-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-share2 w-4 h-4 mr-2"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><path d="m8.59 13.51 6.83 3.98m-.01-10.98-6.82 3.98"/></svg> <?php echo do_shortcode('[addtoany]'); ?>
                            </div>

                        </div>

                        <!-- Featured Image -->
                        <?php if (has_post_thumbnail()): ?>
                            <div class="mb-6 rounded-lg h-400 overflow-hidden hover:shadow-lg transition-shadow duration-300">
                                <?php the_post_thumbnail('medium', ['class' => 'w-full h-400']); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Content -->
                        <article class="max-w-none grid gap-4">
                            <?php the_content(); ?>
                        </article>

                        <!-- Tags Section -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold mb-3">Tags</h3>
                            <div class="flex flex-wrap gap-2">
                                <?php
                                $tags = get_the_terms(get_the_ID(), 'post_tag');
                                if ($tags && !is_wp_error($tags)):
                                    foreach ($tags as $tag): ?>
                                        <div
                                            class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 text-foreground bg-white">
                                            <?php echo esc_html($tag->name); ?>
                                        </div>
                                    <?php endforeach;
                                endif; ?>
                            </div>
                        </div>

                        <!-- Last Updated & Share Section -->
                        <div class="pt-6 border-t border-gray-200">
                            <div class="flex justify-between items-center">
                                <div class="text-sm text-gray-500">
                                    Last updated: <?php echo get_the_modified_date('F j, Y'); ?>
                                </div>
                                <div class="flex space-x-2">
                                    <div class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border border-input bg-white hover:shadow-md hover:text-primary-500 h-9 rounded-md px-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-share2 w-4 h-4 mr-2"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><path d="m8.59 13.51 6.83 3.98m-.01-10.98-6.82 3.98"/></svg> <?php echo do_shortcode('[addtoany]'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endwhile; ?>
                </div>

                <div class="w-full lg:w-80 xl:w-80">
                    <aside class="space-y-6 sticky top-8">
                        <?php
                        // Social Media Section
                        get_template_part('template-parts/sections/sidebar-dynamic', null, [
                            'title' => 'Stay Connected',
                            'subtitle' => 'Follow us on social media',
                            'content' => [
                                [
                                    'type' => 'link',
                                    'title' => '',
                                    'content' => 'Facebook',
                                    'icon' => 'facebook',
                                    'link' => 'https://facebook.com/',
                                    'target' => '_blank'
                                ],
                                [
                                    'type' => 'link',
                                    'title' => '',
                                    'content' => 'Twitter/X',
                                    'icon' => 'twitter',
                                    'link' => 'https://twitter.com/',
                                    'target' => '_blank'
                                ],
                                [
                                    'type' => 'link',
                                    'title' => '',
                                    'content' => 'Instagram',
                                    'icon' => 'instagram',
                                    'link' => 'https://instagram.com/',
                                    'target' => '_blank'
                                ]
                            ],
                            'button' => [
                                'show' => true,
                                'text' => 'Join Our Community',
                                'icon' => 'users',
                                'alignment' => 'center',
                                'url' => 'https://facebook.com/',
                                'target' => '_self'
                            ],
                            'container_class' => 'bg-white rounded-lg shadow-md p-6'
                        ]);



                        // Related News (kept from original)
                        $related_posts = get_posts([
                            'post_type' => 'news',
                            'posts_per_page' => 3,
                            'post__not_in' => [get_the_ID()],
                            'orderby' => 'rand'
                        ]);

                        if ($related_posts):
                            $related_content = [];
                            foreach ($related_posts as $post) {
                                setup_postdata($post);
                                $related_content[] = [
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
                                'title' => 'Related News',
                                'subtitle' => 'You might also like',
                                'content' => $related_content,
                                'button' => [
                                    'show' => true,
                                    'text' => 'View All News',
                                    'icon' => 'newspaper',
                                    'alignment' => 'center',
                                    'url' => get_post_type_archive_link('news'),
                                    'target' => '_self'
                                ],
                                'container_class' => 'bg-white rounded-lg shadow-md p-6'
                            ]);

                            // Date Archive Section
                            get_template_part('template-parts/sections/sidebar-dynamic', null, [
                                'title' => 'News Archive',
                                'subtitle' => 'Browse by date',
                                'content' => [
                                    [
                                        'type' => 'link',
                                        'title' => '',
                                        'content' => 'This Month',
                                        'icon' => 'calendar',
                                        'link' => get_month_link(date('Y'), date('m')),
                                        'target' => '_self'
                                    ],
                                    [
                                        'type' => 'link',
                                        'title' => '',
                                        'content' => 'This Year',
                                        'icon' => 'calendar',
                                        'link' => get_year_link(date('Y')),
                                        'target' => '_self'
                                    ],
                                    [
                                        'type' => 'link',
                                        'title' => '',
                                        'content' => 'All Archives',
                                        'icon' => 'archive',
                                        'link' => get_post_type_archive_link('news'),
                                        'target' => '_self'
                                    ]
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