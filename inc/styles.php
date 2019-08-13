<?php
/**
 * Generate styles based upon theme settings set in the customizer.
 *
 * @package Jarvis
 * @subpackage WordPress
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

/**
 * Return a list of websafe fonts.
 *
 * The font list was retried from Pro Theme Design:
 * @see https://github.com/BinaryMoon/pro-theme-design/blob/master/views/_tools/_websafe-fonts/index.php
 *
 * @uses inc/customizer/fonts.php
 */
function jarvis_get_fonts() {

	$fonts = array(
		'arial' => [ 'Arial', 'Arial, Helvetica Neue, Helvetica, sans-serif' ],
		'arial-black' => [ 'Arial Black', 'Arial Black, Arial Bold, Gadget, sans-serif' ],
		'arial-narrow' => [ 'Arial Narrow', 'Arial Narrow, Arial, sans-serif' ],
		'arial-rounded' => [ 'Arial Rounded', 'Arial Rounded MT Bold, Helvetica Rounded, Arial, sans-serif' ],
		'baskerville' => [ 'Baskerville', 'Baskerville, Baskerville Old Face, Hoefler Text, Garamond, Times New Roman, serif' ],
		'bitstream-sans' => [ 'Bitstream Vera', 'Bitstream Vera, Trebuchet MS, Verdana, sans-serif' ],
		'bitstream-serif' => [ 'Bitstream Vera Serif', 'Bitstream Vera Serif, Liberation Serif, Georgia, serif' ],
		'book-antiqua' => [ 'Book Antiqua', 'Book Antiqua, Palatino, Palatino Linotype, Palatino LT STD, Georgia, serif' ],
		'bookman' => [ 'Bookman', 'Bookman, Bookman Old Style, Book Antiqua, Palatino, serif' ],
		'calibri' => [ 'Calibri', 'Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif' ],
		'cambria' => [ 'Cambria', 'Cambria, Georgia, serif' ],
		'century-gothic' => [ 'Century Gothic', 'Century Gothic, CenturyGothic, AppleGothic, sans-serif' ],
		'copperplate' => [ 'Copperplate', 'Copperplate Light, Copperplate Gothic Light, serif' ],
		'comic-sans' => [ 'Comic Sans', 'Comic Sans, Comic Sans MS, sans-serif' ],
		'constantia' => [ 'Constantia', 'Constantia, "Lucida Bright", Lucidabright, "Lucida Serif", Lucida, Georgia serif' ],
		'consolas' => [ 'Consolas', 'Consolas, monaco, monospace' ],
		'courier' => [ 'Courier', 'Courier, monospace' ],
		'courier-new' => [ 'Courier New', 'Courier New, Courier, Lucida Sans Typewriter, Lucida Typewriter, monospace' ],
		'franklin-gothic' => [ 'Franklin Gothic', 'Franklin Gothic Medium, Franklin Gothic, ITC Franklin Gothic, Arial, sans-serif' ],
		'frutiger' => [ 'Frutiger', '"Frutiger Linotype", Univers, Calibri, Gill Sans, Gill Sans MT, Century Gothic, Calibri, sans-serif' ],
		'futura' => [ 'Futura', 'Futura, Trebuchet MS, Arial, sans-serif' ],
		'garamond' => [ 'Garamond', 'Garamond, Baskerville, Baskerville Old Face, Hoefler Text, Times New Roman, serif' ],
		'geneva' => [ 'Geneva', 'Geneva, Tahoma, Verdana, sans-serif' ],
		'georgia' => [ 'Georgia', 'Georgia, Times, Times New Roman, serif' ],
		'gill-sans' => [ 'Gill Sans', 'Gill Sans, Gill Sans MT, Century Gothic, Calibri, sans-serif' ],
		'haettenschweiler' => [ 'Haettenschweiler', 'Haettenschweiler, Impact, Franklin Gothic Bold, Charcoal, Helvetica Inserat, Bitstream Vera Sans Bold, Arial Black, sans-serif' ],
		'helvetica' => [ 'Helvetica', 'Helvetica Neue, Helvetica, Arial, sans-serif' ],
		'hoefler' => [ 'Hoefler', 'Hoefler Text, Baskerville Old Face, Garamond, Times New Roman, serif' ],
		'impact' => [ 'Impact', 'Impact, Haettenschweiler, Franklin Gothic Bold, Charcoal, Helvetica Inserat, Bitstream Vera Sans Bold, Arial Black, sans-serif' ],
		'lucida-bright' => [ 'Lucida Bright', 'Lucida Bright, Georgia, serif' ],
		'lucida-grande' => [ 'Lucida Grande', 'Lucida Grande, Lucida Sans Unicode, Lucida Sans, Geneva, Verdana, sans-serif' ],
		'lucida-console' => [ 'Lucida Console', 'Lucida Console, Lucida Sans Typewriter, monaco, Bitstream Vera Sans Mono, monospace' ],
		'menlo' => [ 'Menlo', 'Menlo, monaco, Consolas, Lucida Console, monospace' ],
		'palatino' => [ 'Palatino', 'Palatino, Palatino Linotype, Palatino LT STD, Book Antiqua, Georgia, serif' ],
		'segoe-ui' => [ 'Segoe UI', 'Segoe UI, Candara, Bitstream Vera Sans, Trebuchet MS, Verdana, sans-serif' ],
		'system' => [ 'System', '-apple-system, BlinkMacSystemFont, Segoe UI, Helvetica, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol' ],
		'system-mono' => [ 'System Monospace', 'SFMono-Regular, Consolas, Liberation Mono, Menlo, Courier, monospace' ],
		'tahoma' => [ 'Tahoma', 'Tahoma, Verdana, Segoe, sans-serif' ],
		'times-new-roman' => [ 'Times New Roman', 'TimesNewRoman, Times New Roman, Times, Baskerville, Georgia, serif' ],
		'trebuchet' => [ 'Trebuchet', 'Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif' ],
		'verdana' => [ 'Verdana', 'Verdana, Geneva, sans-serif' ],
	);

	return apply_filters( 'jarvis_fonts', $fonts );

}


/**
 * Generate the css required to display the custom fonts.
 *
 * @uses inc/customizer/fonts.php
 */
function jarvis_get_font_css() {

	$fonts = jarvis_get_fonts();

	$styles = array();

	$styles[] = 'body { --font-body:' . $fonts[ get_theme_mod( 'jarvis_body_font', 'cambria' ) ][1] . '; }';
	$styles[] = 'body { --font-title:' . $fonts[ get_theme_mod( 'jarvis_title_font', 'cambria' ) ][1] . '; }';
	$styles[] = 'body { --font-header:' . $fonts[ get_theme_mod( 'jarvis_header_font', 'cambria' ) ][1] . '; }';

	return implode( $styles, ' ' );

}


/**
 * Get a json encoded variable containing a list of all the available fonts.
 *
 * @uses inc/customizer/fonts.php
 */
function jarvis_get_font_json() {

	$fonts = jarvis_get_fonts();

	return 'jarvis_fonts = ' . wp_json_encode( $fonts ) . ';';

}


/**
 * Generate the css required to display single posts properly.
 *
 * @uses inc/customizer/single.php
 *
 * @return string CSS styles for single post layout.
 */
function jarvis_get_single_css() {

	if ( is_customize_preview() ) {
		return '';
	}

	$styles = array();

	if ( ! get_theme_mod( 'jarvis_single_show_author', true ) ) {
		$styles[] = 'html .byline { display: none; }';
	}

	if ( ! get_theme_mod( 'jarvis_single_show_date', true ) ) {
		$styles[] = 'html .posted-on { display: none; }';
	}

	if ( ! get_theme_mod( 'jarvis_single_show_categories', true ) ) {
		$styles[] = 'html .entry-terms { display: none; }';
	}

	return implode( $styles, ' ' );

}


/**
 * Print custom header styles.
 *
 * This includes showing and hiding elements, and changing the heading colours.
 *
 * @see inc/custom-header.php
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

	$styles[] = 'body { --title-color: ' . esc_attr( get_theme_mod( 'jarvis_title_color', '#000000' ) ) . '}';

	return implode( $styles, ' ' );

}
