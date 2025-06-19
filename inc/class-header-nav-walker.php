<?php 

class Header_Nav_Walker extends Walker_Nav_Menu {
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $is_current = in_array('current-menu-item', $classes);
        
        $output .= sprintf(
            '<a href="%s" class="font-semibold  transition-colors duration-300 relative group %s">%s<span class="absolute bottom-0 left-0 h-0.5 bg-primary transition-all duration-300 %s"></span></a>',
            esc_url($item->url),
            $is_current ? 'text-primary' : 'text-gray-700 hover:text-primary',
            esc_html($item->title),
            $is_current ? 'w-full' : 'w-0 group-hover:w-full'
        );
    }
}

class Mobile_Nav_Walker extends Walker_Nav_Menu {
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $is_current = in_array('current-menu-item', $classes);
        
        $output .= sprintf(
            '<a href="%s" class="block font-semibold  transition-colors duration-300 %s">%s</a>',
            esc_url($item->url),
            $is_current ? 'text-primary' : 'text-gray-700 hover:text-primary',
            esc_html($item->title)
        );
    }
}