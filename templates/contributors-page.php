<?php
/**
 * Contributors page template
 *
 * Displays a list of all users from a website who have published at least one
 * blog post.
 *
 * Template Name: Contributors
 *
 * @package Jarvis
 * @subpackage PageTemplate
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	get_header();

	get_template_part( 'parts/featured-content' );
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

		<section class="entry-contributors">

<?php
			get_template_part( 'parts/content-contributors' );
?>

		</section>

	</main>

<?php
	get_footer();
