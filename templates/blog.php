<?php
/**
 * Blog Template
 *
 * Template Name: Blog Posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Jarvis
 * @subpackage Template
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	get_header();

?>

	<main id="main" class="main-content content-single">

<?php

	if ( have_posts() ) {

		while ( have_posts() ) {

			the_post();
			get_template_part( 'parts/content-single', get_post_type() );

		}

	}

?>

	</main>

	<section class="content-posts main-content">

<?php

	$query = new WP_Query(
		array(
			'post_type' => array( 'post' ),
			'post_status' => array( 'publish' ),
			'nopaging' => false,
			'paged' => '1',
			'order' => 'DESC',
			'orderby' => 'date',
		)
	);

	if ( $query->have_posts() ) {

		while ( $query->have_posts() ) {

			$query->the_post();
			get_template_part( 'parts/content', 'format-' . get_post_format() );

		}

		get_template_part( 'parts/archive-pagination' );

	}

	wp_reset_postdata();

?>

	</section>

<?php

	get_footer();
