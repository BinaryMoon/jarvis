<?php
/**
 * Add compatability functions for new WordPress features.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * These functions can be removed once the required version reaches > 90% adoption.
 * {@link https://wordpress.org/about/stats/}
 *
 * @package Jarvis
 * @subpackage WordPress
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

/**
 * Add the wp_body_open function.
 * Introduced in WordPress 5.2
 *
 * @link https://make.wordpress.org/themes/2019/03/29/addition-of-new-wp_body_open-hook
 */
if ( ! function_exists( 'wp_body_open' ) ) {
	/**
	 * Add a wp_body_open filter.
	 */
	function wp_body_open() { // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedFunctionFound

			do_action( 'wp_body_open' ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound

	}

}
