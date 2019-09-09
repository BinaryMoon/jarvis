<?php
/**
 * WP Toolbelt
 *
 * @see https://wordpress.org/plugins/wp-toolbelt/
 *
 * Toolbelt styles are customized in:
 * @see https://github.com/BinaryMoon/jarvis/blob/master/assets/sass/lib/plugins/_toolbelt.scss
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
		/**
		 * Output Toolbelt related posts.
		 *
		 * This is fully escaped on the plugin so there's no need to escape it
		 * again.
		 */
		echo toolbelt_related_posts_get(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

}


/**
 * Disable the default related posts output.
 * Jarvis adds the posts after the comments.
 */
add_filter( 'toolbelt_related_posts', '__return_false' );


/**
 * Use Toolbelt video wrapper if it exists.
 *
 * @param string $html The html to wrap.
 * @return string
 */
function jarvis_video_wrapper( $html ) {

	if ( function_exists( 'toolbelt_responsive_video_embed_html' ) ) {

		return toolbelt_responsive_video_embed_html( $html );

	}

	return $html;

}
