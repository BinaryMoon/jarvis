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

	<main id="main">

<?php
	if ( have_posts() ) {
?>

		<div id="infinite-scroll" class="content-masonry-wrapper">

			<div id="main-content" class="main-content content-posts content-masonry">

<?php
		while ( have_posts() ) {

			the_post();
			get_template_part( 'parts/content', 'format-' . get_post_format() );

		}
?>

			</div>

		</div>

<?php
		the_posts_pagination(
			array(
				'mid_size' => 2,
				'prev_text' => esc_html__( 'Newer', 'jarvis' ),
				'next_text' => esc_html__( 'Older', 'jarvis' ),
				'before_page_number' => '<span class="screen-reader-text"> ' . __( 'page', 'jarvis' ) . ' </span>',
			)
		);

	} else {
?>

		<div class="main-content">

<?php
		get_template_part( 'parts/content-empty' );
?>

		</div>

<?php
	}
?>

	</main>

<?php
		get_footer();
