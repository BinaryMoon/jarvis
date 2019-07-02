<?php
/**
 * Guestbook page template
 *
 * Displays a full-width page, with prominent comments styles. Allows for easy
 * creation of a Guestbook on a site.
 *
 * Template Name: Guestbook
 * Template Post Type: post, page
 *
 * @package Jarvis
 * @subpackage PageTemplate
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	get_header();
?>

	<main class="full-width guestbook">

		<div class="main-content content-single">

<?php
	if ( have_posts() ) {

		while ( have_posts() ) {

			the_post();

			get_template_part( 'parts/content-single', get_post_type() );
			get_template_part( 'parts/comments' );

		}
	}
?>

		</div>

	</main>

<?php
	get_footer();
