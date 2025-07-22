<?php
/**
 * Template Name: Single Official
 * Description: Template for displaying individual government official profiles
 */

get_header();
?>

<div class="min-h-screen bg-gray-50">
    <!-- Dynamic Page Banner -->
    <div><?php pageBanner(); ?></div>

    <!-- Dynamic Breadcrumbs -->
    <?php the_breadcrumbs(); ?>

    <main class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Main Content -->
                <div class="lg:flex-1 order-1 lg:order-none">
                    <div class="max-w-4xl mx-auto">
                        <div class="container-primary">

                        </div>
                        <?php if (have_posts()):
                            while (have_posts()):
                                the_post(); ?>
                                <div class="mb-8">
                                    <!-- Official Type and Status -->
                                    <div class="flex items-center gap-4 mb-4">
                                        <?php
                                        $official_types = get_the_terms(get_the_ID(), 'official_type');
                                        if ($official_types && !is_wp_error($official_types)):
                                            ?>
                                            <span
                                                class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold border-transparent text-primary-foreground bg-primary-500 hover:bg-primary-700">
                                                <?php echo esc_html($official_types[0]->name); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>

                                    <div
                                        class="container-primary mb-6 p-8 shadow-sm hover:shadow-lg transition-shadow duration-300 ease-in-out">
                                        <!-- Title and Position -->
                                        <div class="flex justify-between items-start mb-6">
                                            <div class="flex-1">
                                                <h1 class="text-3xl font-bold text-gray-800 mb-2"><?php the_title(); ?></h1>
                                                <p class="text-lg text-gray-600 leading-relaxed">
                                                    <?php
                                                    $position = get_field('position');
                                                    $department = get_field('department');

                                                    echo esc_html($position ? $position : 'Government Official');
                                                    if ($department) {
                                                        echo ' | ' . esc_html($department->post_title);
                                                    }
                                                    ?>
                                                </p>
                                            </div>
                                            <div
                                                class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border border-input bg-white hover:shadow-md hover:text-primary-500 h-9 rounded-md px-3">
                                                <?php echo get_service_icon_svg('share', 'w-6 h-6 text-primary-500');
                                                echo do_shortcode('[addtoany]'); ?>
                                            </div>
                                        </div>

                                        <!-- Official Details Grid -->
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                            <!-- Position -->
                                            <div class="flex items-center space-x-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-5 h-5 text-primary-500">
                                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="12" cy="7" r="4"></circle>
                                                </svg>
                                                <div>
                                                    <div class="font-medium text-gray-800">Position</div>
                                                    <div class="text-gray-600">
                                                        <?php echo esc_html(get_field('position') ?: 'Not specified'); ?></div>
                                                </div>
                                            </div>

                                            <!-- Office -->
                                            <div class="flex items-center space-x-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-5 h-5 text-primary-500">
                                                    <path
                                                        d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0">
                                                    </path>
                                                    <circle cx="12" cy="10" r="3"></circle>
                                                </svg>
                                                <div>
                                                    <div class="font-medium text-gray-800">Office</div>
                                                    <div class="text-gray-600">
                                                        <?php echo esc_html(get_field('office_location') ?: 'Municipal Hall'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Term -->
                                            <div class="flex items-center space-x-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-5 h-5 text-primary-500">
                                                    <path d="M8 2v4"></path>
                                                    <path d="M16 2v4"></path>
                                                    <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                                    <path d="M3 10h18"></path>
                                                </svg>
                                                <div>
                                                    <div class="font-medium text-gray-800">Term</div>
                                                    <div class="text-gray-600">
                                                        <?php
                                                        $term_stat = get_field('term_stat');
                                                        $term_start = $term_stat['term_start'] ?? '';
                                                        $term_end = $term_stat['term_end'] ?? '';
                                                        $status = $term_stat['status'] ?? '';

                                                        echo $term_start ? esc_html($term_start) : 'Current';
                                                        echo $term_end ? ' - ' . esc_html($term_end) : '';
                                                        echo $status ? ' (' . esc_html($status) . ')' : '';
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Featured Image with Biography Section -->
                                    <div
                                        class="container-primary shadow-sm hover:shadow-lg transition-shadow duration-300 ease-in-out">
                                        <div class="grid grid-cols-1 md:grid-cols-2">
                                            <?php if (has_post_thumbnail()): ?>
                                                <div class="w-full aspect-[3/4] max-h-[800px] overflow-hidden rounded-l-lg">
                                                    <?php the_post_thumbnail('official-portrait', [
                                                        'class' => 'w-full h-full object-cover',
                                                        'loading' => 'eager' // Optional: prioritize loading
                                                    ]); ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="p-8">
                                                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Biography</h2>
                                                <div class="content-area text-gray-600">
                                                    <?php if (get_field('biography')): ?>
                                                        <?php echo wpautop(get_field('biography')); ?>
                                                    <?php else: ?>
                                                        <p>No biography available for this official.</p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Footer -->
                                    <div class="pt-6 border-t border-gray-200">
                                        <div class="flex justify-between items-center">
                                            <div class="text-sm text-gray-500">
                                                Last updated: <?php the_modified_date(); ?>
                                            </div>
                                            <div class="flex space-x-2">
                                                <div
                                                    class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border border-input bg-white hover:shadow-md hover:text-primary-500 h-9 rounded-md px-3">
                                                    <?php echo get_service_icon_svg('share', 'w-6 h-6 text-primary-500');
                                                    echo do_shortcode('[addtoany]'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; endif; ?>
                    </div>
                </div>

                <!-- Sidebar - Right Side -->
                <div class="w-full lg:w-64 xl:w-72">
                    <aside class="space-y-6 top-8">
                        <?php
                        // Contact Information
                        get_template_part('template-parts/sections/sidebar-dynamic', null, [
                            'title' => 'Contact Information',
                            'content' => [
                                [
                                    'type' => 'link',
                                    'title' => '',
                                    'content' => get_field('contact_information')['email'] ?? 'No email provided',
                                    'icon' => 'mail',
                                    'link' => 'mailto:' . (get_field('contact_information')['email'] ?? ''),
                                    'target' => '_self'
                                ],
                                [
                                    'type' => 'link',
                                    'title' => '',
                                    'content' => get_field('contact_information')['phone'] ?? 'No phone provided',
                                    'icon' => 'phone',
                                    'link' => 'tel:' . preg_replace('/[^0-9]/', '', get_field('contact_information')['phone'] ?? ''),
                                    'target' => '_self'
                                ],
                                [
                                    'type' => 'text',
                                    'title' => '',
                                    'content' => get_field('contact_information')['office_hours'] ?? 'Monday - Friday, 8:00 AM - 5:00 PM',
                                    'icon' => 'clock'
                                ],
                                [
                                    'type' => 'text',
                                    'title' => '',
                                    'content' => get_field('office_location') ?? 'Municipal Hall',
                                    'icon' => 'building'
                                ]
                            ],
                            'button' => [
                                'show' => true,
                                'icon' => 'phone',
                                'text' => 'Send Message',
                                'alignment' => 'center',
                                'url' => '/contact',
                                'target' => '_self'
                            ]
                        ]);

                        // Quick Links
                        get_template_part('template-parts/sections/sidebar-dynamic', null, [
                            'title' => 'Quick Links',
                            'content' => [
                                [
                                    'type' => 'link',
                                    'title' => '',
                                    'content' => 'Official Facebook Page',
                                    'icon' => 'facebook',
                                    'link' => get_field('facebook_url') ?? '#',
                                    'target' => '_blank'
                                ],
                                [
                                    'type' => 'link',
                                    'title' => '',
                                    'content' => 'Municipal Website',
                                    'icon' => 'globe',
                                    'link' => home_url(),
                                    'target' => '_self'
                                ],
                                [
                                    'type' => 'link',
                                    'title' => '',
                                    'content' => 'Department Directory',
                                    'icon' => 'users',
                                    'link' => '/departments',
                                    'target' => '_self'
                                ]
                            ]
                        ]);
                        ?>
                    </aside>
                </div>
            </div>
        </div>
    </main>
</div>

<?php get_footer(); ?>