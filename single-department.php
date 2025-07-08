<?php
/**
 * Single Department Template
 * 
 * @package pinabacdao-lgu
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
            <div class="flex gap-8">
                <!-- Main Content Area -->
                <<!-- Main Content Area -->
                    <!-- Main Content Area -->
                    <div class="flex-1 space-y-8">
                        <!-- Department Header -->
                        <div class="bg-white rounded-xl shadow-md overflow-hidden">
                            <div class="p-8">
                                <div class="flex items-start gap-6">
                                    <?php if (get_field('department_icon')): ?>
                                        <div class="flex-shrink-0 p-4 bg-primary-100 rounded-lg">
                                            <?php echo display_service_icon(get_field('department_icon'), 'text-3xl text-primary-600'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div>
                                        <h1 class="text-4xl font-bold text-gray-900"><?php the_title(); ?></h1>
                                        <?php if (get_field('acronym')): ?>
                                            <p class="text-lg text-gray-600 mt-1">(<?php the_field('acronym'); ?>)</p>
                                        <?php endif; ?>
                                        <?php if (get_field('parent_department')): ?>
                                            <p class="text-gray-500 mt-2">
                                                <span class="font-medium">Parent Department:</span>
                                                <?php echo get_field('parent_department')->post_title; ?>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Core Information Section -->
                        <div class="grid md:grid-cols-2 gap-8">
                            <!-- Mission & Vision -->
                            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                                <div class="p-8">
                                    <div class="flex items-center gap-3 mb-6">
                                        <?php echo display_service_icon('vision-mark', 'w-6 h-6 text-primary-600'); ?>
                                        <h2 class="text-2xl font-bold text-gray-900">Mission & Vision</h2>
                                    </div>
                                    <div class="space-y-6">
                                        <?php if (get_field('mission')): ?>
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-800 mb-2">Mission</h3>
                                                <p class="text-gray-600"><?php the_field('mission'); ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (get_field('vision')): ?>
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-800 mb-2">Vision</h3>
                                                <p class="text-gray-600"><?php the_field('vision'); ?></p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Mandate & Functions -->
                            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                                <div class="p-8">
                                    <div class="flex items-center gap-3 mb-6">
                                        <?php echo display_service_icon('clipboard', 'w-6 h-6 text-primary-600'); ?>
                                        <h2 class="text-2xl font-bold text-gray-900">Mandate & Functions</h2>
                                    </div>
                                    <div class="space-y-6">
                                        <?php if (get_field('mandate')): ?>
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-800 mb-2">Mandate</h3>
                                                <div class="prose prose-gray max-w-none"><?php the_field('mandate'); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (get_field('functions')): ?>
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-800 mb-2">Key Functions</h3>
                                                <div class="prose prose-gray max-w-none"><?php the_field('functions'); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Organizational Structure -->
                        <?php if (get_field('organizational_structure')): ?>
                            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                                <div class="p-8">
                                    <div class="flex items-center gap-3 mb-6">
                                        <?php echo display_service_icon('users', 'w-6 h-6 text-primary-600'); ?>
                                        <h2 class="text-2xl font-bold text-gray-900">Organizational Structure</h2>
                                    </div>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <img src="<?php echo get_field('organizational_structure')['url']; ?>"
                                            alt="Organizational Chart of <?php the_title(); ?>"
                                            class="w-full h-auto mx-auto">
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Department Leadership -->
                        <div class="grid md:grid-cols-2 gap-8">
                            <!-- Department Head -->
                            <?php if (get_field('department_head')): ?>
                                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                                    <div class="p-8">
                                        <div class="flex items-center gap-3 mb-6">
                                            <?php echo display_service_icon('user-check', 'w-6 h-6 text-primary-600'); ?>
                                            <h2 class="text-2xl font-bold text-gray-900">Department Head</h2>
                                        </div>
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="flex-shrink-0 w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center text-gray-400">
                                                <?php echo display_service_icon('users', 'w-8 h-8'); ?>
                                            </div>
                                            <div>
                                                <h3 class="text-xl font-semibold text-gray-800">
                                                    <?php echo get_field('department_head')->post_title; ?></h3>
                                                <p class="text-gray-600">Department Head</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Employee Count -->
                            <?php if (get_field('employee_count')): ?>
                                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                                    <div class="p-8">
                                        <div class="flex items-center gap-3 mb-6">
                                            <?php echo display_service_icon('users', 'w-6 h-6 text-primary-600'); ?>
                                            <h2 class="text-2xl font-bold text-gray-900">Personnel</h2>
                                        </div>
                                        <div class="grid grid-cols-3 gap-4">
                                            <div class="text-center p-4 bg-gray-50 rounded-lg">
                                                <p class="text-3xl font-bold text-primary-600">
                                                    <?php the_field('employee_count_regular'); ?></p>
                                                <p class="text-sm text-gray-600">Regular</p>
                                            </div>
                                            <div class="text-center p-4 bg-gray-50 rounded-lg">
                                                <p class="text-3xl font-bold text-primary-600">
                                                    <?php the_field('employee_count_casual'); ?></p>
                                                <p class="text-sm text-gray-600">Casual</p>
                                            </div>
                                            <div class="text-center p-4 bg-gray-50 rounded-lg">
                                                <p class="text-3xl font-bold text-primary-600">
                                                    <?php the_field('employee_count_job_order'); ?></p>
                                                <p class="text-sm text-gray-600">Job Order</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Divisions/Units -->
                        <?php if (have_rows('divisions')): ?>
                            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                                <div class="p-8">
                                    <div class="flex items-center gap-3 mb-6">
                                        <?php echo display_service_icon('building', 'w-6 h-6 text-primary-600'); ?>
                                        <h2 class="text-2xl font-bold text-gray-900">Divisions & Units</h2>
                                    </div>
                                    <div class="grid md:grid-cols-2 gap-6">
                                        <?php while (have_rows('divisions')):
                                            the_row(); ?>
                                            <div
                                                class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                                                <div class="flex items-center gap-3 mb-3">
                                                    <?php echo display_service_icon('users', 'w-5 h-5 text-gray-500'); ?>
                                                    <h3 class="text-lg font-semibold text-gray-800">
                                                        <?php the_sub_field('division_name'); ?></h3>
                                                </div>
                                                <?php if (get_sub_field('division_head')): ?>
                                                    <p class="text-gray-600 mb-1 flex items-center gap-2">
                                                        <?php echo display_service_icon('user-check', 'w-4 h-4 text-gray-400'); ?>
                                                        <span>Head: <?php the_sub_field('division_head'); ?></span>
                                                    </p>
                                                <?php endif; ?>
                                                <?php if (get_sub_field('division_contact')): ?>
                                                    <p class="text-gray-600 flex items-center gap-2">
                                                        <?php echo display_service_icon('phone', 'w-4 h-4 text-gray-400'); ?>
                                                        <span>Contact: <?php the_sub_field('division_contact'); ?></span>
                                                    </p>
                                                <?php endif; ?>
                                            </div>
                                        <?php endwhile; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Citizen's Charter -->
                        <?php if (get_field('citizens_charter')): ?>
                            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                                <div class="p-8">
                                    <div class="flex items-center gap-3 mb-6">
                                        <?php echo display_service_icon('file-text', 'w-6 h-6 text-primary-600'); ?>
                                        <h2 class="text-2xl font-bold text-gray-900">Citizen's Charter</h2>
                                    </div>
                                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
                                        <?php echo display_service_icon('file-text', 'w-10 h-10 text-primary-600'); ?>
                                        <div>
                                            <h3 class="font-medium text-gray-800">Citizen's Charter Document</h3>
                                            <a href="<?php echo get_field('citizens_charter')['url']; ?>"
                                                class="text-primary-600 hover:text-primary-700 text-sm font-medium inline-flex items-center mt-1"
                                                download>
                                                Download PDF
                                                <?php echo display_service_icon('download', 'w-4 h-4 ml-1'); ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Related Services -->
                        <?php if (get_field('related_services')): ?>
                            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                                <div class="p-8">
                                    <div class="flex items-center gap-3 mb-6">
                                        <?php echo display_service_icon('settings', 'w-6 h-6 text-primary-600'); ?>
                                        <h2 class="text-2xl font-bold text-gray-900">Services Offered</h2>
                                    </div>
                                    <div class="grid md:grid-cols-2 gap-4">
                                        <?php foreach (get_field('related_services') as $service): ?>
                                            <a href="<?php echo get_permalink($service->ID); ?>"
                                                class="group flex items-center gap-4 p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                                <div
                                                    class="flex-shrink-0 w-10 h-10 bg-primary-100 text-primary-600 rounded-full flex items-center justify-center">
                                                    <?php
                                                    $service_icon = get_field('service_icon', $service->ID) ?: 'settings';
                                                    echo display_service_icon($service_icon, 'h-5 w-5');
                                                    ?>
                                                </div>
                                                <div>
                                                    <h3
                                                        class="font-medium text-gray-800 group-hover:text-primary-600 transition-colors">
                                                        <?php echo $service->post_title; ?></h3>
                                                    <p class="text-sm text-gray-500">
                                                        <?php echo wp_trim_words(get_the_excerpt($service->ID), 10); ?></p>
                                                </div>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Sidebar -->
                    <!-- Sidebar - Right Side -->
                    <div class="w-full lg:w-80 xl:w-80">
                        <aside class="space-y-6 top-8">
                            <?php
                            // Contact Information
                            $contact_info = get_field('contact_information');
                            if ($contact_info):
                                $contact_content = [];

                                // Email
                                if (!empty($contact_info['email'])) {
                                    $contact_content[] = [
                                        'type' => 'link',
                                        'title' => 'Email',
                                        'content' => esc_html($contact_info['email']),
                                        'icon' => 'mail',
                                        'link' => 'mailto:' . esc_attr($contact_info['email']),
                                        'target' => '_self'
                                    ];
                                }
                                // Phone
                                if (!empty($contact_info['phone'])) {
                                    $contact_content[] = [
                                        'type' => 'link',
                                        'title' => 'Phone',
                                        'content' => esc_html($contact_info['phone']),
                                        'icon' => 'phone',
                                        'link' => 'tel:' . preg_replace('/[^0-9]/', '', $contact_info['phone']),
                                        'target' => '_self'
                                    ];
                                }
                                // Location
                                if (!empty($contact_info['location'])) {
                                    $contact_content[] = [
                                        'type' => 'text',
                                        'title' => 'Office',
                                        'content' => esc_html($contact_info['location']),
                                        'icon' => 'location'
                                    ];
                                }

                                // Office Hours
                                if (!empty($contact_info['operating_hours'])) {
                                    $contact_content[] = [
                                        'type' => 'text',
                                        'title' => 'Hours',
                                        'content' => esc_html($contact_info['operating_hours']),
                                        'icon' => 'clock'
                                    ];
                                }

                                // Divisions/Units
                                $divisions = get_field('divisions');
                                if ($divisions) {
                                    foreach ($divisions as $division) {
                                        $division_info = [];
                                        if (!empty($division['division_name'])) {
                                            $division_info[] = esc_html($division['division_name']);
                                        }
                                        if (!empty($division['division_head'])) {
                                            $division_info[] = 'Head: ' . esc_html($division['division_head']);
                                        }
                                        if (!empty($division['division_contact'])) {
                                            $division_info[] = 'Contact: ' . esc_html($division['division_contact']);
                                        }

                                        if (!empty($division_info)) {
                                            $contact_content[] = [
                                                'type' => 'text',
                                                'title' => '',
                                                'content' => implode(' • ', $division_info),
                                                'icon' => 'users'
                                            ];
                                        }
                                    }
                                }

                                if (!empty($contact_content)) {
                                    get_template_part('template-parts/sections/sidebar-dynamic', null, [
                                        'title' => 'Contact Information',
                                        'content' => $contact_content,
                                        'button' => [
                                            'show' => true,
                                            'icon' => 'mail',
                                            'text' => 'Contact Department',
                                            'alignment' => 'center',
                                            'url' => '/contact?department=' . urlencode(get_the_title()),
                                            'target' => '_self'
                                        ]
                                    ]);
                                }
                            endif;

                            // Social Media Links
                            $social_media = get_field('social_media_links');
                            if ($social_media):
                                $social_content = [];

                                if (!empty($social_media['facebook'])) {
                                    $social_content[] = [
                                        'type' => 'link',
                                        'title' => '',
                                        'content' => 'Facebook Page',
                                        'icon' => 'facebook',
                                        'link' => esc_url($social_media['facebook']),
                                        'target' => '_blank'
                                    ];
                                }

                                if (!empty($social_media['twitter'])) {
                                    $social_content[] = [
                                        'type' => 'link',
                                        'title' => '',
                                        'content' => 'Twitter Profile',
                                        'icon' => 'twitter',
                                        'link' => esc_url($social_media['twitter']),
                                        'target' => '_blank'
                                    ];
                                }

                                if (!empty($social_media['youtube'])) {
                                    $social_content[] = [
                                        'type' => 'link',
                                        'title' => '',
                                        'content' => 'YouTube Channel',
                                        'icon' => 'youtube',
                                        'link' => esc_url($social_media['youtube']),
                                        'target' => '_blank'
                                    ];
                                }

                                if (!empty($social_media['instagram'])) {
                                    $social_content[] = [
                                        'type' => 'link',
                                        'title' => '',
                                        'content' => 'Instagram Profile',
                                        'icon' => 'instagram',
                                        'link' => esc_url($social_media['instagram']),
                                        'target' => '_blank'
                                    ];
                                }

                                if (!empty($social_content)) {
                                    get_template_part('template-parts/sections/sidebar-dynamic', null, [
                                        'title' => 'Social Media',
                                        'content' => $social_content
                                    ]);
                                }
                            endif;

                            // Documents
                            $documents = get_field('documents');
                            if ($documents):
                                $doc_content = [];

                                for ($i = 1; $i <= 5; $i++) {
                                    $doc_key = 'document_' . $i;
                                    if (!empty($documents[$doc_key])) {
                                        // Get the file name without extension
                                        $file_name = pathinfo($documents[$doc_key]['filename'], PATHINFO_FILENAME);
                                        // Replace underscores and hyphens with spaces
                                        $display_name = str_replace(['_', '-'], ' ', $file_name);
                                        // Capitalize first letter of each word
                                        $display_name = ucwords($display_name);

                                        $doc_content[] = [
                                            'type' => 'link',
                                            'title' => '',
                                            'content' => $display_name,
                                            'icon' => 'file-text',
                                            'link' => esc_url($documents[$doc_key]['url']),
                                            'target' => '_blank'
                                        ];
                                    }
                                }

                                if (!empty($doc_content)) {
                                    get_template_part('template-parts/sections/sidebar-dynamic', null, [
                                        'title' => 'Department Documents',
                                        'content' => $doc_content
                                    ]);
                                }
                            endif;

                            // Quick Links
                            get_template_part('template-parts/sections/sidebar-dynamic', null, [
                                'title' => 'Quick Links',
                                'content' => [
                                    [
                                        'type' => 'link',
                                        'title' => '',
                                        'content' => 'All Services',
                                        'icon' => 'file-text',
                                        'link' => get_permalink(get_page_by_path('services')),
                                        'target' => '_self'
                                    ],
                                    [
                                        'type' => 'link',
                                        'title' => '',
                                        'content' => 'News & Events',
                                        'icon' => 'calendar',
                                        'link' => get_permalink(get_page_by_path('news')),
                                        'target' => '_self'
                                    ],
                                    [
                                        'type' => 'link',
                                        'title' => '',
                                        'content' => 'Department Directory',
                                        'icon' => 'building',
                                        'link' => get_permalink(get_page_by_path('government')),
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