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
 * Add support for Toolbelt features.
 *
 * @return void
 */
function jarvis_toolbelt_after_setup_theme() {

	// Infinite scroll.
	add_theme_support(
		'infinite-scroll',
		apply_filters(
			'jarvis_infinite_scroll',
			array(
				'render' => 'jarvis_toolbelt_infinite_scroll_render',
			)
		)
	);

}

add_filter( 'after_setup_theme', 'jarvis_toolbelt_after_setup_theme' );


/**
 * Render Toolbelt Infinite Scroll content.
 *
 * @return void
 */
function jarvis_toolbelt_infinite_scroll_render() {

	while ( have_posts() ) {

		the_post();
		get_template_part( 'parts/content', 'format-' . get_post_format() );

	}

}


/**
 * Change the related posts thumbnail size.
 *
 * @return string
 */
function jarvis_toolbelt_related_posts_thumbnail_size() {

	return 'jarvis-archive';

}

add_filter( 'toolbelt_related_posts_thumbnail_size', 'jarvis_toolbelt_related_posts_thumbnail_size' );


/**
 * Display related posts.
 *
 * @return void
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
 *
 * @return void
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


/**
 * Hide breadcrumbs on Toolbelt Projects archives.
 *
 * @return boolean
 */
function jarvis_diplay_breadcrumbs() {

	if ( is_post_type_archive( 'toolbelt-portfolio' ) || is_tax( 'toolbelt-portfolio-type' ) ) {
		return false;
	}

	return true;

}

add_filter( 'toolbelt_display_breadcrumbs', 'jarvis_diplay_breadcrumbs' );


/**
 * Display Plugin Styles.
 *
 * @return void
 */
function jarvis_toolbelt_styles() {

	if ( defined( 'TOOLBELT_VERSION' ) ) {
		jarvis_print_plugin_css( 'toolbelt' );
	}

}

add_action( 'wp_body_open', 'jarvis_toolbelt_styles' );


/**
 * Add random posts shorttag to credits content.
 *
 * @param string $contents The html credits.
 * @return string
 */
function jarvis_toolbelt_random_post_tag( $contents ) {

	$random_link = '';

	/**
	 * If the random redirect function exists then we will set the link.
	 *
	 * If it doesn't exist the link will remain empty, and so the short tag will
	 * be removed.
	 */
	if ( function_exists( 'toolbelt_random_redirect' ) ) {
		$random_link = '<a href="' . esc_url( site_url( '/?random' ) ) . '">%s</a>';
	}

	$contents = str_ireplace( '(?)', sprintf( $random_link, esc_html__( '?', 'jarvis' ) ), $contents );
	$contents = str_ireplace( '(RANDOM)', sprintf( $random_link, esc_html__( 'Random', 'jarvis' ) ), $contents );

	return $contents;

}

add_filter( 'jarvis_footer_content', 'jarvis_toolbelt_random_post_tag' );


/**
 * Add the random redirect shorttags to the customizer instructions.
 *
 * @param array<string> $description List of shorttags for.
 * @return array<string>
 */
function jarvis_toolbelt_customizer_credits_description( $description ) {

	$new_description = array();

	/**
	 * Add the extra tags if the random redirect function is enabled.
	 */
	if ( function_exists( 'toolbelt_random_redirect' ) ) {

		$new_description[] = '<li>' . __( '<strong>(?)</strong>: Random Redirect with "?" link', 'jarvis' ) . '</li>';
		$new_description[] = '<li>' . __( '<strong>(random)</strong>: Random Redirect with "random" link', 'jarvis' ) . '</li>';

	}

	if ( count( $new_description ) > 0 ) {

		$position = array_search( '</ul>', $description, true );
		array_splice( $description, $position, 0, $new_description );

	}

	return $description;

}

add_filter( 'jarvis_customizer_credits_description', 'jarvis_toolbelt_customizer_credits_description' );
