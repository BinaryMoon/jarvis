<?php
/**
 * Jetpack Featured Content Slide
 *
 * @link https://jetpack.me/support/featured-content/
 *
 * @package Jarvis
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	$styles = array();
	$image = jarvis_get_attachment_image_src( get_the_ID(), 'jarvis-archive' );

	if ( $image ) {

		$styles = array(
			'background-image: url(' . esc_url( $image ) . ');',
		);

	}
?>

<article <?php post_class(); ?> style="<?php echo esc_attr( implode( ' ', $styles ) ); ?>">

<?php
	the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

	get_template_part( 'parts/edit-post' );
?>

</article><!-- #post-<?php the_ID(); ?> -->
