<?php
/**
 * Theme Functions Engine.
 *
 * This file is simply used as a wrapper to load other files that do all the
 * work.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * @package Jarvis
 * @subpackage Template
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

/**
 * DESIGN CHECKLIST
 * ---
 * test for possible text widows (titles, descriptions etc)
 * check letter-spacing - especially on large and small text
 */

/**
 * TODO BEFORE SUBMISSION
 * ---
 * ensure margins and paddings are consistent
 * test in incognito mode. Maybe consider defining columns for the different content?
 * test theme with and without jetpack
 * theme description
 * screenshot.png (880 x 660)
 * check sticky styles
 * style quotes properly, in particular the # permalink glyph
 * Add some subtle animations for added delight.
 * responsive styles
 * set content_width (in jarvis_content_width and jarvis_after_setup_theme)
 * theme_colors
 * Remove "Dev: 1" from style.scss so that packages get build properly.
 * check custom page template styles
 * check custom logo properties are appropriate
 * rtl.css - "gulp rtl --theme jarvis"
 * theme scan
 * test site logo
 * test block colours
 * readme.txt
 * test hiding header and description through customizer works
 * test logo is still visible when you hide the header text
 * test custom header
 * test custom backgrounds
 * remove jarvis_widgets_overlay_body_class function there are no widgets in an overlay
 * check all registered menus are being used
 * check sidebar names and that sidebar display conditions match the sidebars they display
 * test print styles
 * go through required accessibility items - https://make.wordpress.org/themes/handbook/review/accessibility/required/
 * Test css on http://cssstats.com/ and make sure things look sensible.
 */


/**
 * Alternate styles
 * ---
 * paragraph - intro
 */

// WordPress specific functionality (actions and filters).
require get_parent_theme_file_path( 'inc/wordpress.php' );

// Filters that modify/ add to WordPress html classes to make them more useful.
require get_parent_theme_file_path( 'inc/wordpress-html-classes.php' );

// Generate styles based upon theme mods.
require get_parent_theme_file_path( 'inc/styles.php' );

// Custom header.
require get_parent_theme_file_path( 'inc/custom-header.php' );

// Featured Images.
require get_parent_theme_file_path( 'inc/featured-images.php' );

// Reusable Template Functions.
require get_parent_theme_file_path( 'inc/template-tags.php' );

// Social Icons.
require get_parent_theme_file_path( 'inc/svg-icons.php' );

// Backwards Compatability functions to ensure there are no errors with older WordPress.
require get_parent_theme_file_path( 'inc/compat.php' );

/**
 * Customizer Properties.
 */

// Load all of the customizer properties.
require get_parent_theme_file_path( 'inc/customizer/loader.php' );

/**
 * Plugins.
 */

/**
 * Jetpack specific functionality.
 *
 * @link https://jetpack.com/
 */
require get_parent_theme_file_path( 'inc/plugins/jetpack.php' );

/**
 * EditorsKit specific functionality.
 *
 * @link https://editorskit.com/
 */
if ( class_exists( 'EditorsKit' ) ) {
	require get_parent_theme_file_path( 'inc/plugins/editorskit.php' );
}


/**
 * Load WooCommerce compatibility file.
 *
 * @link https://woocommerce.com/
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_parent_theme_file_path( 'inc/plugins/woocommerce.php' );
}

/**
 * Add support for WP-Post-Series plugin
 *
 * @link https://wordpress.org/plugins/wp-post-series/
 */
if ( class_exists( 'WP_Post_Series' ) ) {
	require get_parent_theme_file_path( 'inc/plugins/wp-post-series.php' );
}
