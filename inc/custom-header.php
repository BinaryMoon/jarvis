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
 * Print custom header styles.
 *
 * May also change other CSS properties related to the header colours.
 */
function jarvis_colour_styles() {

	/**
	 * Take care of header text color and visibility.
	 */
	$header_text_color = get_header_textcolor();

	/**
	 * If no custom options for text are set, let's bail.
	 * get_header_textcolor() options: Any hex value, 'blank' to hide text.
	 * Default: add_theme_support( 'custom-header' ).
	 */
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
		return;
	}

	if ( ! display_header_text() ) {
?>
<style>
	.masthead .site-title,
	.masthead .site-description {
		clip: rect( 1px, 1px, 1px, 1px );
		position: absolute;
	}
</style>
<?php
	} else {
?>
<style>
	.masthead .site-title,
	.masthead .site-title a,
	.masthead .site-title a:hover,
	.masthead p.site-description {
		color: #<?php echo esc_attr( $header_text_color ); ?>;
	}
</style>
<?php
	}

}

add_action( 'wp_head', 'jarvis_colour_styles' );