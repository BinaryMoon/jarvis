<?php
/**
 * Social Media Menu.
 *
 * Replaces links to social media websites with svg icons.
 *
 * @package Jarvis
 * @subpackage WordPress
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

/**
 * Display SVG icons in social navigation.
 *
 * @since 1.0.0
 *
 * @param  string  $item_output The menu item output.
 * @param  WP_Post $item        Menu item object.
 * @param  int     $depth       Depth of the menu.
 * @param  array   $args        wp_nav_menu() arguments.
 * @return string  $item_output The menu item output with social icon.
 */
function jarvis_nav_social_icons( $item_output, $item, $depth, $args ) {

	// Quit early if it's the wrong menu.
	if ( 'social' !== $args->theme_location ) {
		return $item_output;
	}

	// Get supported social icons.
	$social_icons = jarvis_social_links_icons();

	// Change SVG icon inside social links menu if there is supported URL.
	foreach ( $social_icons as $attr => $value ) {
		if ( false !== strpos( $item_output, $attr ) ) {
			$item_output = str_replace( $args->link_after, '</span>' . jarvis_svg( $value, false ), $item_output );
		}
	}

	return $item_output;

}

add_filter( 'walker_nav_menu_start_el', 'jarvis_nav_social_icons', 10, 4 );


/**
 * Embed an svg directly into the webpage.
 *
 * @param string $key The key for the svg file. This is the filename without the .svg.
 * @return null
 */
function jarvis_svg( $key, $echo = true ) {

	$file_path = get_parent_theme_file_path( 'assets/svg/' . $key . '.svg' );

	/**
	 * Grab the local file and store it to output or return.
	 */
	$file = file_get_contents( $file_path );

	if ( ! $echo ) {

		return $file;

	}

	/**
	 * $file is loaded above from a static svg file so is safe to output
	 * directly.
	 */
	echo $file; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

}


/**
 * Returns an array of supported social links (URL and icon name).
 *
 * @return array $social_links_icons
 */
function jarvis_social_links_icons() {

	$social_links_icons = array(
		'behance.net'     => 'behance',
		// 'codepen.io'      => 'codepen',
		'deviantart.com'  => 'deviantart',
		'dribbble.com'    => 'dribbble',
		'facebook.com'    => 'facebook',
		'flickr.com'      => 'flickr',
		// 'foursquare.com'  => 'foursquare',
		'github.com'      => 'github',
		'instagram.com'   => 'instagram',
		'linkedin.com'    => 'linkedin',
		'mailto:'         => 'email',
		'medium.com'      => 'medium',
		'pinterest.com'   => 'pinterest',
		// 'getpocket.com'   => 'get-pocket',
		'reddit.com'      => 'reddit',
		'skype.com'       => 'skype',
		'skype:'          => 'skype',
		// 'slideshare.net'  => 'slideshare',
		'snapchat.com'    => 'snapchat',
		'soundcloud.com'  => 'soundcloud',
		'tumblr.com'      => 'tumblr',
		'twitch.tv'       => 'twitch',
		'twitter.com'     => 'twitter',
		'vimeo.com'       => 'vimeo',
		'vk.com'          => 'vk',
		// 'weibo.com'       => 'weibo',
		'wordpress.org'   => 'wordpress',
		'wordpress.com'   => 'wordpress',
		// 'yelp.com'        => 'yelp',
		'youtube.com'     => 'youtube',
	);

	return apply_filters( 'jarvis_social_links_icons', $social_links_icons );

}
