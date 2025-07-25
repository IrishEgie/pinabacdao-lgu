<?php
/**
 * Need Help Section - Redesigned
 * 
 * @package your-theme-name
 * 
 * Dynamic arguments:
 * @param array $need_help_args {
 *     @type string $title         Section title
 *     @type string $description   Help description text
 *     @type array  $contact_info  Contact information (phone, email)
 *     @type string $mt_class      Margin top class
 *     @type string $bg_color      Background color class
 *     @type string $text_color    Text color class
 *     @type array  $button        Button settings
 * }
 */

if (!function_exists('display_need_help_section')) {
    function display_need_help_section($args = array()) {
        $defaults = array(
            'title' => 'Need Immediate Assistance?',
            'description' => 'For urgent matters or emergencies, please contact us directly by phone or visit our office during business hours.',
            'contact_info' => array(
                'phone' => '(555) 123-4567',
                'email' => 'info@municipality.gov'
            ),
            'mt_class' => '',
            'bg_color' => 'bg-primary-50',
            'text_color' => 'text-gray-800',
            'button' => array(
                'call_text' => 'Call Now',
                'email_text' => 'Send Email',
                'call_class' => 'border border-primary-600 text-primary-600 hover:bg-primary-600 hover:text-white',
                'email_class' => 'bg-primary-600 hover:bg-primary-500 text-white'
            )
        );
        
        $args = wp_parse_args($args, $defaults);
        set_query_var('need_help_args', $args);
        get_template_part('template-parts/sections/need-help');
    }
}

// Display the template if called directly
if (get_query_var('need_help_args')) {
    $args = get_query_var('need_help_args');
    ?>
    <div class="rounded-lg border text-card-foreground shadow-sm hover:shadow-lg <?php echo esc_attr($args['bg_color']); ?> p-6 <?php echo esc_attr($args['mt_class']); ?>">
        <div class="p-8 text-center">
            <h3 class="text-2xl font-bold <?php echo esc_attr($args['text_color']); ?> mb-4">
                <?php echo esc_html($args['title']); ?>
            </h3>
            <p class="text-gray-600 mb-6">
                <?php echo esc_html($args['description']); ?>
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <?php if (!empty($args['contact_info']['phone'])) : ?>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $args['contact_info']['phone'])); ?>" 
                       class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 h-10 px-4 py-2 <?php echo esc_attr($args['button']['call_class']); ?>">
                        <?php echo get_service_icon_svg('phone', 'w-4 h-4 mr-2'); ?>
                        <?php echo esc_html($args['button']['call_text']); ?>
                    </a>
                <?php endif; ?>
                
                <?php if (!empty($args['contact_info']['email'])) : ?>
                    <a href="mailto:<?php echo esc_attr($args['contact_info']['email']); ?>" 
                       class="inline-flex items-center justify-center px-6 py-3 font-medium rounded-md transition-colors duration-300 <?php echo esc_attr($args['button']['email_class']); ?>">
                        <?php echo esc_html($args['button']['email_text']); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
}
?>