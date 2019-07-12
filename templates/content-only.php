<?php
/**
 * Content only page template
 *
 * Removes the site header and footer and just displays the page content.
 *
 * Template Name: Content Only
 *
 * @package Jarvis
 * @subpackage PageTemplate
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

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


	</main>
