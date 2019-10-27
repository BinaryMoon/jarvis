<?php
/**
 * Theme Customizer
 *
 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/
 *
 * @package Jarvis
 * @subpackage ThemeCustomizerSettings
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

/**
 * Exit if we're not in the Customizer.
 */
if ( ! class_exists( 'WP_Customize_Control' ) ) {

	return null;

}

// Customizer Sanitization functions.
require get_parent_theme_file_path( 'inc/customizer/customizer-sanitization.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

// A custom control that allows users to select fonts.
require get_parent_theme_file_path( 'inc/customizer/class-jarvis-font-selector.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

// A custom control that adds a link to the docs in the customizer.
require get_parent_theme_file_path( 'inc/customizer/class-jarvis-doc-link.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

// Customizer controls for setting theme properties.
require get_parent_theme_file_path( 'inc/customizer/settings.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

// Customizer controls for custom colours.
require get_parent_theme_file_path( 'inc/customizer/colours.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

// Custom header layout.
require get_parent_theme_file_path( 'inc/customizer/site-header.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

// Custom single post layout.
require get_parent_theme_file_path( 'inc/customizer/single.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

// Custom footer. To allow for custom credits/ copyright info.
require get_parent_theme_file_path( 'inc/customizer/footer.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

// Custom single post layout.
require get_parent_theme_file_path( 'inc/customizer/archive.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

// Custom fonts.
require get_parent_theme_file_path( 'inc/customizer/fonts.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
