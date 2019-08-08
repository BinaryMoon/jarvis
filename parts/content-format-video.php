<?php
/**
 * Video Content Template Partial
 *
 * Used to display video post format on archive pages.
 *
 * Uses `parts/content.php` as a fallback if no videos are found.
 *
 * @package Jarvis
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	/**
	 * Apply the_content filter so that we can ensure the content we are parsing
	 * is using raw code and not random shortcodes that we do not know the name
	 * of.
	 */
	$content = apply_filters( 'the_content', get_the_content() ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
	$video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );

	if ( ! $video ) {

		get_template_part( 'parts/content' );

		return;

	}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php

	get_template_part( 'parts/entry-meta' );

	the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

	echo jarvis_video_wrapper( $video[0] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

?>

</article><!-- #post-<?php the_ID(); ?> -->
