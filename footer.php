<?php
/**
 * Footer Template
 *
 * The template for displaying the site footer. This includes the closing divs
 * that close the content opened in header.php - and all of the content after
 * (credits, widgets etc.)
 *
 * @link https://developer.wordpress.org/themes/template-files-section/partial-and-miscellaneous-template-files/#footer-php
 *
 * @package Jarvis
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	get_sidebar();
?>

	</div>

	<footer id="colophon" class="site-footer" role="contentinfo">

<?php
	get_sidebar( 'footer' );

	jarvis_social_links();
?>

		<a href="#header" class="scroll-to scroll-to-top">
<?php
	echo jarvis_svg( 'navigate-top' ); /* WPCS: xss ok. */
	esc_html_e( 'Top', 'jarvis' );
?>
		</a>

<?php

	/**
	 * Check to see if a custom credits option is set.
	 * If custom credits are set then the filter should output the credits and
	 * return a non false value. This will hide the default footer credits.
	 */
	if ( false === apply_filters( 'jarvis_credits', false ) ) {

?>

		<div class="site-info">
<?php
			if ( function_exists( 'the_privacy_policy_link' ) ) {
				the_privacy_policy_link( '', '<span role="separator" aria-hidden="true" class="sep"></span>' );
			}
?>
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'jarvis' ) ); ?>" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'jarvis' ); ?>" rel="generator">
<?php
			/* Translators: %s = WordPress (cms name) */
			printf( esc_html__( 'Proudly powered by %s', 'jarvis' ), 'WordPress' );
?>
			</a>

			<span role="separator" aria-hidden="true" class="sep"></span>
<?php
			/* Translators: %1$s = theme name, %2$s = theme author website */
			printf( esc_html__( 'Theme: %1$s by %2$s.', 'jarvis' ), 'Jarvis', '<a href="https://prothemedesign.com/">Pro Theme Design</a>' );
?>
		</div>

<?php

	}

?>

	</footer>

</div>

<?php wp_footer(); ?>

</body>
</html>
