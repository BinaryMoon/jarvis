<?php
/**
 * Gallery Content Template Partial
 *
 * Used to display the gallery post format in archive pages.
 *
 * Uses `parts/content.php` as a fallback if no galleries are found.
 *
 * @package Jarvis
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	$gallery = get_post_gallery( get_the_ID() );

	// No gallery so use default layout.
	if ( ! $gallery ) {

		get_template_part( 'parts/content' );
		return;

	}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post-gallery">
		<?php echo $gallery; // WPCS: XSS OK. ?>
	</div>

	<section class="entry entry-archive">

<?php

	get_template_part( 'parts/entry-meta' );

	the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

?>

	</section>

</article><!-- #post-<?php the_ID(); ?> -->
