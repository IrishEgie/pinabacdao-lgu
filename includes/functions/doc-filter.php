<?php
/**
 * Document Archive Filter Functions
 */

/**
 * Get unique years from documents
 */
function get_document_years() {
    global $wpdb;
    
    $years = $wpdb->get_col("
        SELECT DISTINCT YEAR(meta_value) 
        FROM $wpdb->postmeta 
        WHERE meta_key = 'document_date_issued' 
        ORDER BY meta_value DESC
    ");
    
    return $years ? $years : [];
}

/**
 * Modify document query based on filters
 */
function filter_documents_query($query) {
    if (is_admin() || !$query->is_main_query() || !is_post_type_archive('document')) {
        return;
    }
    
    $meta_query = [];
    
    // Search filter
    if (isset($_GET['document_search']) && !empty($_GET['document_search'])) {
        $query->set('s', sanitize_text_field($_GET['document_search']));
    }
    
    // Document type filter
    if (isset($_GET['document_type']) && !empty($_GET['document_type'])) {
        $query->set('tax_query', [
            [
                'taxonomy' => 'document_type',
                'field' => 'slug',
                'terms' => sanitize_text_field($_GET['document_type']),
            ]
        ]);
    }
    
    // Year filter
    if (isset($_GET['document_year']) && !empty($_GET['document_year'])) {
        $meta_query[] = [
            'key' => 'document_date_issued',
            'value' => sanitize_text_field($_GET['document_year']),
            'compare' => 'LIKE',
        ];
    }
    
    // Month filter
    if (isset($_GET['document_month']) && !empty($_GET['document_month'])) {
        $meta_query[] = [
            'key' => 'document_date_issued',
            'value' => '-' . str_pad(sanitize_text_field($_GET['document_month']), 2, '0', STR_PAD_LEFT) . '-',
            'compare' => 'LIKE',
        ];
    }
    
    // Office filter
    if (isset($_GET['document_office']) && !empty($_GET['document_office'])) {
        $meta_query[] = [
            'key' => 'document_issuing_office',
            'value' => sanitize_text_field($_GET['document_office']),
            'compare' => '=',
        ];
    }
    
    if (!empty($meta_query)) {
        $query->set('meta_query', $meta_query);
    }
}
add_action('pre_get_posts', 'filter_documents_query');