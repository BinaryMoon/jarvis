<?php
/**
 * Image Attachment Template
 *
 * This file displays Image attachments on their own page with a link back to
 * the parent blog post/ page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Jarvis
 * @subpackage Template
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	get_header();

	if ( have_posts() ) {

?>

	<main id="main" class="main-content content-single">

<?php
		while ( have_posts() ) {

			the_post();
?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<header class="entry-header">

<?php
			the_title( '<h1 class="entry-title">', '</h1>' );
			get_template_part( 'parts/entry-meta' );
?>

			</header>

			<section class="entry">

				<div class="attachment-image">
					<?php echo wp_get_attachment_link( get_the_ID(), 'large' ); ?>
				</div>

				<div class="attachment-description entry-single">
<?php
			if ( has_excerpt() ) {
?>
					<div class="attachment-caption">
						<?php the_excerpt(); ?>
					</div>
<?php
			}

			the_content();
?>
				</div>
<?php
			if ( $post->post_parent ) {
?>

				<nav id="image-navigation" class="navigation image-navigation">
					<div class="nav-links">
						<span class="nav-parent">
							<a href="<?php echo esc_url( get_permalink( $post->post_parent ) ); ?>" rev="attachment" class="attachment-parent"><?php esc_html_e( '&lsaquo; Return to post', 'jarvis' ); ?></a>
						</span>
						<span class="nav-previous">
							<?php previous_image_link( false, esc_html__( 'Previous Image', 'jarvis' ) ); ?>
						</span>
						<span class="nav-next">
							<?php next_image_link( false, esc_html__( 'Next Image', 'jarvis' ) ); ?>
						</span>
					</div>
				</nav>

<?php
			}
?>

			</section>
		</article>

<?php
			get_template_part( 'parts/comments' );

		}
?>

	</main>

<?php
	}

	get_footer();
