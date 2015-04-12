<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package PixelHunter
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function pixel_hunter_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'pixel_hunter_jetpack_setup' );

/**
 * Removing the 'Older posts' and 'Newer posts' links when infinite scroll is active
 */
function pixel_hunter_remove_pagination_on_infinte_scroll(){
	if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ){
		echo '<style>.paging-navigation{display:none;}</style>';
	}
}
add_action('wp_head','pixel_hunter_remove_pagination_on_infinte_scroll');
