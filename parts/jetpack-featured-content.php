<?php
/**
 * Jetpack Featured Content
 *
 * @link https://jetpack.me/support/featured-content/
 *
 * @package Jarvis
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	if ( ! jarvis_has_featured_posts() ) {
		return;
	}

	$featured_posts = jarvis_get_featured_posts();

?>

	<section class="showcase">

<?php
	foreach ( $featured_posts as $featured_post ) {

		setup_postdata( $featured_post );

		get_template_part( 'parts/content', 'slider' );

	}
?>

	</section>

<?php

	wp_reset_postdata();
