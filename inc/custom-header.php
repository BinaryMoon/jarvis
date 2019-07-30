<?php
/**
 * Custom Header
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Jarvis
 * @subpackage CustomHeader
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

/**
 * Add theme support for Custom Header image.
 *
 * Sets the default properties and the custom header callback {@see granule_colour_styles}.
 */
function jarvis_custom_header_support() {

	add_theme_support(
		'custom-header',
		apply_filters(
			'jarvis_custom_header',
			array(
				'default-text-color' => '000000',
				'random-default' => false,
				'width' => 1600,
				'height' => 900,
				'header-text' => false,
				'uploads' => true,
				'wp-head-callback' => '__return_false',
			)
		)
	);

}

add_action( 'after_setup_theme', 'jarvis_custom_header_support' );


/**
 * Print custom header styles.
 *
 * This includes showing and hiding elements, and changing the heading colours.
 */
function jarvis_title_styles() {

	$header_visibility = (int) get_theme_mod( 'jarvis_site_title', 0 );
	$styles = array();

	$hide = '{ clip: rect( 1px, 1px, 1px, 1px ); position: absolute; }';

	/**
	 * We don't need to set display/ visible properties since the items will display by default.
	 */

	// Hide the description.
	if ( 1 === $header_visibility ) {
		$styles[] = '.branding .site-description ' . $hide;
	}

	// Hide everything.
	if ( 2 === $header_visibility ) {
		$styles[] = '.branding .site-title, .branding .site-description ' . $hide;
	}

	$styles[] = 'body { --title-color: ' . get_theme_mod( 'jarvis_title_color', '#000000' ) . '}';

	return implode( $styles, ' ' );

}


/**
 * Calculate the colour brightness.
 *
 * @param string $color string The colour to calculate.
 * @param int    $lighter_than The brightness to check against.
 * @return boolean true if lighter than, false otherwise.
 */
function jarvis_colour_brightness( $color = false, $lighter_than = 130 ) {

	if ( ! $color ) {
		return 0;
	}

	$color = str_replace( '#', '', $color );

	// Calculate straight from RGB.
	$r = hexdec( $color[0] . $color[1] );
	$g = hexdec( $color[2] . $color[3] );
	$b = hexdec( $color[4] . $color[5] );

	return ( ( $r * 299 + $g * 587 + $b * 114 ) / 1000 > $lighter_than );

}


/**
 * Display header image and link to homepage.
 *
 * On singular pages display featured image if it is large enough to fill the
 * space. Uses get_queried_object_id in case the header image is called outside
 * the_loop (before the_post has been called) so that we can be sure featured
 * images are found.
 */
function jarvis_header() {

	$header_image = get_header_image();

	// Use custom headers on singular pages, but only if the image is large
	// enough.
	if ( is_singular() && get_theme_mod( 'jarvis_single_header', false ) ) {

		// Use get_queried_object_id so that the content id will always be found
		// in cases where $post has not been set.
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_queried_object_id() ), 'jarvis-header' );

		if ( ! empty( $image ) ) {

			$header_image = $image[0];

		}
	}

	// Output header image as background image on page header.
	if ( $header_image ) {

		return '.site-header { background-image: url( ' . esc_attr( $header_image ) . ' ); }';

	}

	return false;

}


/**
 * If the site has a header image defined.
 *
 * This checks for the normal header image, but also for the custom featured
 * image which will show in the same location and override the header image if
 * appropriate.
 *
 * The featured header image can be disabled in the customizer.
 */
function jarvis_has_header_image() {

	if ( get_header_image() ) {
		return true;
	}

	if ( is_singular() && get_theme_mod( 'jarvis_single_header', false ) ) {

		if ( has_post_thumbnail() ) {

			return true;

		}

	}

	return false;

}


/**
 * Get the class for the header height.
 *
 * This can vary between single posts, and all other pages (such as archives).
 * This function takes care of the different template types.
 */
function jarvis_header_height() {

	$header_height = 0;

	if ( is_singular() ) {

		$header_height = get_theme_mod( 'jarvis_single_header_height', 1 );

	} else {

		$header_height = get_theme_mod( 'jarvis_archive_header_height', 1 );

	}

	return 'header-height-' . (int) $header_height;

}
