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
                <div class="flex-1">
                    <!-- About the Department Card -->
                    <div class="rounded-lg border bg-white shadow-sm hover:shadow-lg transition-shadow duration-300">
                        <div class="flex flex-col space-y-1.5 p-6">
                            <h3 class="font-semibold tracking-tight text-2xl text-gray-800">About the Department</h3>
                        </div>
                        <div class="p-6 pt-0">
                            <div class="space-y-6">
                                <p class="text-gray-700 leading-relaxed"><?php echo get_field('department_description') ?: 'The chief executive office responsible for overall municipal governance and leadership.'; ?></p>
                                
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div>
                                        <h4 class="font-semibold text-gray-800 mb-2">Mission</h4>
                                        <p class="text-gray-600 text-sm"><?php echo get_field('mission') ?: 'To provide effective leadership and governance that promotes the welfare and development of our municipality.'; ?></p>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-800 mb-2">Vision</h4>
                                        <p class="text-gray-600 text-sm"><?php echo get_field('vision') ?: 'A progressive municipality with transparent, responsive, and accountable leadership.'; ?></p>
                                    </div>
                                </div>
                                
                                <div class="border-t pt-4">
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium">Department Head:</span> 
                                        <?php 
                                        $head = get_field('department_head');
                                        echo $head ? $head->post_title : 'Hon. Maria Santos';
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Services Section -->
                    <?php 
                    // Include services section with limit of 3 services
                    $services_limit = 3;
                    include(locate_template('template-parts/sections/services-section.php'));
                    ?>

                    <!-- How to Apply Card -->
                    <div class="rounded-lg border bg-white shadow-sm hover:shadow-lg transition-shadow duration-300 mt-8">
                        <div class="flex flex-col space-y-1.5 p-6">
                            <h3 class="font-semibold tracking-tight text-2xl text-gray-800">How to Apply / Avail Services</h3>
                        </div>
                        <div class="p-6 pt-0">
                            <div class="space-y-4">
                                <p class="text-gray-700 mb-6">Follow these steps to access our services:</p>
                                <?php 
                                $steps = get_field('application_steps');
                                if ($steps) {
                                    $counter = 1;
                                    foreach ($steps as $step) {
                                        echo '<div class="flex items-start space-x-4">';
                                        echo '<div class="flex-shrink-0 w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center text-sm font-semibold">'.$counter.'</div>';
                                        echo '<p class="text-gray-700 pt-1">'.esc_html($step['step']).'</p>';
                                        echo '</div>';
                                        $counter++;
                                    }
                                } else {
                                    // Default steps if none are set
                                    $default_steps = [
                                        "Schedule an appointment through the Mayor's Office",
                                        "Submit your request or petition in writing",
                                        "Provide necessary supporting documents",
                                        "Wait for review and response from the office",
                                        "Follow up as needed for status updates"
                                    ];
                                    
                                    foreach ($default_steps as $i => $step) {
                                        echo '<div class="flex items-start space-x-4">';
                                        echo '<div class="flex-shrink-0 w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center text-sm font-semibold">'.($i+1).'</div>';
                                        echo '<p class="text-gray-700 pt-1">'.esc_html($step).'</p>';
                                        echo '</div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- Announcements Section -->
                    <section class="py-8">
                        <div class="mb-8">
                            <h2 class="text-3xl font-bold text-gray-800 mb-4">Latest Announcements & Opportunities</h2>
                        </div>
                        <?php
                        $announcements = get_posts([
                            'post_type' => 'post',
                            'category_name' => 'announcements',
                            'posts_per_page' => 3,
                            'meta_query' => [
                                [
                                    'key' => 'related_department',
                                    'value' => get_the_ID(),
                                    'compare' => '='
                                ]
                            ]
                        ]);
                        
                        if ($announcements) : ?>
                            <div class="space-y-6">
                                <?php foreach ($announcements as $post) : setup_postdata($post); ?>
                                    <div class="rounded-lg border bg-white shadow-sm hover:shadow-md transition-shadow duration-300">
                                        <div class="p-6 pt-6">
                                            <div class="flex justify-between items-start mb-3">
                                                <h3 class="font-semibold text-gray-800"><?php the_title(); ?></h3>
                                                <span class="text-sm text-gray-500"><?php echo get_the_date(); ?></span>
                                            </div>
                                            <p class="text-gray-600"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                            <a href="<?php the_permalink(); ?>" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium text-primary-600 hover:text-primary-700 h-9 rounded-md p-0 mt-2">
                                                Read More 
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 ml-1">
                                                    <path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; wp_reset_postdata(); ?>
                            </div>
                        <?php else : ?>
                            <div class="text-center py-12">
                                <p class="text-gray-600 text-lg">No announcements available at the moment.</p>
                            </div>
                        <?php endif; ?>
                    </section>
                </div>

                <!-- Sidebar -->
<!-- Sidebar - Right Side -->
<div class="w-full lg:w-80 xl:w-80">
    <aside class="space-y-6 top-8">
        <?php
        // Contact Information
        $contact_info = get_field('contact_information');
        if ($contact_info) :
            $contact_content = [];
                     
            // Email
            if (!empty($contact_info['email'])) {
                $contact_content[] = [
                    'type' => 'link',
                    'title' => 'Email',
                    'content' => esc_html($contact_info['email']),
                    'icon' => 'mail',
                    'link' => 'mailto:'.esc_attr($contact_info['email']),
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
                    'link' => 'tel:'.preg_replace('/[^0-9]/', '', $contact_info['phone']),
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
                        'url' => '/contact?department='.urlencode(get_the_title()),
                        'target' => '_self'
                    ]
                ]);
            }
        endif;
        
        // Social Media Links
        $social_media = get_field('social_media_links');
        if ($social_media) :
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
        if ($documents) :
            $doc_content = [];
            
            for ($i = 1; $i <= 5; $i++) {
                $doc_key = 'document_' . $i;
                if (!empty($documents[$doc_key])) {
                    $doc_content[] = [
                        'type' => 'link',
                        'title' => '',
                        'content' => 'Download Document '.$i,
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