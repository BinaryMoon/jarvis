<?php
/**
 * Reusable Template Functions
 *
 * Functions that can be used directly inside theme files to add functionality/
 * features to the theme.
 *
 * @package Jarvis
 * @subpackage TemplateTags
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

/**
 * Prints HTML with meta information for the current post-date or time.
 *
 * The time is generated by {@see jarvis_human_time_diff}.
 */
function jarvis_post_time() {

	$time_string = sprintf(
		'<time class="entry-date published updated dt-published" datetime="%1$s">%2$s</time>',
		esc_attr( get_the_date( 'c' ) ),
		esc_attr( get_the_date() )
	);

	$posted_on = '<a href="' . esc_url( get_permalink() ) . '" class="u-url" rel="bookmark">' . $time_string . '</a>';

	echo '<span class="posted-on meta">' . $posted_on . '</span>'; /* WPCS: xss ok. */

}


/**
 * Prints HTML with the author meta data.
 */
function jarvis_post_author() {

	if ( ! is_single() || is_attachment() ) {
		return;
	}

	echo sprintf(
		'<span class="byline meta author v-card"><a class="url fn n p-name u-url" href="%s">%s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_html( get_the_author() )
	);

}


/**
 * Display a link to the Jarvis Comments.
 *
 * Used in post meta, and adds a smooth scroll effect to add context to the
 * comments position.
 */
function jarvis_comments_link() {

	if ( ! post_password_required() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {

		$class = '';

		echo '<span class="comment-count meta">';

		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'jarvis' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				esc_html( get_the_title() )
			),
			false,
			false,
			$class
		);

		echo '</span>';

	}

}


/**
 * Get the posts custom read more text and, if available, display it instead of
 * 'read more'.
 */
function jarvis_read_more_text() {

	// Get post data.
	$post = get_post();
	$custom_readmore = get_extended( $post->post_content );

	if ( ! empty( $custom_readmore['more_text'] ) ) {

		echo esc_html( $custom_readmore['more_text'] );
		return;

	}

	// Default text value.
	printf(
		/* translators: %s: post title */
		esc_html__( 'Read more %s', 'jarvis' ),
		'<span class="screen-reader-text">' . esc_html( the_title( '', '', false ) ) . '</span>'
	);

}


/**
 * Get a list of children pages for the current page.
 *
 * @return WP_Query
 */
function jarvis_child_pages() {

	return new WP_Query(
		array(
			'post_type' => 'page',
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'post_parent' => get_the_ID(),
			'posts_per_page' => 99,
			'no_found_rows' => true,
		)
	);

}


/**
 * Display a specific user and their contributor info.
 *
 * This is used at the end of blog posts, and on the contributor-page.php custom
 * page template.
 *
 * @param integer $user_id ID of current contributor.
 * @param integer $post_count Optional post count for current contributor. If
 *                            set then also display a list of recent blog posts.
 */
function jarvis_contributor( $user_id = null, $post_count = null ) {

	if ( ! get_theme_mod( 'jarvis_single_show_author_details', true ) && ! is_customize_preview() ) {
		return false;
	}

	// If no user id set then get th user for the current post.
	if ( ! $user_id ) {
		$user_id = get_the_author_meta( 'ID' );
	}

?>

	<section class="entry-author contributor h-card">

		<?php echo get_avatar( $user_id, 250, '', '', array( 'class' => 'u-photo' ) ); ?>

		<div class="entry">

			<h2 class="author v-card">
				<a class="url fn n p-name u-url" href="<?php echo esc_url( get_author_posts_url( $user_id ) ); ?>">
					<?php the_author_meta( 'display_name', $user_id ); ?>
				</a>
			</h2>

<?php

	the_author_meta( 'description', $user_id );

	if ( $post_count ) {

?>

		<p>
			<a class="contributor-posts-link" href="<?php echo esc_url( get_author_posts_url( $user_id ) ); ?>">
<?php
		/* Translators: %d: Number of articles written by a particular author. */
		printf( esc_html( _n( '%d Article', '%d Articles', (int) $post_count, 'jarvis' ) ), (int) $post_count );
?>
			</a>
		</p>

<?php

	}

?>

		</div>

	</section>

<?php

}


/**
 * Display a list of all of the project categories.
 */
function jarvis_project_terms() {

	$terms = get_terms(
		'jetpack-portfolio-type',
		array(
			'number' => 20,
			'orderby' => 'count',
			'order' => 'DESC',
		)
	);

	// Highlight currently selected page.
	$class = 'current-page';

	// Get the term for the current page.
	$current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

	// We're on a project category page, and not the main portfolio page, so reset the class.
	if ( $current_term ) {
		$class = '';
	}

	// Make sure the term exists and has some results.
	if ( is_wp_error( $terms ) || empty( $terms ) ) {
		return false;
	}

	// All clear - let's display the terms.
?>
	<p class="projects-terms">

		<span class="project-terms-intro">
			<?php esc_html_e( 'Categories:', 'jarvis' ); ?>
		</span>

		<a class="<?php echo esc_attr( $class ); ?>" href="<?php echo esc_url( home_url( '/portfolio/' ) ); ?>"><?php esc_html_e( 'All', 'jarvis' ); ?></a>

<?php
		foreach ( $terms as $t ) {
			$class = '';

			if ( $current_term && $current_term->term_id === (int) $t->term_id ) {
				$class = 'current-page';
			}
?>
		<a class="<?php echo esc_attr( $class ); ?>" href="<?php echo esc_url( get_term_link( $t ) ); ?>"><?php echo esc_html( $t->name ); ?></a>
<?php
		}
?>
	</p>
<?php

}


/**
 * Display featured images.
 *
 * But only if the archive article layout supports it, or it's a customizer
 * preview.
 */
function jarvis_archive_image() {

	$archive_articles = (int) get_theme_mod( 'jarvis_archive_articles', 0 );

	/**
	 * Featured images do not display on $archive_articles = 0 however we still
	 * display them if it's the customizer preview so that we can easily toggle
	 * between layouts.
	 */
	if ( 0 === $archive_articles && ! is_customize_preview() ) {
		return false;
	}

	return get_the_post_thumbnail( get_the_ID(), 'jarvis-archive' );

}
