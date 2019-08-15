<?php
/**
 * Generic Content Template Partial
 *
 * @package Jarvis
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	$jarvis_image = jarvis_archive_image();

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php

	if ( $jarvis_image ) {

?>

	<a href="<?php the_permalink(); ?>" class="entry-thumbnail" aria-hidden="true" tabindex="-1">
		<?php echo $jarvis_image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</a>

<?php

	}

	get_template_part( 'parts/entry-meta' );

	the_title( '<h2 class="entry-title summary"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

?>

	<section class="entry entry-archive entry-summary p-summary">

		<?php the_excerpt(); ?>

		<p class="entry-meta"><a href="<?php the_permalink(); ?>" class="read-more" aria-hidden="true" tabindex="-1"><?php jarvis_read_more_text(); ?></a></p>

	</section>

</article><!-- #post-<?php the_ID(); ?> -->
