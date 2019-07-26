<?php
/**
 * Footer Template
 *
 * Includes the site footer.
 *
 * Traditionally this file is included in theme-root/footer.php however in
 * Jarvis it has been split out into a partial so that page builders can
 * customize the footer more easily.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Jarvis
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */


	get_sidebar();
?>

	</div>

	<footer id="colophon" class="site-footer container" role="contentinfo">

<?php
	get_sidebar();

	jarvis_social_links();

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
				the_privacy_policy_link();
			}
?>

			<span role="separator" aria-hidden="true" class="sep"></span>

<?php
			/* Translators: %1$s = theme name, %2$s = theme author website */
			printf( esc_html__( 'Theme: %1$s by %2$s', 'jarvis' ), 'Jarvis', '<a href="https://prothemedesign.com/" rel="nofollow">Pro Theme Design</a>' );
?>

			<span role="separator" aria-hidden="true" class="sep"></span>

			<a href="#header"><?php esc_html_e( 'Top', 'jarvis' ); ?></a>

		</div>

<?php

	}

?>

	</footer>

</div>