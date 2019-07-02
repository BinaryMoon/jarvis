<?php
/**
 * Archive Template
 *
 * This is the fallback archive template which works for all archive types if
 * there are no specific archive templates. If there are other templates, for
 * example category.php or tag.php then these will be used instead.
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

	<main id="main" class="main-content content-posts content-masonry">

<?php
	if ( have_posts() ) {
?>

		<header class="entry-archive-header">

<?php
		the_archive_title( '<h1 class="entry-title entry-archive-title">', '</h1>' );
		the_archive_description( '<div class="category-description">', '</div>' );

		if ( is_post_type_archive( 'jetpack-portfolio' ) || is_tax( 'jetpack-portfolio-type' ) ) {
			jarvis_project_terms();
		}
?>

		</header>

<?php
		while ( have_posts() ) {
			the_post();
			get_template_part( 'parts/content', 'format-' . get_post_format() );
		}

		the_posts_pagination(
			array(
				'mid_size' => 2,
				'prev_text' => esc_html__( 'Newer', 'jarvis' ),
				'next_text' => esc_html__( 'Older', 'jarvis' ),
				'before_page_number' => '<span class="screen-reader-text"> ' . __( 'page', 'jarvis' ) . ' </span>',
			)
		);

	} else {

		get_template_part( 'parts/content-empty' );

	}
?>

	</main>

<?php
	get_footer();
