<?php
/**
 * Testimonials Archive Template
 *
 * This is the template used to display Jetpack Testimonials post type.
 *
 * The Testimonials will display at: http://website.com/testimonial/
 *
 * @link https://jetpack.com/support/custom-content-types/
 *
 * @package Jarvis
 * @subpackage Template
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	get_header();
?>

	<main id="main" class="main-content testimonials content-testimonials content-masonry">

<?php

	if ( have_posts() ) {

		$image = jarvis_testimonials_image();

		if ( $image ) {

			$image_allowed_properties = array(
				'src' => array(),
				'width' => array(),
				'height' => array(),
				'class' => array(),
			);
?>

		<div class="header-image">

<?php
			echo wp_kses(
				$image,
				array(
					'img' => $image_allowed_properties,
				)
			);
?>

		</div>

<?php
		}
?>

		<header class="entry-archive-header">

			<h1 class="entry-title entry-archive-title"><?php jarvis_testimonials_title(); ?></h1>
			<?php jarvis_testimonials_description( '<div class="category-description">', '</div>' ); ?>

		</header>

<?php
		while ( have_posts() ) {

			the_post();
			get_template_part( 'parts/content', 'testimonial' );

		}

	} else {

		get_template_part( 'parts/content-empty' );

	}
?>

	</main>

<?php
	get_footer();
