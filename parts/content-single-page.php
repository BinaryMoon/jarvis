<?php
/**
 * Page Content Template Partial
 *
 * Display page content.
 *
 * @package Jarvis
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

<?php
	jarvis_breadcrumbs();

	// If page is set as static homepage.
	if ( is_front_page() ) {

		the_title( '<h2 class="entry-title">', '</h2>' );

	} else {

		the_title( '<h1 class="entry-title">', '</h1>' );

	}

	get_template_part( 'parts/entry-meta' );
?>

	</header>

	<section class="entry entry-single">

<?php
	the_content(
		sprintf(
			/* Translators: %s: Post title */
			esc_html__( 'Read more %s', 'jarvis' ),
			the_title( '<span class="screen-reader-text">', '</span>', false )
		)
	);

	wp_link_pages(
		array(
			'before' => '<div class="pagination">',
			'after' => '</div>',
			'pagelink' => '<span class="screen-reader-text">' . esc_html__( 'Page', 'jarvis' ) . ' </span>%',
		)
	);
?>

	</section>

</article><!-- #post-<?php the_ID(); ?> -->
