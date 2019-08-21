<?php
/**
 * WP Post Series
 *
 * @package Jarvis
 */

/**
 * Change the related posts thumbnail size.
 */
function jarvis_toolbelt_related_posts_thumbnail_size() {

	return 'jarvis-archive';

}

add_filter( 'toolbelt_related_posts_thumbnail_size', 'jarvis_toolbelt_related_posts_thumbnail_size' );


/**
 * Display related posts.
 */
function jarvis_related_posts() {

	if ( function_exists( 'toolbelt_related_posts_get' ) ) {
		echo toolbelt_related_posts_get();
	}

}

/**
 * Disable the default related posts output.
 * Jarvis adds the posts after the comments.
 */
add_filter( 'toolbelt_related_posts', '__return_false' );
