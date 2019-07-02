<?php
/**
 * Actions and Filters That Modify WordPress html & css classes.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package Jarvis
 * @subpackage WordPress
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

/**
 * Add additional body classes to body_class function call.
 *
 * @param array $classes Array of body classes.
 * @return array
 */
function jarvis_body_class( $classes ) {

	if ( is_multi_author() ) {
		$classes[] = 'multi-author-true';
	} else {
		$classes[] = 'multi-author-false';
	}

	if ( is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'themes-sidebar1-active';
	}

	if ( is_active_sidebar( 'sidebar-2' ) ) {
		$classes[] = 'themes-sidebar2-active';
	}

	if ( display_header_text() ) {
		$classes[] = 'has-site-title';
	}

	if ( get_header_image() ) {
		$classes[] = 'has-custom-header';
	}

	if ( ! is_singular() && ! is_404() ) {
		$classes[] = 'hfeed';
	}

	return $classes;

}

add_filter( 'body_class', 'jarvis_body_class' );


/**
 * Add additional post classes to post_class function call.
 *
 * @link https://core.trac.wordpress.org/ticket/28482
 * @param array  $classes Array of post classes.
 * @param string $class An array of additional class names added to the post.
 * @param int    $post_id The id of the post.
 * @return array
 */
function jarvis_post_class( $classes, $class, $post_id ) {

	if ( is_admin() ) {
		return $classes;
	}

	$post = get_post( $post_id );
	$image = get_the_post_thumbnail( $post_id );

	// Entry class.
	$classes[] = 'entry';

	// Post field classes.
	$classes[] = sprintf( 'entry--%s', $post_id );
	$classes[] = sprintf( 'entry--type-%s', get_post_type() );

	// Author class.
	$classes[] = sprintf(
		'entry--author-%s',
		sanitize_html_class( get_the_author_meta( 'user_nicename' ), get_the_author_meta( 'ID' ) )
	);

	// Image thumbnail classes.
	if ( $image ) {
		$classes[] = 'entry--thumbnail-true';
	} else {
		$classes[] = 'entry--thumbnail-false';
	}

	/**
	 * Remove this if you need to add text contrast based upon featured images.
	if ( isset( $image[0] ) ) {

		$tone = jarvis_image_tone( $image[0] );

		if ( $tone ) {
			$classes[] = 'entry--tone-' . $tone;
		}
	}
	 */

	return $classes;

}

add_filter( 'post_class', 'jarvis_post_class', 10, 3 );
