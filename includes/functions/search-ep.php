<?php

function register_search_endpoint() {
    register_rest_route('custom/v1', '/search', array(
        'methods' => 'GET',
        'callback' => 'handle_custom_search',
        'permission_callback' => '__return_true'
    ));
    
    // Add new endpoint for default content
    register_rest_route('custom/v1', '/search/default', array(
        'methods' => 'GET',
        'callback' => 'handle_default_content',
        'permission_callback' => '__return_true'
    ));
}
add_action('rest_api_init', 'register_search_endpoint');

function handle_default_content() {
    $per_page = 5; // Fewer items for default display
    
    // Initialize results array
    $results = [
        'general' => [],
        'news' => [],
        'documents' => []
    ];
    
    // Get latest general content
    $general_post_types = ['page', 'service', 'department', 'official'];
    $posts_query = new WP_Query([
        'post_type' => $general_post_types,
        'posts_per_page' => $per_page,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC'
    ]);
    
    foreach ($posts_query->posts as $post) {
        $post_type_label = '';
        switch($post->post_type) {
            case 'service':
                $post_type_label = 'Service';
                break;
            case 'department':
                $post_type_label = 'Department';
                break;
            case 'official':
                $post_type_label = 'Official';
                break;
            default:
                $post_type_label = 'Page';
        }
        
        $results['general'][] = [
            'title' => get_the_title($post),
            'link' => get_permalink($post),
            'excerpt' => wp_trim_words(get_the_excerpt($post) ?: get_the_content(null, false, $post), 20),
            'post_type' => $post_type_label
        ];
    }

    // Get latest news
    $news_post_types = ['news', 'events', 'announcements'];
    $news_query = new WP_Query([
        'post_type' => $news_post_types,
        'posts_per_page' => $per_page,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC'
    ]);
    
    foreach ($news_query->posts as $news) {
        $results['news'][] = [
            'title' => get_the_title($news),
            'link' => get_permalink($news),
            'excerpt' => wp_trim_words(get_the_excerpt($news) ?: get_the_content(null, false, $news), 20),
            'image' => get_the_post_thumbnail_url($news, 'medium') ?: ''
        ];
    }

    // Get latest documents
    $docs_query = new WP_Query([
        'post_type' => 'document',
        'posts_per_page' => $per_page,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
        'meta_query' => [
            [
                'key' => 'document_file',
                'compare' => 'EXISTS'
            ]
        ]
    ]);
    
    foreach ($docs_query->posts as $doc) {
        $document_file = get_field('document_file', $doc->ID);
        
        if (!$document_file || !isset($document_file['url'])) {
            continue;
        }
        
        $doc_types = get_the_terms($doc->ID, 'document_type');
        $doc_type = ($doc_types && !is_wp_error($doc_types)) ? $doc_types[0]->name : 'Document';
        
        $date_issued = get_field('document_date_issued', $doc->ID);
        $display_date = $date_issued ? date('M j, Y', strtotime($date_issued)) : get_the_date('M j, Y', $doc);
        
        $document_number = get_field('document_number', $doc->ID);
        $formatted_title = $document_number ? $document_number . ' - ' . get_the_title($doc) : get_the_title($doc);
        
        $results['documents'][] = [
            'title' => $formatted_title,
            'link' => $document_file['url'],
            'type' => $doc_type,
            'date' => $display_date
        ];
    }

    return new WP_REST_Response([
        'results' => $results,
        'message' => 'default_content'
    ], 200);
}

function handle_custom_search(WP_REST_Request $request) {
    $search_term = sanitize_text_field($request->get_param('term'));
    $page = absint($request->get_param('page')) ?: 1;
    $per_page = 10;
    
    // Initialize results array
    $results = [
        'general' => [],
        'news' => [],
        'documents' => []
    ];
    
    if (empty($search_term)) {
        return new WP_REST_Response([
            'results' => $results,
            'total' => [
                'general' => 0,
                'news' => 0,
                'documents' => 0
            ],
            'page' => $page,
            'per_page' => $per_page
        ], 200);
    }

    // Search general content (pages, services, departments, officials)
    $general_post_types = ['page', 'service', 'department', 'official'];
    $posts_query = new WP_Query([
        's' => $search_term,
        'post_type' => $general_post_types,
        'posts_per_page' => $per_page,
        'paged' => $page,
        'post_status' => 'publish'
    ]);
    
    foreach ($posts_query->posts as $post) {
        $post_type_label = '';
        switch($post->post_type) {
            case 'service':
                $post_type_label = 'Service';
                break;
            case 'department':
                $post_type_label = 'Department';
                break;
            case 'official':
                $post_type_label = 'Official';
                break;
            default:
                $post_type_label = 'Page';
        }
        
        $results['general'][] = [
            'title' => get_the_title($post),
            'link' => get_permalink($post),
            'excerpt' => wp_trim_words(get_the_excerpt($post) ?: get_the_content(null, false, $post), 20),
            'post_type' => $post_type_label
        ];
    }

    // Search news (includes news, events, announcements)
    $news_post_types = ['news', 'events', 'announcements'];
    $news_query = new WP_Query([
        's' => $search_term,
        'post_type' => $news_post_types,
        'posts_per_page' => $per_page,
        'paged' => $page,
        'post_status' => 'publish'
    ]);
    
    foreach ($news_query->posts as $news) {
        $results['news'][] = [
            'title' => get_the_title($news),
            'link' => get_permalink($news),
            'excerpt' => wp_trim_words(get_the_excerpt($news) ?: get_the_content(null, false, $news), 20),
            'image' => get_the_post_thumbnail_url($news, 'medium') ?: ''
        ];
    }

    // Search documents
    $docs_query = new WP_Query([
        's' => $search_term,
        'post_type' => 'document',
        'posts_per_page' => $per_page,
        'paged' => $page,
        'post_status' => 'publish',
        'meta_query' => [
            [
                'key' => 'document_file',
                'compare' => 'EXISTS'
            ]
        ]
    ]);
    
    foreach ($docs_query->posts as $doc) {
        // Get document file
        $document_file = get_field('document_file', $doc->ID);
        
        // Skip if no file attached
        if (!$document_file || !isset($document_file['url'])) {
            continue;
        }
        
        // Get document type from taxonomy
        $doc_types = get_the_terms($doc->ID, 'document_type');
        $doc_type = ($doc_types && !is_wp_error($doc_types)) ? $doc_types[0]->name : 'Document';
        
        // Get date issued or fall back to published date
        $date_issued = get_field('document_date_issued', $doc->ID);
        $display_date = $date_issued ? date('M j, Y', strtotime($date_issued)) : get_the_date('M j, Y', $doc);
        
        // Get document number for title formatting
        $document_number = get_field('document_number', $doc->ID);
        $formatted_title = $document_number ? $document_number . ' - ' . get_the_title($doc) : get_the_title($doc);
        
        $results['documents'][] = [
            'title' => $formatted_title,
            'link' => $document_file['url'], // Direct file URL instead of permalink
            'type' => $doc_type,
            'date' => $display_date
        ];
    }

    return new WP_REST_Response([
        'results' => $results,
        'total' => [
            'general' => $posts_query->found_posts,
            'news' => $news_query->found_posts,
            'documents' => $docs_query->found_posts
        ],
        'page' => $page,
        'per_page' => $per_page
    ], 200);
}