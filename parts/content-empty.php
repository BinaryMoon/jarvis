<?php
/**
 * No Content Template Partial
 *
 * Display an empty template that lets the user know what is happening. The
 * content is contextual and varies depending upon the page it is displayed on,
 * and the person who is viewing the content.
 *
 * @link https://developer.wordpress.org/themes/template-files-section/partial-and-miscellaneous-template-files/#content-slug-php
 *
 * @package Jarvis
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

?>

<article class="page-404 post-singular no-results not-found">

	<h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'jarvis' ); ?></h1>

	<section class="entry">

<?php
	if ( is_home() && current_user_can( 'publish_posts' ) ) {

		printf(
			'<p>' . wp_kses(
				/* Translators: %1$s: admin url */
				__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'jarvis' ),
				array(
					'a' => array(
						'href' => array(),
					),
				)
			) . '</p>',
			esc_url( admin_url( 'post-new.php' ) )
		);

	} if ( is_search() ) {
?>

		<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'jarvis' ); ?></p>

		<div class="search-wrapper">
			<?php get_search_form(); ?>
		</div>

<?php
	} else {
?>

		<p><?php esc_html_e( 'It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'jarvis' ); ?></p>

		<div class="search-wrapper">
			<?php get_search_form(); ?>
		</div>

<?php
	}
?>

	</section>

</article>
