<?php
/**
 * Template part for displaying Department cards
 */

// Get department groups to filter by
$current_group = isset($args['group']) ? $args['group'] : '';
$icon_class = 'w-6 h-6 text-primary-500';

// Query args
$query_args = array(
    'post_type' => 'department',
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC'
);

// Add taxonomy filter if group is specified
if ($current_group) {
    $query_args['tax_query'] = array(
        array(
            'taxonomy' => 'department_group',
            'field' => 'slug',
            'terms' => $current_group
        )
    );
}

$departments = new WP_Query($query_args);

if ($departments->have_posts()) :
    while ($departments->have_posts()) : $departments->the_post();
        // Get ACF fields
        $functions = get_field('functions');
        $contact_info = get_field('contact_information');
        $email = $contact_info['email'] ?? '';
        $icon = get_field('department_icon') ?: 'building'; // Default icon if none set
        
        // Get department group terms
        $groups = get_the_terms(get_the_ID(), 'department_group');
        $group_class = $groups ? 'group-' . sanitize_title($groups[0]->name) : '';
        ?>
        
        <div class="department-card rounded-lg border bg-card text-card-foreground shadow-sm hover:shadow-lg transition-shadow duration-300 cursor-pointer hover:bg-gray-50 <?php echo esc_attr($group_class); ?>">
            <div class="flex flex-col space-y-1.5 p-6">
                <div class="flex items-center space-x-3">
                    <?php echo get_service_icon_svg($icon, $icon_class); ?>
                    <h3 class="font-semibold tracking-tight text-lg"><?php the_title(); ?></h3>
                </div>
            </div>
            <div class="p-6 pt-0">
                <?php if ($functions) : ?>
                    <p class="text-gray-600 mb-3"><?php echo wp_trim_words($functions, 15); ?></p>
                <?php endif; ?>
                <?php if ($email) : ?>
                    <p class="text-sm text-primary-500"><?php echo esc_html($email); ?></p>
                <?php endif; ?>
            </div>
        </div>
        
    <?php endwhile;
    wp_reset_postdata();
else : ?>
    <p>No departments found.</p>
<?php endif; ?>