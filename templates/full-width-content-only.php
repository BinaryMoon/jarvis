<?php
/**
 * Full-width Content Only
 *
 * Ideal for Page Builders.
 * The template is just a placeholder for those wanting to use Page Builders.
 * the sass/theme/_builder.scss file using the body class as a modifier.
 *
 * Template Name: Full-width Content Only
 *
 * @package Jarvis
 * @subpackage PageTemplate
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
			the_content();

		}
	}

?>

	</main>

<?php

	get_footer();
