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

		<header class="entry-archive-header">

			<h1 class="entry-title entry-archive-title">
<?php

		/**
		 * If there is a search query then show 'Search results for:'. If
		 * there's no query then just use 'Search:`
		 *
		 * This allows the search results page to also be used as a search page
		 * that can be linked to from anywhere.
		 */
		if ( '' === get_search_query() ) {
			echo esc_html__( 'Search:', 'jarvis' );
		} else {
			echo esc_html__( 'Search results for:', 'jarvis' );
		}

?>
			</h1>

			<div class="search-wrapper">
				<?php get_search_form(); ?>
			</div>

		</header>

<?php

	if ( have_posts() && '' !== get_search_query() ) {

		while ( have_posts() ) {

			the_post();
			get_template_part( 'parts/content', 'format-' . get_post_format() );

		}

		get_template_part( 'parts/archive-pagination' );

	}

?>

	</main>

<?php
	get_footer();
