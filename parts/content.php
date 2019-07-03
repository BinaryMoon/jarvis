<?php
/**
 * Generic Content Template Partial
 *
 * @package Jarvis
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	$image = get_the_post_thumbnail( get_the_ID(), 'jarvis-archive' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php

	get_template_part( 'parts/entry-meta' );

	the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

?>

	<section class="entry entry-archive">

		<?php the_excerpt(); ?>

		<p><a href="<?php the_permalink(); ?>" class="read-more"><?php jarvis_read_more_text(); ?></a></p>

	</section>

</article><!-- #post-<?php the_ID(); ?> -->
