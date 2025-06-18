<?php
/**
 * Breadcrumbs Functionality
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Generate breadcrumb items based on current page
 */
function get_wp_breadcrumbs() {
    $items = array();
    $home_title = __('Home', 'your-text-domain');
    
    // Always start with home (unless we're on home)
    if (!is_front_page()) {
        $items[] = array('label' => $home_title, 'href' => home_url('/'));
    }
    
    if (is_singular()) {
        $items = array_merge($items, handle_singular_breadcrumbs());
    } 
    elseif (is_archive()) {
        $items = array_merge($items, handle_archive_breadcrumbs());
    } 
    elseif (is_search()) {
        $items[] = array('label' => sprintf(__('Search Results for "%s"', 'your-text-domain'), esc_html(get_search_query())));
    } 
    elseif (is_404()) {
        $items[] = array('label' => __('Page Not Found', 'your-text-domain'));
    }
    
    return apply_filters('wp_breadcrumb_items', $items);
}

/**
 * Handle singular content types
 */
function handle_singular_breadcrumbs() {
    $items = array();
    
    // Posts - add category
    if (is_single() && 'post' === get_post_type()) {
        $categories = get_the_category();
        if (!empty($categories)) {
            $primary_category = apply_filters('breadcrumb_primary_category', $categories[0], $categories);
            $items[] = array(
                'label' => esc_html($primary_category->name),
                'href' => esc_url(get_category_link($primary_category->term_id))
            );
        }
    }
    
    // Pages - add hierarchy
    if (is_page()) {
        $ancestors = get_post_ancestors(get_the_ID());
        if (!empty($ancestors)) {
            foreach (array_reverse($ancestors) as $ancestor) {
                $items[] = array(
                    'label' => esc_html(get_the_title($ancestor)),
                    'href' => esc_url(get_permalink($ancestor))
                );
            }
        }
    }
    
    // Custom post types - add archive link
    if (is_singular() && !is_page() && !is_single()) {
        $post_type = get_post_type_object(get_post_type());
        if ($post_type && $post_type->has_archive) {
            $items[] = array(
                'label' => esc_html($post_type->labels->name),
                'href' => esc_url(get_post_type_archive_link(get_post_type()))
            );
        }
    }
    
    // Current item (no link)
    $items[] = array('label' => esc_html(get_the_title()));
    
    return $items;
}

/**
 * Handle archive pages
 */
function handle_archive_breadcrumbs() {
    $items = array();
    
    if (is_category() || is_tag() || is_tax()) {
        $term = get_queried_object();
        if ($term->parent) {
            $ancestors = get_ancestors($term->term_id, $term->taxonomy);
            foreach (array_reverse($ancestors) as $ancestor) {
                $ancestor_term = get_term($ancestor);
                $items[] = array(
                    'label' => esc_html($ancestor_term->name),
                    'href' => esc_url(get_term_link($ancestor_term))
                );
            }
        }
        $items[] = array('label' => esc_html($term->name));
    } 
    elseif (is_author()) {
        $items[] = array('label' => esc_html(get_the_author()));
    } 
    elseif (is_date()) {
        if (is_day()) {
            $items[] = array('label' => esc_html(get_the_date()));
        } 
        elseif (is_month()) {
            $items[] = array('label' => esc_html(get_the_date('F Y')));
        } 
        elseif (is_year()) {
            $items[] = array('label' => esc_html(get_the_date('Y')));
        }
    } 
    elseif (is_post_type_archive()) {
        $items[] = array('label' => esc_html(post_type_archive_title('', false)));
    }
    
    return $items;
}

/**
 * Initialize breadcrumbs
 */
function setup_breadcrumbs() {
    // Add any initialization code here
    // Example: add_filter('breadcrumb_primary_category', 'your_custom_filter', 10, 2);
}
add_action('after_setup_theme', 'setup_breadcrumbs');