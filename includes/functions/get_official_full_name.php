<?php
/**
 * Official Name Helper Functions
 * 
 * This file contains all functions related to getting and formatting
 * official names from the 'official' post type
 */

if (!function_exists('get_official_full_name')) {
    /**
     * Get the full name of an official from ACF fields
     * 
     * @param int $post_id The post ID of the official (optional, defaults to current post)
     * @return string The formatted full name
     */
    function get_official_full_name($post_id = null) {
        // Use current post ID if none provided
        if (!$post_id) {
            $post_id = get_the_ID();
        }
        
        // Return early if no valid post ID
        if (!$post_id) {
            return '';
        }
        
        // Get the official_name field from ACF
        $name = get_field('official_name', $post_id);
        
        // Fallback to post title if no ACF field data
        if (!$name || !is_array($name)) {
            return get_the_title($post_id);
        }

        // Build the full name from components
        $name_parts = [];
        
        // Add first name (required)
        if (!empty($name['first_name'])) {
            $name_parts[] = trim($name['first_name']);
        }
        
        // Add middle name (optional)
        if (!empty($name['middle_name'])) {
            $name_parts[] = trim($name['middle_name']);
        }
        
        // Add last name (required)
        if (!empty($name['last_name'])) {
            $name_parts[] = trim($name['last_name']);
        }
        
        // Add extension (Jr., Sr., III, etc.)
        if (!empty($name['extension'])) {
            $name_parts[] = trim($name['extension']);
        }

        // Join all parts with spaces and return
        return implode(' ', array_filter($name_parts));
    }
}

if (!function_exists('get_official_short_name')) {
    /**
     * Get a shortened version of the official's name (First + Last only)
     * 
     * @param int $post_id The post ID of the official
     * @return string The formatted short name
     */
    function get_official_short_name($post_id = null) {
        if (!$post_id) {
            $post_id = get_the_ID();
        }
        
        if (!$post_id) {
            return '';
        }
        
        $name = get_field('official_name', $post_id);
        
        if (!$name || !is_array($name)) {
            return get_the_title($post_id);
        }

        $name_parts = [];
        
        if (!empty($name['first_name'])) {
            $name_parts[] = trim($name['first_name']);
        }
        
        if (!empty($name['last_name'])) {
            $name_parts[] = trim($name['last_name']);
        }

        return implode(' ', array_filter($name_parts));
    }
}

if (!function_exists('get_official_display_name')) {
    /**
     * Get the display name based on context (formal with title, or just name)
     * 
     * @param int $post_id The post ID of the official
     * @param bool $include_title Whether to include the official title/position
     * @return string The formatted display name
     */
    function get_official_display_name($post_id = null, $include_title = false) {
        if (!$post_id) {
            $post_id = get_the_ID();
        }
        
        $full_name = get_official_full_name($post_id);
        
        if (!$include_title) {
            return $full_name;
        }
        
        $position = get_field('position', $post_id);
        
        if ($position) {
            return $position . ' ' . $full_name;
        }
        
        return $full_name;
    }
}