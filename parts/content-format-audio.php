<?php
/**
 * Audio Content Template Partial
 *
 * Used to display the audio post format on archive pages.
 *
 * Uses `parts/content.php` as a fallback if no audio files are found.
 *
 * @package Jarvis
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	$content = apply_filters( 'the_content', get_the_content() );
	$audio = get_media_embedded_in_content( $content, array( 'audio' ) );

	if ( ! $audio ) {

		get_template_part( 'parts/content' );
		return;

	}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php

	get_template_part( 'parts/entry-meta' );

	the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

?>

	<div class="entry-audio">
		<?php echo $audio[0]; /* WPCS: xss ok. */ ?>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
