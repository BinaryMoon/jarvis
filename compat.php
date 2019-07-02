<?php
/**
 * Add compatability functions for new WordPress features.
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
 * Add the wp_body_open function.
 *
 * @link https://make.wordpress.org/themes/2019/03/29/addition-of-new-wp_body_open-hook
 */
if ( ! function_exists( 'wp_body_open' ) ) {
	/**
	 * Add a wp_body_open filter.
	 */
	function wp_body_open() {
			do_action( 'wp_body_open' );
	}
}
