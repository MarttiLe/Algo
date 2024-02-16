<?php

/* ***************************************************************************** */
/* THEME CUSTOM POST TYPES                                                       */
/* ***************************************************************************** */
/* Define all custom post types, taxonomies & statuses here                      */
/* Customize and add/remove items as needed                                      */
/* ***************************************************************************** */


// CUSTOM POST TYPES
function theme_custom_post_types() {

    // Sample post type
    register_post_type('faq', [
        'labels' => [
            'name' => __('FAQs', 'algorigin-theme'),
            'singular_name' => __('FAQ item', 'algorigin-theme'),
            'all_items' => __('All FAQ items', 'algorigin-theme'),
            'add_new' => __('Add new', 'algorigin-theme'),
            'add_new_item' => __('Add item', 'algorigin-theme'),
            'edit' => __('Edit', 'algorigin-theme'),
            'edit_item' => __('Edit item', 'algorigin-theme'),
            'new_item' => __('New item', 'algorigin-theme'),
            'view_item' => __('View item', 'algorigin-theme'),
            'search_items' => __('Search for items', 'algorigin-theme'),
            'not_found' => __('No items found', 'algorigin-theme'),
            'not_found_in_trash' => __('Trash is empty', 'algorigin-theme'),
            'parent_item_colon' => ''
        ],
        'description' => __('FAQ items', 'algorigin-theme'),
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'show_ui' => true,
        'query_var' => true,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-info',
        'has_archive' => false,
        'rewrite' => [
            'slug' => 'faq',
            'with_front' => false
        ],
        'capability_type' => 'post',
        'hierarchical' => false,
        'show_in_rest' => false,
        'supports' => [
            'title'
        ],
        'taxonomies' => [],
    ]);

}
add_action('init', 'theme_custom_post_types');


// CUSTOM TAXONOMIES
function theme_custom_taxonomies() {

    // Item categories taxonomy
	register_taxonomy( 'sample_category', 'sample', [
		'hierarchical'          => true,
		'labels'                => [
            'name'              => _x( 'Sample categories', 'taxonomy general name', 'algorigin-theme' ),
            'singular_name'     => _x( 'Sample category', 'taxonomy singular name', 'algorigin-theme' ),
            'search_items'      => __( 'Search categories', 'algorigin-theme' ),
            'all_items'         => __( 'All categories', 'algorigin-theme' ),
            'parent_item'       => __( 'Parent category', 'algorigin-theme' ),
            'parent_item_colon' => __( 'Parent category:', 'algorigin-theme' ),
            'edit_item'         => __( 'Edit category', 'algorigin-theme' ),
            'update_item'       => __( 'Update category', 'algorigin-theme' ),
            'add_new_item'      => __( 'Add new category', 'algorigin-theme' ),
            'new_item_name'     => __( 'New category name', 'algorigin-theme' ),
            'menu_name'         => __( 'Categories', 'algorigin-theme' ),
        ],
		'show_ui'               => true,
		'show_admin_column'     => true,
		'query_var'             => true,
		'rewrite'               => [
            'slug' => 'samples'
        ]
    ]);

}
//add_action('init', 'theme_custom_taxonomies');


// CUSTOM POST STATUSES
function theme_custom_post_statuses() {

    register_post_status('inactive', [
        'label' => __('Inactive', 'algorigin-theme'),
        'post_type' => ['item'],
        'public' => true,
        'exclude_from_search' => true,
        'show_in_admin_all_list' => true,
        'show_in_admin_status_list' => true,
        'label_count' => _n_noop('Inactive <span class="count">(%s)</span>', 'Inactive <span class="count">(%s)</span>', 'algorigin-theme'),
    ]);

}
//add_action('init', 'theme_custom_post_statuses');


?>