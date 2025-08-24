<?php
/**
 * Template Name: Test Page
 * Description: WordPress template matching SinglePost React component
 */

get_header();
?>

<?php
$department_heads = new WP_Query([
    'post_type' => 'official',
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'tax_query' => [
        [
            'taxonomy' => 'official_type',
            'field' => 'slug',
            'terms' => 'department-heads',
        ]
    ],
]);

if ($department_heads->have_posts()) {
    while ($department_heads->have_posts()) {
        $department_heads->the_post();
        compactOfficialCard(['post_id' => get_the_ID()]);
    }
    wp_reset_postdata();
} else {
    echo '<p class=" text-center col-span-full text-gray-500">No administrative officials found.</p>';
}
?>

<?php get_footer() ?>