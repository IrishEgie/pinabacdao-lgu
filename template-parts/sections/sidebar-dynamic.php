<?php
/**
 * Dynamic Sidebar Container
 * 
 * @param array $args {
 *     @type string $title        - Container title
 *     @type string $subtitle     - Container subtitle (optional)
 *     @type array  $button       - Button configuration (optional)
 *     @type array  $content      - Content rows configuration
 *     @type string $container_id - Unique ID for the container (optional)
 * }
 */

// Set defaults
$args = wp_parse_args($args, [
    'title' => '',
    'subtitle' => '',
    'button' => [
        'show' => false,
        'icon' => '',
        'text' => 'Button',
        'alignment' => 'left',
        'url' => '#',
        'target' => '_self'
    ],
    'content' => [],
    'container_id' => '',
    'container_class' => 'bg-white rounded-lg shadow-md p-6 mb-6'
]);
?>

<div id="<?php echo esc_attr($args['container_id']); ?>" class="<?php echo esc_attr($args['container_class']); ?>">
    <div class="border-b pb-3 mb-4">
        <h3 class="text-lg font-semibold text-gray-800"><?php echo esc_html($args['title']); ?></h3>
        <?php if ($args['subtitle']) : ?>
            <p class="text-sm text-gray-500 mt-1"><?php echo esc_html($args['subtitle']); ?></p>
        <?php endif; ?>
    </div>
    
    <div class="space-y-4">
        <?php 
        foreach ($args['content'] as $row) {
            $row_defaults = [
                'type' => 'text', // text, link, button, list
                'title' => '',
                'content' => '',
                'icon' => '',
                'link' => '#',
                'target' => '_self',
                'class' => ''
            ];
            $row = wp_parse_args($row, $row_defaults);
            
            echo '<div class="'.esc_attr($row['class']).'">';
            
            if ($row['title']) {
                echo '<h4 class="text-sm font-sm text-gray-500 mb-1">'.esc_html($row['title']).'</h4>';
            }
            
            switch ($row['type']) {
                case 'text':
                    echo '<div class="text-gray-700 text-sm italic flex items-center">';
                    if ($row['icon']) {
                        echo '<span class="mr-2">'.get_service_icon_svg($row['icon'], 'w-4 h-4').'</span>';
                    }
                    echo empty($row['content']) ? '<span class="text-gray-400 italic">No data available</span>' : esc_html($row['content']);
                    echo '</div>';
                    break;
                    
                case 'link':
                    echo '<a href="'.esc_url($row['link']).'" target="'.esc_attr($row['target']).'" class="text-gray-700 hover:text-primary-500 transition-colors flex items-center">';
                    if ($row['icon']) {
                        echo '<span class="mr-2">'.get_service_icon_svg($row['icon'], 'w-4 h-4').'</span>';
                    }
                    echo empty($row['content']) ? '<span class="text-gray-400 italic">No data available</span>' : esc_html($row['content']);
                    echo '</a>';
                    break;
                    
                case 'list':
                    $items = is_array($row['content']) ? $row['content'] : explode("\n", $row['content']);
                    if (empty($items)) {
                        echo '<span class="text-gray-400 italic">No data available</span>';
                    } else {
                        echo '<ul class="list-disc pl-5 text-gray-700 space-y-1">';
                        foreach ($items as $item) {
                            echo '<li>'.esc_html(trim($item)).'</li>';
                        }
                        echo '</ul>';
                    }
                    break;
            }
            
            echo '</div>';
        }
        ?>
    </div>
    
    <?php if ($args['button']['show']) : ?>
        <div class="mt-4 text-<?php echo esc_attr($args['button']['alignment']); ?>">
            <a href="<?php echo esc_url($args['button']['url']); ?>" 
               target="<?php echo esc_attr($args['button']['target']); ?>" 
               class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                <?php if ($args['button']['icon']) : ?>
                    <span class="mr-2"><?php echo get_service_icon_svg($args['button']['icon'], 'w-4 h-4'); ?></span>
                <?php endif; ?>
                <?php echo esc_html($args['button']['text']); ?>
            </a>
        </div>
    <?php endif; ?>
</div>