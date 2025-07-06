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
            <div class="flex gap-8">
                <div class="flex-1">
                    <div class="max-w-4xl mx-auto">
                        <!-- Back Button -->
                        <button onclick="window.history.back();" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium h-10 px-4 py-2 mb-6 hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-2">
                                <path d="m12 19-7-7 7-7"></path>
                                <path d="M19 12H5"></path>
                            </svg>
                            Back
                        </button>

                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                            <div class="mb-8">
                                <!-- Official Type and Status -->
                                <div class="flex items-center gap-4 mb-4">
                                    <?php 
                                    $official_types = get_the_terms(get_the_ID(), 'official_type');
                                    if ($official_types && !is_wp_error($official_types)) :
                                    ?>
                                        <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold border-transparent text-primary-foreground bg-primary-600 hover:bg-primary-700">
                                            <?php echo esc_html($official_types[0]->name); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>

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
                                    <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium h-9 rounded-md px-3 ml-4 border border-input bg-background hover:bg-accent hover:text-accent-foreground">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-2">
                                            <circle cx="18" cy="5" r="3"></circle>
                                            <circle cx="6" cy="12" r="3"></circle>
                                            <circle cx="18" cy="19" r="3"></circle>
                                            <line x1="8.59" x2="15.42" y1="13.51" y2="17.49"></line>
                                            <line x1="15.41" x2="8.59" y1="6.51" y2="10.49"></line>
                                        </svg>
                                        Share
                                    </button>
                                </div>

                                <!-- Official Details Grid -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                    <!-- Position -->
                                    <div class="flex items-center space-x-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-primary-600">
                                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <div>
                                            <div class="font-medium text-gray-800">Position</div>
                                            <div class="text-gray-600"><?php echo esc_html(get_field('position') ?: 'Not specified'); ?></div>
                                        </div>
                                    </div>

                                    <!-- Office -->
                                    <div class="flex items-center space-x-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-primary-600">
                                            <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                        <div>
                                            <div class="font-medium text-gray-800">Office</div>
                                            <div class="text-gray-600"><?php echo esc_html(get_field('office_location') ?: 'Municipal Hall'); ?></div>
                                        </div>
                                    </div>

                                    <!-- Term -->
                                    <div class="flex items-center space-x-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-primary-600">
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

                                <!-- Featured Image with Biography Section -->
                                <div class="container-primary shadow-sm hover:shadow-lg transition-shadow duration-300 ease-in-out">
                                    <div class="grid grid-cols-1 md:grid-cols-2">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <div class="w-full h-96 overflow-hidden rounded-l-lg">
                                                <?php the_post_thumbnail('large', ['class' => 'w-full h-full object-cover']); ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="p-8">
                                            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Biography</h2>
                                            <div class="text-gray-600">
                                            <?php if (get_field('biography')) : ?>
                                                <?php echo wpautop(get_field('biography')); ?>
                                            <?php else : ?>
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
                                        <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium h-9 rounded-md px-3 border border-input bg-background hover:bg-accent hover:text-accent-foreground">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-2">
                                                <circle cx="18" cy="5" r="3"></circle>
                                                <circle cx="6" cy="12" r="3"></circle>
                                                <circle cx="18" cy="19" r="3"></circle>
                                                <line x1="8.59" x2="15.42" y1="13.51" y2="17.49"></line>
                                                <line x1="15.41" x2="8.59" y1="6.51" y2="10.49"></line>
                                            </svg>
                                            Share Profile
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; endif; ?>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="w-80 hidden lg:block">
                    <aside class="space-y-6">
                        <!-- Contact Information -->
                        <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                            <div class="flex flex-col space-y-1.5 p-6">
                                <h3 class="text-2xl font-semibold leading-none tracking-tight flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                    </svg>
                                    Contact Information
                                </h3>
                            </div>
                            <div class="p-6 pt-0 space-y-3">
                                <?php 
                                $contact_info = get_field('contact_information');
                                if ($contact_info) : 
                                ?>
                                    <?php if (!empty($contact_info['email'])) : ?>
                                        <div class="flex items-center gap-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-primary-600">
                                                <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                                            </svg>
                                            <span class="text-sm"><?php echo esc_html($contact_info['email']); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($contact_info['phone'])) : ?>
                                        <div class="flex items-center gap-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-primary-600">
                                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                            </svg>
                                            <span class="text-sm"><?php echo esc_html($contact_info['phone']); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($contact_info['office_hours'])) : ?>
                                        <div class="flex items-center gap-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-primary-600">
                                                <path d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20z"></path>
                                                <path d="M12 6v6l4 2"></path>
                                            </svg>
                                            <span class="text-sm"><?php echo esc_html($contact_info['office_hours']); ?></span>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if (get_field('office_location')) : ?>
                                    <div class="flex items-center gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-primary-600">
                                            <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                        <span class="text-sm"><?php echo esc_html(get_field('office_location')); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Quick Links -->
                        <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                            <div class="flex flex-col space-y-1.5 p-6">
                                <h3 class="text-2xl font-semibold leading-none tracking-tight flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                                        <path d="M15 3h6v6"></path>
                                        <path d="M10 14 21 3"></path>
                                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                                    </svg>
                                    Quick Links
                                </h3>
                            </div>
                            <div class="p-6 pt-0 space-y-2">
                                <?php if (get_field('facebook_url')) : ?>
                                    <a href="<?php echo esc_url(get_field('facebook_url')); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 whitespace-nowrap text-sm font-medium h-9 rounded-md px-3 w-full justify-start border border-input bg-background hover:bg-accent hover:text-accent-foreground">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-2">
                                            <path d="M15 3h6v6"></path>
                                            <path d="M10 14 21 3"></path>
                                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                                        </svg>
                                        Official Facebook Page
                                    </a>
                                <?php endif; ?>

                                <a href="<?php echo esc_url(home_url()); ?>" class="inline-flex items-center gap-2 whitespace-nowrap text-sm font-medium h-9 rounded-md px-3 w-full justify-start border border-input bg-background hover:bg-accent hover:text-accent-foreground">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-2">
                                        <path d="M15 3h6v6"></path>
                                        <path d="M10 14 21 3"></path>
                                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                                    </svg>
                                    Municipal Website
                                </a>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </main>
</div>

<?php get_footer(); ?>