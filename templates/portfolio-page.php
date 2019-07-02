<?php
/**
 * Portfolio template
 *
 * Displays your portfolio on a static page. Mimics the portfolio archive,
 * however this can be added as a static front page for portfolio websites.
 *
 * Template Name: Portfolio
 *
 * @package Jarvis
 * @subpackage PageTemplate
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	get_header();

?>

	<main id="main">

		<div class="main-content content-single">

<?php
	if ( have_posts() ) {

		while ( have_posts() ) {

			the_post();

			get_template_part( 'parts/content-single', get_post_type() );

		}
	}
?>

		</div>

<?php

	jarvis_project_terms();

	$query = new WP_Query(
		array(
			'post_type' => 'jetpack-portfolio',
			'posts_per_page' => 999,
			'ignore_sticky_posts' => true,
			'no_found_rows' => true,
		)
	);

	if ( $query->have_posts() ) {
?>

		<div id="main-content" class="main-content content-posts">

<?php
		while ( $query->have_posts() ) {

			$query->the_post();

			get_template_part( 'parts/content', 'format-' . get_post_format() );

		}
?>

		</div>

<?php
	} else {
?>

		<div class="main-content">

<?php
		get_template_part( 'content-empty' );
?>

		</div>

<?php
	}

	wp_reset_postdata();
?>

	</main>

<?php
	get_footer();
