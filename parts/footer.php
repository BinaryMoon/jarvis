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

?>

	<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">

		<meta itemprop="name" content="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
		<meta itemprop="url" content="<?php echo esc_attr( home_url( '/' ) ); ?>" />

<?php

	if ( has_custom_logo() ) {

		$image = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ) );

?>

		<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
			<meta itemprop="url" content="<?php echo esc_attr( current( $image ) ); ?>" />
			<meta itemprop="width" content="<?php echo esc_attr( next( $image ) ); ?>" />
			<meta itemprop="height" content="<?php echo esc_attr( next( $image ) ); ?>" />
		</div>

<?php

	}

?>

	</div>

<?php

	get_template_part( 'parts/navigation-social' );

	jarvis_credits_content();

?>

	</footer>

</div>
