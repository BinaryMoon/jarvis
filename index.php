<?php
/**
 * Homepage Template
 *
 * This template is the fallback for every template in the theme. If a required
 * template doesn't exist then this is the template that will be used.
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

	<main id="main" class="main-content content-posts">

<?php
	if ( have_posts() ) {

		while ( have_posts() ) {

			the_post();
			get_template_part( 'parts/content', 'format-' . get_post_format() );

		}

		get_template_part( 'parts/archive-pagination' );

	} else {

		get_template_part( 'parts/content-empty' );

	}
?>

	</main>

<?php
		get_footer();
