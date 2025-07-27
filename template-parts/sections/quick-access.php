<?php
/**
 * Quick Access Section
 * 
 * @package your-theme-name
 * 
 * Dynamic arguments:
 * @param array $quick_access_args {
 *     @type string $title       Section title
 *     @type array  $items       Array of quick access items (each with icon, title, description, color)
 *     @type string $mt_class    Margin top class
 *     @type string $columns     Number of columns (2, 3, or 4)
 *     @type string $bg_color    Background color class
 *     @type string $hover_effect Hover effect class
 * }
 */

if (!function_exists('display_quick_access_section')) {
    function display_quick_access_section($args = array()) {
        $defaults = array(
            'title' => '',
            'items' => array(
                array(
                    'icon' => 'file-text',
                    'title' => 'Forms & Applications',
                    'description' => 'Download official forms',
                    'color' => 'primary-600',
                    'link' => '#'
                ),
                array(
                    'icon' => 'calendar',
                    'title' => 'Annual Reports',
                    'description' => 'View yearly summaries',
                    'color' => 'green-600',
                    'link' => '#'
                ),
                array(
                    'icon' => 'shield',
                    'title' => 'Policies',
                    'description' => 'Municipal regulations',
                    'color' => 'orange-600',
                    'link' => '#'
                ),
                array(
                    'icon' => 'search',
                    'title' => 'Search All',
                    'description' => 'Find specific documents',
                    'color' => 'purple-600',
                    'link' => '#'
                )
            ),
            'mt_class' => 'mt-12',
            'columns' => '4',
            'bg_color' => 'bg-white',
            'hover_effect' => 'hover:bg-gray-50',
            'card_border' => 'border',
            'wrapper_class' => ''
        );
        
        $args = wp_parse_args($args, $defaults);
        set_query_var('quick_access_args', $args);
        get_template_part('template-parts/sections/quick-access');
    }
}

// Display the template if called directly
if (get_query_var('quick_access_args')) {
    $args = get_query_var('quick_access_args');
    
    // Determine column classes
    $column_classes = [
        '2' => 'md:grid-cols-2',
        '3' => 'md:grid-cols-3 lg:grid-cols-3',
        '4' => 'md:grid-cols-2 lg:grid-cols-4'
    ];
    $grid_class = $column_classes[$args['columns']] ?? 'md:grid-cols-2 lg:grid-cols-4';
    ?>
    <div class="rounded-lg <?php echo esc_attr($args['card_border']); ?> <?php echo esc_attr($args['bg_color']); ?> shadow-sm hover:shadow-lg transition-shadow duration-300 <?php echo esc_attr($args['mt_class']); ?> <?php echo esc_attr($args['wrapper_class']); ?>">
        <div class="flex flex-col space-y-1.5 p-6">
            <h3 class="font-semibold tracking-tight text-2xl text-gray-800"><?php echo esc_html($args['title']); ?></h3>
        </div>
        <div class="p-6 pt-0">
            <div class="grid grid-cols-1 <?php echo esc_attr($grid_class); ?> gap-4">
                <?php foreach ($args['items'] as $item) : ?>
                    <a href="<?php echo esc_url($item['link']); ?>" class="block text-center p-4 <?php echo esc_attr($args['card_border']); ?> rounded-lg <?php echo esc_attr($args['hover_effect']); ?> transition-colors">
                        <?php 
                        echo get_service_icon_svg(
                            $item['icon'], 
                            'w-8 h-8 mx-auto mb-2 text-' . esc_attr($item['color'])
                        ); 
                        ?>
                        <h4 class="text-gray-700 font-semibold mb-1"><?php echo esc_html($item['title']); ?></h4>
                        <p class="text-sm text-gray-600"><?php echo esc_html($item['description']); ?></p>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php
}
?>