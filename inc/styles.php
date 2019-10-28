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
 * The font list was inspired by Pro Theme Design.
 *
 * @link https://github.com/BinaryMoon/pro-theme-design/blob/master/views/_tools/_websafe-fonts/index.php
 * @uses inc/customizer/fonts.php
 */
function jarvis_get_fonts() {

	$fonts = array(
		'arial' => array( 'Arial', 'Arial, Helvetica Neue, Helvetica, sans-serif' ),
		'arial-black' => array( 'Arial Black', 'Arial Black, Arial Bold, Gadget, sans-serif' ),
		'arial-narrow' => array( 'Arial Narrow', 'Arial Narrow, Arial, sans-serif' ),
		'arial-rounded' => array( 'Arial Rounded', 'Arial Rounded MT Bold, Helvetica Rounded, Arial, sans-serif' ),
		'avenir' => array( 'Avenir', 'Avenir, Roboto, Gill Sans, Century Gothic, Calibri, sans-serif' ),
		'baskerville' => array( 'Baskerville', 'Baskerville, Baskerville Old Face, Hoefler Text, Garamond, Times New Roman, serif' ),
		'bitstream-sans' => array( 'Bitstream Vera', 'Bitstream Vera, Trebuchet MS, Verdana, sans-serif' ),
		'bitstream-serif' => array( 'Bitstream Vera Serif', 'Bitstream Vera Serif, Liberation Serif, Georgia, serif' ),
		'book-antiqua' => array( 'Book Antiqua', 'Book Antiqua, Palatino, Palatino Linotype, Palatino LT STD, Georgia, serif' ),
		'bookman' => array( 'Bookman', 'Bookman, Bookman Old Style, Book Antiqua, Palatino, serif' ),
		'brush-script' => array( 'Brush Script', 'Brush Script MT, cursive' ),
		'calibri' => array( 'Calibri', 'Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif' ),
		'cambria' => array( 'Cambria', 'Cambria, Georgia, serif' ),
		'century-gothic' => array( 'Century Gothic', 'Century Gothic, CenturyGothic, AppleGothic, sans-serif' ),
		'copperplate' => array( 'Copperplate', 'Copperplate, Copperplate Light, Copperplate Gothic Light, serif' ),
		'copperplate-light' => array( 'Copperplate Light', 'Copperplate Light, Copperplate Gothic Light, serif' ),
		'comic-sans' => array( 'Comic Sans', 'Comic Sans, Comic Sans MS, sans-serif' ),
		'constantia' => array( 'Constantia', 'Constantia, "Lucida Bright", Lucidabright, "Lucida Serif", Lucida, Georgia serif' ),
		'consolas' => array( 'Consolas', 'Consolas, monaco, monospace' ),
		'cormarant-infant' => array( 'Cormarant Infant', 'Cormorant Infant, Georgia, serif' ),
		'courier' => array( 'Courier', 'Courier, monospace' ),
		'courier-new' => array( 'Courier New', 'Courier New, Courier, Lucida Sans Typewriter, Lucida Typewriter, monospace' ),
		'franklin-gothic' => array( 'Franklin Gothic', 'Franklin Gothic Medium, Franklin Gothic, ITC Franklin Gothic, Arial, sans-serif' ),
		'frutiger' => array( 'Frutiger', '"Frutiger Linotype", Univers, Calibri, Gill Sans, Gill Sans MT, Century Gothic, Calibri, sans-serif' ),
		'futura' => array( 'Futura', 'Futura, Trebuchet MS, Arial, sans-serif' ),
		'garamond' => array( 'Garamond', 'Garamond, Baskerville, Baskerville Old Face, Hoefler Text, Times New Roman, serif' ),
		'geneva' => array( 'Geneva', 'Geneva, Tahoma, Verdana, sans-serif' ),
		'georgia' => array( 'Georgia', 'Georgia, Times, Times New Roman, serif' ),
		'gill-sans' => array( 'Gill Sans', 'Gill Sans, Gill Sans MT, Century Gothic, Calibri, sans-serif' ),
		'haettenschweiler' => array( 'Haettenschweiler', 'Haettenschweiler, Impact, Franklin Gothic Bold, Charcoal, Helvetica Inserat, Bitstream Vera Sans Bold, Arial Black, sans-serif' ),
		'helvetica' => array( 'Helvetica', 'Helvetica Neue, Helvetica, Arial, sans-serif' ),
		'hoefler' => array( 'Hoefler', 'Hoefler Text, Baskerville Old Face, Garamond, Times New Roman, serif' ),
		'impact' => array( 'Impact', 'Impact, Haettenschweiler, Franklin Gothic Bold, Charcoal, Helvetica Inserat, Bitstream Vera Sans Bold, Arial Black, sans-serif' ),
		'interui' => array( 'InterUI', 'InterUI, Arial, sans-serif' ),
		'lucida-bright' => array( 'Lucida Bright', 'Lucida Bright, Georgia, serif' ),
		'lucida-grande' => array( 'Lucida Grande', 'Lucida Grande, Lucida Sans Unicode, Lucida Sans, Geneva, Verdana, sans-serif' ),
		'lucida-console' => array( 'Lucida Console', 'Lucida Console, Lucida Sans Typewriter, monaco, Bitstream Vera Sans Mono, monospace' ),
		'menlo' => array( 'Menlo', 'Menlo, monaco, Consolas, Lucida Console, monospace' ),
		'palatino' => array( 'Palatino', 'Palatino, Palatino Linotype, Palatino LT STD, Book Antiqua, Georgia, serif' ),
		'papyrus' => array( 'Papyrus', 'Papyrus, fantasy' ),
		'segoe-ui' => array( 'Segoe UI', 'Segoe UI, Candara, Bitstream Vera Sans, Trebuchet MS, Verdana, sans-serif' ),
		'system' => array( 'System', '-apple-system, BlinkMacSystemFont, Segoe UI, Helvetica, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol' ),
		'system-mono' => array( 'System Monospace', 'SFMono-Regular, Consolas, Liberation Mono, Menlo, Courier, monospace' ),
		'tahoma' => array( 'Tahoma', 'Tahoma, Verdana, Segoe, sans-serif' ),
		'times-new-roman' => array( 'Times New Roman', 'TimesNewRoman, Times New Roman, Times, Baskerville, Georgia, serif' ),
		'trebuchet' => array( 'Trebuchet', 'Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif' ),
		'verdana' => array( 'Verdana', 'Verdana, Geneva, sans-serif' ),
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

	$styles[] = 'body {';

	$styles[] = '--font-body:' . $fonts[ get_theme_mod( 'jarvis_body_font', 'cambria' ) ][1] . ';';
	$styles[] = '--font-title:' . $fonts[ get_theme_mod( 'jarvis_title_font', 'cambria' ) ][1] . ';';
	$styles[] = '--font-header:' . $fonts[ get_theme_mod( 'jarvis_header_font', 'cambria' ) ][1] . ';';
	$styles[] = '--font-meta:' . $fonts[ get_theme_mod( 'jarvis_meta_font', 'cambria' ) ][1] . ';';

	$styles[] = '}';

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
 * Get the css for the site background colours.
 *
 * @return string
 */
function jarvis_get_colour_css() {

	$styles = array();

	$colour_light = get_theme_mod( 'jarvis_light_mode_colour', '#eedd33' );
	$colour_dark = $colour_light;

	/**
	 * Only use the dark mode background colour if the setting has been enabled.
	 * Else it will always use the default background colour.
	 */
	if ( get_theme_mod( 'jarvis_dark_mode', false ) ) {

		$colour_dark = get_theme_mod( 'jarvis_dark_mode_colour', '#004466' );

	}

	$black = apply_filters( 'jarvis_colour_black', '#000' );
	$white = apply_filters( 'jarvis_colour_white', 'rgba(255,255,255,0.9)' );

	$styles[] = 'body {';

	$styles[] = '--background-color-light:' . esc_attr( $colour_light ) . ';';
	$styles[] = '--background-color-dark:' . esc_attr( $colour_dark ) . ';';

	$styles[] = '--foreground-color-light:' . esc_attr( jarvis_colour_brightness( $colour_light ) ? $black : $white ) . ';';
	$styles[] = '--foreground-color-dark:' . esc_attr( jarvis_colour_brightness( $colour_dark ) ? $black : $white ) . ';';

	$styles[] = '--foreground-contrast-color-light:' . esc_attr( jarvis_colour_brightness( $colour_light ) ? $white : $black ) . ';';
	$styles[] = '--foreground-contrast-color-dark:' . esc_attr( jarvis_colour_brightness( $colour_dark ) ? $white : $black ) . ';';

	$styles[] = '}';

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

	$header_visibility = (int) get_theme_mod( 'jarvis_site_title', '0' );
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

	return implode( $styles, ' ' );

}
