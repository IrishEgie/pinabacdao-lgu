<?php
/**
 * Single Service Template
 * 
 * @package your-theme
 */

get_header();
?>

<div class="min-h-screen bg-gray-50">
    <?php pageBanner(); ?>
    <?php the_breadcrumbs(); ?>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-3">
                <article class="bg-white rounded-lg shadow-md overflow-hidden">
                    <!-- Service Header -->
                    <div class="bg-primary-600 px-6 py-4">
                        <div class="flex items-center space-x-4">
                            <?php 
                            $service_icon = get_field('service_icon');
                            if ($service_icon) : ?>
                                <div class="p-2 bg-white bg-opacity-20 rounded-lg">
                                    <?php echo get_service_icon_svg($service_icon, 'w-6 h-6 text-white'); ?>
                                </div>
                            <?php endif; ?>
                            <div>
                                <h1 class="text-2xl font-bold text-white"><?php the_title(); ?></h1>
                                <p class="text-primary-100 mt-1">
                                    <?php 
                                    $terms = get_the_terms(get_the_ID(), 'service_category');
                                    if ($terms && !is_wp_error($terms)) {
                                        echo esc_html($terms[0]->name);
                                    } else {
                                        echo 'Municipal Service';
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Service Content -->
                    <div class="p-6">
                        <!-- Service Description -->
                        <div class="prose max-w-none mb-8">
                            <?php the_content(); ?>
                        </div>

                        <!-- Service Details -->
                        <div class="bg-gray-50 rounded-lg p-6 mb-8">
                            <h3 class="text-xl font-semibold mb-4 text-gray-800">Service Information</h3>
                            <div class="grid md:grid-cols-2 gap-6">
                                <div class="space-y-4">
                                    <!-- Department -->
                                    <div>
                                        <h4 class="flex gap-2 font-medium text-gray-700 mb-2 flex items-center">
                                            <?php echo get_service_icon_svg('landmark', 'w-6 h-6 text-primary-600') ?>
                                            Department
                                        </h4>
                                        <p class="text-gray-600 pl-6">
                                            <?php echo esc_html(get_field('department') ?: 'Municipal Office'); ?>
                                        </p>
                                    </div>

                                    <!-- Availability -->
                                    <div>
                                        <h4 class="flex gap-2 font-medium text-gray-700 mb-2 flex items-center">
                                            <?php echo get_service_icon_svg('clock', 'w-6 h-6 text-primary-600') ?>
                                            Availability
                                        </h4>
                                        <p class="text-gray-600 pl-6">
                                            <?php echo esc_html(get_field('service_availability') ?: 'Monday - Friday, 8:00 AM - 5:00 PM'); ?>
                                        </p>
                                    </div>

                                    <!-- Processing Time -->
                                    <div>
                                        <h4 class="flex gap-2 font-medium text-gray-700 mb-2 flex items-center">
                                            <?php echo get_service_icon_svg('clock', 'w-6 h-6 text-primary-600') ?>
                                            Processing Time
                                        </h4>
                                        <p class="text-gray-600 pl-6">
                                            <?php echo esc_html(get_field('service_processing_time') ?: '3-5 business days'); ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <!-- Requirements -->
                                    <div>
                                        <h4 class="flex gap-2 font-medium text-gray-700 mb-2 flex items-center">
                                            <?php echo get_service_icon_svg('file-text', 'w-6 h-6 text-primary-600') ?>
                                            Requirements
                                        </h4>
                                        <div class="pl-6">
                                            <?php 
                                            $requirements = get_field('service_requirements');
                                            if ($requirements) : 
                                                // Split by line breaks, trim each line, and remove empty lines
                                                $items = array_filter(array_map('trim', explode("\n", $requirements)));
                                                if (!empty($items)) : ?>
                                                    <ul class="list-disc pl-5 text-gray-600 space-y-1">
                                                        <?php foreach ($items as $item) : ?>
                                                            <li><?php echo esc_html($item); ?></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php else : ?>
                                                    <p class="text-gray-600">No requirements specified.</p>
                                                <?php endif; ?>
                                            <?php else : ?>
                                                <p class="text-gray-600">Valid ID and completed application form</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Fees -->
                                    <div>
                                        <h4 class="flex gap-2 font-medium text-gray-700 mb-2 flex items-center">
                                            <?php echo get_service_icon_svg('money', 'w-6 h-6 text-primary-600') ?>
                                            Fees
                                        </h4>
                                        <p class="text-gray-600 pl-6">
                                            <?php echo esc_html(get_field('service_fees') ?: 'No fees required'); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Service Process -->
                        <div class="mb-8">
                            <h3 class="text-xl font-semibold mb-4 text-gray-800">Process Flow</h3>
                            <div class="bg-gray-50 rounded-lg p-6">
                                <?php 
                                $process = get_field('service_process');
                                if ($process) : ?>
                                    <div class="prose max-w-none">
                                        <?php echo $process; ?>
                                    </div>
                                <?php else : ?>
                                    <p class="text-gray-600">Process information not available.</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Service Contact -->
                        <div class="mb-8">
                            <h3 class="text-xl font-semibold mb-4 text-gray-800">Contact Information</h3>
                            <div class="bg-gray-50 rounded-lg p-6">
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div>
                                        <h4 class="font-medium text-gray-700 mb-2">Office Location</h4>
                                        <p class="text-gray-600">
                                            <?php echo esc_html(get_field('service_location') ?: 'Ground Floor, Municipal Hall'); ?>
                                        </p>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-700 mb-2">Contact Details</h4>
                                        <p class="text-gray-600">
                                            <?php echo esc_html(get_field('service_contact_person') ?: 'Municipal Services Office'); ?>
                                        </p>
                                        <p class="text-gray-600">
                                            <?php echo esc_html(get_field('service_contact_phone') ?: '+63 (55) 123-4567'); ?>
                                        </p>
                                        <p class="text-gray-600">
                                            <?php echo esc_html(get_field('service_contact_email') ?: 'services@pinabacdao.gov.ph'); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Call to Action -->
                        <div class="border-t pt-6">
                            <h3 class="text-lg font-semibold mb-4 text-gray-800">Ready to Get Started?</h3>
                            <div class="flex flex-col sm:flex-row gap-4">
                                <?php 
                                $application_url = get_field('service_application_url');
                                if ($application_url) : ?>
                                    <a href="<?php echo esc_url($application_url); ?>" 
                                       class="inline-flex items-center justify-center px-6 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors font-medium">
                                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        Apply Online
                                    </a>
                                <?php endif; ?>
                                
                                <a href="/contact" 
                                   class="inline-flex items-center justify-center px-6 py-3 border border-primary-600 text-primary-600 rounded-lg hover:bg-primary-50 transition-colors font-medium">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-3.582 8-8 8a8.959 8.959 0 01-2.165-.267l-5.69 1.265a.964.964 0 01-1.143-.905l.001-5.535A8 8 0 1121 12z" />
                                    </svg>
                                    Contact About This Service
                                </a>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Related Services -->
                <?php
                $related_services = get_posts(array(
                    'post_type' => 'service',
                    'posts_per_page' => 3,
                    'post__not_in' => array(get_the_ID()),
                    'orderby' => 'rand'
                ));

                if ($related_services) : ?>
                    <div class="mt-16">
                        <h3 class="text-2xl font-bold text-gray-800 mb-8">Other Services You Might Need</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            <?php foreach ($related_services as $service) : 
                                $service_id = $service->ID;
                                $service_icon = get_field('service_icon', $service_id);
                                $service_description = $service->post_excerpt ? $service->post_excerpt : wp_trim_words($service->post_content, 20);
                                $redirect_url = get_field('service_application_url', $service_id);
                                $open_new_tab = get_field('open_in_new_tab', $service_id);
                                $link_attributes = array(
                                    'href' => $redirect_url ?: get_permalink($service_id),
                                    'target' => ($redirect_url && $open_new_tab) ? '_blank' : '',
                                    'rel' => ($redirect_url && $open_new_tab) ? 'noopener noreferrer' : ''
                                );
                                
                                $terms = get_the_terms($service_id, 'service_category');
                                ?>
                                
                                <div class="group bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-l-primary-600 h-full">
                                    <a 
                                        href="<?php echo esc_url($link_attributes['href']); ?>" 
                                        class="block h-full p-6"
                                        <?php if (!empty($link_attributes['target'])) echo 'target="'.esc_attr($link_attributes['target']).'"'; ?>
                                        <?php if (!empty($link_attributes['rel'])) echo 'rel="'.esc_attr($link_attributes['rel']).'"'; ?>
                                    >
                                        <div class="flex items-center space-x-4 pb-4">
                                            <div class="p-3 bg-primary-50 rounded-lg group-hover:bg-primary-100 transition-colors duration-300">
                                                <?php
                                                $icon_name = !empty($service_icon) ? sanitize_text_field($service_icon) : 'briefcase';
                                                $icon_name = array_key_exists($icon_name, get_service_icon_options()) ? $icon_name : 'briefcase';
                                                echo get_service_icon_svg($icon_name, 'w-6 h-6 text-primary-600');
                                                ?>
                                            </div>
                                            <h3 class="text-xl font-semibold text-gray-800 group-hover:text-primary-600 transition-colors duration-300">
                                                <?php echo esc_html($service->post_title); ?>
                                            </h3>
                                        </div>
                                        
                                        <?php if ($terms && !is_wp_error($terms)) : ?>
                                            <div class="flex flex-wrap gap-2 mt-2 mb-4">
                                                <?php foreach ($terms as $term) {
                                                    echo '<span class="bg-gray-100 text-gray-800 text-xs px-3 py-1 rounded-full">';
                                                    echo esc_html($term->name);
                                                    echo '</span>';
                                                } ?>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <div class="space-y-4">
                                            <p class="text-gray-600 leading-relaxed"><?php echo esc_html($service_description); ?></p>
                                            <button class="inline-flex items-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 w-full justify-between group-hover:bg-primary-50 transition-colors duration-300">
                                                <div class="flex items-center text-primary-600 group-hover:text-primary-700 transition-colors duration-300">
                                                    <span class="mr-2">Learn More</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="w-6 h-6 group-hover:translate-x-1 transition-transform duration-300">
                                                        <path d="M5 12h14" />
                                                        <path d="m12 5 7 7-7 7" />
                                                    </svg>
                                                </div>
                                            </button>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>                
            </div>

<!-- Sidebar Navigation -->
<div class="lg:col-span-1 space-y-6">
    <?php
    // Quick Info
    get_template_part('template-parts/sections/sidebar-dynamic', null, [
        'title' => 'Service Quick Info',
        'content' => [
            [
                'type' => 'text',
                'title' => 'Department',
                'content' => get_field('department') ?: 'Municipal Office',
                'icon' => 'landmark'
            ],
            [
                'type' => 'text',
                'title' => 'Processing Time',
                'content' => get_field('service_processing_time') ?: '3-5 business days',
                'icon' => 'clock'
            ],
            [
                'type' => 'text',
                'title' => 'Fees',
                'content' => get_field('service_fees') ?: 'No fees required',
                'icon' => 'dollar-sign'
            ]
        ]
    ]);
    
    // All Services List
    $services = get_posts([
        'post_type' => 'service',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ]);
    
    if ($services) {
        $service_items = [];
        foreach ($services as $service) {
            $service_items[] = [
                'type' => 'link',
                'title' => '',
                'content' => $service->post_title,
                'icon' => get_field('service_icon', $service->ID) ?: 'briefcase',
                'link' => get_permalink($service->ID),
                'target' => '_self',
                'class' => (get_the_ID() === $service->ID) ? 'bg-primary-50 text-primary-600 font-medium px-3 py-2 rounded' : 'text-gray-600 hover:bg-gray-50 px-3 py-2 rounded'
            ];
        }
        
        get_template_part('template-parts/sections/sidebar-dynamic', null, [
            'title' => 'All Services',
            'content' => $service_items
        ]);
    }
    
    // Quick Actions
    get_template_part('template-parts/sections/sidebar-dynamic', null, [
        'title' => 'Quick Actions',
        'content' => [
            [
                'type' => 'link',
                'title' => '',
                'content' => 'All Services',
                'icon' => 'list',
                'link' => '/services',
                'target' => '_self'
            ],
            [
                'type' => 'link',
                'title' => '',
                'content' => 'Download Forms',
                'icon' => 'download',
                'link' => '/forms',
                'target' => '_self'
            ],
            [
                'type' => 'link',
                'title' => '',
                'content' => 'FAQs',
                'icon' => 'help-circle',
                'link' => '/faq',
                'target' => '_self'
            ]
        ]
    ]);
    ?>
</div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>