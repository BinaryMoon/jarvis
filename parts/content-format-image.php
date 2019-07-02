<?php
/**
 * Image Content Template Partial
 *
 * Used to display image post format on archive pages.
 *
 * Will display the featured image. If there's no featured image it will check the post attachments and use those instead.
 *
 * Uses `parts/content.php` as a fallback if no images are found.
 *
 * @package Jarvis
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	$image = get_the_post_thumbnail( get_the_ID(), 'jarvis-archive-image' );

	// No image so use default post format.
	if ( ! $image ) {

		get_template_part( 'parts/content' );
		return;

	}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<a href="<?php the_permalink(); ?>" class="thumbnail" aria-hidden="true" tabindex="-1">
		<?php echo $image; // WPCS: XSS OK. ?>
	</a>

	<section class="entry entry-archive">

<?php
	the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

	get_template_part( 'parts/entry-meta' );
?>

	</section>

</article><!-- #post-<?php the_ID(); ?> -->
