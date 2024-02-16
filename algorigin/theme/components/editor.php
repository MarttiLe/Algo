<?php

/* ***************************************************************************** */
/* BLOCK EDITOR (GUTENBERG) CUSTOMIZATIONS                                       */
/* ***************************************************************************** */
/* Change block editor defaults                                                  */
/* Customize and add/remove items as needed                                      */
/* ***************************************************************************** */


// CUSTOMIZE BLOCKS AVAILABLE IN THE THEME
// Full block list can be found here: https://wordpress.org/support/article/blocks/
function theme_supported_gutenberg_blocks( $allowed_blocks, $post ) {
	$allowed_blocks = [
		// Common blocks
		'core/image',
		'core/video',
		'core/paragraph',
		'core/heading',
		'core/list',
		'core/quote',
		// Formatting blocks
		'core/table',
		'core/code',
		'core/html',
		// Layout blocks
		'core/columns',
		'core/media-text',
		'core/buttons',
		'core/separator',
		'core/spacer',
		// Widget blocks
		'core/shortcode',
		// Embeds blocks
		'core/embed',
	];

	return $allowed_blocks;
}
add_filter( 'allowed_block_types_all', 'theme_supported_gutenberg_blocks', 10, 2 );


// ADD CUSTOM COLOR SCHEMES
add_theme_support( 'editor-color-palette', [
	[
		'name'  => __( 'Brand light', 'algorigin-theme' ),
		'slug'  => 'brand_light',
		'color'	=> '#e5f0e4',
	],
	[
		'name'  => __( 'Brand dark', 'algorigin-theme' ),
		'slug'  => 'brand_dark',
		'color'	=> '#263938',
	],
	[
		'name'	=> __( 'Brand gray light', 'algorigin-theme' ),
		'slug'	=> 'brand_gray_light',
		'color'	=> '#cecece',
	],
	[
		'name'	=> __( 'Brand gray', 'algorigin-theme' ),
		'slug'	=> 'brand_gray',
		'color'	=> '#9b9b9b',
	],
	[
		'name'	=> __( 'Brand gray dark', 'algorigin-theme' ),
		'slug'	=> 'brand_gray_dark',
		'color'	=> '#6c6c6c',
	]
]);


// CUSTOM THEME BLOCK CATEGORIES
function theme_block_categories( $categories, $post ) {
    if ( $post->post_type !== 'post' ) {
        return $categories;
    }
    return array_merge(
        $categories,
        [
            [
                'slug' => 'theme-blocks',
                'title' => __( 'Theme custom blocks', 'algorigin-theme' ),
                'icon'  => 'star-filled',
            ],
		]
    );
}
//add_filter( 'block_categories', 'theme_block_categories', 10, 2 );