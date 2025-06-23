<?php 

class Header_Nav_Walker extends Walker_Nav_Menu {
    public function start_lvl(&$output, $depth = 0, $args = null) {
        if ($depth === 0) {
            $output .= '<div class="dropdown-menu absolute left-0 top-full mt-1 w-80 bg-white border border-gray-200 rounded-md shadow-lg z-50">';
            $output .= '<div class="p-2">';
        }
    }

    public function end_lvl(&$output, $depth = 0, $args = null) {
        if ($depth === 0) {
            $output .= '</div></div>';
        }
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $is_current = in_array('current-menu-item', $classes);
        $has_children = in_array('menu-item-has-children', $classes);
        
        if ($depth === 0) {
            $output .= '<li class="relative group">';
            
            $output .= sprintf(
                '<a href="%s" class="flex items-center px-4 py-2 text-sm font-medium transition-colors duration-300 rounded-md %s relative">
                    %s
                    %s
                    <span class="nav-link-underline %s"></span>
                </a>',
                esc_url($item->url),
                $is_current ? 'text-primary' : 'text-gray-700 hover:text-primary',
                esc_html($item->title),
                $has_children ? '<svg class="chevron-down ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>' : '',
                $is_current ? 'w-full' : 'w-0 group-hover:w-full'
            );
        } else {
            $output .= sprintf(
                '<a href="%s" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary rounded-md transition-colors">%s</a>',
                esc_url($item->url),
                esc_html($item->title)
            );
        }
    }

    public function end_el(&$output, $item, $depth = 0, $args = null) {
        if ($depth === 0) {
            $output .= '</li>';
        }
    }
}

class Mobile_Nav_Walker extends Walker_Nav_Menu {
    public function start_lvl(&$output, $depth = 0, $args = null) {
        $output .= '<div class="pl-4 mt-2 space-y-2">';
    }

    public function end_lvl(&$output, $depth = 0, $args = null) {
        $output .= '</div>';
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $is_current = in_array('current-menu-item', $classes);
        $has_children = in_array('menu-item-has-children', $classes);
        
        $output .= '<div class="space-y-2">';
        
        $output .= sprintf(
            '<a href="%s" class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium transition-colors duration-300 rounded-md %s">%s%s</a>',
            esc_url($item->url),
            $is_current ? 'text-primary' : 'text-gray-700 hover:text-primary',
            esc_html($item->title),
            $has_children ? '<svg class="w-4 h-4 transform transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>' : ''
        );
    }

    public function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= '</div>';
    }
}