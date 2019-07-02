<?php
/**
 * Individual Testimonial Template Partial
 *
 * Display Jetpack Testimonial
 *
 * @package Jarvis
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	$image = get_the_post_thumbnail(
		get_the_ID(),
		'jarvis-archive',
		array(
			'class' => 'avatar',
		)
	);
?>

<article id="post-<?php the_ID(); ?>" class="testimonial">

	<div class="entry">

<?php
	the_content(
		sprintf(
			/* Translators: %s: Post title */
			esc_html__( 'Read more %s', 'jarvis' ),
			the_title( '<span class="screen-reader-text">', '</span>', false )
		)
	);
?>

	</div>

	<div class="entry-meta">

<?php
	if ( $image ) {
		echo $image; // WPCS: XSS OK.
	}

	the_title( '<h3>', '</h3>' );
?>

	</div>

</article><!-- #post-<?php the_ID(); ?> -->
