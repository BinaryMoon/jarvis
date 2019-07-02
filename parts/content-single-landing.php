<?php
/**
 * Single Post Content Template Partial
 *
 * This is the default content layout for all single posts (all custom post
 * types). It can be overriden by creating a new template in the parts folder
 * with the name content-single-[CUSTOM-POST-TYPE].php.
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
	the_title( '<h1 class="entry-title">', '</h1>' );
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

	get_template_part( 'parts/edit-post' );

	wp_link_pages(
		array(
			'before' => '<div class="pagination">',
			'after' => '</div>',
			'pagelink' => '<span class="screen-reader-text">' . esc_html__( 'Page', 'jarvis' ) . ' </span>%',
		)
	);
?>

	</section>

</article>
