<?php
class Simple_Footer_Menu_Walker extends Walker_Nav_Menu {
    public function start_lvl(&$output, $depth = 0, $args = null) {
        // Don't output any additional markup for submenus
        $output = '';
    }

    public function end_lvl(&$output, $depth = 0, $args = null) {
        // Don't output any additional markup for submenus
        $output = '';
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $output .= '<li>';
        
        $attributes  = ! empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= ! empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= ! empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= ! empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        
        // Changed hover:text-white to hover:text-primary
        $output .= '<a' . $attributes . ' class="text-gray-400 hover:text-primary transition-colors duration-300">';
        $output .= esc_html($item->title);
        $output .= '</a>';
    }

    public function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= '</li>';
    }
}