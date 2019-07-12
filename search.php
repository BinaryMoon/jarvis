<?php
/**
 * Search Results Template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
?>

		<header class="entry-archive-header">

			<h1 class="entry-title entry-archive-title">
<?php
		printf(
			wp_kses(
				/* Translators: %s: Search query */
				__( '<span>Search results for:</span> %s', 'jarvis' ),
				array(
					'span' => array(),
				)
			),
			esc_html( get_search_query() )
		);
?>
			</h1>

			<div class="search-wrapper">
				<?php get_search_form(); ?>
			</div>

		</header>


<?php
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
